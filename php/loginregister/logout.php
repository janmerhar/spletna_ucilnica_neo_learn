<?php
    require_once '../libraries/dbconnect.php';
    require_once '../libraries/jwt.php';
    
    $response['status'] = true;
    if(isset($_COOKIE['refresh_token']))
        setcookie("refresh_token", "", time() - 60, NULL, NULL, false, true);

    echo json_encode($response);