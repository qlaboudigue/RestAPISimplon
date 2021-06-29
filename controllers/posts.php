<?php

    include_once("../config/database.php");
    include_once("../class/postDao.php");

    $database = new Database();
    $db = $database->getConnection();

    $items = new PostDao($db);

    $stmt = $items->getPosts();
    
    echo 'Posts </br> </br>';

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        echo'<td id="titre"><strong> '.$row['content'].', </strong>
        posté le :
        <strong> '.$row['postDate'].'</strong></td>
        </br>
        ';
        
        
    }

?>
