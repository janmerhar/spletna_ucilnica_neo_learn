<?php
    session_start();
    if(isset($_GET["file"]) && isset($_SESSION['ucilnica']))
    {
        $file = $_GET["file"];
        $filepath = "../uploads/" . $file;

        if(file_exists($filepath)) 
        {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); 
            readfile($filepath);
            header("Location: ../ucilnica.php?ucilnica=".$_SESSION['ucilnica']);
        } 
        else 
        {
            header("Location: ../ucilnica.php?ucilnica=".$_SESSION['ucilnica']);
        }
    } 
    else 
        header("Location: ../ucilnica.php?ucilnica=".$_SESSION['ucilnica']);
?>