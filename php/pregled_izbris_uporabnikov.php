<?php
    require_once 'dbconnect.php';
    require_once 'dbfunkcije.php';
    require_once 'htmfunkcije.php';

    navbar(1, "");
    levo(0);
    glava("Pregled uporabnikov");

    if(!isset($_SESSION['ucilnica']))
        header("Location: ../indeks.php");
    else if(vrstaClanstva($_SESSION['ucilnica'], $_SESSION['upime']) != 1)
        header("Location: ../indeks.php");

    $ucilnica = $_SESSION['ucilnica'];

    izpisUporabnikov($ucilnica);

    desno(1);
?>