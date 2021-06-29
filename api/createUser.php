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
    // Tested with JSON body with a POST request :
    // {
    //    "email": "test@gh.com",
    //    "password": "azerty",
    //    "birthDate": "2021-06-02 02:02:02",
    // }
    $userInputs = json_decode(file_get_contents("php://input"), true);

    if (isset($userInputs['email']) && isset($userInputs['password']) && isset ($userInputs['birthDate'])) {
        if($userDao->createUser($userInputs)){
            echo json_encode('User created successfully.');
        } else{
            echo json_encode('User could not be created.');
        }
    } else {
        echo json_encode("Missing fields");
        die();
    }


?>
