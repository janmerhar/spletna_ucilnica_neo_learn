<?php
    require_once 'dbfunkcije.php';
    require_once 'htmfunkcije.php';
    //argument je število minut
    navbar(1, "");
    levo(0);
    glava("Reši test");
    unset($_SESSION['zacetek']);
    /*
    if(!isset($_POST['idtest']) xor !isset($_GET['idtest']))
    {
        glava("Reši test");
        izpisTestovZaResevanje($_SESSION['ucilnica']);
    }
    else if(isset($_SESSION['zacetek']))
    {
        header("Location: ../indeks.php");
    }
    else
    */

    if((isset($_POST['idtest']) || isset($_GET['idtest'])) && !isset($_SESSION['zacetek']))
    {
        if(isset($_POST['idtest']))
            $idtest = $_POST['idtest'];
        else
            $idtest = $_GET['idtest'];
        $_SESSION['idtest'] = $idtest;
        $_SESSION['zacetek'] = date("Y-m-d H:i:s");
        $uporabnik = $_SESSION['username'];
        
        require_once 'dbconnect.php';

        if(aliJePisal($idtest, $uporabnik) == 1)
            header("Location: ../indeks.php");
            
        // dobim podatke o trajanju testa in število vprašanj 
        $q = "SELECT trajanje, st_vprasanj, ime_testa 
        FROM test t INNER JOIN ucilnica u ON t.ucilnica_imeucilnice = u.imeucilnice
        WHERE idtest = ?";
        $stmt_test = $conn->prepare($q);
        $stmt_test->bind_param("s", $idtest);
        $stmt_test->execute();
        $result_test = $stmt_test->get_result();
        $row_test = $result_test->fetch_assoc();

        glava($row_test['ime_testa']);
        $trajanje = $row_test['trajanje'];
        $_SESSION['trajanje'] = $trajanje;
        $st_vprasanj = $row_test['st_vprasanj'];
        $_SESSION['st_vprasanj'] = $st_vprasanj;
        
        ?>
        <div id="countdown">
        </div>
        <form action="vrednoti_test.php" method="post">
        <?php

            // dobim vprašanja in odgovore iz testa
            $q = "SELECT idvprasanja, vprasanje, idodgovori, odgovor
            FROM ucilnica u INNER JOIN test t ON u.imeucilnice = t.ucilnica_imeucilnice
            INNER JOIN vprasanja v ON v.test_idtest = t.idtest
            INNER JOIN odgovori o ON o.vprasanja_idvprasanja = v.idvprasanja
            WHERE idtest = ?
            ORDER BY vprasanje, RAND()";

            $stmt = $conn->prepare($q);
            $stmt->bind_param("s", $idtest);
            $stmt->execute();
            $result = $stmt->get_result();

            // izpis vprašanj uporabniku
            $vprasanje = "";
            while($row = $result->fetch_assoc())
            {
                if($vprasanje != $row['vprasanje'])
                {
                    // izpis vprašanja
                    if($vprasanje != "")
                        echo '<br/><br/>';
                    if($st_vprasanj <= 0)
                        break;
                    $vprasanje = $row['vprasanje'];
                    echo $vprasanje;
                    $st_vprasanj--;
                }
                // izpis možnosti za odgovore
                $name = $row['idvprasanja'].'[]';
                $value = $row["idodgovori"];
                $odgovor = $row['odgovor'];

                echo '<br/><input type="checkbox" name="'. $name .'" value="'. $value .'" />'. $odgovor;
            }
        ?>
        
        <br/><input type="submit" value="Zaključi z reševanjem" />
        </form>
        <script>
        countdown(<?php echo $trajanje; ?>)
        </script>
    
        <?php
    }
    else if(isset($_SESSION['zacetek']))
    {
        header("Location: ../indeks.php");
    }
    else
        izpisTestovZaResevanje($_SESSION['ucilnica']);
    desno(0);
?>