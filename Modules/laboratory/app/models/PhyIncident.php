<?php

class PhyIncident
{
    private $db;
    private $table = "lab_phys_incidents";

    public function __construct()
    {
        require_once __DIR__ . '/../../config/database.php';
        $this->db = Database::connect();
    }

    /**
     * Get all active incident reports.
     */
    public function getAll()
    {
        $sql = "
            SELECT
                i.*,
                inv.serial_number,
                inv.item_name
            FROM {$this->table} AS i
            LEFT JOIN lab_phys_inventory AS inv
                ON i.inventory_id = inv.id
            WHERE i.is_active = 1
            ORDER BY i.id DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get active inventory items.
     */
    public function getInventoryItems()
    {
        $sql = "
            SELECT id, serial_number, item_name, laboratory, status
            FROM lab_phys_inventory
            WHERE is_active = 1
            ORDER BY item_name ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get one active incident.
     */
    public function getById($id)
    {
        $sql = "
            SELECT
                i.*,
                inv.serial_number,
                inv.item_name
            FROM {$this->table} AS i
            LEFT JOIN lab_phys_inventory AS inv
                ON i.inventory_id = inv.id
            WHERE i.id = :id
              AND i.is_active = 1
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => (int) $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new incident report.
     */
    public function create($data)
    {
        $sql = "
            INSERT INTO {$this->table} (
                incident_number,
                inventory_id,
                incident_type,
                incident_date,
                laboratory,
                location_details,
                description,
                reported_by,
                people_involved,
                action_taken,
                severity,
                report_status,
                is_active
            ) VALUES (
                :incident_number,
                :inventory_id,
                :incident_type,
                :incident_date,
                :laboratory,
                :location_details,
                :description,
                :reported_by,
                :people_involved,
                :action_taken,
                :severity,
                :report_status,
                1
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':incident_number' => $data['incident_number'],
            ':inventory_id' => $data['inventory_id'],
            ':incident_type' => $data['incident_type'],
            ':incident_date' => $data['incident_date'],
            ':laboratory' => $data['laboratory'],
            ':location_details' => $data['location_details'],
            ':description' => $data['description'],
            ':reported_by' => $data['reported_by'],
            ':people_involved' => $data['people_involved'],
            ':action_taken' => $data['action_taken'],
            ':severity' => $data['severity'],
            ':report_status' => $data['report_status']
        ]);
    }

    /**
     * Update an active incident report.
     */
    public function update($data)
    {
        $sql = "
            UPDATE {$this->table}
            SET
                inventory_id = :inventory_id,
                incident_type = :incident_type,
                incident_date = :incident_date,
                laboratory = :laboratory,
                location_details = :location_details,
                description = :description,
                reported_by = :reported_by,
                people_involved = :people_involved,
                action_taken = :action_taken,
                severity = :severity,
                report_status = :report_status
            WHERE id = :id
              AND is_active = 1
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => (int) $data['id'],
            ':inventory_id' => $data['inventory_id'],
            ':incident_type' => $data['incident_type'],
            ':incident_date' => $data['incident_date'],
            ':laboratory' => $data['laboratory'],
            ':location_details' => $data['location_details'],
            ':description' => $data['description'],
            ':reported_by' => $data['reported_by'],
            ':people_involved' => $data['people_involved'],
            ':action_taken' => $data['action_taken'],
            ':severity' => $data['severity'],
            ':report_status' => $data['report_status']
        ]);
    }

    /**
     * Get archived incident reports.
     */
    public function getInactive()
    {
        $sql = "
            SELECT
                i.*,
                inv.serial_number,
                inv.item_name
            FROM {$this->table} AS i
            LEFT JOIN lab_phys_inventory AS inv
                ON i.inventory_id = inv.id
            WHERE i.is_active = 0
            ORDER BY i.id DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deactivate($id)
    {
        $sql = "
        UPDATE {$this->table}
        SET is_active = 0
        WHERE id = :id
          AND is_active = 1
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => (int) $id]);

        return $stmt->rowCount() > 0;
    }

    /**
     * Restore an archived incident report.
     */
    public function activate($id)
    {
        $sql = "
            UPDATE {$this->table}
            SET is_active = 1
            WHERE id = :id
              AND is_active = 0
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([':id' => (int) $id]);
    }
}
