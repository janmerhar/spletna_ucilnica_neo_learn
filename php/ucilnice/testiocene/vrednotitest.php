<?php
    require_once '../../libraries/dbconnect.php';
    require_once '../../libraries/jwt.php';

    $response['status'] = false;

    /*
        struktura POST [
            "testid"
            "username"
            "zacetek"
            "odgovori" => [
                idvprasanje: int => [
                    idodgovora: int, idodgovora: int, ...
                ],
            ]
        ]
    */

    /*
        vrstni red:
        - preveri, ali je test rešen v časovnem obdobju, sicer daj -1 točk => kasneje naredi tako, da bo podatek o začetku že v bazi in ga na koncu le posodobiš
        - 
        - prevzemi odgovore za dani id polja
        - preveli, ali je število DB odgovorov enako odgovorom v $_POST 
        - če je, jih preveri vsakega posebej, sicer daj 0 točk
        - ponovi
        ...
        - INSERT podatke v tabelo RESUJE
    */
    $tocke = 0;

    // preverim, ali je čas reševanja potekel
    $zacetek = $db->rawQueryValue("
        SELECT zacetek FROM resuje
        WHERE uporabnik_upime = ? 
        AND test_idtest = ? 
    ", [$_POST['username'], $_POST['testid']])[0];
    $date_zacetek = new DateTime($zacetek);
    $date_konec = new DateTime(date("Y-m-d H:i:s"));

    $diff = $date_konec->diff($date_zacetek);
    $pretekel_cas = $diff->format('%i');
    $casNaVoljo = $db->rawQueryValue("
        SELECT trajanje FROM test
        WHERE idtest = ?
    ", [$_POST['testid']])[0];

    // tukaj preverim koliko časa je že preteklo
    // dve minuti razmika
    if(($casNaVoljo + 2) > $pretekel_cas)
    {
        $tocke = -1;
        $response['status'] = false;
    }
    // začetek z vrednotenjem odgovorom
    else if(isset($_POST['odgovori']) AND !empty($_POST['odgovori']))
    {
        foreach($_POST['odgovori'] as $vprasanjeId => $odgovori)
        {
            // preverim, ali število odgovorov ustreza številu vprašanj
            $odgovoriDB = $db->rawQuery("SELECT idodgovori 
            FROM odgovori
            WHERE vprasanja_test_idtest = ?
            AND vprasanja_idvprasanja = ?
            AND pravilen = 'ja'", [$_POST['testid'], $vprasanjeId]);
            
            if(count($odgovoriDB) == count($odgovori))
            {
                $isTocka = true;
                foreach($odgovoriDB as $k1 => $array_odgovor)
                {
                    // id odgovora, ki je bil poslan
                    // echo $array_odgovor['idodgovori'];
                    if(!in_array($array_odgovor['idodgovori'], $odgovori))
                        $isTocka = false;
                }
                if($isTocka)
                    $tocke++;
            }
        }
    }

    // UPDATE zabela RESUJE
    $q = "UPDATE resuje
    SET rezultat = ?
    WHERE test_idtest = ? AND uporabnik_upime = ?";

    $db->rawQuery($q, [$tocke, $_POST['testid'], $_POST['username']]);
    echo json_encode($response);