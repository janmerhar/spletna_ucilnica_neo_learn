<?php
    header("Access-Control-Allow-Origin: http://localhost:8080");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    require_once '../libraries/jwt.php';

    // Preverim, ali imamo refresh_token
    if (isset($_COOKIE['refresh_token'])) 
    {
        $token = new Token($_COOKIE['refresh_token'], "cookie");
        $response = [ "token" => $token->getToken() ];
    }
    else 
    {
        $response = [ "error" => "token" ];
    }

    echo json_encode($response);