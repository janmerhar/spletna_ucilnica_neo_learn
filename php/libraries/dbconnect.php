<?php
    // HttpOnly cookie
    // header("Set-Cookie: hidden=value; httpOnly");

    header('Access-Control-Allow-Headers: *');
    header("Access-Control-Allow-Origin: *");

    $conn = new mysqli("localhost", "root", "", "learn");

    // Težave zaradi šumnikov
    $conn->set_charset("utf8");

    // dobim JSON podatke preko FETCH-a ali AXIOS-a
    $json = file_get_contents('php://input');
    $json_data = (array) json_decode($json);



?>
