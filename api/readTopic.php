<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/topicDao.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new TopicDao($db);

    // Tested with a Get request

    $stmt = $items->getTopics();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $topicArr = array();
        $topicArr["body"] = array();
        $topicArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "title" => $title,
                "category_id" => $category_id,
                "topic_admin_id" => $topic_admin_id
            );

            array_push($topicArr["body"], $e);
        }
        echo json_encode($topicArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
