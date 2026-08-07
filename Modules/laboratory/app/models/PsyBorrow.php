<?php

require_once __DIR__ . '/../../config/database.php';

class PsyBorrow
{
    private $conn;
    private $table = "psy_lab_borrow";

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    // all records
    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} ORDER BY id DESC");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // one record
    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // create
    public function create($data)
    {
        $sql = "INSERT INTO {$this->table}
        (
            laboratory,
            borrower_name,
            item_name,
            quantity,
            borrowed_date,
            returned_date,
            status
        )
        VALUES
        (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $data['laboratory'],
            $data['borrower_name'],
            $data['item_name'],
            $data['quantity'],
            $data['borrowed_date'],
            $data['returned_date'],
            $data['status']
        ]);
    }

    // update
    public function update($data)
    {
        $sql = "UPDATE {$this->table}
                SET
                    laboratory = ?,
                    borrower_name = ?,
                    item_name = ?,
                    quantity = ?,
                    borrowed_date = ?,
                    returned_date = ?,
                    status = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $data['laboratory'],
            $data['borrower_name'],
            $data['item_name'],
            $data['quantity'],
            $data['borrowed_date'],
            $data['returned_date'],
            $data['status'],
            $data['id']
        ]);
    }

    // ddelete
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}