<?php
    require_once 'dbconnect.php';
    
    // https://stackoverflow.com/questions/35091757/parse-javascript-fetch-in-php
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $username = $conn->real_escape_string($data->username);

    $q = "SELECT COUNT(upime) AS count FROM uporabnik WHERE upime = ?";
    $stmt = $conn->prepare($q);
    $stmt->bind_param("s", $username);
    
    if($stmt->execute())
    {
        $rezultat = [];
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if($row['count'] == 0)
            $rezultat['status'] = true;
        else
            $rezultat['status'] = false;
    }
    echo json_encode($rezultat);    
?>