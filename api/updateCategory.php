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

    // Get body request :
    // Tested with JSON and POST :
    // {
    //      "id": "22",
    //      "label": "Movies"
    // }
    $categoryDetails = json_decode(file_get_contents("php://input"), true);

    if (isset($categoryDetails['id'])) {
        if($categoryDao->getSingleCategory($categoryDetails['id']) != null) {
            if($categoryDao->updateCategory($categoryDetails)) {
                echo json_encode("Category updated.");
            } else {
                echo json_encode("Category could not be updated");
            }
        } else {
            echo json_encode("Requested category does not exist");
        }
    } else {
        echo json_encode("Please provide a category Id");
        die();
    }
?>
