<?php
    header("Access-Control-Allow-Origin: http://localhost:8080");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    
    define("__ROOT__", $_SERVER['DOCUMENT_ROOT'] . '/spletna_ucilnica_neo_learn');
    require_once __ROOT__ . '/vendor/autoload.php';

    $conn = new mysqli("localhost", "root", "", "learn");

    // Težave zaradi šumnikov
    $conn->set_charset("utf8");

    // dobim JSON podatke preko FETCH-a ali AXIOS-a
    $json = file_get_contents('php://input');
    $json_data = (array) json_decode($json);

    // pretvorba objecta v array
    function object_to_array($data)
    {
        if (is_array($data) || is_object($data))
        {
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = object_to_array($value);
            }
            return $result;
        }
        return $data;
    }

    // nova baza https://github.com/ThingEngineer/PHP-MySQLi-Database-Class
    $db = new MysqliDb($conn);

    $response = [];
?>
