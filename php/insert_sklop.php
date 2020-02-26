<?php
    session_start();
    if(!isset($_SESSION['ucilnica']))
        header("Location: ../indeks.php");
    
    require_once 'dbconnect.php';
    require_once 'phpfunkcije.php';
    require_once 'dbfunkcije.php';

    $id = stSklopov();
    $ucilnica = $_SESSION['ucilnica'];
    $ime_sklopa = $conn->real_escape_string($_POST['ime_sklopa']);

    $q = "INSERT INTO sklop VALUES(?, ?, ?)";
    $stmt = $conn->prepare($q);
    $stmt->bind_param("iss", $id, $ucilnica, $ime_sklopa);
    $stmt->execute();
    
    $q = "INSERT INTO vsebina(idvsebine, sklop_idsklop, sklop_ucilnica_imeucilnice, vrsta, besedilo)
    VALUES(?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($q);
    $stmt->bind_param("iisss", $idvsebine, $idsklopa, $ucilnica, $vrsta, $besedilo);

    //$idvsebine je v zanki;
    $idsklopa = $id;
    //ucilnica -- JE ŽE
    $vrsta = "text";


    foreach($_POST as $k1 => $t1)
    {
        if($k1 == "ime_sklopa")
                continue;
        $idvsebine = extractStevilo($k1);
        $besedilo = $t1;
        $stmt->execute();
    }

    //vnašanje slik/datotek v bazo
    $q = "INSERT INTO vsebina(idvsebine, sklop_idsklop, sklop_ucilnica_imeucilnice, vrsta, besedilo, datoteka)
    VALUES(?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($q);
    $stmt->bind_param("iisssb", $idvsebine, $idsklopa, $ucilnica, $vrsta, $besedilo, $datoteka);

    if(isset($_FILES) && !empty($_FILES))
    {
        foreach($_FILES as $k1 => $t1)
        {
            if($k1 == "ime_sklopa")
                continue;
            //tip binarne datoteke
            $vrsta = $t1['type'];
            //ime binarne datoteke
            $besedilo = $conn->real_escape_string($t1['name']);
            //blob binarne datoteke
            $datoteka = addslashes(file_get_contents($t1['tmp_name']));
            //id vsebine
            $idvsebine = extractStevilo($k1);

            $stmt->execute();
            
        }
    }
    if(isset($conn))
        $conn->close();
    header("Location: ../ucilnica.php?ucilnica=$ucilnica");
?>