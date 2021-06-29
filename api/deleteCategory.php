<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/categoryDao.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $categoryDao = new CategoryDao($db);
    
    // Get body request
    // Tested with JSON body and DELETE :
    // {
    //    "id": "21"
    // }
    $categoryDetails = json_decode(file_get_contents("php://input"), true);
    
    // Check userId existence from Json input
    $categoryId = isset($categoryDetails['id']) ? $categoryDetails['id'] : die();

    if($categoryDao->getSingleCategory($categoryId) != null) {
        if($categoryDao->deleteCategory($categoryId)) {
            echo json_encode("Post deleted.");
        } else {
            echo json_encode("Post could not be deleted");
        }
    } else {
        echo json_encode("Requested category does not exist");
    }

?>
