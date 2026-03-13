<?php 
class DamageController 
{

    public function index()
    {
        require __DIR__ . '/../../config/database.php';
        
        
        try {
            $db = Database::connect();

            $stmt = $db->prepare("SELECT * FROM damage");
            $stmt->execute();

            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);



            require __DIR__ . '/../views/damages/damage.php';

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }

    public function create()
    {
        require __DIR__ . '/../../config/database.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $item = $_POST['item'];
                $description = $_POST['description'];
                $status = $_POST['status'];
                $code = $_POST['code'];
    
                try {
                    $db = Database::connect();
                    $stmt = $db->prepare("INSERT INTO damage (category, code,description, status) VALUES (:category, :code, :description, :status)");
                    $stmt->bindParam(':category', $item);
                    $stmt->bindParam(':code', $code);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':status', $status);
                    $stmt->execute();
    
                    header('Location: ' . BASE_URL . '/damages');
                    exit();
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }

    }

    public function view($id)
    {
        require __DIR__ . '/../../config/database.php';

        try {
            $db = Database::connect();
            $stmt = $db->prepare("SELECT * FROM damage WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $damage = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($damage) {
                echo json_encode($damage);
            } else {
                echo json_encode(['error' => 'Damage not found']);
            }
        } catch (PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
 }
