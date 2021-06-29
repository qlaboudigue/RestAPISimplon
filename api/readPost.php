<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/postDao.php';
    include_once '../class/userDao.php';
    include_once '../class/topicDao.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new PostDao($db);

    $stmt = $items->getPosts();
    $itemCount = $stmt->rowCount();

    // Tested with a Get request

    if($itemCount > 0){
        
        $postArr = array();
        $postArr["body"] = array();
        $postArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            
            // Get user identity (email) based on author_id
            $userDao = new UserDao($db);
            if($userDao->getSingleUser($author_id) != null) {
                $author = $userDao->getSingleUser($author_id);
                $authorEmail = $author['email'];
            } else {
                $authorEmail = "User does not exist anymore";
            }
            
            // Get topic title based on topic_id
            $topicDao = new TopicDao($db);
            if($topicDao->getSingleTopic($topic_id) != null) {
                $topic = $topicDao->getSingleTopic($topic_id);
                $topicTitle = $topic['title'];
            } else {
                $topicTitle = "Topic does not exist anymore";
            }
            
            
            $e = array(
                "id" => $id,
                "content" => $content,
                "author_id" => $author_id,
                "author_email" => $authorEmail,
                "topic_id" => $topic_id,
                "topic_title" => $topicTitle,
                "postDate" => $postDate
            );

            array_push($postArr["body"], $e);
        }
        echo json_encode($postArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
