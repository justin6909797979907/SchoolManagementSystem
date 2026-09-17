<?php

class BalDamage
{
    private $db;
    private $table = "lab_ballistic_damage";

    public function __construct()
    {
        require __DIR__ . '/../../config/database.php';
        $this->db = Database::connect();
    }

    // Get only active damage reports
    public function getAll()
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table}
             WHERE archived_at IS NULL
             ORDER BY id DESC"
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get one damage report
    public function getById($id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table}
             WHERE id = :id
             AND archived_at IS NULL"
        );

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create damage report
    public function create($data)
    {
        $sql = "INSERT INTO {$this->table}
        (
            item_name,
            laboratory,
            issue,
            reported_by,
            date_reported,
            status
        )
        VALUES
        (
            :item_name,
            :laboratory,
            :issue,
            :reported_by,
            :date_reported,
            :status
        )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':item_name'     => $data['item_name'],
            ':laboratory'    => $data['laboratory'],
            ':issue'         => $data['issue'],
            ':reported_by'   => $data['reported_by'],
            ':date_reported' => $data['date_reported'],
            ':status'        => $data['status']
        ]);
    }

    // Update damage report
    public function update($data)
    {
        $sql = "UPDATE {$this->table}
        SET
            item_name = :item_name,
            laboratory = :laboratory,
            issue = :issue,
            reported_by = :reported_by,
            date_reported = :date_reported,
            status = :status
        WHERE id = :id
        AND archived_at IS NULL";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id'            => $data['id'],
            ':item_name'     => $data['item_name'],
            ':laboratory'    => $data['laboratory'],
            ':issue'         => $data['issue'],
            ':reported_by'   => $data['reported_by'],
            ':date_reported' => $data['date_reported'],
            ':status'        => $data['status']
        ]);
    }

    // Archive damage report instead of permanently deleting
    public function archive($id)
    {
        $stmt = $this->db->prepare(
            "UPDATE {$this->table}
             SET archived_at = NOW()
             WHERE id = :id"
        );

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
