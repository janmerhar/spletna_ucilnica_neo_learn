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

        $q = "INSERT INTO uporabnik(upime, ime, priimek, email, vkey, hash)
        VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($q);
        $stmt->bind_param("ssssss", $username, $ime, $priimek, $email, $vkey, $hash);
        $vkey = md5($_POST['username'].time());

        if($stmt->execute())
        {
            header("Location: send.php?vkey=". $vkey ."&email=" . $email);
        }
        else // Če registracija spodleti, preusmerim uporabnika nazaj na polje za registracijo
        {
            header("location:../tmpregister.php");
        }
        if(isset($conn))
            $conn->close();
    }
    else
    header("location:../tmpregister.php");


?>