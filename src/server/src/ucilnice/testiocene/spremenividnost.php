<?php
    require_once '../../libraries/dbconnect.php';
    require_once '../../libraries/jwt.php';
    require_once '../../libraries/jwt_verify.php';

    $response['status'] = false;
    if(isset($json_data['test_id']))
    {
        $q = "UPDATE test 
        SET vidnen = ?
        WHERE idtest = ?";

        $idtest = $json_data['test_id'];
        $vidnost = $json_data['vidnost'];

        $stmt = $conn->prepare($q);
        $stmt->bind_param("si", $vidnost, $idtest);
        if($stmt->execute())
        {
            if($stmt->affected_rows == 1)
                $response['status'] = true;
        }
    }

    echo json_encode($response);