<?php
    require_once 'dbfunkcije.php';
    require_once 'htmfunkcije.php';
    //argument je število minut
    navbar(1, "");
    levo(0);

    /*
    SELECT idvprasanja, vprasanje, idodgovori, odgovor, pravilen
FROM ucilnica u INNER JOIN test t ON u.imeucilnice = t.ucilnica_imeucilnice
INNER JOIN vprasanja v ON v.test_idtest = t.idtest
INNER JOIN odgovori o ON o.vprasanja_idvprasanja = v.idvprasanja
WHERE ime_testa = 'Sloni'
ORDER BY vprasanje, RAND()
*/
    if(!isset($_POST['idtest']))
    {
        glava("Reši test");
        izpisTestovZaResevanje($_SESSION['ucilnica']);
    }
    else if(isset($_SESSION['zacetek']))
    {
        header("Location: ../indeks.php");
    }
    else
    {
        $idtest = $_POST['idtest'];
        $_SESSION['idtest'] = $idtest;
        $_SESSION['zacetek'] = date("Y-m-d H:i:s");
        
        require_once 'dbconnect.php';

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
    desno(0);
?>