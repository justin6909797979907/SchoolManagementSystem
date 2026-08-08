<?php

require_once __DIR__ . '/../models/ScheduleModel.php';

class ScheduleController
{
    private $model;

    public function __construct()
    {
        $this->model = new ScheduleModel();
    }

    // DISPLAY
    public function index()
    {
        $schedules = $this->model->getAll();

        require __DIR__ . '/../views/schedule/schedule.php';
    }

    // GET ONE
    public function view($id)
    {
        header('Content-Type: application/json');

        $schedule = $this->model->getById($id);

        echo json_encode($schedule);
    }

    // CREATE
    public function create()
    {
        header('Content-Type: application/json');

        try {

            $data = [
                'lab_id' => $_POST['lab_id'] ?? null,
                'subject_code' => $_POST['subject_code'] ?? null,
                'subject_name' => $_POST['subject_name'] ?? null,
                'instructor' => $_POST['instructor'] ?? null,
                'section' => $_POST['section'] ?? null,
                'day' => $_POST['day'] ?? null,
                'start_time' => $_POST['start_time'] ?? null,
                'end_time' => $_POST['end_time'] ?? null,
                'semester' => $_POST['semester'] ?? null,
                'school_year' => $_POST['school_year'] ?? null,
                'status' => $_POST['status'] ?? null,
                'remarks' => $_POST['remarks'] ?? null
            ];

            $result = $this->model->create($data);

            echo json_encode([
                'success' => $result,
                'message' => $result
                    ? 'Schedule added successfully.'
                    : 'Failed to add schedule.'
            ]);

        } catch (PDOException $e) {

            http_response_code(500);

            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    // UPDATE
    public function update($id)
    {
        header('Content-Type: application/json');

        $data = [
            'lab_id' => $_POST['lab_id'],
            'subject_code' => $_POST['subject_code'],
            'subject_name' => $_POST['subject_name'],
            'instructor' => $_POST['instructor'],
            'section' => $_POST['section'],
            'day' => $_POST['day'],
            'start_time' => $_POST['start_time'],
            'end_time' => $_POST['end_time'],
            'semester' => $_POST['semester'],
            'school_year' => $_POST['school_year'],
            'status' => $_POST['status'],
            'remarks' => $_POST['remarks']
        ];

        $result = $this->model->update($id, $data);

        echo json_encode([
            'success' => $result
        ]);
    }

    // DELETE
    public function delete($id)
    {
        header('Content-Type: application/json');

        $result = $this->model->delete($id);

        echo json_encode([
            'success' => $result
        ]);
    }
}