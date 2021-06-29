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
    // Tested with JSON body and DELETE :
    // {
    //    "id": "4"
    // }
    $postDetails = json_decode(file_get_contents("php://input"), true);
    
    // Check userId existence from Json input
    $postId = isset($postDetails['id']) ? $postDetails['id'] : die();

    if($postDao->getSinglePost($postId) != null) {
        if (isset($postDetails)) {
            if($postDao->deletePost($postId)) {
                echo json_encode("Post deleted.");
            } else {
                echo json_encode("Post could not be deleted");
            }
        } else {
            echo json_encode("Request is empty");
            die();
        }
    } else {
        echo json_encode("Requested post does not exist");
    }

?>
