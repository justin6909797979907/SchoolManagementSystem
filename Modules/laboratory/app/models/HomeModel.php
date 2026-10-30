<?php

require_once __DIR__ . '/../../config/database.php';

class HomeModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getEquipmentStatus()
    {
        $sql = "
        SELECT status COLLATE utf8mb4_unicode_ci AS status,
               COUNT(*) AS total
        FROM lab_phys_inventory
        WHERE is_active = 1
        GROUP BY status

        UNION ALL

        SELECT status COLLATE utf8mb4_unicode_ci AS status,
               COUNT(*) AS total
        FROM lab_psy_inventory
        WHERE is_active = 1
        GROUP BY status

        UNION ALL

        SELECT status COLLATE utf8mb4_unicode_ci AS status,
               COUNT(*) AS total
        FROM lab_ballistic_inventory
        WHERE is_active = 1
        GROUP BY status

        UNION ALL

        SELECT status COLLATE utf8mb4_unicode_ci AS status,
               COUNT(*) AS total
        FROM lab_chemistry_inventory
        WHERE is_active = 1
        GROUP BY status
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
