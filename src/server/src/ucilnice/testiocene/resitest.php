<?php
    require_once '../../libraries/dbconnect.php';
    require_once '../../libraries/jwt.php';
    require_once '../../libraries/jwt_verify.php';

    $response['status'] = false;

  /*
  {
    ime_testa,
    trajanje,
    zacetek,
    ----------------------
    vsebina: [
      {
        naslov, => samo vprašanje
        checkboxi: [
            {
                besedilo,
                name => HTML atribut
            },
        ]
      },
    ]
    ----------------------
  }

  */

    if(isset($json_data['testid']))
        $idtest = $json_data['testid'];
    else
        die(json_encode($response));    

    $response['status'] = true;
        
    // dobim podatke o trajanju testa in število vprašanj 
    $q = "SELECT trajanje, st_vprasanj, ime_testa 
    FROM test t INNER JOIN ucilnica u ON t.ucilnica_imeucilnice = u.imeucilnice
    WHERE idtest = ?";
    $stmt_test = $conn->prepare($q);
    $stmt_test->bind_param("s", $idtest);
    $stmt_test->execute();
    $result_test = $stmt_test->get_result();
    $row_test = $result_test->fetch_assoc();
    
    $trajanje = $row_test['trajanje'];
    $st_vprasanj = $row_test['st_vprasanj'];

    // ime testa, trajanje in zacetek v odgovoru
    $response['ime_testa'] = $row_test['ime_testa'];
    $response['trajanje'] = $row_test['trajanje'];
    $response['zacetek'] = date("Y-m-d H:i:s");

    // vnesem podatke v tabelo RESUJE za preverjanje, ali je bil test resen pravočasno 
    $db->insert("resuje", [
      "test_idtest" => $idtest,
      "uporabnik_upime" =>  $json_data['username'],
      "zacetek" => $response['zacetek']
    ]);
    
    // dobim vprašanja in odgovore iz testa
    $q = "SELECT idvprasanja, vprasanje, idodgovori, odgovor, st_vprasanj
    FROM ucilnica u INNER JOIN test t ON u.imeucilnice = t.ucilnica_imeucilnice
    INNER JOIN vprasanja v ON v.test_idtest = t.idtest
    INNER JOIN odgovori o ON o.vprasanja_idvprasanja = v.idvprasanja
    WHERE idtest = ?
    ORDER BY vprasanje, RAND()";

    $stmt = $conn->prepare($q);
    $stmt->bind_param("s", $idtest);
    $stmt->execute();
    $result = $stmt->get_result();

    /*
    ----------------------
    vsebina: [
      {
        naslov, => samo vprašanje
        checkboxi: [
            {
                besedilo,
                name => HTML atribut --> idvprasanja
                value => HTML atribut
            },
        ]
      },
    ]
    ----------------------
    */

    // izpis vprašanj uporabniku
    $vprasanje = null;
    $vsebina = [];
    
    while($row = $result->fetch_assoc())
    {
        // pride do spremembe imena vprašanje
        // dodam polje v tabelo 'vsebina'
        if($vprasanje != $row['vprasanje'])
        {
            // izpis vprašanja
            if($vprasanje !== null) // tukaj lahko skippam prvo zanko, da ne pride do vpisa prazne tabele
                $response['vsebina'][] = $vsebina;
            if($st_vprasanj <= 0)
                break;
            $vsebina['naslov'] = $row['vprasanje'];

            $vprasanje = $row['vprasanje']; 
            $vsebina['checkboxi'] = [];
            $st_vprasanj--;
        }

        $vsebina['checkboxi'][] = [
            "besedilo" => $row['odgovor'],
            "name" => $row['idvprasanja'], // vbistvu je idvprasanja
            "value" => $row["idodgovori"]  // id odgovora
        ];
    }
    $response['vsebina'][] = $vsebina;

    echo json_encode($response, JSON_PRETTY_PRINT);