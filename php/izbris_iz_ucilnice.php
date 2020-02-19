<?php
    session_start();
    if(!isset($_SESSION) || !isset($_GET['uporabnik']))
        header("Location: ../indeks.php");
    $uporabnikSession = $_SESSION['username'];
    $uporabnikIzbris = $_GET['uporabnik'];
    $ucilnica = $_SESSION['ucilnica'];

    require_once 'dbconnect.php';
    require_once 'dbfunkcije.php';

    // preverim, če je uporabnik ADMIN in ga, v primeru, da je, zavrnem
    if(vrstaClanstva($ucilnica, $uporabnikIzbris) == 1)
        header("Location: ../indeks.php");
    if($uporabnikSession == $uporabnikIzbris)
    {
        // brisanje uporabnikovega statusa znotraj učilnice: taela VCLANJEN
        $q = "DELETE FROM vclanjen WHERE uporabnik_upime = ? AND ucilnica_imeucilnice = ?";
        $stmt_vclanjen = $conn->prepare($q);
        $stmt_vclanjen->bind_param("ss", $uporabnikIzbris, $ucilnica);
        if($stmt_vclanjen->execute())
        {
            echo "Uspešen izbris";
        }
    }
    echo "Neuspešen izbris";
?>