<?php

    include_once '../class/user.php';
    // include_once '../class/basicDao.php'

    class UserDao {
        
        // PROPERTIES
        
        // Connection
        private $conn;
        
        // Table
        private $tableName = "User";
        public $primaryKey = "id";
        
        // METHODS
        
        // Constructor : Db connection
        public function __construct($db){
            $this->conn = $db;
        }
    
        // CREATE User
        
        public function createUser($userKeyedArray){
            
            $user = new User();
            
            $user->email = $userKeyedArray['email'];
            $user->password = $userKeyedArray['password'];
            $user->birthDate = $userKeyedArray['birthDate'];
            
            $sqlQuery = "INSERT INTO {$this->tableName} SET email = :email, password = :password, birthDate = :birthDate";

            $stmt = $this->conn->prepare($sqlQuery);

            // Sanitize
            $user->email = htmlspecialchars(strip_tags($user->email));
            $user->password = htmlspecialchars(strip_tags($user->password));
            $user->birthDate = htmlspecialchars(strip_tags($user->birthDate));

            // Bind data
            $stmt->bindParam(":email", $user->email);
            $stmt->bindParam(":password", $user->password);
            $stmt->bindParam(":birthDate", $user->birthDate);

            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        
        // SINGLE USER READ
        public function getSingleUser($value, $key = NULL) {
            
            if(is_null($key)){
                $key = $this->primaryKey;
            }
            
            $sqlQuery = "select * from {$this->tableName} where {$key}='{$value}'";
            
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $rows;
            
        }

        // GET ALL
        public function getUsers(){
            $sqlQuery = "SELECT id, email, password, birthDate FROM " . $this->tableName . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        

        // UPDATE
        public function updateUser($keyedArray){

            $sqlPreparation = "UPDATE {$this->tableName} SET ";

            foreach ($keyedArray as $column=> $value) {
                $updates[] = "{$column}='{$value}'";
            }

            $implodeUpdates = implode(', ', $updates);
            $sqlQuery = "{$sqlPreparation} {$implodeUpdates} where {$this->primaryKey}='{$keyedArray[$this->primaryKey]}'";
            
            $stmt = $this->conn->prepare($sqlQuery);

            if($stmt->execute()){
               return true;
            }
            return false;
        }
        
        // DELETE
        function deleteUser($userId){
            $sqlQuery = "DELETE FROM {$this->tableName} WHERE id = {$userId}";
            // echo $sqlQuery;
            $stmt = $this->conn->prepare($sqlQuery);
        
            // $this->id=htmlspecialchars(strip_tags($this->id));
        
            // $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        
        
    }

?>
