<?php

    include_once '../class/topic.php';

    class TopicDao {
        
        // Connection
        private $conn;
        
        // Table
        private $tableName = "Topic";
        public $primaryKey = "id";
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        
        // CREATE TOPIC
        
        public function createTopic($keyedArray){
            
            $topic = new Topic();
            
            $topic->title = $keyedArray['title'];
            $topic->category_id = $keyedArray['category_id'];
            $topic->topic_admin_id = $keyedArray['topic_admin_id'];
            
            
            $sqlQuery = "INSERT INTO {$this->tableName} SET title = :title, category_id = :category_id, topic_admin_id = :topic_admin_id";
            
            $stmt = $this->conn->prepare($sqlQuery);

            // sanitize
            $topic->title = htmlspecialchars(strip_tags($topic->title));
            $topic->category_id = htmlspecialchars(strip_tags($topic->category_id));
            $topic->topic_admin_id = htmlspecialchars(strip_tags($topic->topic_admin_id));
           

            // bind data
            $stmt->bindParam(":title", $topic->title);
            $stmt->bindParam(":category_id", $topic->category_id);
            $stmt->bindParam(":topic_admin_id", $topic->topic_admin_id);
            

            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
            
        }
        
        // SINGLE TOPIC READ
        public function getSingleTopic($value, $key = NULL) {
            
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
        
        // GET ALL TOPICS
        public function getTopics(){
            $sqlQuery = "SELECT id, title, category_id, topic_admin_id FROM " . $this->tableName . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        
        // UPDATE
        public function updateTopic($keyedArray){

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
        function deleteTopic($topicId){
            $sqlQuery = "DELETE FROM {$this->tableName} WHERE id = {$topicId}";
            $stmt = $this->conn->prepare($sqlQuery);
            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        
        
        
    }

?>
