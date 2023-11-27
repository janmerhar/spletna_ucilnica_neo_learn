<?php
    require_once '../../libraries/dbconnect.php';
    require_once '../../libraries/jwt.php';
    require_once '../../libraries/jwt_verify.php';

    $response['status'] = false;

    // pretvorim object v array
    $array = object_to_array($json_data);

    function testid() {
        global $db;
        return $db->rawQueryValue("SELECT idtest FROM test
        ORDER BY idtest DESC
        LIMIT 1") + 1;
    }
    function idvprasanja() {
        global $db;
        return $db->rawQueryValue("SELECT idvprasanja FROM vprasanja
        ORDER BY idvprasanja DESC
        LIMIT 1") + 1;
    }
    
    // podatki za vnos v tabelo TEST
    
    $idtest = testid();
    $ucilnica = $conn->real_escape_string($array['ucilnica']);
    $ime_testa = $conn->real_escape_string($array['test']['ime_testa']);
    $trajanje = $conn->real_escape_string($array['test']['trajanje']);
    $st_vprasanj = $conn->real_escape_string($array['test']['st_vprasanj']);
    
    $result = $db->insert('test', [
            "idtest" => $idtest,
            "ucilnica_imeucilnice" => $ucilnica,
            "ime_testa" => $ime_testa,
            "trajanje" => $trajanje,
            "st_vprasanj" => $st_vprasanj,
            "vidnen" => "ja"
        ]);
    
    /*
    if(!$result)
        echo 'insert failed (test): ' . $db->getLastError();
    */
    $response['status'] = true;

    // sprehod po poljih z vprašanji
    foreach($array['test']["vprasanja"] as $vprasanje)
    {
        // $vprasanje['vprasanje']
        // $vprasanje['odgovori'] => []
        
        $vprasanjeId = idvprasanja();
        // $idtest
        
        $result = $db->insert('vprasanja', [
            "idvprasanja" => $vprasanjeId,
            "test_idtest" => $idtest,
            "vprasanje" => $vprasanje['vprasanje'],
            "tocke" => 1
        ]);

        /*
        if(!$result)
            echo 'insert failed (vprasanja): ' . $db->getLastError();
        */
        foreach($vprasanje['odgovori'] as $odgovor)
        {
            // $odgovor['odgovor']
            // $odgovor['isTrue']

            $resultOdg = $db->insert("odgovori", [
                "odgovor" => $odgovor['odgovor'],
                "pravilen" => $odgovor['isTrue'],
                "vprasanja_idvprasanja" => $vprasanjeId,
                "vprasanja_test_idtest" => $idtest
            ]);

            /*
                if(!$resultOdg)
                echo 'insert failed (odgovori): ' . $db->getLastError();
            */
        }
    }

    echo json_encode($response);
    /*
    array(1) {
  ["test"]=>
  array(4) {
    ["ime_testa"]=>
    string(9) "ime testa"
    ["st_vprasanj"]=>
    int(2)
    ["trajanje"]=>
    int(220)
    ["vprasanja"]=>
    array(2) {
      [0]=>
      array(2) {
        ["vprasanje"]=>
        string(12) "vprašanje 1"
        ["odgovori"]=>
        array(2) {
          [0]=>
          array(2) {
            ["odgovor"]=>
            string(10) "Odgovor1.1"
            ["isTrue"]=>
            bool(true)
          }
          [1]=>
          array(2) {
            ["odgovor"]=>
            string(10) "Odgovor1.2"
            ["isTrue"]=>
            bool(false)
          }
        }
      }
      [1]=>
      array(2) {
        ["vprasanje"]=>
        string(12) "vprašanje 2"
        ["odgovori"]=>
        array(2) {
          [0]=>
          array(2) {
            ["odgovor"]=>
            string(10) "Odgovor2.1"
            ["isTrue"]=>
            bool(true)
          }
          [1]=>
          array(2) {
            ["odgovor"]=>
            string(10) "Odgovor2.2"
            ["isTrue"]=>
            bool(false)
          }
        }
      }
    }
  }
}
    */