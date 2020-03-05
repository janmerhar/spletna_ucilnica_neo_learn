<?php
    require_once 'dbconnect.php';
    require_once 'dbfunkcije.php';
    require_once 'htmfunkcije.php';

    navbar(1, "");
    if(!isset($_SESSION['username']) || !isset($_SESSION['ucilnica']))
        header("Location: ../indeks.php");
    levo(0);
    glava("Pregled testov");

    uporabnikoviNereseniTesti($_SESSION['ucilnica'], $_SESSION['username']);
    uporabnikoviTesti($_SESSION['ucilnica'], $_SESSION['username']);
    desno(0);
?>