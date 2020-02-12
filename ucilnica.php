<?php
    if(!isset($_GET['ucilnica']))
        header("Location: indeks.php");
    require_once 'php/dbconnect.php';
    require_once 'php/htmfunkcije.php';

    $ucilnica = $_GET['ucilnica'];
    navbar(3, "mainFunction()");
    levo();
    glava("$ucilnica");

    //dodajanje FORM-a za vnos podatkov preko JS
    vnos_podatkov();
    desno();
?>