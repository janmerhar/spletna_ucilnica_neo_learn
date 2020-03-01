<?php
    require_once 'phpfunkcije.php';
    preveriLogin(1);

    require_once 'dbconnect.php';

    $imeucilnice = $conn->real_escape_string($_POST['imeucilnice']);
    // 1 => DA, 2 => NE
    $vrsta_ucilnice = $conn->real_escape_string($_POST['zaseben']);
    if($vrsta_ucilnice == 1)
        $kljuc = $conn->real_escape_string($_POST['geslo']);
    else
        $kljuc = "NULL";
    $opis = $conn->real_escape_string($_POST['opisucilnice']);
    if(strlen($opis) <= 1)
        $opis = "NULL";
    $kategorija = $conn->real_escape_string($_POST['kategorija']);

    //Vnašam podatke v tabelo UCILNICA
    $sql = "INSERT INTO ucilnica 
            VALUES('$imeucilnice', '$vrsta_ucilnice', '$kljuc', '$opis', '$kategorija')";

    if(!$conn->query($sql))
        die($conn->error);

    //vpisuje podatke o članstvu v pomožno tabelo VCLANJEN
    $upime = $_SESSION['username'];

    $sql = "INSERT INTO vclanjen 
            VALUES('$imeucilnice', '$upime', 'admin')";
    if($conn->query($sql))
    {
        header("Location: ../ucilnica.php?ucilnica=".$imeucilnice);
    }
    else
    {
        header("Location: ../indeks.php");
    }
    if(isset($conn))
        $conn->close();
?>