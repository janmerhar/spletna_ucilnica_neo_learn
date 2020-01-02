<?php
    function header()
    {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8" />
            <link href="css/login2.css" rel="stylesheet" type="text/css" />
            <link rel="icon" href="images/favicon.png" />
            <title>Learn</title>
        </head>

        <body>
            <header>
            <a href="#"><img src="images/logo.png" alt="logo"/></a>
            <nav>
                <ul class="nav_links">
                <li><a href="#" class="underline">Tečaji</a></li>
                <li><a href="#" class="underline">ISKANJE-BAR</a></li>
                <li><a href="#" class="underline">Moji-tečaji</a></li>
                </ul>
            </nav>
            <div class="cta">
                <a class="cta" href="#"><button>LOGIN</button></a>
                <a class="cta" href="#"><button>LOGOUT</button></a>
            </div>
            </header>

    }

?>