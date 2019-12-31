<?php

    function metaHead($status = 1)
    {
        if($status == 1)
        {
            ?>
            <link href="../css/nav.css" rel="stylesheet" type="text/css" />
            <link href="../css/login.css" rel="stylesheet" type="text/css" />
        
            <link rel="icon" href="../images/favicon.png" />

            <script src="../js/form.js"></script>
            <?php
        }
        else
        {
            ?>
            <link href="css/login.css" rel="stylesheet" type="text/css" /> <!-- moggoče naredim posebno funkcijo za login/register -->
            <link href="css/nav.css" rel="stylesheet" type="text/css" />
        
            <link rel="icon" href="images/favicon.png" />

            <script src="js/form.js"></script>
            <?php
        }
    }

    function navbar($status = 1)
    {
        session_start();
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8" />

            <?php metaHead($status) ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

            <title>Learn</title>
        </head>

        <body onload="mainFunction()">
            <header>
            <a href="#"><img src="../images/logo.png" alt="logo"/></a>
            <nav>
                <ul class="nav_links">
                <li><a href="#" class="underline">Tečaji</a></li>
                <?php
                if(isset($_POST['username']))
                {?>
                <li><a href="#" class="underline">Moji tečaji</a></li>
                <?php
                }?>
                </ul>
            </nav>
        <?php
        if(isset($_POST['username']))
        {
            ?>
            <div class="dropdown">
             <button class="dropbtn"><?php echo $_POST['username'] ?>
                <i class="fa fa-caret-down"></i>
             </button>
             <div class="dropdown-content">
                <a href="#">Moj profil</a>
                <a href="#">Odjava</a>
             </div>
            </div> 
        
        </header>
            <?php
        }
        else
        {
            ?>
            <div class="cta">
                <a class="cta" href="../login-page.php"><button>Prijava</button></a>
                <a class="cta" href="../register-page.php"><button>Registracija</button></a>
            </div>
            </header>

            <?php
        }        
    }

    function body()
    {
        ?>

    }
    
    navbar();
    

?>