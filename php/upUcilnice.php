<?php
    require_once 'htmfunkcije.php';
    require_once 'dbconnect.php';
    require_once 'dbfunkcije.php';

    navbar(1, "");
    levo(0);
    glava("Moje učilnice");

    if(isset($_SESSION['ucilnica']))
        unset($_SESSION['ucilnica']);
    if(isset($_SESSION['upime']))
        header("Location: ../tmplogin.php");
    else
        $uporabnik = $_SESSION['username'];
    
    echo '<div class="vsebina_sklopa">';
    uporabnikoveUcilnice($uporabnik);
    echo '</div>';
    
    desno(0);
    if(isset($conn))
        $conn->close();
?>