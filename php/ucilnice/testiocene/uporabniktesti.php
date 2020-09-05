<?php
    require_once '../../libraries/dbconnect.php';
    require_once '../../libraries/jwt.php';

    $response['status'] = false;
    
    /*
    tabela {
        headers: [],
        path_name: ''
        vsebina: [
            [{text, param}],
        ],
    }
    */

    if($json_data['type'] == "nereseni")
    {
        $q = "SELECT idtest, ime_testa, st_vprasanj, trajanje FROM test
        WHERE ucilnica_imeucilnice = ? AND vidnen = 'ja'
        AND idtest NOT IN 
        (
            SELECT test_idtest FROM resuje r INNER JOIN uporabnik u ON r.uporabnik_upime = u.upime
            WHERE upime = ?
        )";
        
        $ucilnica = $json_data['ucilnica'];
        $uporabnik = $json_data['username'];

        $stmt = $conn->prepare($q);
        $stmt->bind_param("ss", $ucilnica, $uporabnik);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows >= 1)
        {
            $response['status'] = true;
            $response['tabela']['headers'] = ['Ime testa', 'Število točk', 'Časovna omejitev', 'Reši test'];

            while($row = $result->fetch_assoc())
            {
                $response['tabela']['vsebina'][] = [
                    [
                        "text" => $row['ime_testa']
                    ],
                    [
                        "text" => $row['st_vprasanj']
                    ],
                    [
                        "text" => $row['trajanje']
                    ],
                    [
                        "text" => "Začni z reševanjem",
                        "param" => "neki link " . $row['idtest']
                    ]
                ]; 
            }
        }
        else
            $response['tabela']['empty'] = "Ni testov za reševanje!";
    }
    else if($json_data['type'] == "reseni")
    {
        $response['status'] = true;
    }

    echo json_encode($response);