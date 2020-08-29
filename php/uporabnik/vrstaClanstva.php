<?php

    require_once '../libraries/dbconnect.php';
    require_once '../libraries/jwt.php';

    $q = "SELECT vrsta_clanstva FROM vclanjen WHERE uporabnik_upime=? AND ucilnica_imeucilnice=?";
    $stmt = $conn->prepare($q);
    $stmt->bind_param("ss", $json_data['username'], $json_data['ucilnica']);

    $response['type'] = false;
    /*
        -1 => napaka v poizvedbi
        0 => ni najdenih vrstic
        1 => uporabnik: admin
        2 => uporabnik: user
    */
    if($stmt->execute())
    {
        $result = $stmt->get_result();
        if($result->num_rows == 1)
        {
            $row = $result->fetch_assoc();
            if($row['vrsta_clanstva'] == 'user')
                $response['type'] = 'user';
            else 
                $response['type'] = 'admin';
        }
    }

    echo json_encode($response);
    $conn->close();
    // lahko dodam še za izpis iz učilnice
        