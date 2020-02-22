<pre>
<?php
    session_start();

    require_once 'dbconnect.php';

    $zacetek = $_SESSION['zacetek'];
    $trajanje = $_SESSION['trajanje'];
    $idtest = $_SESSION['idtest'];
    $st_vprasanj = $_SESSION['st_vprasanj'];
    $uporabnik = $_SESSION['upime'];

    $date_zacetek = new DateTime($zacetek);
    $date_konec = new DateTime(date("Y-m-d H:i:s"));

    $diff = $date_konec->diff($date_zacetek);
    $pretekel_cas = $diff->format('%i');
    echo "Pretekel čas v minutah: ".$diff->format('%i').'<br/>'; 
    /*
    začasno zakomentiral
    if($pretekel_cas > $trajanje)
        header("Location: ../indeks.php");
    else
        echo "Pretekel čas: $pretekel_cas <br/>";
    */
    var_dump($_SESSION); 
    echo '<p/>';
    var_dump($_POST);
    
    $q = "SELECT idvprasanja, idodgovori FROM
    vprasanja v INNER JOIN odgovori o ON v.idvprasanja = o.vprasanja_idvprasanja
    INNER JOIN test t ON t.idtest = v.test_idtest INNER JOIN ucilnica u 
    ON u.imeucilnice = t.ucilnica_imeucilnice 
    WHERE idtest = ? AND idvprasanja = ? AND pravilen = 'ja' ";

    $q = "SELECT idvprasanja, idodgovori
    FROM ucilnica u INNER JOIN test t ON u.imeucilnice = t.ucilnica_imeucilnice
    INNER JOIN vprasanja v ON v.test_idtest = t.idtest
    INNER JOIN odgovori o ON o.vprasanja_idvprasanja = v.idvprasanja
    WHERE idtest = ? AND pravilen = 'ja' AND idvprasanja = ?";

    $stmt = $conn->prepare($q);
    $stmt->bind_param("ii", $idtest, $idvprasanja);

    // začnem z branjem odgovorov iz $_POST
    $dosezene_tocke = 0;
    $i = 0;
    foreach($_POST as $k1 => $t1)
    {
        // izvršim SQL poizvedbo in dobim rezultate
        $idvprasanja = $k1;
        $stmt->execute();
        $result = $stmt->get_result();

        // če so prebrani podatki, nadaljujem z vrednotenjem
        if($result->num_rows > 0)
        {
            // v tabelo $row prenesem podatke iz SQL-a
            $row = array();
            while($row[] = $result->fetch_assoc())
            {
            }
            // preverim, če se število odgovorov ujema v bazi in aplikaciji
            if( (count($row)-1) == count($t1))
            {
                $tmpOdgovori = array();
                foreach($row as $r1)
                {
                    if(in_array($r1['idodgovori'], $t1))
                    {
                        $tmpOdgovori[] = $r1['idodgovori'];
                        // sploh ne pridem do te točke
                        echo '<br>'.$r1['idodgovori'];
                    }
                }
                if((count($row)-1) == count($tmpOdgovori))
                    $dosezene_tocke++;
            }
            /*else
            {
                // to sem odpravil
                echo "<br/>count ključ $k1 ni enak: count(row): ".count($row)
                .' count($t1): '.count($t1);
            }*/
        }
        $i++;
    }
    // dodaj urejeni izpis podatkov
    echo "<br/>Dosežene točke: ".$dosezene_tocke;
    echo "<br/>Število vprašanj: ".$i;

    $q = "INSERT INTO resuje VALUES(?, ?, ?, ?)";
    $stmt = $conn->prepare($q);
    $stmt->bind_param("issi", $idtest, $uporabnik, $zacetek, $dosezene_tocke);
    $stmt->execute();

    $conn->close();
?>
