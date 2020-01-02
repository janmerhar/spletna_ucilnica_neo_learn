<?php
    $conn = new mysqli("localhost", "root", "", "learn");

    //Težave zaradi šumnikov
    $conn->set_charset("utf8");

    //++dodal 
    //ALTER DATABASE learn CHARACTER SET utf8 COLLATE utf8_general_ci;
    
?>