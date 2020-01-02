<?php
    session_start();
    //Počistim polje asociativen tabele $_SESSION
    session_unset();
    //Končam sejo
    session_destroy();
    header("location: ../tmplogin.php");

?>