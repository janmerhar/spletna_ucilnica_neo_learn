<?php
    function login($username, $geslo)
    {
        require_once 'dbconnect.php';
        //dodaj pred kratkim
        $username = $conn->real_escape_string($username);
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

    //spremeni count v order by DESC, limit 1
    function stSklopov()
    {
        global $conn;
        $q = "SELECT count(idsklop) as st FROM sklop";
        $result = $conn->query($q);
        $row = $result->fetch_assoc();
        if($row['st'] == 0)
            return 1;
        else 
        {
            $i = $row['st']+1; 
            return $i;
        }
    }
    require_once 'dbconnect.php';

    function izpis_sklopov($ucilnica)
    {
        global $conn;
        $ucilnica = $conn->real_escape_string($ucilnica);

        $q = "SELECT idsklop, idvsebine, ime_sklopa, vrsta, besedilo, datoteka 
        FROM sklop s
        INNER JOIN ucilnica u ON s.ucilnica_imeucilnice = u.imeucilnice
        INNER JOIN vsebina v ON v.sklop_idsklop = s.idsklop
        WHERE imeucilnice = ?
        ORDER BY idsklop, idvsebine";

        $stmt = $conn->prepare($q);
        $stmt->bind_param("s", $ucilnica);
        $stmt->execute();

        $result = $stmt->get_result();
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                //preverim, če sem že postavil ime sklopa
                if(!isset($idsklopa))
                {
                    $idsklopa = $row['idsklop'];
                    echo '<div class="vsebina_sklopa" id="'.$idsklopa.'">';
                    echo '<p>'.$row['ime_sklopa'].'</p>';
                    echo '<ul>';
                }
                //izpišem novo ime sklopa, če je se spremenil
                else if($idsklopa != $row['idsklop'])
                {    
                    $idsklopa = $row['idsklop'];
                    echo '</ul>';
                    echo '</div>';
                    echo '<div class="vsebina_sklopa" id="'.$idsklopa.'">';
                    echo '<p>'.$row['ime_sklopa'].'</p>';
                    echo '<ul>';
                }
                $id = $row['idsklop']. '.' .$row['idvsebine'];
                echo '<li id="'.$id.'">'.$row['besedilo'].'</li>';   
            }
            echo '</div>';
        }
    }

    function dodajClanstvo($ucilnica, $uporabnik, $clanstvo=2)
    {
        global $conn;

        $q = "INSERT INTO vclanjen VALUES(?, ?, ?)";
        $stmt = $conn->prepare($q);
        $stmt->bind_param("ssi", $ucilnica, $uporabnik, $clanstvo);
        if($stmt->execute())
            return 1;
        else
            $conn->error;
    }
    /*
        -1 => napaka v poizvedbi
        0 => ni najdenih vrstic
        1 => uporabnik: admin
        2 => uporabnik: user
    */
    function vrstaClanstva($ucilnica, $uporabnik)
    {
        global $conn;

        $q = "SELECT vrsta_clanstva FROM vclanjen WHERE uporabnik_upime=? AND ucilnica_imeucilnice=?";
        $stmt = $conn->prepare($q);
        $stmt->bind_param("ss", $uporabnik, $ucilnica);
        if($stmt->execute())
        {
            $result = $stmt->get_result();
            if($result->num_rows == 1)
            {
                $row = $result->fetch_assoc();
                if($row['vrsta_clanstva'] == 'user')
                    echo 2;
                else 
                    echo 1;
            }
            else
                return 0;
        }
        else
            return -1;
    }

    //require_once 'dbconnect.php';

    function idZaTest()
    {
        global $conn;
        $q = "SELECT idtest FROM test
        ORDER BY idtest DESC
        LIMIT 1";
        $stmt = $conn->prepare($q);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 0)
            return 1;
        else
        {
            $row = $result->fetch_assoc();
            $id = $row['idtest'] + 1;
            return $id;
        }
        return -1;
    } 
    $vpr = "vprasanje1";
    if($vpr[0] == "v")
        echo "enako";
?>
