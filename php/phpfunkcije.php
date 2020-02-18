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
?>