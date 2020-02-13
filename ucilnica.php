<?php
    require_once 'php/htmfunkcije.php';
    require_once 'php/dbconnect.php';
    require_once 'php/dbfunkcije.php';

    navbar(3, "mainFunction()");
    if(!isset($_GET['ucilnica']))
        header("Location: indeks.php");
    $_SESSION['ucilnica'] = $_GET['ucilnica'];
    

    $ucilnica = $_SESSION['ucilnica'];
    levo(1);
    glava("$ucilnica");

    izpis_sklopov($ucilnica);
    //dodajanje FORM-a za vnos podatkov preko JS
    vnos_podatkov();
    desno();
    //izpis_sklopov($ucilnica);
?>