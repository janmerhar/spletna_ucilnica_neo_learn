<?php
    require_once 'dbconnect.php';
    require_once 'dbfunkcije.php';
    require_once 'htmfunkcije.php';

    session_start();
    if(!isset($_SESSION['username']))
        header("Location: ../indeks.php");
    else if(vrstaClanstva($_SESSION['ucilnica'], $_SESSION['username']) != 1)
        header("Location: ../indeks.php");
    if(!isset($_GET['vidnost']) || !isset($_GET['idtest']))
        header("Location: ../indeks.php");
    else
    {
        spremeniVidnostTesta($_GET['idtest'], $_GET['vidnost']);
        header("Location: pregled_ocen.php");
    }

    if(isset($conn))
        $conn->close();
?>