<?php
if(isset($_GET["file"]))
{
    // Get parameters
    $file = $_GET["file"];

    /* Test whether the file name contains illegal characters
    such as "../" using the regular expression */

    $filepath = "../uploads/" . $file;

    // Process download
    if(file_exists($filepath)) 
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        die();
    } 
    else 
    {
        die();
    }
} 
else 
    die("Invalid file name!");
?>