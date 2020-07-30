<?php
    session_start();
    require_once 'dbconnect.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $username = strtolower($conn->real_escape_string($data->username));
    $password = $data->password;

    $q = "SELECT hash, email, vkey FROM uporabnik WHERE upime = ?";
    $stmt = $conn->prepare($q);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $response = [];
    if($result->num_rows == 1)
    {
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['hash']))
        {
            if($row['vkey'] != "")
                $response['status'] = 'verify_account';
            else
            {
                $_SESSION['username'] = $username;
                $response['status'] = true;
            }
        }
        else
            $response['status'] = false;
    }
    else
        $response['status'] = false;
    echo json_encode($response);
?>