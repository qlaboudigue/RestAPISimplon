<?php

    include_once '../class/post.php';

    class PostDao {
        
        // Connection
        private $conn;
        
        // Table
        private $tableName = "Post";
        public $primaryKey = "id";
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        
        // CREATE Post
        
        public function createPost($postKeyedArray){
            
            $post = new Post();
            
            $post->content = $postKeyedArray['content'];
            $post->author_id = $postKeyedArray['author_id'];
            $post->topic_id = $postKeyedArray['topic_id'];
            $post->postDate = date('Y-m-d H:i:s');
            
            $sqlQuery = "INSERT INTO {$this->tableName} SET postDate = :postDate, content = :content, author_id = :author_id, topic_id = :topic_id";
            
            $stmt = $this->conn->prepare($sqlQuery);

            // sanitize
            $post->content = htmlspecialchars(strip_tags($post->content));
            $post->postDate = htmlspecialchars(strip_tags($post->postDate));
            $post->author_id = htmlspecialchars(strip_tags($post->author_id));
            $post->topic_id = htmlspecialchars(strip_tags($post->topic_id));

            // bind data
            $stmt->bindParam(":content", $post->content);
            $stmt->bindParam(":postDate", $post->postDate);
            $stmt->bindParam(":author_id", $post->author_id);
            $stmt->bindParam(":topic_id", $post->topic_id);

            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
            
        }
        
        // SINGLE POST READ
        public function getSinglePost($value, $key = NULL) {
            
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
        
        // READ ALL POSTS
        public function getPosts(){
            $sqlQuery = "SELECT id, content, author_id, topic_id, postDate FROM " . $this->tableName . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        
        // UPDATE
        public function updatePost($keyedArray){

            // Check if keyedArray contains at least the if field
            // ...

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
        function deletePOST($postId){
            $sqlQuery = "DELETE FROM {$this->tableName} WHERE id = {$postId}";
            $stmt = $this->conn->prepare($sqlQuery);
            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        
        
        
    }

?>
