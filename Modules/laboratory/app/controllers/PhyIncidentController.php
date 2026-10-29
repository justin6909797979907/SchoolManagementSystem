<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once __DIR__ . '/../models/PhyIncident.php';

class PhyIncidentController
{
    private function redirect($path)
    {
        header("Location: " . BASE_URL . $path);
        exit;
    }

    private function setFlash($type, $message)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION[$type] = $message;
    }

    private function fail($message, $code = 400)
    {
        http_response_code($code);
        exit($message);
    }

    private function validateStatus($severity, $status)
    {
        return in_array(
            $severity,
            ['low', 'medium', 'high', 'critical'],
            true
        ) && in_array(
            $status,
            ['pending', 'investigating', 'resolved', 'closed'],
            true
        );
    }

    public function index()
    {
        $incident = new PhyIncident();

        $incidents = $incident->getAll();
        $inventoryItems = $incident->getInventoryItems();

        require __DIR__ . '/../views/incidents/physics/physics-incident.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/physics-incident');
        }

        foreach (
            ['incident_type', 'incident_date', 'laboratory', 'description', 'reported_by']
            as $field
        ) {
            if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
                $this->fail('Please complete all required incident fields.');
            }
        }

        $severity = strtolower(trim($_POST['severity'] ?? 'low'));
        $status = strtolower(trim($_POST['report_status'] ?? 'pending'));

        if (!$this->validateStatus($severity, $status)) {
            $this->fail('Invalid incident severity or report status.');
        }

        $incident = new PhyIncident();

        $inventoryId = null;

        if (trim($_POST['inventory_id'] ?? '') !== '') {
            $inventoryId = filter_var(
                $_POST['inventory_id'],
                FILTER_VALIDATE_INT,
                ['options' => ['min_range' => 1]]
            );

            if ($inventoryId === false) {
                $this->fail('Please select a valid inventory item.');
            }

            $validIds = array_map(
                'intval',
                array_column($incident->getInventoryItems(), 'id')
            );

            if (!in_array($inventoryId, $validIds, true)) {
                $this->fail('The selected inventory item is invalid or inactive.');
            }
        }

        $data = [
            'incident_number' => 'INC-' . date('Ymd-His') . '-' .
                strtoupper(bin2hex(random_bytes(3))),
            'inventory_id' => $inventoryId,
            'incident_type' => strtolower(trim($_POST['incident_type'])),
            'incident_date' => str_replace('T', ' ', $_POST['incident_date']),
            'laboratory' => trim($_POST['laboratory']),
            'location_details' => trim($_POST['location_details'] ?? ''),
            'description' => trim($_POST['description']),
            'reported_by' => trim($_POST['reported_by']),
            'people_involved' => trim($_POST['people_involved'] ?? ''),
            'action_taken' => trim($_POST['action_taken'] ?? ''),
            'severity' => $severity,
            'report_status' => $status
        ];

        try {
            if (!$incident->create($data)) {
                throw new RuntimeException('Incident insertion failed.');
            }
        } catch (Throwable $e) {
            error_log('Incident creation failed: ' . $e->getMessage());

            $this->setFlash('error', 'Unable to create the incident report.');
            $this->redirect('/physics-incident');
        }

        $this->setFlash('success', 'Incident report created successfully.');
        $this->redirect('/physics-incident');
    }

    public function view($id)
    {
        $incident = new PhyIncident();
        $record = $incident->getById((int) $id);

        header('Content-Type: application/json; charset=utf-8');

        if (!$record) {
            http_response_code(404);
            echo json_encode(['error' => 'Incident report not found.']);
            exit;
        }

        echo json_encode($record);
        exit;
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/physics-incident');
        }

        foreach (
            ['id', 'incident_type', 'incident_date', 'laboratory', 'description', 'reported_by']
            as $field
        ) {
            if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
                $this->fail('Please complete all required incident fields.');
            }
        }

        $id = filter_var(
            $_POST['id'],
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );

        $severity = strtolower(trim($_POST['severity'] ?? 'low'));
        $status = strtolower(trim($_POST['report_status'] ?? 'pending'));

        if ($id === false || !$this->validateStatus($severity, $status)) {
            $this->fail('Invalid incident report information.');
        }

        $incident = new PhyIncident();

        if (!$incident->getById($id)) {
            $this->fail('Incident report not found.', 404);
        }

        $inventoryId = null;

        if (trim($_POST['inventory_id'] ?? '') !== '') {
            $inventoryId = filter_var(
                $_POST['inventory_id'],
                FILTER_VALIDATE_INT,
                ['options' => ['min_range' => 1]]
            );

            if ($inventoryId === false) {
                $this->fail('Please select a valid inventory item.');
            }

            $validIds = array_map(
                'intval',
                array_column($incident->getInventoryItems(), 'id')
            );

            if (!in_array($inventoryId, $validIds, true)) {
                $this->fail('The selected inventory item is invalid or inactive.');
            }
        }

        $data = [
            'id' => $id,
            'inventory_id' => $inventoryId,
            'incident_type' => strtolower(trim($_POST['incident_type'])),
            'incident_date' => str_replace('T', ' ', $_POST['incident_date']),
            'laboratory' => trim($_POST['laboratory']),
            'location_details' => trim($_POST['location_details'] ?? ''),
            'description' => trim($_POST['description']),
            'reported_by' => trim($_POST['reported_by']),
            'people_involved' => trim($_POST['people_involved'] ?? ''),
            'action_taken' => trim($_POST['action_taken'] ?? ''),
            'severity' => $severity,
            'report_status' => $status
        ];

        try {
            if (!$incident->update($data)) {
                throw new RuntimeException('Incident update failed.');
            }
        } catch (Throwable $e) {
            error_log('Incident update failed: ' . $e->getMessage());

            $this->setFlash('error', 'Unable to update the incident report.');
            $this->redirect('/physics-incident');
        }

        $this->setFlash('success', 'Incident report updated successfully.');
        $this->redirect('/physics-incident');
    }

    public function inactive()
    {
        $incident = new PhyIncident();
        $rows = $incident->getInactive();

        require __DIR__ . '/../views/incidents/physics/phyInactive.php';
    }

    public function deactivate($id)
    {
        $id = filter_var(
            $id,
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );

        if ($id === false) {
            $this->setFlash('error', 'Invalid incident ID.');
            $this->redirect('/physics-incident');
        }

        $incident = new PhyIncident();

        try {
            $success = $incident->deactivate($id);

            if ($success) {
                $this->setFlash(
                    'success',
                    'Incident report archived successfully.'
                );
            } else {
                $this->setFlash(
                    'error',
                    'Incident not found or already archived.'
                );
            }
        } catch (Throwable $e) {
            error_log('Deactivation failed: ' . $e->getMessage());

            $this->setFlash(
                'error',
                'Unable to archive the incident report.'
            );
        }

        $this->redirect('/physics-incident');
    }

    public function activate($id)
    {
        $incident = new PhyIncident();

        if ($incident->activate((int) $id)) {
            $this->setFlash('success', 'Incident report restored successfully.');
        } else {
            $this->setFlash('error', 'Unable to restore the incident report.');
        }

        $this->redirect('/physics-incident/inactive');
    }

    /**
     * Display the create incident form.
     * Supports creating an incident from a Physics Damage record.
     */
    public function createForm()
    {
        $incident = new PhyIncident();

        $inventoryItems = $incident->getInventoryItems();
        $record = [];

        // Check whether this form was opened from a damage record.
        $damageId = filter_input(
            INPUT_GET,
            'damage_id',
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );

        if ($damageId) {
            require_once __DIR__ . '/../models/PhyDamage.php';

            $damageModel = new PhyDamage();
            $damage = $damageModel->getById($damageId);

            if (!$damage) {
                $this->fail('Physics damage record not found or inactive.', 404);
            }

            $record = [
                'damage_id'     => $damage['id'],
                'inventory_id'  => $damage['inventory_id'],
                'incident_type' => 'equipment damage',
                'incident_date' => $damage['date_reported'],
                'laboratory'    => $damage['laboratory'],
                'reported_by'   => $damage['reported_by'],
                'description'   => $damage['issue_description'],
                'action_taken'  => $damage['action_taken'] ?? '',
                'severity'      => 'medium',
                'report_status' => 'pending'
            ];
        }

        require __DIR__ . '/../views/incidents/physics/physics-incident-form.php';
    }


    /**
     * Display the edit incident form.
     */
    public function editForm($id)
    {
        $incident = new PhyIncident();

        $record = $incident->getById((int) $id);

        if (!$record) {
            $this->setFlash('error', 'Incident report not found.');
            $this->redirect('/physics-incident');
        }

        $inventoryItems = $incident->getInventoryItems();

        require __DIR__ . '/../views/incidents/physics/physics-incident-form.php';
    }

    /**
     * Display a printable incident report.
     */
    public function printReport($id)
    {
        $id = filter_var(
            $id,
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );

        if ($id === false) {
            $this->setFlash('error', 'Invalid incident report ID.');
            $this->redirect('/physics-incident');
        }

        $incident = new PhyIncident();
        $record = $incident->getById($id);

        if (!$record) {
            http_response_code(404);
            exit('Incident report not found.');
        }

        require __DIR__ . '/../views/incidents/physics/physics-incident-report.php';
    }
}
