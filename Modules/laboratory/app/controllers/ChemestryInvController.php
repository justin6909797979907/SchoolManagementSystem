<?php

require_once __DIR__ . '/../models/chemInventory.php';

class ChemestryInvController
{
    // Start session when needed
    private function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Display active Chemistry inventory items
    public function index()
    {
        $this->startSession();

        $inventory = new ChemInventory();
        $inventories = $inventory->getAll();

        require __DIR__ . '/../views/inventories/crim-lab/chemestry/chemestry-inventory.php';
    }

    // Create one physical inventory item
    public function create()
    {
        $this->startSession();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "/chemestry-inventory");
            exit;
        }

        $data = [
            'serial_number' => trim($_POST['serial_number'] ?? ''),
            'item_name'     => trim($_POST['item_name'] ?? ''),
            'category'      => trim($_POST['category'] ?? ''),
            'laboratory'    => 'Chemistry Laboratory',
            'status'        => strtolower(trim($_POST['status'] ?? ''))
        ];

        if (
            $data['serial_number'] === '' ||
            $data['item_name'] === '' ||
            $data['category'] === '' ||
            !in_array($data['status'], [
                'working',
                'under maintenance',
                'damage',
                'unavailable'
            ], true)
        ) {
            $_SESSION['error'] = 'Invalid input. Please complete all fields and select a valid condition.';

            header("Location: " . BASE_URL . "/chemestry-inventory");
            exit;
        }

        $inventory = new ChemInventory();

        try {
            $inventory->create($data);

            $_SESSION['success'] = 'Chemistry inventory item successfully added!';

            header("Location: " . BASE_URL . "/chemestry-inventory");
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $_SESSION['error'] = 'That serial number already exists. Please use a unique serial number.';

                header("Location: " . BASE_URL . "/chemestry-inventory");
                exit;
            }

            throw $e;
        }
    }

    // Return item details for View/Edit modals
    public function view($id)
    {
        $inventory = new ChemInventory();
        $item = $inventory->getById((int) $id);

        header('Content-Type: application/json; charset=utf-8');

        if (!$item) {
            http_response_code(404);

            echo json_encode([
                'success' => false,
                'message' => 'Inventory item not found.'
            ]);

            exit;
        }

        echo json_encode($item);
        exit;
    }

    // Update one Chemistry inventory item
    public function update()
    {
        $this->startSession();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "/chemestry-inventory");
            exit;
        }

        $data = [
            'id'            => (int) ($_POST['id'] ?? 0),
            'serial_number' => trim($_POST['serial_number'] ?? ''),
            'item_name'     => trim($_POST['item_name'] ?? ''),
            'category'      => trim($_POST['category'] ?? ''),
            'laboratory'    => 'Chemistry Laboratory',
            'status'        => strtolower(trim($_POST['status'] ?? ''))
        ];

        if (
            $data['id'] <= 0 ||
            $data['serial_number'] === '' ||
            $data['item_name'] === '' ||
            $data['category'] === '' ||
            !in_array($data['status'], [
                'working',
                'under maintenance',
                'damage',
                'unavailable'
            ], true)
        ) {
            $_SESSION['error'] = 'Invalid input. Please check the item details.';

            header("Location: " . BASE_URL . "/chemestry-inventory");
            exit;
        }

        $inventory = new ChemInventory();

        try {
            $inventory->update($data);

            $_SESSION['success'] = 'Chemistry inventory item successfully updated!';

            header("Location: " . BASE_URL . "/chemestry-inventory");
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $_SESSION['error'] = 'That serial number is already assigned to another item.';

                header("Location: " . BASE_URL . "/chemestry-inventory");
                exit;
            }

            throw $e;
        }
    }

    // Display inactive Chemistry inventory items
    public function inactive()
    {
        $this->startSession();

        $inventory = new ChemInventory();
        $rows = $inventory->getInactive();

        require __DIR__ . '/../views/inventories/crim-lab/chemestry/chemInvInactive.php';
    }

    // Archive an inventory item without deleting it
    public function deactivate($id)
    {
        $this->startSession();

        $inventory = new ChemInventory();

        if ($inventory->deactivate((int) $id)) {
            $_SESSION['success'] = 'Chemistry inventory item successfully deactivated!';
        } else {
            $_SESSION['error'] = 'Unable to deactivate the inventory item.';
        }

        header("Location: " . BASE_URL . "/chemestry-inventory");
        exit;
    }

    // Restore an archived inventory item
    public function activate($id)
    {
        $this->startSession();

        $inventory = new ChemInventory();

        if ($inventory->activate((int) $id)) {
            $_SESSION['success'] = 'Chemistry inventory item successfully restored!';
        } else {
            $_SESSION['error'] = 'Unable to restore the inventory item.';
        }

        header("Location: " . BASE_URL . "/chemestry-inventory/inactive");
        exit;
    }
}