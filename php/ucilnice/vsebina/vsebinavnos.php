<?php
    // https://www.taniarascia.com/how-to-upload-files-to-a-server-with-plain-javascript-and-php/
    require_once '../../libraries/dbconnect.php';
    require_once '../../libraries/jwt.php';

    define("__UPLOAD__", __ROOT__ . "/_uploads");
    // var_dump($_POST);

    // funkcija, ki nam preimenuje datoteko, v primeru, da 
    // datoteka z istim imenov že obstaja
    function dodajStevilko($ime, $st)
    {
        $pika = strpos($ime, ".");
        $ime_do_pike = substr($ime, 0, $pika);
        $koncnica = substr($ime, $pika+1);

        $novoIme = $ime_do_pike . "($st)." . $koncnica;
        return $novoIme;
    }

    function stSklopov()
    {
        global $conn;
        $q = "SELECT COUNT(idsklop) AS st FROM sklop";
        $result = $conn->query($q);
        $row = $result->fetch_assoc();
        if($row['st'] == 0)
            return 1;
        else 
        {
            $i = $row['st'] + 1; 
            return $i;
        }
    }
    
    $id = stSklopov();
    $ucilnica = $_POST['ucilnica'];
    $ime_sklopa = htmlspecialchars($conn->real_escape_string($_POST['ime_sklopa']));

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

    // vnos besedila v učinico
    if(isset($_POST['text']) AND !empty($_POST['text'])) 
    {
        foreach($_POST['text'] as $k1 => $t1)
        {
            $idvsebine = $k1;
            $besedilo = htmlspecialchars($t1);
            $stmt->execute();
        }
    }
        
    //vnašanje slik/datotek v bazo
    if(isset($_FILES) && !empty($_FILES))
    {
        foreach($_FILES as $k1 => $FILE)
        {
            $vrsta = $_FILES[$k1]['type'];
            
            $idvsebine = $k1;
            if($FILE['error'] == UPLOAD_ERR_OK)
            {
                if ($FILE["size"] > 50000000) 
                  continue;
                
                $target_dir = __UPLOAD__ . "/";
                $target_file = $target_dir . basename($FILE["name"]);
                $file_name = basename($FILE["name"]);
                $besedilo = basename($FILE["name"]);
                $type = $FILE["type"];

                $i = 1;
                while(file_exists($target_file))
                {
                    $besedilo = dodajStevilko($file_name, $i);
                    $target_file = $target_dir . dodajStevilko($file_name, $i);
                    $i++;
                }

                if (move_uploaded_file($FILE["tmp_name"], $target_file)) 
                    $stmt->execute();   
            }
        }
    }
    $conn->close();