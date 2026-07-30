<?php

class PsychoInvController
{

    public function index()
    {

        require __DIR__ . '/../../config/database.php';

        try {
            $db = Database::connect();

            $stmt = $db->prepare("SELECT * FROM psy_lab_inventory");
            $stmt->execute();

            $inventories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            require __DIR__ . '/../views/inventories/psych-lab/psycho-inventory.php';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function create()
    {
        require __DIR__ . '/../../config/database.php';

        $item_name      = $_POST['item_name'] ?? '';
        $category       = $_POST['category'] ?? '';
        $laboratory     = $_POST['laboratory'] ?? '';
        $total_item     = $_POST['total_item'] ?? 0;
        $available_item = $_POST['available_item'] ?? 0;
        $status         = $_POST['status'] ?? '';

        try {

            $db = Database::connect();

            $stmt = $db->prepare("
            INSERT INTO psy_lab_inventory
            (item_name, category, laboratory, total_item, available_item, status)
            VALUES
            (:item_name, :category, :laboratory, :total_item, :available_item, :status)
        ");

            $stmt->execute([
                ':item_name'      => $item_name,
                ':category'       => $category,
                ':laboratory'     => $laboratory,
                ':total_item'     => $total_item,
                ':available_item' => $available_item,
                ':status'         => $status
            ]);

            header('Location: ' . BASE_URL . '/psycho-inventory');
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

            $stmt = $db->prepare("SELECT * FROM psy_lab_inventory WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $inventory = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($inventory) {
                echo json_encode($inventory);
            } else {
                echo json_encode(['success' => false, 'message' => 'Inventory not found']);
            }
        } catch (PDOException $e) {
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        require __DIR__ . '/../../config/database.php';

        try {
            $db = Database::connect();

            $stmt = $db->prepare("DELETE FROM psy_lab_inventory WHERE id = :id");
            $stmt->execute([':id' => $id]);

            header('Location: ' . BASE_URL . '/psycho-inventory');
            exit();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function update()
    {
        require __DIR__ . '/../../config/database.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id             = $_POST['id'] ?? null;
            $item_name      = $_POST['item_name'] ?? '';
            $category       = $_POST['category'] ?? '';
            $laboratory     = $_POST['laboratory'] ?? '';
            $total_item     = $_POST['total_item'] ?? 0;
            $available_item = $_POST['available_item'] ?? 0;
            $status         = $_POST['status'] ?? '';

            try {

                $db = Database::connect();

                $stmt = $db->prepare("
                UPDATE psy_lab_inventory
                SET
                    item_name = :item_name,
                    category = :category,
                    laboratory = :laboratory,
                    total_item = :total_item,
                    available_item = :available_item,
                    status = :status
                WHERE id = :id
            ");

                $stmt->execute([
                    ':item_name'      => $item_name,
                    ':category'       => $category,
                    ':laboratory'     => $laboratory,
                    ':total_item'     => $total_item,
                    ':available_item' => $available_item,
                    ':status'         => $status,
                    ':id'             => $id
                ]);

                header('Location: ' . BASE_URL . '/psycho-inventory');
                exit();
            } catch (PDOException $e) {

                echo json_encode([
                    'success' => false,
                    'error' => $e->getMessage()
                ]);
            }
        }
    }
}
