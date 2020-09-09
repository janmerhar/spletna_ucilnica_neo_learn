<?php
    header('Access-Control-Allow-Headers: *');
    header("Access-Control-Allow-Origin: *");
    
    define("__ROOT__", $_SERVER['DOCUMENT_ROOT']. '/koda/vuelearn');

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
?>
