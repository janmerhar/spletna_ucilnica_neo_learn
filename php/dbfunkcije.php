<?php
    function login($username, $geslo)
    {
        require_once 'dbconnect.php';
        $sql = "SELECT geslo FROM uporabnik WHERE upime = '$username'";

        $result = $conn->query($sql);
        if($result->num_rows == 1)
        {
            $row = $result->fetch_assoc();
            if($row['geslo'] == $geslo)
                return true;
            else
                return false;
                
        }
        else
            return false;
    }
    //login('merjan', '123');

    //Dodaj še izpis s pomočjo elementa SELECT 
    /*  TO-DO
        UTF-8 encoding težave
        https://www.toptal.com/php/a-utf-8-primer-for-php-and-mysql
    */
    function izbor_kategorije()
    {
        require_once 'dbconnect.php';
        
        $sql = "SELECT imekategorije FROM kategorija";
        $result = $conn->query($sql);
            echo '<select name="kategorija">';
            while($row = $result->fetch_assoc())
                echo '<option value="'.$row['imekategorije'].'">'.$row['imekategorije'].'</option>';
            echo '</select>';
    }
?>
