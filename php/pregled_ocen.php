<?php
    require_once 'dbconnect.php';
    require_once 'dbfunkcije.php';
    require_once 'htmfunkcije.php';

    navbar(1);
    if(!isset($_SESSION['ucilnica']) || !isset($_SESSION['username']))
        header("Location: ../indeks.php");
    else if(vrstaClanstva($_SESSION['ucilnica'], $_SESSION['username']) != 1)
        header("Location: ../indeks.php");
        
    levo(0);
    glava("Pregled testov");

    if(!isset($_GET['testid']))
        izpisTestovZaPregled($_SESSION['ucilnica']);
    else
        izpisOcenZaTest($_GET['testid']);
    desno(0);
?>