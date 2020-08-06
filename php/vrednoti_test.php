<?php
    require_once 'htmfunkcije.php';
    require_once 'dbconnect.php';

    navbar(1);
    levo(0);

    if(!isset($_SESSION['zacetek']) || !isset($_SESSION['username']) || !isset($_SESSION['ucilnica']))
        header("Location: ../indeks.php");

    $zacetek = $_SESSION['zacetek'];
    $trajanje = $_SESSION['trajanje'];
    $idtest = $_SESSION['idtest'];
    $st_vprasanj = $_SESSION['st_vprasanj'];
    $uporabnik = $_SESSION['username'];

    $date_zacetek = new DateTime($zacetek);
    $date_konec = new DateTime(date("Y-m-d H:i:s"));

    $diff = $date_konec->diff($date_zacetek);
    $pretekel_cas = $diff->format('%i');

    if($pretekel_cas > $trajanje)
    {
        $q = "INSERT INTO resuje VALUES(?, ?, ?, ?)";
        $stmt = $conn->prepare($q);
        $stmt->bind_param("issi", $idtest, $uporabnik, $zacetek, $dosezene_tocke);

        // vnesem prazno število
        $dosezene_tocke = 0;
        $stmt->execute();
    }

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
            if((count($row)-1) == count($t1))
            {
                $tmpOdgovori = array();
                foreach($row as $r1)
                {
                    if(isset($r1['idodgovori']))
                    {
                        if(in_array($r1['idodgovori'], $t1))
                        {
                            $tmpOdgovori[] = $r1['idodgovori'];
                        }
                    }
                }
                if((count($row)-1) == count($tmpOdgovori))
                    $dosezene_tocke++;
            }
        }
        $i++;
    }
    glava("Rezultat");

    $q = "INSERT INTO resuje VALUES (?, ?, ?, ?)";
    $stmt_test = $conn->prepare($q);
    $stmt_test->bind_param("issi", $idtest, $uporabnik, $zacetek, $dosezene_tocke);
    echo "Dosežene točke: ".$dosezene_tocke;
    echo "<br/>Število vprašanj: ".$i;

    if(!$stmt_test->execute())
        echo 'Napaka pri vnosu';

    desno(0);
    unset($_SESSION['zacetek']);
    if(isset($conn))
        $conn->close();
?>
