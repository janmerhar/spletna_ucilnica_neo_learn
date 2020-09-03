<?php
require_once 'libraries/dbconnect.php';
require_once 'libraries/dbconnect.php';
    header('Access-Control-Allow-Headers: *');
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Headers: *');
    header('Access-Control-Allow-Credentials: true');

    $headers = apache_request_headers();
    var_dump($headers);