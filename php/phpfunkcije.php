<?php
    //Funkcija preverja, če je uporabnik prijavljen in 
    //ga po potrebi preusmeri na drugo stran
    function preveriLogin($status = 1, $lokacija = "tmplogin.php")
    {
        //Preverim, če je seja inicializirana
        if(session_status() == PHP_SESSION_NONE)
            session_start();

        //Uporabnika preusmerim na tmplogin.php, če ni prijavljen
        if(!isset($_SESSION['username']))
        {
            if($status == 1)
                header("location: ../$lokacija");
            else
                header("location: $lokacija");
        }
    }
    function extractStevilo($id)
    {
        $str = preg_replace('/\D/', '', $id);
        return $str;
    }


    // vnesem STRING in znak, do katerega naprej želim odstrezati string
    function odZnakaNaprej($kVprasanje, $znak)
    {
        $pika = strpos($kVprasanje, $znak);
        $diff = strlen($kVprasanje) - $pika;
        $vprasanjeN = substr($kVprasanje, $pika+1, strlen($kVprasanje)-$pika-1);

        return $vprasanjeN;
    }
    // 1. najdem številke in nato iščem _, za katerim se nahaja nova številka
    //echo odZnakaNaprej(odZnakaNaprej("Odgovor13_243", "r"), "_");

    // funkcija, ki prebere podatke iz FORMe za vnos testa in jih uredi
    function urediVnosTesta()
    {
        global $conn;
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
                        $podatki[$vprasanjeN][] = $conn->real_escape_string($t1);
                    }
                }
                // polji ODG in RADIO
                else
                {   
                    // polje za odgovor
                    if($k1[0] == "o")
                    {
                        $odgovor = $conn->real_escape_string($t1);
                        $indeks = odZnakaNaprej(odZnakaNaprej($k1, "r"), "_");
                        $podatki[$vprasanjeN][$indeks][] = $odgovor;
                    }
                    // polje za vprašanje
                    else
                    {
                        $radio = $conn->real_escape_string($t1);
                        if($radio == "da")
                            $radio = "ja";
                        $indeks = odZnakaNaprej(odZnakaNaprej($k1, "o"), "_");
                        $podatki[$vprasanjeN][$indeks][] = $radio;
                    }
                }
            }
        }
        return $podatki;
    }
?>