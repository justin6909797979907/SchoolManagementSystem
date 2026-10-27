<?php

require_once __DIR__ . '/../models/PhyDamage.php';

class PhyDamageController
{
    // Display active damage records.
    public function index()
    {
        $damage = new PhyDamage();

        $damages = $damage->getAll();
        $inventoryItems = $damage->getInventoryItems();

        require __DIR__ . '/../views/damages/physics/physics-damage.php';
    }

    // Create a damage record.
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "/physics-damage");
            exit;
        }

        $requiredFields = [
            'inventory_id',
            'issue_description',
            'accountable_department',
            'date_reported',
            'repair_status'
        ];

        foreach ($requiredFields as $field) {
            if (
                !isset($_POST[$field]) ||
                trim((string) $_POST[$field]) === ''
            ) {
                http_response_code(400);
                exit("Please complete all required damage record fields.");
            }
        }

        $allowedStatuses = [
            'pending',
            'under repair',
            'repaired',
            'written off'
        ];

        $status = strtolower(trim($_POST['repair_status']));

        if (!in_array($status, $allowedStatuses, true)) {
            http_response_code(400);
            exit("Invalid repair status.");
        }

        $inventoryId = filter_var(
            $_POST['inventory_id'],
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );

        if ($inventoryId === false) {
            http_response_code(400);
            exit("Please select a valid inventory item.");
        }

        $damage = new PhyDamage();

        // Confirm that the inventory item exists and is active.
        $inventoryItems = $damage->getInventoryItems();

        $validInventoryIds = array_map(
            'intval',
            array_column($inventoryItems, 'id')
        );

        if (!in_array($inventoryId, $validInventoryIds, true)) {
            http_response_code(400);
            exit("The selected inventory item does not exist or is inactive.");
        }

        $data = [
            'inventory_id' => $inventoryId,
            'issue_description' => trim($_POST['issue_description']),
            'accountable_department' => trim($_POST['accountable_department']),
            'reported_by' => trim($_POST['reported_by'] ?? ''),
            'date_reported' => str_replace('T', ' ', $_POST['date_reported']),
            'repair_status' => $status,
            'action_taken' => trim($_POST['action_taken'] ?? ''),
            'remarks' => trim($_POST['remarks'] ?? '')
        ];

        // Prevent another open report for the same equipment.
        if ($damage->hasOpenDamage($inventoryId)) {
            $this->setFlash(
                'error',
                'This equipment already has an active damage report that is pending or under repair. Please update the existing report instead.'
            );

            header("Location: " . BASE_URL . "/physics-damage");
            exit;
        }


        try {
            if (!$damage->create($data)) {
                throw new RuntimeException('Damage record insertion failed.');
            }
        } catch (Throwable $e) {
            error_log("Physics damage creation failed: " . $e->getMessage());

            $this->setFlash(
                'error',
                'Unable to save the damage record. Please try again.'
            );

            header("Location: " . BASE_URL . "/physics-damage");
            exit;
        }

        $this->setFlash('success', 'Damage report created successfully.');

        header("Location: " . BASE_URL . "/physics-damage");
        exit;
    }

    // Return one active damage record as JSON.
    public function view($id)
    {
        $damage = new PhyDamage();
        $record = $damage->getById((int) $id);

        header('Content-Type: application/json; charset=utf-8');

        if (!$record) {
            http_response_code(404);
            echo json_encode([
                'error' => 'Damage record not found.'
            ]);
            exit;
        }

        echo json_encode($record);
        exit;
    }

    // Update an existing damage record.
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "/physics-damage");
            exit;
        }

        $requiredFields = [
            'id',
            'inventory_id',
            'issue_description',
            'accountable_department',
            'date_reported',
            'repair_status'
        ];

        foreach ($requiredFields as $field) {
            if (
                !isset($_POST[$field]) ||
                trim((string) $_POST[$field]) === ''
            ) {
                http_response_code(400);
                exit("Please complete all required damage record fields.");
            }
        }

        $id = filter_var(
            $_POST['id'],
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );

        $inventoryId = filter_var(
            $_POST['inventory_id'],
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );

        $allowedStatuses = [
            'pending',
            'under repair',
            'repaired',
            'written off'
        ];

        $status = strtolower(trim($_POST['repair_status']));

        if (
            $id === false ||
            $inventoryId === false ||
            !in_array($status, $allowedStatuses, true)
        ) {
            http_response_code(400);
            exit("Invalid damage record information.");
        }

        $damage = new PhyDamage();

        // Confirm the report exists and is active.
        $existingRecord = $damage->getById($id);

        if (!$existingRecord) {
            http_response_code(404);
            exit("Damage record not found.");
        }

        // Confirm the selected inventory item exists and is active.
        $inventoryItems = $damage->getInventoryItems();

        $validInventoryIds = array_map(
            'intval',
            array_column($inventoryItems, 'id')
        );

        if (!in_array($inventoryId, $validInventoryIds, true)) {
            http_response_code(400);
            exit("The selected inventory item does not exist or is inactive.");
        }

        // Only check for duplicates when the updated report will remain open.
        // Exclude this report from the duplicate check.
        if (
            in_array($status, ['pending', 'under repair'], true) &&
            $damage->hasOpenDamage($inventoryId, $id)
        ) {
            $this->setFlash(
                'error',
                'This equipment already has another active damage report that is pending or under repair.'
            );

            header("Location: " . BASE_URL . "/physics-damage");
            exit;
        }

        $data = [
            'id' => $id,
            'inventory_id' => $inventoryId,
            'issue_description' => trim($_POST['issue_description']),
            'accountable_department' => trim($_POST['accountable_department']),
            'reported_by' => trim($_POST['reported_by'] ?? ''),
            'date_reported' => str_replace('T', ' ', $_POST['date_reported']),
            'repair_status' => $status,
            'action_taken' => trim($_POST['action_taken'] ?? ''),
            'remarks' => trim($_POST['remarks'] ?? '')
        ];

        try {
            if (!$damage->update($data)) {
                throw new RuntimeException('Damage record update failed.');
            }
        } catch (Throwable $e) {
            error_log("Physics damage update failed: " . $e->getMessage());

            $this->setFlash(
                'error',
                'Unable to update the damage record. Please try again.'
            );

            header("Location: " . BASE_URL . "/physics-damage");
            exit;
        }

        $this->setFlash('success', 'Damage report updated successfully.');

        header("Location: " . BASE_URL . "/physics-damage");
        exit;
    }

    // Display inactive damage records.
    public function inactive()
    {
        $damage = new PhyDamage();
        $rows = $damage->getInactive();

        require __DIR__ . '/../views/damages/physics/phyInactive.php';
    }

    // Archive a damage record without deleting it.
    public function deactivate($id)
    {
        $damage = new PhyDamage();

        if ($damage->deactivate((int) $id)) {
            $this->setFlash('success', 'Damage report archived successfully.');
        } else {
            $this->setFlash('error', 'Unable to archive the damage report.');
        }

        header("Location: " . BASE_URL . "/physics-damage");
        exit;
    }

    // Reactivate an archived damage record.
    public function activate($id)
    {
        $damage = new PhyDamage();

        if ($damage->activate((int) $id)) {
            $this->setFlash('success', 'Damage report reactivated successfully.');
        } else {
            $this->setFlash(
                'error',
                'Unable to reactivate this report. The report may already be active, may not exist, or another open report may exist for this equipment.'
            );
        }

        header("Location: " . BASE_URL . "/physics-damage/inactive");
        exit;
    }

    // Store a one-time message for the next page.
    private function setFlash($type, $message)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION[$type] = $message;
    }
}
