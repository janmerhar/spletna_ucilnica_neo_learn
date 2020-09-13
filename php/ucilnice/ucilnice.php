<?php
    require_once '../libraries/dbconnect.php';
    require_once '../libraries/jwt.php';
    require_once '../libraries/jwt_verify.php';

    // tabela, ki hrani polja z vsebino učilnic
    $ucilnice = [];
    // tabela, ki hrani lastnosti posamezne učilnice
    $ucilnica = [];

    if($json_data['type'] == 'all')
    {
        $q = "SELECT imeucilnice, vrsta_ucilnice, kljuc, kategorija_imekategorije
        FROM ucilnica ORDER BY imeucilnice LIMIT 10"; 
        $result = $conn->query($q);
    
        while($row = $result->fetch_assoc())
        {
            $ucilnica['ime'] = $row['imeucilnice'];
            $ucilnica['kategorija'] = $row['kategorija_imekategorije'];
            $ucilnica['isJavna'] = $row['vrsta_ucilnice'] == 'javna' ? true : false;
            
            $ucilnice[] = $ucilnica;
        }
    }
    else if($json_data['type'] == 'search')
    {
        $search = $conn->real_escape_string(strtolower($json_data['niz']));

        $q = "SELECT imeucilnice, vrsta_ucilnice, kljuc, kategorija_imekategorije
        FROM ucilnica  WHERE lower(imeucilnice) LIKE '%$search%'
        ORDER BY imeucilnice"; 
        
        $result = $conn->query($q);
        while($row = $result->fetch_assoc())
        {
            $ucilnica['ime'] = $row['imeucilnice'];
            $ucilnica['kategorija'] = $row['kategorija_imekategorije'];
            $ucilnica['isJavna'] = $row['vrsta_ucilnice'] == 'javna' ? true : false;
            
            $ucilnice[] = $ucilnica;
        }
    }
    else if($json_data['type'] == 'my')
    {
        $q = "SELECT imeucilnice, vrsta_ucilnice, kljuc, kategorija_imekategorije
        FROM ucilnica u INNER JOIN vclanjen v ON u.imeucilnice = v.ucilnica_imeucilnice 
        WHERE uporabnik_upime = ?
        ORDER BY imeucilnice "; 
        
        $stmt = $conn->prepare($q);
        $stmt->bind_param("s", $json_data['username']);
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc())
        {
            $ucilnica['ime'] = $row['imeucilnice'];
            $ucilnica['kategorija'] = $row['kategorija_imekategorije'];
            $ucilnica['isJavna'] = $row['vrsta_ucilnice'] == 'javna' ? true : false;
            
            $ucilnice[] = $ucilnica;
        }
    }
    $response['ucilnice'] = $ucilnice;
 
    echo json_encode($response);
    $conn->close();
?>
