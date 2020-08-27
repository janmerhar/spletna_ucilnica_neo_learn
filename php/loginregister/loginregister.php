<?php

    require_once '../libraries/dbconnect.php';
    require_once '../libraries/jwt.php';

    $response = [];

    if($json_data['isLogin'] === true) 
    {
        // login
        $username = strtolower($conn->real_escape_string($json_data['username']));
        $password = $json_data['password'];

        $q = "SELECT hash, email, vkey FROM uporabnik WHERE upime = ?";
        $stmt = $conn->prepare($q);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows == 1)
        {
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['hash']))
            {
                if($row['vkey'] != "")
                {
                    $response['status'] = 'verify_account';
                    // dodaj še obvestilo o nepotrjenem računu
                }
                else
                {
                    $response['status'] = true;
                    $payload = [
                        "username" => $username,
                        "exp" => time() + 15 * 60 
                    ];

                    $token = new Token($payload);
                    $response['token'] = $token->getToken();
                    $response['username'] = $token->getUsername();
                }
            }
            else
                $response['status'] = false;
        }
        else
            $response['status'] = false;
    }
    else if($json_data['isLogin']  === false) 
    {
        // register
        $username = strtolower($conn->real_escape_string($json_data['username']));
        
        // HASHiranje gesla
        $geslo = $conn->real_escape_string($json_data['password']);
        $hash = password_hash($geslo, PASSWORD_DEFAULT);

        $ime = $conn->real_escape_string($json_data['ime']);
        $priimek = $conn->real_escape_string($json_data['priimek']);
        $email = $conn->real_escape_string($json_data['email']);

        $q = "INSERT INTO uporabnik(upime, ime, priimek, email, vkey, hash)
        VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($q);
        $stmt->bind_param("ssssss", $username, $ime, $priimek, $email, $vkey, $hash);
        $vkey = md5($json_data['username'] . time());

        $stmt->execute();
        if($stmt->affected_rows == 1)
        {
            $response['status'] = true;
            
            // pošlji email => PHPMailer
        }
    }

    echo json_encode($response);