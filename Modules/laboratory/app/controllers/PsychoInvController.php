<?php

require_once __DIR__ . '/../models/PsyInventory.php';

class PsychoInvController
{
    // Display active Psychology inventory items
    public function index()
    {
        $inventory = new PsyInventory();
        $inventories = $inventory->getAll();

        require __DIR__ . '/../views/inventories/psych-lab/psycho-inventory.php';
    }

    // Create one physical inventory item
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "/psycho-inventory");
            exit;
        }

        $data = [
            'serial_number' => trim($_POST['serial_number'] ?? ''),
            'item_name'     => trim($_POST['item_name'] ?? ''),
            'category'      => trim($_POST['category'] ?? ''),
            'laboratory'    => 'Psychology Laboratory',
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
            die('Invalid input. Please complete all fields and select a valid condition.');
        }

        $inventory = new PsyInventory();

        try {
            $inventory->create($data);

            header("Location: " . BASE_URL . "/psycho-inventory");
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                die('That serial number already exists. Please use a unique serial number.');
            }

            throw $e;
        }
    }

    // Return item details for the View/Edit modals
    public function view($id)
    {
        $inventory = new PsyInventory();
        $item = $inventory->getById((int) $id);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($item);
        exit;
    }

    // Update one Psychology inventory item
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "/psycho-inventory");
            exit;
        }

        $data = [
            'id'            => (int) ($_POST['id'] ?? 0),
            'serial_number' => trim($_POST['serial_number'] ?? ''),
            'item_name'     => trim($_POST['item_name'] ?? ''),
            'category'      => trim($_POST['category'] ?? ''),
            'laboratory'    => 'Psychology Laboratory',
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
            die('Invalid input. Please check the item details.');
        }

        $inventory = new PsyInventory();

        try {
            $inventory->update($data);

            header("Location: " . BASE_URL . "/psycho-inventory");
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                die('That serial number is already assigned to another item.');
            }

            throw $e;
        }
    }

    // Display inactive Psychology inventory items
    public function inactive()
    {
        $inventory = new PsyInventory();
        $rows = $inventory->getInactive();

        require __DIR__ . '/../views/inventories/psych-lab/psyInvInactive.php';
    }

    // Archive an item without deleting it
    public function deactivate($id)
    {
        $inventory = new PsyInventory();
        $inventory->deactivate((int) $id);

        header("Location: " . BASE_URL . "/psycho-inventory");
        exit;
    }

    // Restore an archived item
    public function activate($id)
    {
        $inventory = new PsyInventory();
        $inventory->activate((int) $id);

        header("Location: " . BASE_URL . "/psycho-inventory/inactive");
        exit;
    }
}
