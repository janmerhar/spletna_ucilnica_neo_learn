<?php
    require_once '../../libraries/dbconnect.php';
    require_once '../../libraries/jwt.php';

    $response['status'] = false;

    /*
    tabela {
        headers: [],
        path_name: '' => še manjka
        vsebina: [
            [{text, param, path, event, eventName}],
        ],
    }
    */
    
    if($json_data['type'] == "vsi") 
    {
        $q = "SELECT ime_testa, idtest, trajanje, st_vprasanj, vidnen FROM test t INNER JOIN 
        ucilnica u ON u.imeucilnice=t.ucilnica_imeucilnice
        WHERE imeucilnice = ?";

        $ucilnica = $json_data['ucilnica'];

        $stmt = $conn->prepare($q);
        $stmt->bind_param("s", $ucilnica);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0)
        {
            $response['status'] = true;
            $response['tabela']['headers'] = ['Ime testa', 'Število vprašanj', 'Trajanje', 'Vidnost'];

            while($row = $result->fetch_assoc())
            {
                $response['tabela']['vsebina'][] = [
                    [
                        "text" => $row['ime_testa'],
                        "to" => [
                            "name" => "test",
                            "params" => [
                                "testid" => $row['idtest']
                            ]
                        ]
                        // dodaj funkcionalnost => lahko naredim tako, da pošljem objekt 
                        // "to" => [ "name" => 'ime', "params" => [ "testid" => 123] ]
                    ],
                    [
                        "text" => $row['st_vprasanj']
                    ],
                    [
                        "text" => $row['trajanje'] . " min"
                    ],
                    [
                        "text" => $row['vidnen'] == 'ja' ? 'JA' : 'NE',
                        "event" => [
                            "name" => "vidnost",
                            "value" => [
                                "id" => $row['idtest'],
                                "vidnost" => $row['vidnen'] == 'ja' ? 'ne' : 'ja'
                            ]
                        ] 
                        // dodaj funkcionalnost ali pa celo pot OZ: naredim event emitter
                    ],
                ];
            }
        }
    }
    else 
    {
        /*
        ime_testa,
        tabela {
            headers: [],
            vsebina: [
                [{text, param, path, event, eventName}],
            ],
        }
        */
        // dobim ime testa
        $testid = $json_data['type'];

        $q = "SELECT ime_testa, test_idtest, upime, ime, priimek, zacetek, rezultat, st_vprasanj
        FROM uporabnik u INNER JOIN resuje r ON u.upime = r.uporabnik_upime
        INNER JOIN test t ON t.idtest = r.test_idtest
        WHERE idtest = ?
        ORDER BY priimek, ime";

        $stmt = $conn->prepare($q);
        $stmt->bind_param("s", $testid);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0)
        {
            $response['status'] = true;
            $response['tabela']['headers'] = ['Ime', 'Priimek', 'Uporabniško ime', 'Dosežene točke', 'Rezultat'];

            while($row = $result->fetch_assoc())
            {
                $tocke = $row['rezultat'];
                $mozneTocke = $row['st_vprasanj'];
                $rezultat = (float) $tocke / $mozneTocke;
                $rezultat = $rezultat * 100;
                $rezultat = number_format($rezultat, 2, ',' , '.');

                $response['tabela']['vsebina'][] = [
                    [
                        "text" => $row['ime']
                    ],
                    [
                        "text" => $row['priimek']
                    ],
                    [
                        "text" => $row['upime']
                    ],
                    [
                        "text" => $tocke . ' / ' . $mozneTocke
                    ],
                    [
                        "text" => $rezultat . ' %'
                    ],
                ];

                $response['ime_testa'] = $row['ime_testa'];
            }
        }
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
