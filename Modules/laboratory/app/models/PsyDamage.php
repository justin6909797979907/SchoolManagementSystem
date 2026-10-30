<?php

class PsyDamage
{
    private $db;
    private $table = "lab_psy_damage";

    public function __construct()
    {
        require_once __DIR__ . '/../../config/database.php';
        $this->db = Database::connect();
    }

    /**
     * Synchronize Psychology inventory status based on active damage reports.
     *
     * Priority:
     * 1. Any pending report = damage
     * 2. Any under repair report = under maintenance
     * 3. Any written-off report = unavailable
     * 4. Otherwise, repaired reports = working
     */
    private function syncInventoryStatus($inventoryId)
    {
        $sql = "
            SELECT repair_status
            FROM {$this->table}
            WHERE inventory_id = :inventory_id
              AND is_active = 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':inventory_id' => (int) $inventoryId
        ]);

        $statuses = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Do not automatically change inventory status
        // when there are no active damage reports.
        if (empty($statuses)) {
            return true;
        }

        $normalizedStatuses = array_map(
            function ($status) {
                return strtolower(trim($status));
            },
            $statuses
        );

        if (in_array('pending', $normalizedStatuses, true)) {
            $inventoryStatus = 'damage';
        } elseif (in_array('under repair', $normalizedStatuses, true)) {
            $inventoryStatus = 'under maintenance';
        } elseif (in_array('written off', $normalizedStatuses, true)) {
            $inventoryStatus = 'unavailable';
        } elseif (in_array('repaired', $normalizedStatuses, true)) {
            $inventoryStatus = 'working';
        } else {
            throw new InvalidArgumentException(
                'Invalid repair status found for Psychology inventory ID: ' . $inventoryId
            );
        }

        $sql = "
            UPDATE lab_psy_inventory
            SET status = :status
            WHERE id = :inventory_id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':status' => $inventoryStatus,
            ':inventory_id' => (int) $inventoryId
        ]);
    }

    /**
     * Get all active Psychology damage records.
     */
    public function getAll()
    {
        $sql = "
            SELECT
                d.id,
                d.inventory_id,
                i.serial_number,
                i.item_name,
                i.laboratory,
                d.issue_description,
                d.accountable_department,
                d.reported_by,
                d.date_reported,
                d.repair_status,
                d.action_taken,
                d.remarks,
                (
                    SELECT ir.id
                    FROM lab_psy_incidents AS ir
                    WHERE ir.damage_id = d.id
                      AND ir.is_active = 1
                    LIMIT 1
                ) AS incident_id
            FROM {$this->table} AS d
            INNER JOIN lab_psy_inventory AS i
                ON d.inventory_id = i.id
            WHERE d.is_active = 1
            ORDER BY d.id DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get active Psychology inventory items for the Add Damage modal.
     */
    public function getInventoryItems()
    {
        $sql = "
            SELECT
                id,
                serial_number,
                item_name,
                category,
                laboratory,
                status
            FROM lab_psy_inventory
            WHERE is_active = 1
            ORDER BY item_name ASC, serial_number ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get one active Psychology damage record.
     */
    public function getById($id)
    {
        $sql = "
            SELECT
                d.id,
                d.inventory_id,
                i.serial_number,
                i.item_name,
                i.laboratory,
                d.issue_description,
                d.accountable_department,
                d.reported_by,
                d.date_reported,
                d.repair_status,
                d.action_taken,
                d.remarks,
                d.is_active
            FROM {$this->table} AS d
            INNER JOIN lab_psy_inventory AS i
                ON d.inventory_id = i.id
            WHERE d.id = :id
              AND d.is_active = 1
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => (int) $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create damage record and synchronize Psychology inventory.
     */
    public function create($data)
    {
        try {
            $this->db->beginTransaction();

            $inventoryId = (int) $data['inventory_id'];
            $repairStatus = strtolower(trim($data['repair_status']));

            $sql = "
                INSERT INTO {$this->table}
                (
                    inventory_id,
                    issue_description,
                    accountable_department,
                    reported_by,
                    date_reported,
                    repair_status,
                    action_taken,
                    remarks,
                    is_active
                )
                VALUES
                (
                    :inventory_id,
                    :issue_description,
                    :accountable_department,
                    :reported_by,
                    :date_reported,
                    :repair_status,
                    :action_taken,
                    :remarks,
                    1
                )
            ";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':inventory_id' => $inventoryId,
                ':issue_description' => trim($data['issue_description']),
                ':accountable_department' => trim($data['accountable_department']),
                ':reported_by' => trim($data['reported_by'] ?? ''),
                ':date_reported' => $data['date_reported'],
                ':repair_status' => $repairStatus,
                ':action_taken' => trim($data['action_taken'] ?? ''),
                ':remarks' => trim($data['remarks'] ?? '')
            ]);

            $this->syncInventoryStatus($inventoryId);

            $this->db->commit();

            return true;
        } catch (Throwable $e) {

            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            error_log('Psychology damage creation failed: ' . $e->getMessage());

            return false;
        }
    }

    /**
     * Update damage record and synchronize inventory.
     */
    public function update($data)
    {
        try {
            $this->db->beginTransaction();

            $damageId = (int) $data['id'];
            $newInventoryId = (int) $data['inventory_id'];
            $repairStatus = strtolower(trim($data['repair_status']));

            // Get the previous inventory ID.
            $sql = "
                SELECT inventory_id
                FROM {$this->table}
                WHERE id = :id
                  AND is_active = 1
                LIMIT 1
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id' => $damageId
            ]);

            $oldDamage = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$oldDamage) {
                $this->db->rollBack();
                return false;
            }

            $oldInventoryId = (int) $oldDamage['inventory_id'];

            $sql = "
                UPDATE {$this->table}
                SET
                    inventory_id = :inventory_id,
                    issue_description = :issue_description,
                    accountable_department = :accountable_department,
                    reported_by = :reported_by,
                    date_reported = :date_reported,
                    repair_status = :repair_status,
                    action_taken = :action_taken,
                    remarks = :remarks
                WHERE id = :id
                  AND is_active = 1
            ";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':id' => $damageId,
                ':inventory_id' => $newInventoryId,
                ':issue_description' => trim($data['issue_description']),
                ':accountable_department' => trim($data['accountable_department']),
                ':reported_by' => trim($data['reported_by'] ?? ''),
                ':date_reported' => $data['date_reported'],
                ':repair_status' => $repairStatus,
                ':action_taken' => trim($data['action_taken'] ?? ''),
                ':remarks' => trim($data['remarks'] ?? '')
            ]);

            // Synchronize the new inventory item.
            $this->syncInventoryStatus($newInventoryId);

            // Also synchronize the previous item if the inventory changed.
            if ($oldInventoryId !== $newInventoryId) {
                $this->syncInventoryStatus($oldInventoryId);
            }

            $this->db->commit();

            return true;
        } catch (Throwable $e) {

            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            error_log('Psychology damage update failed: ' . $e->getMessage());

            return false;
        }
    }

    /**
     * Get inactive Psychology damage records.
     */
    public function getInactive()
    {
        $sql = "
            SELECT
                d.id,
                d.inventory_id,
                i.serial_number,
                i.item_name,
                i.laboratory,
                d.issue_description,
                d.accountable_department,
                d.reported_by,
                d.date_reported,
                d.repair_status,
                d.action_taken,
                d.remarks
            FROM {$this->table} AS d
            INNER JOIN lab_psy_inventory AS i
                ON d.inventory_id = i.id
            WHERE d.is_active = 0
            ORDER BY d.id DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Archive damage record and synchronize inventory.
     */
    public function deactivate($id)
    {
        try {
            $this->db->beginTransaction();

            $sql = "
                SELECT inventory_id
                FROM {$this->table}
                WHERE id = :id
                  AND is_active = 1
                LIMIT 1
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id' => (int) $id
            ]);

            $damage = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$damage) {
                $this->db->rollBack();
                return false;
            }

            $inventoryId = (int) $damage['inventory_id'];

            $sql = "
                UPDATE {$this->table}
                SET is_active = 0
                WHERE id = :id
                  AND is_active = 1
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id' => (int) $id
            ]);

            $this->syncInventoryStatus($inventoryId);

            $this->db->commit();

            return true;
        } catch (Throwable $e) {

            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            error_log('Psychology damage archive failed: ' . $e->getMessage());

            return false;
        }
    }

    /**
     * Reactivate archived Psychology damage record.
     */
    public function activate($id)
    {
        try {
            $this->db->beginTransaction();

            $sql = "
                SELECT inventory_id, repair_status
                FROM {$this->table}
                WHERE id = :id
                  AND is_active = 0
                LIMIT 1
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id' => (int) $id
            ]);

            $damage = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$damage) {
                $this->db->rollBack();
                return false;
            }

            $inventoryId = (int) $damage['inventory_id'];
            $repairStatus = strtolower(trim($damage['repair_status']));

            if (
                in_array($repairStatus, ['pending', 'under repair'], true) &&
                $this->hasOpenDamage($inventoryId)
            ) {
                $this->db->rollBack();
                return false;
            }

            $sql = "
                UPDATE {$this->table}
                SET is_active = 1
                WHERE id = :id
                  AND is_active = 0
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id' => (int) $id
            ]);

            $this->syncInventoryStatus($inventoryId);

            $this->db->commit();

            return true;
        } catch (Throwable $e) {

            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            error_log('Psychology damage activation failed: ' . $e->getMessage());

            return false;
        }
    }

    /**
     * Check for an existing active pending or under-repair report.
     */
    public function hasOpenDamage($inventoryId, $excludeId = null)
    {
        $sql = "
            SELECT COUNT(*)
            FROM {$this->table}
            WHERE inventory_id = :inventory_id
              AND is_active = 1
              AND repair_status IN ('pending', 'under repair')
        ";

        $params = [
            ':inventory_id' => (int) $inventoryId
        ];

        if ($excludeId !== null) {
            $sql .= " AND id != :exclude_id";
            $params[':exclude_id'] = (int) $excludeId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (int) $stmt->fetchColumn() > 0;
    }
}
