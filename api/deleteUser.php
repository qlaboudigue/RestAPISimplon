<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/userDao.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $userDao = new UserDao($db);
    
    // Get body request
    // Tested with JSON body and DELETE : 
    // {
    //    "id": "4"
    // }
    $userDaoDetails = json_decode(file_get_contents("php://input"), true);
    
    // Check userId existence from Json input
    $userId = isset($userDaoDetails['id']) ? $userDaoDetails['id'] : die();

    // Single read to check if user exists
    if($userDao->getSingleUser($userId) != null) {
        if (isset($userDaoDetails)) {
            if($userDao->deleteUser($userId)) {
                echo json_encode("User deleted.");
            } else {
                echo json_encode("User could not be deleted");
            }
        } else {
            echo json_encode("Request is empty");
            die();
        }
    } else {
        echo json_encode("User does not exist");
    }

    

?>
