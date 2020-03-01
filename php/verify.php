<?php
    require_once 'dbconnect.php';

    function verifyAccount($upime, $vkey)
    {
        global $conn;
        $q = "UPDATE uporabnik
        SET vkey = NULL
        WHERE upime = ? AND vkey = ?";

        $stmt = $conn->prepare($q);
        $stmt->bind_param("ss", $upime, $vkey);
        $stmt->execute();
        // preveri, če je ukaz uspel
        if($stmt->affected_rows == 1)
            return 1;
        else
            return 0;
    }
    echo verifyAccount("merjan", "4c0fca706e8a61f1cfe855466c5a4efa");

?>