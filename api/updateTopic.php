<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/topicDao.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $topicDao = new TopicDao($db);

    // Get body request :
    // Tested with JSON input and POST :
    // {
    //      "id": "1",
    //      "title": "Title changed",
    //      "category_id": "22",
    //      "topic_admin_id": "4"
    // }
    $topicDetails = json_decode(file_get_contents("php://input"), true);

    if (isset($topicDetails['id'])) {
        // Check if topic Id exists
        if ($topicDao->getSingleTopic($topicDetails['id']) != null) {
            if($topicDao->updateTopic($topicDetails)) {
                echo json_encode("Topic updated.");
            } else {
                echo json_encode("Topic could not be updated");
            }
        } else {
            echo json_encode("Requested topic does not exist");
        }
    } else {
        echo json_encode("Please provide a topic Id");
        die();
    }
?>
