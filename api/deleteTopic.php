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
    
    // Get body request, true parameter return key value pair array
    // Tested with JSON body and DELETE :
    // {
    //      "id": "4"
    // }
    $topicDetails = json_decode(file_get_contents("php://input"), true);

    // Check userId existence from Json input
    $topicId = isset($topicDetails['id']) ? $topicDetails['id'] : die();

    if ($topicDao->getSingleTopic($topicId) != null) {
        if($topicDao->deleteTopic($topicId)) {
            echo json_encode("Topic deleted.");
        } else {
            echo json_encode("Topic could not be deleted");
        }
    } else {
        echo json_encode("Please provide a valid topic Id");
        die();
    }

?>
