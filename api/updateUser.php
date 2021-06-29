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

    // Get body request :
    // Tested with JSON and POST :
    // {
    //    "id": "4",
    //    "password": "qsdfg",
    //    "birthDate": "2021-06-02 02:02:04"
    // }
    $userDetails = json_decode(file_get_contents("php://input"), true);

    if (isset($userDetails['id'])) {
        // Single read to check if user exists
        if($userDao->getSingleUser($userDetails['id']) != null) {
            if($userDao->updateUser($userDetails)) {
                echo json_encode("User data updated.");
            } else {
                echo json_encode("Data could not be updated");
            }
        } else {
            echo json_encode("User does not exist");
        }
    } else {
        echo json_encode("Request is empty");
        die();
    }

?>
