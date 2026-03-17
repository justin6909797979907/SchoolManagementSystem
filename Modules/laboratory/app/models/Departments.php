<?php

require_once __DIR__ . '/core/Database.php';

class Departments extends Database
{
    protected $table = 'sd_department';
    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function all()
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM {$this->table}
            ORDER BY department_name ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}