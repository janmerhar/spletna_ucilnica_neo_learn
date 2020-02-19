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
    if(!isset($_POST['test']))
    {
        glava("Reši test");
        izpisTestovZaResevanje($_SESSION['ucilnica']);
    }
    else
    {
        $test = $_POST['test'];
        glava($test);
        ?>
        <div id="countdown">
        </div>
        <form action="neobstaja.php">
        <?php
            require_once 'dbconnect.php';

            // dobim podatke o trajanju testa in število vprašanj 
            $q = "SELECT trajanje, st_vprasanj 
            FROM test t INNER JOIN ucilnica u ON t.ucilnica_imeucilnice = u.imeucilnice
            WHERE ime_testa = ?";
            $stmt_test = $conn->prepare($q);
            $stmt_test->bind_param("s", $test);
            $stmt_test->execute();
            $result_test = $stmt_test->get_result();
            $row_test = $result_test->fetch_assoc();

            $trajanje = $row_test['trajanje'];
            $st_vprasanj = $row_test['st_vprasanj'];

            // dobim vprašanja in odgovore iz testa
            $q = "SELECT idvprasanja, vprasanje, idodgovori, odgovor
            FROM ucilnica u INNER JOIN test t ON u.imeucilnice = t.ucilnica_imeucilnice
            INNER JOIN vprasanja v ON v.test_idtest = t.idtest
            INNER JOIN odgovori o ON o.vprasanja_idvprasanja = v.idvprasanja
            WHERE ime_testa = ?
            ORDER BY vprasanje, RAND()";

            $stmt = $conn->prepare($q);
            $stmt->bind_param("s", $test);
            $stmt->execute();
            $result = $stmt->get_result();

            // izpis vprašanj uporabniku

            // dodaj še odštevanje vprašanj
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
            //echo '<pre>';
            //var_dump($row);
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