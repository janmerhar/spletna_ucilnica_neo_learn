<?php
    $conn = new mysqli("localhost", "root", "", "learn");
    $conn->set_charset("utf8");

    $vkey = $conn->real_escape_string($_GET["vkey"]);


    $q = "UPDATE uporabnik SET vkey = NULL WHERE vkey = ?";

    $stmt = $conn->prepare($q);
    $stmt->bind_param("s", $vkey);
    $stmt->execute();

    header("Location: http://localhost:8080");