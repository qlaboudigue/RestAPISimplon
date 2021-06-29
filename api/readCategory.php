<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/categoryDao.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new CategoryDao($db);

    // Tested with a GET request

    $stmt = $items->getCategories();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $categoryArr = array();
        $categoryArr["body"] = array();
        $categoryArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "label" => $label,
            );

            array_push($categoryArr["body"], $e);
        }
        echo json_encode($categoryArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
