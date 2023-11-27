<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require_once '../libraries/dbconnect.php';
    require_once '../libraries/jwt.php';

    $response['status'] = true;
    $mail = new PHPMailer(true);

    try {
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'spletna.prodajalna.ep@gmail.com';
        $mail->Password = 'mjythpndfffbxlke';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Sumniki fix
        $mail->CharSet = 'UTF-8';

        //Recipients
        $mail->setFrom('spletna.prodajalna.ep@gmail.com', 'Learn Ucilnica');
        $mail->addAddress($json_data['email']);               // Name is optional

        $vkey = md5(time() . $json_data['username']);
        $url ="localhost/spletna_ucilnica_neo_learn/php/loginregister/verify_account.php?vkey=$vkey";

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Potrdite svoj uporabniški račun';
        $mail->Body    = '<p>Spoštovani!</p>Hvala za registracijo pri spletni učilnici Learn. Pred prvo prijavo morate potrditi svoj 
        e-poštni naslov s klikom na povezavo ' . "<a href='$url'>$url</a>";

        $mail->send();
        // zgeneriram vkey in ga potem pošljem
        // tukaj potem še posodobim tabelo s podatki
        $db->rawQuery("
            UPDATE uporabnik
            SET vkey = ?
            WHERE upime = ?
        ", [ $vkey, $json_data['username'] ]);
    } catch (Exception $e) {
        $response['status'] = false;
    }
