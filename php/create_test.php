<?php
    require_once 'dbconnect.php';
    require_once 'dbfunkcije.php';

    require_once 'htmfunkcije.php';
    navbar(1, "vnosTesta()");
    if(!isset($_SESSION['username']) || !isset($_SESSION['ucilnica']))
        header("Location: ../indeks.php");
    else if(vrstaClanstva($_SESSION['ucilnica'], $_SESSION['username']) != 1)
        header("Location: ../indeks.php");

    levo(0);
    glava("Ustvari test");
    ?>
    <div id="vnosForm">
        <form method="post" action="insert_test.php">

        </form>
    </div>

    <?php
    desno(0);
?>