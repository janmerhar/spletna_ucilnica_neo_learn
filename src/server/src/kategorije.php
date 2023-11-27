<?php
    require_once 'libraries/dbconnect.php';

    $kategorije = [];

    $q = "SELECT imekategorije FROM kategorija";
    $stmt = $conn->prepare($q);
    $stmt->execute();
    
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc())
    {
        $kategorije[] = $row['imekategorije'];
    }

    echo json_encode($kategorije, JSON_PRETTY_PRINT);
    $conn->close();