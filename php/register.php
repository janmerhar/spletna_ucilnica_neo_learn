<?php

    require_once 'dbconnect.php';

    if($_POST['geslo'] == $_POST['geslo2'] && $_POST['email1'] == $_POST['email2'])
    {
        //Sanitiranje podatkov
        //in preprečevanje SQL Inject-ov
        $username = strtolower($conn->real_escape_string($_POST['username']));
        
        // HASHiranje gesla
        $geslo = $conn->real_escape_string($_POST['geslo']);
        $hash = password_hash($geslo, PASSWORD_DEFAULT);

        $ime = $conn->real_escape_string($_POST['ime']);
        $priimek = $conn->real_escape_string($_POST['priimek']);
        $email = $conn->real_escape_string($_POST['email1']);
        $vkey = md5(time().$username);

        // dodaj PHPMailer
        /*


        */

        $q = "INSERT INTO uporabnik(upime, geslo, ime, priimek, email, vkey, hash)
        VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($q);
        $stmt->bind_param("sssssss", $username, $geslo, $ime, $priimek, $email, $vkey, $hash);

        if($stmt->execute())
        {
            header("location:../tmplogin.php");
        }
        else //Če registracija spodleti, preusmerim uporabnika nazaj na polje za registracijo
        {
            header("location:../tmpregister.php");
        }
        if(isset($conn))
            $conn->close();
    }
    else
    header("location:../tmpregister.php");


?>