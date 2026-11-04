<?php

class ItLab1Inventory
{
    private $db;
    private $table = "lab_it1_inventory";

    public function __construct()
    {
        require_once __DIR__ . '/../../config/database.php';
        $this->db = Database::connect();
    }

    // GET ALL ACTIVE INVENTORY ITEMS
    public function getAll()
    {
        $sql = "SELECT *
                FROM {$this->table}
                WHERE is_active = 1
                ORDER BY id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // GET ALL INACTIVE INVENTORY ITEMS
    public function getInactive()
    {
        $sql = "SELECT *
                FROM {$this->table}
                WHERE is_active = 0
                ORDER BY id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // GET INVENTORY ITEM BY ID
    // Includes inactive records for viewing
    public function getById($id)
    {
        $sql = "SELECT *
                FROM {$this->table}
                WHERE id = :id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => (int) $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CREATE ONE PHYSICAL INVENTORY ITEM
    public function create($data)
    {
        $sql = "INSERT INTO {$this->table}
                (
                    serial_number,
                    item_name,
                    category,
                    laboratory,
                    status,
                    is_active
                )
                VALUES
                (
                    :serial_number,
                    :item_name,
                    :category,
                    :laboratory,
                    :status,
                    1
                )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':serial_number' => trim($data['serial_number']),
            ':item_name'     => trim($data['item_name']),
            ':category'      => trim($data['category']),
            ':laboratory'    => 'IT Lab 1',
            ':status'        => strtolower(trim($data['status']))
        ]);
    }

    // UPDATE ONE PHYSICAL INVENTORY ITEM
    public function update($data)
    {
        $sql = "UPDATE {$this->table}
                SET
                    serial_number = :serial_number,
                    item_name = :item_name,
                    category = :category,
                    laboratory = :laboratory,
                    status = :status
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id'            => (int) $data['id'],
            ':serial_number' => trim($data['serial_number']),
            ':item_name'     => trim($data['item_name']),
            ':category'      => trim($data['category']),
            ':laboratory'    => 'IT Lab 1',
            ':status'        => strtolower(trim($data['status']))
        ]);
    }

    // DEACTIVATE INVENTORY ITEM
    public function deactivate($id)
    {
        $sql = "UPDATE {$this->table}
                SET is_active = 0
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => (int) $id
        ]);
    }

    // REACTIVATE INVENTORY ITEM
    public function activate($id)
    {
        $sql = "UPDATE {$this->table}
                SET is_active = 1
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => (int) $id
        ]);
    }

    // GET ACTIVE DAMAGED ITEMS
    // FOR IT LAB 1 DAMAGE MODULE
    public function getDamagedItems()
    {
        $sql = "SELECT
                    id,
                    serial_number,
                    item_name,
                    category,
                    laboratory,
                    status
                FROM {$this->table}
                WHERE status = 'damage'
                  AND is_active = 1
                ORDER BY id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}