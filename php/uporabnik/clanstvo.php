<?php
    require_once '../libraries/dbconnect.php';
    require_once '../libraries/jwt.php';

    $response['status'] = false;

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

    echo json_encode($response);
    $conn->close();
        