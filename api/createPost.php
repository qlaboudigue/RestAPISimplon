<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/postDao.php';

    $database = new Database();
    $db = $database->getConnection();

    $postDao = new PostDao($db);

    // Get body request
    // Tested with JSON inpu and POST :
    // {
    //    "content" : "Message test",
    //    "author_id": "33",
    //    "topic_id": "1"
    // }
    $postInputs = json_decode(file_get_contents("php://input"), true);

    if(isset($postInputs['content']) && isset($postInputs['author_id']) && isset ($postInputs['topic_id'])) {
        // Request non empty
        if($postDao->createPost($postInputs)) {
            echo json_encode('Post created successfully.');
        } else {
            echo json_encode('Post could not be created.');
        }
    } else {
        echo json_encode("Request is incomplete");
        die();
    }

?>
