<?php

require_once __DIR__ . '/../models/PsyDamage.php';

class PsychoDmgController
{
    // ==========================================
    // DISPLAY ACTIVE DAMAGE RECORDS
    // ==========================================
    public function index()
    {
        $damage = new PsyDamage();

        $damages = $damage->getAll();

        // Retrieve active Psychology inventory items for Add Damage modal.
        $inventoryItems = $damage->getInventoryItems();

        require __DIR__ . '/../views/damages/psych/psycho-damage.php';
    }


    // ==========================================
    // CREATE A DAMAGE RECORD
    // ==========================================
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "/psycho-damage");
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

        // Allowed repair statuses.
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

        // Validate inventory ID.
        $inventoryId = filter_var(
            $_POST['inventory_id'],
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );

        if ($inventoryId === false) {
            http_response_code(400);
            exit("Please select a valid inventory item.");
        }

        $damage = new PsyDamage();

        // Confirm that the inventory item exists and is active.
        $inventoryItems = $damage->getInventoryItems();

        $validInventoryIds = array_map(
            'intval',
            array_column($inventoryItems, 'id')
        );

        if (!in_array($inventoryId, $validInventoryIds, true)) {
            http_response_code(400);
            exit("The selected Psychology inventory item does not exist or is inactive.");
        }

        // Prepare damage data.
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

        // Prevent duplicate open damage reports.
        if ($damage->hasOpenDamage($inventoryId)) {
            $this->setFlash(
                'error',
                'This equipment already has an active damage report that is pending or under repair. Please update the existing report instead.'
            );

            header("Location: " . BASE_URL . "/psycho-damage");
            exit;
        }

        try {
            if (!$damage->create($data)) {
                throw new RuntimeException('Damage record insertion failed.');
            }
        } catch (Throwable $e) {
            error_log("Psychology damage creation failed: " . $e->getMessage());

            $this->setFlash(
                'error',
                'Unable to save the damage record. Please try again.'
            );

            header("Location: " . BASE_URL . "/psycho-damage");
            exit;
        }

        $this->setFlash(
            'success',
            'Psychology damage report created successfully.'
        );

        header("Location: " . BASE_URL . "/psycho-damage");
        exit;
    }


    // VIEW ONE DAMAGE RECORD AS JSON
    public function view($id)
    {
        $damage = new PsyDamage();

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

    public function viewInactive($id)
{
    $damage = new PsyDamage();

    $record = $damage->getInactiveById($id);

    if (!$record) {
        http_response_code(404);
        echo "Inactive damage record not found.";
        exit;
    }

    header('Content-Type: application/json');

    echo json_encode($record);
    exit;
}


    // UPDATE AN EXISTING DAMAGE RECORD
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "/psycho-damage");
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

        // Validate IDs.
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

        // Allowed repair statuses.
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

        $damage = new PsyDamage();

        // Confirm that the damage record exists and is active.
        $existingRecord = $damage->getById($id);

        if (!$existingRecord) {
            http_response_code(404);
            exit("Damage record not found.");
        }

        // Confirm that the selected inventory item exists and is active.
        $inventoryItems = $damage->getInventoryItems();

        $validInventoryIds = array_map(
            'intval',
            array_column($inventoryItems, 'id')
        );

        if (!in_array($inventoryId, $validInventoryIds, true)) {
            http_response_code(400);
            exit("The selected Psychology inventory item does not exist or is inactive.");
        }

        // Prevent duplicate open reports, excluding the current report.
        if (
            in_array($status, ['pending', 'under repair'], true) &&
            $damage->hasOpenDamage($inventoryId, $id)
        ) {
            $this->setFlash(
                'error',
                'This equipment already has another active damage report that is pending or under repair.'
            );

            header("Location: " . BASE_URL . "/psycho-damage");
            exit;
        }

        // Prepare updated data.
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
            error_log("Psychology damage update failed: " . $e->getMessage());

            $this->setFlash(
                'error',
                'Unable to update the damage record. Please try again.'
            );

            header("Location: " . BASE_URL . "/psycho-damage");
            exit;
        }

        $this->setFlash(
            'success',
            'Psychology damage report updated successfully.'
        );

        header("Location: " . BASE_URL . "/psycho-damage");
        exit;
    }


    // DISPLAY INACTIVE DAMAGE RECORDS
    public function inactive()
    {
        $damage = new PsyDamage();

        $rows = $damage->getInactive();

        require __DIR__ . '/../views/damages/psych/psyInactive.php';
    }


    // DEACTIVATE A DAMAGE RECORD
    public function deactivate($id)
    {
        $damage = new PsyDamage();

        if ($damage->deactivate((int) $id)) {
            $this->setFlash(
                'success',
                'Psychology damage report archived successfully.'
            );
        } else {
            $this->setFlash(
                'error',
                'Unable to archive the damage report.'
            );
        }

        header("Location: " . BASE_URL . "/psycho-damage");
        exit;
    }


    // reactivate and activate a damage record
    public function activate($id)
    {
        $damage = new PsyDamage();

        if ($damage->activate((int) $id)) {
            $this->setFlash(
                'success',
                'Psychology damage report reactivated successfully.'
            );
        } else {
            $this->setFlash(
                'error',
                'Unable to reactivate this report. The report may already be active, may not exist, or another open report may exist for this equipment.'
            );
        }

        header("Location: " . BASE_URL . "/psycho-damage/inactive");
        exit;
    }


    // flash message
    private function setFlash($type, $message)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION[$type] = $message;
    }
}
