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
                    $response['status'] = 'verify_account';
                else
                {
                    $response['status'] = true;
                    $payload = [
                        "username" => $username,
                        "exp" => time() + 15 * 60 
                    ];

                    $token = new Token($payload);
                    $response['token'] = $token->getToken();
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
        $response = $json_data;
    }

    echo json_encode($response);