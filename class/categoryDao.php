<?php

    include_once '../class/category.php';

    class CategoryDao {
        
        // Connection
        private $conn;
        
        // Table
        private $tableName = "Category";
        public $primaryKey = "id";
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        
        // CREATE Category
        
        public function createCategory($keyedArray){
            
            $category = new Category();
            
            $category->label = $keyedArray['label'];
            
            $sqlQuery = "INSERT INTO {$this->tableName} SET label = :label";
            
            $stmt = $this->conn->prepare($sqlQuery);

            // Sanitize
            $category->label = htmlspecialchars(strip_tags($category->label));
        
            // Bind data
            $stmt->bindParam(":label", $category->label);

            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
            
        }
        
        // SINGLE CATEGORY READ
        public function getSingleCategory($value, $key = NULL) {
            
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
        
        // GET ALL CATEGORIES
        public function getCategories(){
            $sqlQuery = "SELECT id, label FROM " . $this->tableName . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        
        // UPDATE
        public function updateCategory($keyedArray){

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
        function deleteCategory($categoryId){
            $sqlQuery = "DELETE FROM {$this->tableName} WHERE id = {$categoryId}";
            $stmt = $this->conn->prepare($sqlQuery);
            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        
        
        
    }

?>
