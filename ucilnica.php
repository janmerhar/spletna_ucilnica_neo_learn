<?php
    if(!isset($_GET['ucilnica']))
        header("Location: indeks.php");
    $_SESSION['ucilnica'] = $_GET['ucilnica'];
    require_once 'php/dbconnect.php';
    require_once 'php/htmfunkcije.php';

    $ucilnica = $_GET['ucilnica'];
    navbar(3, "mainFunction()");
    levo(1);
    glava("$ucilnica");

    ?>
    <!-- Ali naj dodam v funkcijo? -->
    <div class="vsebina_sklopa" id="1">
        <p>Naslov sklopa</p>
        <ul>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <?php

    //dodajanje FORM-a za vnos podatkov preko JS
    vnos_podatkov();
    desno();
?>