<?php

class ScheduleModel
{
    protected $table = 'laboratory_schedule';

    private $db;

    public function __construct()
    {
        require __DIR__ . '/../../config/database.php';

        $this->db = Database::connect();
    }

    // GET ALL
    public function getAll()
    {
        $sql = "
            SELECT 
                s.*,
                l.laboratory_name
            FROM {$this->table} s
            INNER JOIN laboratories l 
                ON s.lab_id = l.lab_id
            ORDER BY s.day, s.start_time
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // GET ONE
    public function getById($id)
    {
        $sql = "
            SELECT *
            FROM {$this->table}
            WHERE schedule_id = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CREATE
    public function create($data)
    {
        $sql = "
            INSERT INTO {$this->table}
            (
                lab_id,
                subject_code,
                subject_name,
                instructor,
                section,
                day,
                start_time,
                end_time,
                semester,
                school_year,
                status,
                remarks
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['lab_id'],
            $data['subject_code'],
            $data['subject_name'],
            $data['instructor'],
            $data['section'],
            $data['day'],
            $data['start_time'],
            $data['end_time'],
            $data['semester'],
            $data['school_year'],
            $data['status'],
            $data['remarks']
        ]);
    }

    // UPDATE
    public function update($id, $data)
    {
        $sql = "
            UPDATE {$this->table}
            SET
                lab_id = ?,
                subject_code = ?,
                subject_name = ?,
                instructor = ?,
                section = ?,
                day = ?,
                start_time = ?,
                end_time = ?,
                semester = ?,
                school_year = ?,
                status = ?,
                remarks = ?
            WHERE schedule_id = ?
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['lab_id'],
            $data['subject_code'],
            $data['subject_name'],
            $data['instructor'],
            $data['section'],
            $data['day'],
            $data['start_time'],
            $data['end_time'],
            $data['semester'],
            $data['school_year'],
            $data['status'],
            $data['remarks'],
            $id
        ]);
    }

    // DELETE
    public function delete($id)
    {
        $sql = "
            DELETE FROM {$this->table}
            WHERE schedule_id = ?
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id]);
    }
}