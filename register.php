<?php
//Funkcija, ki pošlje uporabniko e-pošto za potrditev uporabniškega računa
/* SCRAPPED
function send_verification_email($email, $vkey)
{
    $subject = "Potditev registracije";
    $message = "<a href='http://localhost/php/verify.php?vkey=$vkey'>Potrdi račun</a>";
    $headers = 'From: ucilnica.learn@yahoo.com' . "\r\n" .
    'Reply-To: ucilnica.learn@yahoo.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    mail($email, $subject, $message, $headers);

    header('location:login-page.php');

}
*/
    require_once 'php/dbconnect.php';

    if($_POST['email'] == $_POST['email2'] && $_POST['geslo'] == $_POST['geslo2'])
    {
        //Sanitiranje podatkov
        //in preprečevanje SQL Inject-ov
        $username = $conn->real_escape_string($_POST['username']);
        $geslo = $conn->real_escape_string($_POST['geslo']);
        $email = $conn->real_escape_string($_POST['email']);
        $ime = $conn->real_escape_string($_POST['ime']);
        $priimek = $conn->real_escape_string($_POST['priimek']);

        //Naredim ključ za verifikacijo
        $vkey = md5(time().$username);
        
        //MD5 inkripcija gesla
        //$geslo = md($geslo);

        $sql = "INSERT INTO uporabnik 
        VALUES('$username', '$geslo', '$email','$ime', '$priimek', '$vkey', 0)";

        if($conn->query($sql))
        {
            send_verification_email($email, $vkey);
            header("location:login-page.php");
        }
        else //Če registracija spodleti, preusmerim uporabnika nazaj na polje za registracijo
        {
            header("location:register-page.php");
        }
        
    }
    else
    header("location:register-page.php");

?>