<?php 

 namespace App\Controllers;

 use App\Core\Controller;
use App\Helper\Response;
use App\Models\Employee;
use App\Models\Enrollee;
use App\Models\EnrolleeCourse;
use App\Models\EnrolleeDocuments;
use App\Models\SchoolYear;
use App\Models\Semester;

 class EnrolleeController extends Controller
 {

    public function index()
    {

        $user = Employee::find('1003'); 
        $semester = Semester::activeSemester();
        $schoolYear = SchoolYear::activeSchoolYear();
        $this->render('/students/enrollee', 
        [
            'user' => $user,
            'semester' => $semester,
            'schoolYear' => $schoolYear
        ]);

    }

    public function allEnrollee()
    {
        $enrollee = Enrollee::allEnrollees();
        Response::json($enrollee);
    }

    public function show(int $id)
    {
  

        $user = Employee::find('1003'); 
        $semester = Semester::activeSemester();
        $schoolYear = SchoolYear::activeSchoolYear();

        $enrollee = Enrollee::find($id);
        $enrollee_course = EnrolleeCourse::getSelectedCourse($enrollee['id']);
        $enrollee_documents = EnrolleeDocuments::getDocuments($enrollee['id']);


        $this->render('/students/view_applicant',
        [
            'user' => $user,
            'semester' => $semester,
            'schoolYear' => $schoolYear,
            'applicant_id' => $enrollee['id'],
            'applicant_number' => $enrollee['application_number'],
            'applicant_surname' => $enrollee['surname'],
            'applicant_first_name' => $enrollee['first_name'],
            'applicant_middle_name' => $enrollee['middle_name'],
            'applicant_suffix' => $enrollee['suffix'],
            'applicant_sex' => $enrollee['sex'],
            'applicant_dob' => date("F d, Y", strtotime($enrollee['date_of_birth'])),
            'applicant_place_of_birth' => $enrollee['place_of_birth'],
            'applicant_civil_status' => $enrollee['civil_status'],
            'applicant_email' => $enrollee['email'],
            'applicant_contact_number' => $enrollee['contact_number'],
            'applicant_barangay' => ucFirst($enrollee['address_barangay']),
            'applicant_city' => ucFirst($enrollee['address_city']),
            'applicant_province' => ucFirst($enrollee['address_province']),
            'applicant_address_complete' => ucFirst($enrollee['address_complete']),
            'applicant_course_code' => $enrollee_course['course_code'],
            'applicant_course_name' => $enrollee_course['course_name'],
            'applicant_last_school' => ucFirst($enrollee['school_last_attended']),
            'applicant_year_graduated' => $enrollee['year_graduated'],
            'applicant_submission_date' => date("F d, Y", strtotime($enrollee['submitted_at'])),
            'applicant_parent_name' => $enrollee['parent_full_name'],
            'applicant_parent_contact' => $enrollee['parent_contact'],
            'appplicant_parent_address' => ucFirst($enrollee['parent_address']),
            'enrollee_documents'  => $enrollee_documents

         ]);

    }


    public function updateDocumentVerified(int $id)
    {
  
      header('Content-Type: application/json');

      $json = file_get_contents("php://input");
      $data = json_decode($json, true);
      
      $applicantId = $data['applicant_id'];
      $status = $data['status'];

       if($status === 'Approve')
       {
 
        EnrolleeDocuments::update($applicantId,[
  
          'status' => 'verified',

        ]);


        echo json_encode([
            'status' => 'success',
            'message' => 'Document Approved.'
        ]);

       }else{

         EnrolleeDocuments::update($applicantId,[
  
          'status' => 'rejected',

        ]);

        echo json_encode([
            'status' => 'success',
            'message' => 'Document Rejected.'
        ]);


       }
       }




    public function documentShow($id)
    {
         $enrollee = Enrollee::find($id);
         $enrollee_documents = EnrolleeDocuments::getDocuments($enrollee['id']);

         Response::json($enrollee_documents);

    }

 }