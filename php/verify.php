<?php
    require_once 'dbconnect.php';
    if(!isset($_GET['vkey']))
        header("Location: ../indeks.php");
    function verifyAccount($vkey)
    {
        global $conn;
        $q = "UPDATE uporabnik
        SET vkey = NULL
        WHERE vkey = ?";

        $stmt = $conn->prepare($q);
        $stmt->bind_param("s", $vkey);
        $stmt->execute();
        // preveri, če je ukaz uspel
        if($stmt->affected_rows == 1)
            return 1;
        else
            return 0;
    }
    header("Locatiton: ../indeks.php");

?>