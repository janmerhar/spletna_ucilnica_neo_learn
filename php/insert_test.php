<pre>
<?php
    session_start();
    require_once 'dbconnect.php';
    require_once 'phpfunkcije.php';

    var_dump($_POST);
    echo '<br/>';
    var_dump($_SESSION);
    echo '<br/>';

    $podatki = array();
    $ignore = array("ime", "stvrpasanj", "trajanje");

    foreach($_POST as $k1 => $t1)
    {
        // ignoriran podatke, ki niso vprasanja/odgovori
        if(in_array($k1, $ignore))
            continue;
        // preverim spremenljivko za detekcijo spremembe vprašanj
        if(!isset($kVprasanje))
        {
            $kVprasanje = "vprasanje-1";
            $vprasanjeN = extractStevilo($kVprasanje);
            // SQL -> vnos vprašanja
            //echo '<p/>'.$vprasanje.'<br/>';
            //$podatki[$vprasanjeN][] = $t1;
        }
        // preverjam spremenljivko vprašanje
        else if(isset($kVprasanje))
        {
            if($k1[0] == "v")
            {
                if($kVprasanje != $k1)
                {
                    $kVprasanje = $k1;
                    $vprasanjeN = extractStevilo($kVprasanje);
                    echo '<p/>'.$kVprasanje.'<br/>';
                    // SQL -> vnos vprašanja
                    $podatki[$vprasanjeN][] = $t1;
                }
            }
            // polji ODG in RADIO
            else
            {   
                // polje za odgovor
                if($k1[0] == "o")
                {
                    $odgovor = $t1;
                    echo $odgovor;
                    //echo odZnakaNaprej(odZnakaNaprej("Odgovor13_243", "r"), "_");
                    $indeks = odZnakaNaprej(odZnakaNaprej($k1, "r"), "_");
                    $podatki[$vprasanjeN][$indeks][] = $odgovor;
                }
                // polje za vprašanje
                else
                {
                    $radio = $t1;
                    echo ' '.$radio.'<br/>';
                    $indeks = odZnakaNaprej(odZnakaNaprej($k1, "o"), "_");
                    $podatki[$vprasanjeN][$indeks][] = $radio;
                }
            }
        }
    }

    var_dump($podatki);
    /*
    razčisti real escape
    */
    $idtest = idZaTest();
    $ucilnica = $_SESSION['ucilnica'];
    $ime_testa = $_POST['ime'];
    $trajanje = $_POST['trajanje'];
    $st_vprasanj = $_POST['stvprasanj'];
    $viden = 2;
    $q = "INSERT INTO test VALUES(?, ?, ?, ?, ?, ?)";
    /*
    Tabela TEST
    - idtest => funkcija idZaTest()
    - ucilnica_imeulicnice => dobim iz $_SESSION
    - ime_testa => $_POST
    - trajanje => $_POST
    - st_vprasanj => $_POST
    - viden: 1 -> ja, 2 -> ne => DEFAULT ja, poznejša sprememba
    */

    /*
    Tabela vprasanja
    - idvprasanja => dobim iz NAME
    - test_idtest => tabela TEST
    - vprasanje => $_POST
    - tocke = 1 ?
    - slika NULLABLE -> bom odstranil
    */

    /*
    Tabela odgovori
    - idodgovori => auto_increment ???
    - odgovor => $_POST
    - pravilen: 1 -> ja, 2 -> ne => $_POST
    - vprasanja_idvprasanja tabela VPRASANJA
    - vprasanja_test_idtest tabela TEST
    */
    $conn->close();
?>