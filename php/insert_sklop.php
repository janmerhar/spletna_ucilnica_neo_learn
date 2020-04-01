<pre>
<?php
    // funkcija, ki nam preimenuje datoteko, v primeru, da 
    // datoteka z istim imenov že obstaja
    function dodajStevilko($ime, $st)
    {
        $pika = strpos($ime, ".");
        $ime_do_pike = substr($ime, 0, $pika);
        $koncnica = substr($ime, $pika+1);

        $novoIme = $ime_do_pike."($st).".$koncnica;
        return $novoIme;
    }
    
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
    

    if(isset($_FILES) && !empty($_FILES))
    {
        
        foreach($_FILES as $k1 => $FILE)
        {
            if($k1 == "ime_sklopa")
                continue;
            $vrsta = $_FILES[$k1]['type'];
            
            $idvsebine = extractStevilo($k1);
            
            if($FILE['error'] == UPLOAD_ERR_OK)
            {
                if ($FILE["size"] > 50000000) 
                  continue;
                
                
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($FILE["name"]);
                $file_name = basename($FILE["name"]);
                $besedilo = basename($FILE["name"]);
                $type = $FILE["type"];

                
                $i = 1;
                while(file_exists($target_file))
                {
                    $besedilo = dodajStevilko($file_name, $i);
                    $target_file = $target_dir.dodajStevilko($file_name, $i);
                    $i++;
                }

                if (move_uploaded_file($FILE["tmp_name"], $target_file)) 
                {
                    $stmt->execute();   
                }
            }
        }
        
    }
    if(isset($conn))
        $conn->close();
    header("Location: ../ucilnica.php?ucilnica=$ucilnica");
?>