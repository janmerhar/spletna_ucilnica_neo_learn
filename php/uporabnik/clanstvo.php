<?php
    require_once '../libraries/dbconnect.php';
    require_once '../libraries/jwt.php';
    require_once '../libraries/jwt_verify.php';

    $response['status'] = false;
    $response['type'] = 'user';

    if($json_data['type'] == "isAdmin")
    {
        $q = "SELECT vrsta_clanstva FROM vclanjen WHERE uporabnik_upime=? AND ucilnica_imeucilnice=?";
        $stmt = $conn->prepare($q);
        $stmt->bind_param("ss", $json_data['username'], $json_data['ucilnica']);
    
        if($stmt->execute())
        {
            $result = $stmt->get_result();
            if($result->num_rows == 1)
            {
                $response['status'] = true;
                $row = $result->fetch_assoc();
                if($row['vrsta_clanstva'] == 'user')
                    $response['type'] = 'user';
                else 
                    $response['type'] = 'admin';
            }
        }
    }
    // izpis iz učilnice
    else if ($json_data['type'] == "izbris") 
    {
        $q = "DELETE FROM vclanjen WHERE uporabnik_upime = ? AND ucilnica_imeucilnice = ?";
        $stmt_vclanjen = $conn->prepare($q);
        $uporabnik = $json_data['username'];
        $ucilnica = $json_data['ucilnica'];

        $stmt_vclanjen->bind_param("ss", $uporabnik, $ucilnica);

        if($stmt_vclanjen->execute())
        {
            if($stmt_vclanjen->affected_rows == 1)
                $response['status'] = true;
            else 
                $response['status'] = false;
        }
    }
    // Vclanjenje uporabnika v zaklenjeno ali nezaklenjeno ucilnico
    else if ($json_data['type'] == "vclani") 
    {
        $response["status"] = false;

        $q = "SELECT imeucilnice, vrsta_ucilnice, kljuc, kategorija_imekategorije, (SELECT COUNT(*) FROM vclanjen WHERE ucilnica_imeucilnice = imeucilnice AND uporabnik_upime = ?) AS isJoined
        FROM ucilnica  
        WHERE imeucilnice = ?"; 

        $stmt_vclanjen = $conn->prepare($q);
        $uporabnik = $token->getUsername();
        $ucilnica = $json_data['ucilnica'];

        $stmt_vclanjen->bind_param("ss", $uporabnik, $ucilnica);

        if($stmt_vclanjen->execute())
        {
            $result = $stmt_vclanjen->get_result();
            $row = $result->fetch_assoc();

            if ($row["isJoined"] == 0) {
                if (($row["vrsta_ucilnice"] == "zasebna" && isset($json_data["kljuc"]) && $row["kljuc"] == $json_data["kljuc"]) || $row["vrsta_ucilnice"] == "javna") {
                    // Pri pravilnem geslo, uporabnika dodam v ucilnico
                    $q = "INSERT INTO vclanjen 
                        VALUES(?, ?, 'user')";

                    $stmt_dodaj = $conn->prepare($q);
                    $stmt_dodaj->bind_param("ss", $ucilnica, $uporabnik);
                    $stmt_dodaj->execute();
                    
                    $response["status"] = true;
                } 
            } else {
                // Uporabnik je ze vclanjen
                $response["status"] = true;
            }
        }
    }

    echo json_encode($response);
    $conn->close();
        