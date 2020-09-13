<?php
    require_once '../../libraries/dbconnect.php';
    require_once '../../libraries/jwt.php';
    require_once '../../libraries/jwt_verify.php';

    // mogoče naredim za vsakega uporabnika svojo mapo

    $sklop = $json_data['id_sklopa'];
    // brišem celoten sklop
    if(!isset($json_data['id_vsebine']))
    {
        $q = "SELECT besedilo FROM vsebina WHERE sklop_idsklop = ?
        AND vrsta != 'text'";
        $stmt_slike = $conn->prepare($q);
        $stmt_slike->bind_param("i", $sklop);   
        $stmt_slike->execute();
        $result = $stmt_slike->get_result();
        while($row = $result->fetch_assoc())
        {
            unlink(__ROOT__ . "/php/uploads/" . $row['besedilo']);
        }
        $q = "DELETE FROM vsebina 
        WHERE sklop_idsklop = ?";
        $stmt_sklop1 = $conn->prepare($q);
        $stmt_sklop1->bind_param("i", $sklop);
        if($stmt_sklop1->execute())
            $response['status'] = true;
    }
    else
    {
        $id = $json_data['id_vsebine'];
        $q = "SELECT besedilo FROM vsebina WHERE sklop_idsklop = ?
        AND vrsta != 'text' AND idvsebine = ?";
        
        $stmt_slike = $conn->prepare($q);
        $stmt_slike->bind_param("ii", $sklop, $id);   
        if($stmt_slike->execute());
        $result = $stmt_slike->get_result();

        while($row = $result->fetch_assoc())
        {
            unlink(__ROOT__ . "/php/uploads/" . $row['besedilo']);
        }

        $q = "DELETE FROM sklop 
        WHERE idsklop = ?";
        $stmt_sklop1 = $conn->prepare($q);
        $stmt_sklop1->bind_param("i", $sklop);
        $stmt_sklop1->execute();
        
        $q = "DELETE FROM vsebina 
        WHERE idvsebine = ? AND sklop_idsklop = ?";
        $stmt_id = $conn->prepare($q);
        $stmt_id->bind_param("ii", $id, $sklop);
        if($stmt_id->execute())
            $response['status'] = true;
    }

    echo json_encode($response);