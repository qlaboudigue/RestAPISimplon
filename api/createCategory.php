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
    // Tested with JSON body with a POST request :
    // {
    //    "label": "Food"
    // }
    $categoryInputs = json_decode(file_get_contents("php://input"), true);

    if(isset($categoryInputs)) {
        // Request non empty
        if($categoryDao->createCategory($categoryInputs)) {
            echo 'Category created successfully.';
        } else {
            echo 'Category could not be created.';
        }
    } else {
        echo json_encode("Input is incomplete");
        die();
    }

?>
