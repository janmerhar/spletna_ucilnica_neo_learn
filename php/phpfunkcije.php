<?php
    //Funkcija preverja, če je uporabnik prijavljen in 
    //ga po potrebi preusmeri na drugo stran
    function preveriLogin($status = 1, $lokacija = "tmplogin.php")
    {
        //Preverim, če je seja inicializirana
        if(session_status() == PHP_SESSION_NONE)
            session_start();

        //Uporabnika preusmerim na tmplogin.php, če ni prijavljen
        if(!isset($_SESSION['username']))
        {
            if($status == 1)
                header("location: ../$lokacija");
            else
                header("location: $lokacija");
        }
    }

?>