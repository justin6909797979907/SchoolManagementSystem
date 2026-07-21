<?php

class InventoryController
{


    protected $tableName = 'phys_lab_inventory';


    public function index()
    {

        require __DIR__ . '/../../config/database.php';
        try {
            $db = Database::connect();

            $stmt = $db->prepare("SELECT * FROM $this->tableName");
            $stmt->execute();

            $inventories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            require __DIR__ . '/../views/inventories/physics/inventory.php';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }




    public function create()
    {

    

        require __DIR__ . '/../../config/database.php';


        $item_name = $_POST['item_name'] ?? '';
        $category = $_POST['category'] ?? '';
        $total = $_POST['total_item'] ?? '';
        $available = $_POST['available_quantity'] ?? '';
        $laboratory = $_POST['laboratory'] ?? 'Physics Lab';
        $status = $_POST['status'] ?? '';


        try {

            $db = Database::connect();

            $stmt = $db->prepare("
                INSERT INTO $this->tableName(item_name, category, total_item, available_item, laboratory, status)
                VALUES(:item_name, :category, :total, :available, :laboratory, :status)
            ");

            $stmt->execute([
                ':item_name' => $item_name,
                ':category' => $category,
                ':laboratory' => $laboratory,
                ':total' => $total,
                ':available' => $available,
                ':status' => $status,
            ]);

            header('Location: ' . BASE_URL . '/inventory');
            exit();
        } catch (PDOException $e) {

            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }


    public function view($id)
    {

        header('Content-Type: application/json');

        require __DIR__ . '/../../config/database.php';

        try {
            $db = Database::connect();
            $stmt = $db->prepare("SELECT * FROM $this->tableName WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $inventory = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($inventory) {
                echo json_encode($inventory);
            } else {
                echo json_encode(['error' => 'Damage not found']);
            }
        } catch (PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function update()
    {

        header('Content-Type: application/json');

        require __DIR__ . '/../../config/database.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $id = $_POST['id'] ?? null;
            $category = $_POST['edit_category'] ?? '';
            $available = $_POST['edit_available'] ?? '';
            $total = $_POST['edit_total'] ?? '';

            try {
                $db = Database::connect();

                $stmt = $db->prepare("
                    UPDATE  $this->tableName    
                    SET category = :category,
                        total = :total,
                        available = :available
                    WHERE id = :id
                ");

                $stmt->execute([
                    ':category' => $category,
                    ':total' => $total,
                    ':available' => $available,
                    ':id' => $id,
                ]);

                echo json_encode(['success' => true, 'message' => 'Damage updated successfully']);
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
        }
    }


    public function destroy($id)
    {

        header('Content-Type: application/json');

        require __DIR__ . '/../../config/database.php';


        try {
            $db = Database::connect();

            $stmt = $db->prepare("DELETE FROM $this->tableName WHERE id = :id");
            $stmt->execute([':id' => $id]);

            echo json_encode([
                'success' => true,
                'message' => 'Damage deleted successfully'
            ]);
        } catch (PDOException $e) {
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
