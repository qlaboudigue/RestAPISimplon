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

    // Get body request :
    // Tested with JSON and POST :
    // {
    //      "id": "20",
    //      "content": "Message changed",
    //      "author_id": "22"
    // }
    $postDetails = json_decode(file_get_contents("php://input"), true);

    if (isset($postDetails['id'])) {
        // Single read to check if requested post exists
        if($postDao->getSinglePost($postDetails['id']) != null){
            if($postDao->updatePost($postDetails)) {
                echo json_encode("Post updated.");
            } else {
                echo json_encode("Post could not be updated");
            }
        } else {
            echo json_encode("Requested post does not exist");
        }
    } else {
        echo json_encode("Request is empty");
        die();
    }
?>
