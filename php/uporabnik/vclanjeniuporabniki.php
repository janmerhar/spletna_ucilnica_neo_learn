<?php
    require_once '../libraries/dbconnect.php';
    require_once '../libraries/jwt.php';

    $response['status'] = false;

    if(isset($json_data['ucilnica']))
    {
        /*
        tabela {
            headers: [],
            path_name: '' => še manjka
            vsebina: [
                [{text, param}],
            ],
        }
        */
    
        $q = "SELECT ime, priimek, upime, vrsta_clanstva FROM
        uporabnik u INNER JOIN vclanjen v ON u.upime = v.uporabnik_upime
        INNER JOIN ucilnica uc ON uc.imeucilnice = v.ucilnica_imeucilnice
        WHERE imeucilnice = ?
        ORDER BY vrsta_clanstva, priimek, ime, upime";

        $ucilnica = $json_data['ucilnica'];
    
        $stmt = $conn->prepare($q);
        $stmt->bind_param("s", $ucilnica);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if($result->num_rows >= 1)
        {
            $response['status'] = true;
            $response['tabela']['headers'] = ['Ime', 'Priimek', 'Uporabniško ime', 'Vrsta članstva', ''];

            while($row = $result->fetch_assoc())
            {
                if($row['vrsta_clanstva'] == 'admin')
                    $vrsta = "Skrbnik";
                else
                    $vrsta = "Uporabnik";

                $vnos = [
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
                        "text" => $vrsta
                    ],
                ];

                if($vrsta == "Uporabnik")
                    $vnos[] = [
                        "text" => "izbris iz učilnice",
                        "event" => $row['upime'] // uporabim event EMITTER za izbris uporabnikov
                        // lahko dodam tudi event name
                    ];
                
                $response['tabela']['vsebina'][] = $vnos;
            }
        }
    }
    
    echo json_encode($response, JSON_PRETTY_PRINT);
