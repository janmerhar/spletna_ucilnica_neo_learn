<?php
    session_start();
    if(isset($_SESSION['username']))
        die("Ste že prijavljeni!");
    else if(isset($_POST['username']) && isset($_POST['password']))
    {  
        require_once 'dbconnect.php';

        $username = strtolower($_POST['username']);
        $password = $_POST['password'];

        $sql = "SELECT geslo FROM uporabnik WHERE upime = '$username'";
        $result = $conn->query($sql);

        if($result->num_rows == 1)
        {
            $row = $result->fetch_assoc();
            if($row['geslo'] == $password)
            {
                echo "Prijavljen!";
                $_SESSION['username'] = $username;
                echo "<br/>".$_SESSION['username'];
            }
            else
                echo "Nepravilno geslo!";
        }
        else
        {
            die("Ne najdem uporabnika!");
        }
    }
?>