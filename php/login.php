<?php
    session_start();
    if(isset($_SESSION['username']))
        header("Location: ../indeks.php");
    else if(isset($_POST['username']) && isset($_POST['password']))
    {  
        require_once 'dbconnect.php';
        //dodaj SQL injection prevention
        $username = strtolower($conn->real_escape_string($_POST['username']));
        $password = $conn->real_escape_string($_POST['password']);

        $q = "SELECT hash FROM uporabnik WHERE upime = ?";
        $stmt = $conn->prepare($q);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 1)
        {
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['hash']))
            {
                $_SESSION['username'] = $username;
                header("Location: ../indeks.php");
            }
            else
                header("Location: ../tmplogin.php");
        }
        else
        {
            header("Location: ../tmplogin.php");
        }
    }
    if(isset($conn))
        $conn->close();
?>