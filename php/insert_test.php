<pre>
<?php
    session_start();
    require_once 'dbconnect.php';
    require_once 'phpfunkcije.php';
    require_once 'dbfunkcije.php';

    $podatki = urediVnosTesta();
    if(!isset($_SESSION['ucilnica']) || !isset($_SESSION['upime']))
        header("Location: ../indeks.php");
    if(vrstaClanstva($_SESSION['ucilnica'], $_SESSION['upime']) != 1)
        header("Location: ../indeks.php");
    // urejanje podatkov za vnos testa
    $idtest = idZaTest();
    $ucilnica = $_SESSION['ucilnica'];
    $ime_testa = $conn->real_escape_string($_POST['ime']);
    $trajanje = $_POST['trajanje'];
    $st_vprasanj = $_POST['stvprasanj'];
    $viden = 2;

    // vnesem v DB podatke o testu 
    $q = "INSERT INTO test VALUES(?, ?, ?, ?, ?, ?)";
    $test_stmt = $conn->prepare($q);
    $test_stmt->bind_param("issiii", 
    $idtest, $ucilnica, $ime_testa, $trajanje, $st_vprasanj, $viden);
    $test_stmt->execute();

    // vnos podatkov v DB od vprašanjih
    $q = "INSERT INTO vprasanja(idvprasanja, test_idtest, vprasanje, tocke)
    VALUES(?, ?, ?, 1)";
    $vprasanja_stmt = $conn->prepare($q);
    $vprasanja_stmt->bind_param("iis", $idvprasanja, $idtest, $vprasanje);
        // $vprasanja_stmt->execute(); --> potem, ko dobim vprasanje 
    
    // vnos podatkov v DB o odgovorih
    $q = "INSERT INTO odgovori(odgovor, pravilen, vprasanja_idvprasanja, vprasanja_test_idtest)
    VALUES(?, ?, ?, ?)";
    $odgovori_stmt = $conn->prepare($q);
    $odgovori_stmt->bind_param("ssii", $odgovor, $pravilen, $idvprasanja, $idtest);
        // $odgovori_stmt->execute(); --> ko dobim odgovore na vprašanja

    foreach($podatki as $k1 => $t1)    
    {
        // vnos vprašanj v DB
        $idvprasanja = idZaVprasanja();
        $vprasanje = $t1[0];
        $vprasanja_stmt->execute();

        // iskanje odgovorov na vprašanja
        foreach($t1 as $k2 => $t2)
        {
            if($k2 != 0)
            {
                $odgovor = $t2[0];
                $pravilen = $t2[1];
                $odgovori_stmt->execute();
            }
        }
    }

    if(isset($conn))
        $conn->close();
?>