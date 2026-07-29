<?php 


   namespace App\Models;

   use App\Core\Model;
   use PDO;


   class EnrolleeDocuments extends Model
   {
     
       public $tableName = 'enr_documents';
       public $primaryKey = 'id';




       protected function getDocuments(int $id)
       {

        $applicant_id = $id;
     
        $sql = "SELECT
             d.id as document_id,
             d.file_path as doc_path,
             dr.requirement_name,
             CASE
             WHEN d.applicant_id IS NULL THEN 'Missing'
             ELSE d.status
             END AS submission_status
             FROM enr_document_requirements dr
             LEFT JOIN $this->tableName d
             ON d.document_type = dr.requirement_name
             AND d.applicant_id = :applicant_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':applicant_id',$applicant_id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);    
  
       }


        public static function __callStatic($name, $arguments)
       {
            $instance = new self();     
            return $instance->$name(...$arguments);
       }
 

   }