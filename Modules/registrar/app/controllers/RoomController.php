<?php 

 namespace App\Controllers;

 use App\Core\Controller;
 use App\Helper\Logger;
 use App\Models\Room;


class RoomController extends Controller 
{

    public function index()
    {

        $this->render('/acad/room');

    }


    public function store()
    {


         header('Content-Type: application/json');

        $errors = [];

        $school_year_name = trim($_POST['school_year_name'] ?? '');
        $is_active = trim($_POST['is_active'] ?? '');
     

        if ($school_year_name === '') {
        $errors['school_year_name'] = 'School Year Name is required.';
        }

        if (!empty($errors)) {
            echo json_encode([
                'status' => 'error',
                'errors' => $errors
            ]);
            return;
        }


       
        Room::create([
            'name' => $school_year_name,
            'is_active' => $is_active,
            
        ]);

        
        Logger::log(
        "Created A New School Year",
         "Created A New Schoool Year Information for System"
         );

        echo json_encode([
            'status' => 'success',
            'message' => 'School Year created successfully.'
        ]);

    }


}
