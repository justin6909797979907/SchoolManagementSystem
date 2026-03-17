<?php

require_once __DIR__ . '/core/DatabaseTwo.php';

class Issues extends DatabaseTwo
{
    protected $table = 'sd_issues';

    public function __construct()
    {
        $this->conn = DatabaseTwo::getInstance()->getConnection();
    }

    public function all()
    {
        $stmt = $this->conn->prepare("
            SELECT 
                i.*,
                d.department_name,
                CONCAT(e.first_name, ' ', e.last_name) AS submitted_by_name
            FROM {$this->table} i
            LEFT JOIN sd_department d ON i.department = d.department_id
            LEFT JOIN sms_employee e ON i.submitted_by = e.employee_id
            ORDER BY i.submitted_on DESC
        ");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $stmt = $this->conn->prepare("
        INSERT INTO {$this->table}
        (title, description, department, submitted_by, file_path)
        VALUES
        (:title, :description, :department, :submitted_by, :file_path)
    ");

        $stmt->execute([
            ':title'        => $data['title'],
            ':description'  => $data['description'],
            ':department'   => $data['department'],
            ':submitted_by' => $data['submitted_by'],
            ':file_path'    => $data['file_path'] ?? null
        ]);

        return $this->conn->lastInsertId();
    }
}
