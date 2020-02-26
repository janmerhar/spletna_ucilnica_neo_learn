<?php

    require_once 'dbconnect.php';

    if($_POST['geslo'] == $_POST['geslo2'])
    {
        //Sanitiranje podatkov
        //in preprečevanje SQL Inject-ov
        $username = strtolower($conn->real_escape_string($_POST['username']));
        $geslo = $conn->real_escape_string($_POST['geslo']);
        $ime = $conn->real_escape_string($_POST['ime']);
        $priimek = $conn->real_escape_string($_POST['priimek']);

        $sql = "INSERT INTO uporabnik(upime, geslo, ime, priimek)
        VALUES('$username', '$geslo', '$ime', '$priimek')";

        if($conn->query($sql))
        {
            header("location:../tmplogin.php");
        }
        else //Če registracija spodleti, preusmerim uporabnika nazaj na polje za registracijo
        {
            //header("location:../tmpregister.php");
            echo $conn->error;
        }
        if(isset($conn))
            $conn->close();
    }
    else
    header("location:../tmpregister.php");


?>