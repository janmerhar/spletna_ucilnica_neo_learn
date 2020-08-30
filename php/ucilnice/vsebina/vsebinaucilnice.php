<?php
    require_once '../../libraries/dbconnect.php';
    require_once '../../libraries/jwt.php';

    $ucilnica = $json_data['ucilnica'];

    $q = "SELECT idsklop, idvsebine, ime_sklopa, vrsta, besedilo 
    FROM sklop s
    INNER JOIN ucilnica u ON s.ucilnica_imeucilnice = u.imeucilnice
    INNER JOIN vsebina v ON v.sklop_idsklop = s.idsklop
    WHERE imeucilnice = ?
    ORDER BY idsklop, idvsebine";

    $stmt = $conn->prepare($q);
    $stmt->bind_param("s", $ucilnica);
    $stmt->execute();
    $result = $stmt->get_result();
    $response = [];

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            //preverim, če sem že postavil ime sklopa
            if(!isset($idsklopa))
            {
                $idsklopa = $row['idsklop'];
                $sklop = [
                    "id_sklopa" => $row['idsklop'],
                    "ime_sklopa" => $row['ime_sklopa']
                ];
            }
            //izpišem novo ime sklopa, če je se spremenil
            else if($idsklopa != $row['idsklop'])
            {   
                $response[] = $sklop;
                $idsklopa = $row['idsklop'];
                $sklop = [
                    "id_sklopa" => $row['idsklop'],
                    "ime_sklopa" => $row['ime_sklopa']
                ];
            }

            if(strpos($row['vrsta'], "image") !== false)
                $vrsta = "image";
            else if($row['vrsta'] != "text")
                $vrsta = "file";
            else
                $vrsta = "text";

            $vsebina = [
                "id_vsebine" => $row['idvsebine'],
                "vrsta" => $vrsta,
                "besedilo" => $row['besedilo']
            ];
            $sklop['vsebina'][] = $vsebina;
        }
        $response[] = $sklop;
    }

    /*
    struktura propsa sklop:
    [
        {
            ime_sklopa,
            id_sklopa, => uporaba za brisanje
            vsebina: [
                {
                    id_vsebine,
                    vrsta,
                    besedilo,
                },
            ]
        }
    ]
    */
    echo json_encode($response);
    $conn->close();