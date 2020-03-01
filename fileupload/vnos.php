<?php
    // if isset
    function dodajStevilko($ime, $st)
    {
        $pika = strpos($ime, ".");
        $ime_do_pike = substr($ime, 0, $pika);
        $koncnica = substr($ime, $pika+1);

        $novoIme = $ime_do_pike."($st).".$koncnica;
        return $novoIme;
    }

    function vnosDatoteke($FILE)
    {
        if($FILE['error'] == UPLOAD_ERR_OK)
        {
            if ($FILE["size"] > 50000000) 
            {
                echo "Sorry, your file is too large.";
                return 0;
            }

            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($FILE["name"]);
            $file_name = basename($FILE["name"]);
            $type = $FILE["type"];

            // Check if file already exists, else give it a different name
            $i = 1;
            while(file_exists($target_file))
            {
                $target_file = $target_dir.dodajStevilko($file_name, $i);
                $i++;
            }

            // upload file
            if (move_uploaded_file($FILE["tmp_name"], $target_file)) 
            {
                /*
                    DODAJ ŠE VNOS V BAZO
                */
                echo "The file ". basename( $FILE["name"]). " has been uploaded. <br/>";
                return 1;
            } 
            else 
            {
                echo "Sorry, there was an error uploading your file.";
                return 0;
            }
        }
    } 

    foreach($_FILES as $f)
    {
        vnosDatoteke($f);
    }
?>