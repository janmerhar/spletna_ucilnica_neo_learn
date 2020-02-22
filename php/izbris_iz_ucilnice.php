<?php
    session_start();
    
    require_once 'dbconnect.php';
    require_once 'dbfunkcije.php';

    if(!isset($_SESSION['upime']) || !isset($_GET['uporabnik']))
        header("Location: ../indeks.php");
    
    $uporabnikSession = $_SESSION['username'];
    $uporabnikIzbris = $_GET['uporabnik'];
    $ucilnica = $_SESSION['ucilnica'];


    if($uporabnikSession == $uporabnikIzbris)
    {
        if(vrstaClanstva($ucilnica, $uporabnikSession) != 1)
            if(izbrisIzUcilnice($ucilnica, $uporabnikIzbris))
                echo "Uporabnik izbrisan";
            else
                echo "Napaka pri brisanju uporabnika";
    }
    else if(vrstaClanstva($ucilnica, $uporabnikSession) == 1)
    {
        izbrisIzUcilnice($ucilnica, $uporabnikIzbris);
    }

?>