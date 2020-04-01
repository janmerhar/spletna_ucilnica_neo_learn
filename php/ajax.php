<?php
    session_start();
    require_once 'dbconnect.php';
    $sklop = $_GET['sklop'];
    if(!isset($_GET['id']))
    {
        $q = "SELECT besedilo FROM vsebina WHERE sklop_idsklop = ?
        AND vrsta != 'text'";
        $stmt_slike = $conn->prepare($q);
        $stmt_slike->bind_param("i", $sklop);   
        $stmt_slike->execute();
        $result = $stmt_slike->get_result();
        while($row = $result->fetch_assoc())
        {
            unlink("../uploads/".$row['besedilo']);
        }
        $q = "DELETE FROM vsebina 
        WHERE sklop_idsklop = ?";
        $stmt_sklop1 = $conn->prepare($q);
        $stmt_sklop1->bind_param("i", $sklop);
        $stmt_sklop1->execute();
    }
    else
    {
        $id = $_GET['id'];
        $q = "SELECT besedilo FROM vsebina WHERE sklop_idsklop = ?
        AND vrsta != 'text' AND idvsebine = ?";
        echo $sklop.' '.$id.'<br/>';
        $stmt_slike = $conn->prepare($q);
        $stmt_slike->bind_param("ii", $sklop, $id);   
        if($stmt_slike->execute())
            echo 'Executed';
        $result = $stmt_slike->get_result();
        echo $result->num_rows;
        while($row = $result->fetch_assoc())
        {
            unlink("../uploads/".$row['besedilo']);
        }
        $id = $_GET['id'];
        $q = "DELETE FROM sklop 
        WHERE idsklop = ?";
        $stmt_sklop1 = $conn->prepare($q);
        $stmt_sklop1->bind_param("i", $sklop);
        $stmt_sklop1->execute();
        
        $q = "DELETE FROM vsebina 
        WHERE idvsebine = ? AND sklop_idsklop = ?";
        $stmt_id = $conn->prepare($q);
        $stmt_id->bind_param("ii", $id, $sklop);
        $stmt_id->execute();
    }
    header("Location: ../ucilnica.php?ucilnica=".$_SESSION['ucilnica']);
?>