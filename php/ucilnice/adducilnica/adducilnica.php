<?php
    require_once '../../libraries/dbconnect.php';
    require_once '../../libraries/jwt.php';

    $response['status'] = true;

    $imeucilnice = htmlspecialchars($conn->real_escape_string($json_data['imeUcilnice']));
    // 1 => DA, 2 => NE
    $vrsta_ucilnice = htmlspecialchars($conn->real_escape_string($json_data['isJavna']));
    if($vrsta_ucilnice != "zasebna")
        $kljuc = $conn->real_escape_string($json_data['geslo']);
    else
        $kljuc = "NULL";
    $kategorija = $conn->real_escape_string($json_data['kategorija']);

    //Vnašam podatke v tabelo UCILNICA
    $q = "INSERT INTO ucilnica 
            VALUES('$imeucilnice', '$vrsta_ucilnice', '$kljuc', '$kategorija')";

    $conn->query($q);

    //vpisuje podatke o članstvu v pomožno tabelo VCLANJEN
    // $upime = $_SESSION['username'];
    $upime = 'merjan';

    $q = "INSERT INTO vclanjen 
            VALUES('$imeucilnice', '$upime', 'admin')";
    if($conn->query($q))
        $response['status'] = true;

    $conn->close();
    echo json_encode($response);