<?php
    require_once '../../libraries/dbconnect.php';
    require_once '../../libraries/jwt.php';
    require_once '../../libraries/jwt_verify.php';

    $response['status'] = false;
    
    /*
    tabela {
        headers: [],
        path_name: '' => še manjka
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
                        "text" => "začni z reševanjem",
                        "to" => [
                            "name" => "resi",
                            "params" => [
                                "testid" => $row['idtest']
                            ]
                        ]
                    ]
                ]; 
            }
        }
        else
            $response['tabela']['empty'] = "Ni testov za reševanje!";
    }
    else if($json_data['type'] == "reseni")
    {
        $q = "SELECT ime_testa, st_vprasanj, rezultat, zacetek, st_vprasanj
        FROM test t INNER JOIN resuje r ON t.idtest = r.test_idtest
        INNER JOIN uporabnik up ON r.uporabnik_upime = up.upime
        WHERE ucilnica_imeucilnice = ? AND uporabnik_upime = ? ";

        $ucilnica = $json_data['ucilnica'];
        $uporabnik = $json_data['username'];

        $stmt = $conn->prepare($q);
        $stmt->bind_param("ss", $ucilnica, $uporabnik);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows >= 1)
        {
            $response['status'] = true;
            $response['tabela']['headers'] = ['Ime testa' , 'Pričetek reševanja', 'Število možnih točk', 'Število doseženih točk', 'Rezultat'];
            
            
            while($row = $result->fetch_assoc())
            {
                $zacetek = new DateTime($row['zacetek']);
                $zacetek = $zacetek->format("d. m. Y H.i");

                $odstotki = (float)$row['rezultat']/$row['st_vprasanj'];
                $odstotki *= 100;
                $odstotki = number_format($odstotki, 2, ",", ".") . '%';

                $response['tabela']['vsebina'][] = [
                    [
                        "text" => $row['ime_testa']
                    ],
                    [
                        "text" => $zacetek
                    ],
                    [
                        "text" => $row['st_vprasanj']
                    ],
                    [
                        "text" => $row['rezultat']
                    ],
                    [
                        "text" => $odstotki
                    ]
                ];
            }
        }
    }

    echo json_encode($response, JSON_PRETTY_PRINT);