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

    // Get body request
    // Tested with JSON body with a POST :
    // {
    //    "title": "Pastas",
    //    "category_id": "12",
    //    "topic_admin_id": "30",
    // }
    $topicInputs = json_decode(file_get_contents("php://input"), true);

    if(isset($topicInputs['title']) && isset($topicInputs['category_id']) && isset($topicInputs['topic_admin_id'])) {
        // Request non empty
        if($topicDao->createTopic($topicInputs)) {
            echo 'Topic created successfully.';
        } else {
            echo 'Topic could not be created.';
        }
    } else {
        echo json_encode("Input is incomplete");
        die();
    }

?>
