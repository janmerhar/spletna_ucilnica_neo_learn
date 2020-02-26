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
                    return 2;
                else 
                    return 1;
            }
            else
                return 0;
        }
        else
            return -1;
    }

    require_once 'dbconnect.php';

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
    
    function idZaVprasanja()
    {
        global $conn;
        $q = "SELECT idvprasanja FROM vprasanja
        ORDER BY idvprasanja DESC
        LIMIT 1";
        $stmt = $conn->prepare($q);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 0)
            return 1;
        else
        {
            $row = $result->fetch_assoc();
            $id = $row['idvprasanja'] + 1;
            return $id;
        }
        return -1;
    } 

    function izpisTestovZaResevanje($ucilnica)
    {
        global $conn;
        $q = "SELECT DISTINCT ime_testa, idtest FROM test t INNER JOIN 
        ucilnica u ON u.imeucilnice=t.ucilnica_imeucilnice
        WHERE imeucilnice = ? AND vidnen = 'ja'";
        $stmt = $conn->prepare($q);
        $stmt->bind_param("s", $ucilnica);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows >= 1)
        {
            echo '<form method="post">';
            echo 'Izberite test: ';
            echo '<select name="idtest" required>';
            while($row = $result->fetch_assoc())
            {
                    echo '<option value="'.$row['idtest'].'">'.$row['ime_testa'].'</option>';
            }
            echo '</select>';
            echo '<input type="submit" value="Piši test"/>';
            echo '</form>';
        }
        else
        {
            echo "Ni najdenih testov!";
            // dodaj možnost za vnos teh
        }
    }

    require_once 'dbconnect.php';

    // izpis uporanikov, včlanjenih v učilnici
    function izpisUporabnikov($ucilnica)
    {
        global $conn;

        $q = "SELECT ime, priimek, upime, vrsta_clanstva FROM
        uporabnik u INNER JOIN vclanjen v ON u.upime = v.uporabnik_upime
        INNER JOIN ucilnica uc ON uc.imeucilnice = v.ucilnica_imeucilnice
        WHERE imeucilnice = ?
        ORDER BY vrsta_clanstva, priimek, ime, upime";

        $stmt = $conn->prepare($q);
        $stmt->bind_param("s", $ucilnica);
        $stmt->execute();
        $result = $stmt->get_result();

        echo '<table>';
        echo '<tr>';
            echo '<th>'. 'Ime' . '</th>';
            echo '<th>'. 'Priimek' . '</th>';
            echo '<th>'. 'Uporabniško ime' . '</th>';
            echo '<th>'. 'Vrsta članstva' . '</th>';
        echo '</tr>';
        while($row = $result->fetch_assoc())
        {
            echo '<tr>';
                echo '<td>'. $row['ime'] . '</td>';
                echo '<td>'. $row['priimek'] . '</td>';
                echo '<td>'. $row['upime'] . '</td>';
                if($row['vrsta_clanstva'] == 'admin')
                    $vrsta = "Skrbnik";
                else
                    $vrsta = "Uporabnik";
                echo '<td>'. $vrsta . '</td>';
                // dodaj še izbris ???
                if($vrsta == "Uporabnik")
                    echo '<td>'. '<a href="izbris_iz_ucilnice.php?uporabnik='. $row['upime'] .'">' ."izbriši iz učilnice". '</a>' .'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    //izpisUporabnikov("IKP");

    function izbrisIzUcilnice($ucilnica, $uporabnik)
    {
        global $conn;
        // brisanje uporabnikovega statusa znotraj učilnice: taela VCLANJEN
        $q = "DELETE FROM vclanjen WHERE uporabnik_upime = ? AND ucilnica_imeucilnice = ?";
        $stmt_vclanjen = $conn->prepare($q);
        $stmt_vclanjen->bind_param("ss", $uporabnik, $ucilnica);
        if($stmt_vclanjen->execute())
        {
            return 1;
        }
        else 
            return -1;
    }

    function aliJePisal($testid, $uporabnik)
    {
        global $conn;

        $q = "SELECT test_idtest, uporabnik_upime, rezultat
        FROM resuje r INNER JOIN uporabnik u ON r.uporabnik_upime = u.upime
        INNER JOIN test t ON t.idtest = r.test_idtest
        WHERE test_idtest = ? AND uporabnik_upime = ?";

        $stmt = $conn->prepare($q);
        $stmt->bind_param("is", $testid, $uporabnik);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 1)
            return 1;
        else
            return -1;
    }

    // izpis testov, ki jih je uporabnik že pisal
    function uporabnikoviTesti($ucilnica, $uporabnik)
    {
        global $conn;

        $q = "SELECT ime_testa, st_vprasanj, rezultat, zacetek, st_vprasanj
        FROM test t INNER JOIN resuje r ON t.idtest = r.test_idtest
        INNER JOIN uporabnik up ON r.uporabnik_upime = up.upime
        WHERE ucilnica_imeucilnice = ? AND uporabnik_upime = ? ";
        
        $stmt = $conn->prepare($q);
        $stmt->bind_param("ss", $ucilnica, $uporabnik);
        $stmt->execute();
        $result = $stmt->get_result();

        // tabela za teste, ki jih je uporabnik že rešil
        $reseniTesti = array();

        if($result->num_rows >= 1)
        {
            echo '<table>';
            echo '<tr>';
                echo '<th>'. 'Ime testa' . '</th>';
                echo '<th>'. 'Pričetek reševanja' . '</th>';
                echo '<th>'. 'Število možnih točk' . '</th>';
                echo '<th>'. 'Število doseženih točk' . '</th>';
                echo '<th>'. 'Rezultat' . '</th>';
            echo '</tr>';
            while($row = $result->fetch_assoc())
            {
                echo '<td>'. $row['ime_testa'] .'</td>';
                echo '<td>'. $row['zacetek'] .'</td>';
                echo '<td>'. $row['st_vprasanj'] .'</td>';
                echo '<td>'. $row['rezultat'] .'</td>';
                $odstotki = (float)$row['rezultat']/$row['st_vprasanj'];
                $odstotki *= 100;
                $odstotki = number_format($odstotki, 2, ",", ".");
                echo '<td>'. $odstotki .' %</td>';
                echo '</tr>';
                // dodam v tabelo test, ki ga je uporabnik že rešil
                $reseniTesti[] = $row['ime_testa'];
            }
            echo '</table>';
            return $reseniTesti;
        }
        else
        {
            //echo "Ni bilo najdenih testov!";
            return -1;
        }
    }
    
    // testi, ki jih uporabnik še ni pisal
    // še ne dela !!!
    // najprej najdem teste, ki jih je uporabnik že pisal, nato pa preberem vse iz učilnice in gledam, če so že bili rešeni
    function uporabnikoviNereseniTesti($ucilnica, $uporabnik)
    {
        global $conn;

        $reseniTesti = uporabnikoviTesti($ucilnica, $uporabnik);
        if(is_array($reseniTesti))
            $soTestiNaVoljo = false;
        
        $q = "SELECT ime_testa, trajanje, st_vprasanj
        FROM test 
        WHERE ucilnica_imeucilnice = ? AND vidnen = 'ja' ";

        $stmt = $conn->prepare($q);
        $stmt->bind_param("s", $ucilnica);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows >= 1)
        {
            echo '<table>';
            echo '<tr>';
                echo '<th>'. 'Ime testa' . '</th>';
                echo '<th>'. 'Število točk' . '</th>';
                echo '<th>'. 'Časovna omejitev' . '</th>';
            echo '</tr>';
            while($row = $result->fetch_assoc())
            {
                if(isset($soTestiNaVoljo))
                {
                    if(!in_array($row['ime_testa'], $reseniTesti))
                    {
                        $soTestiNaVoljo = true;
                        echo '<tr>';
                        echo '<td>'. $row['ime_testa'] .'</td>';
                        echo '<td>'. $row['st_vprasanj'] .'</td>';
                        echo '<td>'. $row['trajanje'] . ' min' .'</td>';
                        // resi test !!!
                        echo '</tr>';
                    }
                }
                else
                {
                    echo '<tr>';
                    echo '<td>'. $row['ime_testa'] .'</td>';
                    echo '<td>'. $row['st_vprasanj'] .'</td>';
                    echo '<td>'. $row['trajanje'] . ' min' .'</td>';
                    // resi test !!!
                    echo '</tr>';
                }
            }
            echo '</table>';
        }
        if(isset($soTestiNaVoljo))
            if($soTestiNaVoljo == false)
                echo "Ni na voljo testov za reševanje!";
    }
    // v bistvu lahko samo to funkcijo kličem in na ta način izpišem rešene in nerešene teste
    // uporabnikoviNereseniTesti('IKP', 'merjan');

    function odstraniClanstvo($ucilnica, $uporabnik)
    {
        global $conn;

        $q = " DELETE FROM vclanjen 
        WHERE vclanjen.ucilnica_imeucilnice = ? AND vclanjen.uporabnik_upime = ? 
        AND vrsta_clanstva != 'admin'";

        $stmt = $conn->prepare($q);
        $stmt->bind_param("ss", $ucilnica, $uporabnik);
        $stmt->execute();

        if($stmt->affected_rows == 1)
            return 1;
        else
            return -1;
    }
  
    function spremeniVidnostTesta($idtest, $vidnost)
    {
        global $conn;
        $q = "UPDATE test 
        SET vidnen = ?
        WHERE idtest = ?";

        $stmt = $conn->prepare($q);
        $stmt->bind_param("si", $vidnost, $idtest);
        $stmt->execute();

        if($stmt->affected_rows == 1)
            return 1;
        else
            return -1;
    }
    //echo spremeniVidnostTesta(1, 'ja');

    // izpis ocen uporabnikov za posamičen test
    function izpisOcenZaTest($testid)
    {
        global $conn;
        $q = "SELECT test_idtest, upime, ime, priimek, zacetek, rezultat, st_vprasanj
        FROM uporabnik u INNER JOIN resuje r ON u.upime = r.uporabnik_upime
        INNER JOIN test t ON t.idtest = r.test_idtest
        WHERE idtest = ?
        ORDER BY priimek, ime";

        $stmt = $conn->prepare($q);
        $stmt->bind_param("s", $testid);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0)
        {
            echo '<table>';
            echo '<tr>';
                echo '<th>'. 'Ime' . '</th>';
                echo '<th>'. 'Priimek' . '</th>';
                echo '<th>'. 'Uporabniško ime' . '</th>';
                echo '<th>'. 'Dosežene točke' . '</th>';
                echo '<th>'. 'Rezultat' . '</th>';
            echo '</tr>';
            echo '<pre>';
            while($row = $result->fetch_assoc())
            {
                $tocke = $row['rezultat'];
                $mozneTocke = $row['st_vprasanj'];
                $rezultat = (float)$tocke/$mozneTocke;
                $rezultat = ($rezultat) * 100;
                $rezultat = number_format($rezultat, 2, ',' , '.');

                echo '<tr>';                
                    echo '<td>'. $row['ime'] .'</td>';
                    echo '<td>'.$row['priimek'] .'</td>';
                    echo '<td>'. $row['upime'].'</td>';
                    echo '<td>'.$tocke.' / '. $mozneTocke .'</td>';
                    echo '<td>'. $rezultat. ' %' .'</td>';
                echo '</tr>';                
            }
            echo '</table>';
        }
        else
            echo "Ni še rešenih testov";
    }
    // izpisOcenZaTest(2);

    function izpisTestovZaPregled($ucilnica)
    {
        global $conn;
        $q = "SELECT ime_testa, idtest, trajanje, st_vprasanj, vidnen FROM test t INNER JOIN 
        ucilnica u ON u.imeucilnice=t.ucilnica_imeucilnice
        WHERE imeucilnice = ?";

        $stmt = $conn->prepare($q);
        $stmt->bind_param("s", $ucilnica);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0)
        {
            // struktura izpisa tabele
            /*
                ime testa
                trajanje
                število vprašanj
                vidnost => omogoči spremembe
                vpogled ocen testa ==> dodaj še pozneje 
            */

            echo '<table>';
            echo '<tr>';
                echo '<th>'. 'Ime testa'.'</th>';
                echo '<th>'. 'Število vprašanj'.'</th>';
                echo '<th>'. 'Trajanje'.'</th>';
                echo '<th>'. 'Vidnost'.'</th>';
            echo '</tr>';
            while($row = $result->fetch_assoc())
            {
                echo '<tr>';
                    // ko kliknem na ime testa se odprejo ocene uporabnikov => dam notri testid
                    $imeTesta = '<a href="pregled_ocen.php?testid='. $row['idtest'] .'">'.$row['ime_testa'].'</a>';
                    echo '<td>'. $imeTesta .'</td>';

                    echo '<td>'. $row['st_vprasanj'] .'</td>';
                    echo '<td>'. $row['trajanje'] .'</td>';
                    $videnHTML = '<a href="testi.php?vidnost='.$row['vidnen'].'?idtest='.$row['idtest'].'">';
                    if($row['vidnen'] == 'ja')
                    {
                        $izpis = $videnHTML.'JA</a> / NE';
                    }
                    else
                        $izpis = 'JA / '.$videnHTML. 'NE</a>';
                    
                    echo '<td>'. $izpis .'</td>';
                echo '</tr>';
                
                // var_dump($row);
                // echo '<br/>';
            }
            echo '</table>';
        }
        
    }
    //izpisTestovZaPregled('IKP');
?>
