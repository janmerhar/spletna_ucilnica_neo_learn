<?php
    if(!isset($_GET['vkey']) || isset($_GET['email']))
        header("Location: ../indeks.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require '../PHPMailer/src/SMTP.php';
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';

    $mail = new PHPMailer(true);


    //Server settings
    $mail->SMTPDebug = /*SMTP::DEBUG_SERVER*/2;                      // Enable verbose debug output
    $mail->CharSet = "utf-8";
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.mail.com';                        // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'learn.ucilnica@mail.com';                     // SMTP username
    $mail->Password   = 'learn.ucilnica';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //Recipients
    $mail->setFrom('learn.ucilnica@mail.com', 'Learn Ucilnica');
    $mail->addAddress($_GET['email']);               // Name is optional

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Potrdite svoj uporabniški račun';
    $mail->Body    = '<p>Spoštovani!</p>Hvala za registracijo pri spletni učilnici Learn. Pred prvo prijavo morate potrditi svoj 
    e-poštni naslov s klikom na povezavo <a href="localhost/learn/learn-spletna_ucilnica/php/verify.php?vkey='.$_GET['vkey'].'"> potrdi račun.</a>';

    $mail->send();

?>