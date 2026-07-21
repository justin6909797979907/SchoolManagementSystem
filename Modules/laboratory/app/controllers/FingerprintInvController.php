<?php 


class FingerprintInvController
{
 
    protected $tableName = 'fingerprint_lab_inventory';

    public function index()
    {


        require __DIR__ . '/../../config/database.php';

         try {
            $db = Database::connect();

            $stmt = $db->prepare("SELECT * FROM $this->tableName");
            $stmt->execute();

            $fingerprint_inventories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            require __DIR__ . '/../views/inventories/crim-lab/fingerprint/fingerprint-inventory.php';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }


    public function create()
    {

       require __DIR__ . '/../../config/database.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $item_name = $_POST['item_name'] ?? '';
            $category = $_POST['category'] ?? '';
            $laboratory = $_POST['laboratory'] ?? '';
            $total_item = $_POST['total_item'] ?? '';
            $available_item = $_POST['available_item'] ?? '';
            $status = $_POST['status'] ?? '';
           

            try {
                $db = Database::connect();
                $stmt = $db->prepare("INSERT INTO $this->tableName (item_name, category, laboratory,total_item,available_item,status) VALUES (:item_name, :category, :laboratory, :total_item, :available_item, :status)");
                $stmt->bindParam(':item_name', $item_name);
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':laboratory', $laboratory);
                $stmt->bindParam(':total_item', $total_item);
                $stmt->bindParam(':available_item', $available_item);
                $stmt->bindParam(':status', $status);
                $stmt->execute();

                header('Location: ' . BASE_URL . '/fingerprint-inventory');
                exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }   


}

