<?php

    function metaHead($status = 1)
    {
        if($status == 1)
        {
            ?>
            <link href="../css/nav.css" rel="stylesheet" type="text/css" />
        
            <link rel="icon" href="../images/favicon.png" />

            <script src="../js/form.js"></script>
            <?php
        }
        else
        {
            ?>
            <link href="css/login2.css" rel="stylesheet" type="text/css" /> <!-- mogoče naredim posebno funkcijo za login/register -->
            <link href="css/nav.css" rel="stylesheet" type="text/css" /> 
            
            <link rel="icon" href="images/favicon.png" />

            <script src="js/form.js"></script>
            <?php
        }
    }

    /*
        0 => za datoteke iz root-a
        1 => za datoteke v mapi prve stopnje
        "" => za login in register strani
    */
    function navbar($status = 1, $jsfunkcija = "")
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

        <body onload="<?php echo $jsfunkcija ?>">
            <header>
                <?php
                if($status == 1)
                {
                    ?>
                    <a href="#"><img src="../images/logo.png" alt="logo"/></a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="#"><img src="images/logo.png" alt="logo"/></a>
                    <?php
                }?>
            <nav>
                <ul class="nav_links">
                <li><a href="#" class="underline">Tečaji</a></li>
                <?php
                if(isset($_SESSION['username']))
                {?>
                <li><a href="#" class="underline">Moji tečaji</a></li>
                <?php
                }?>
                </ul>
            </nav>
        <?php
        if(isset($_SESSION['username']))
        {
            ?>
            <div class="dropdown">
             <button class="dropbtn"><?php echo $_SESSION['username'] ?>
                <i></i>
             </button>
             <div class="dropdown-content">
                <a href="#">Moj profil</a>
                <a href="
                <?php 
                if($status == 1)
                    echo "../php/logout.php";
                else
                    echo "php/logout.php";
                ?>">Odjava</a>
             </div>
            </div> 
        
        </header>
            <?php
        }
        else
        {   if($status != 0)
            {
            ?>
            <div class="cta">
                <a class="cta" href="tmplogin.php"><button>Prijava</button></a>
                <a class="cta" href="tmpregister.php"><button>Registracija</button></a>
            </div>
            </header>

            <?php
            }
            else
            {
                ?>
                <a class="cta" href="../tmplogin.php"><button>Prijava</button></a>
                <a class="cta" href="../tmpregister.php"><button>Registracija</button></a>
                <?php
            }
        }        
    }

    function leva_skatla()
    {
        ?>
        <div class="leva_skatla">
          Uporabnik
          <ul>
            <br/>
            <li><a href="#">Testi in ocene/zgodovina</a></li>
            <li><a href="#">Izpis iz učilnice</a></li>
          </ul>
        </div>
        <?php
    }

    function levo($status = 0)    
    {
        ?>
        <div class="ogrodje">
            <div class="levo">

        <?php
        if($status != 0)
            leva_skatla()
        ?>
            </div>
        <?php
    }

    function glava($besedilo = "")
    {
        ?>
        <div class="vsebina">
            <?php
            if(strlen($besedilo) >= 1)
            {
                ?>
            <div class="glava">
            <?php
            echo $besedilo.'<br/>';
            ?>
            </div><?php
            }
                
    }

    function vnos_podatkov()
    {
        ?>
        <div class="vnos_podatkov">
         <div id="formdiv">

         </div>
       </div>
       <?php
    }

    function desna_skatla()
    {
        ?>
        <div class="desna_skatla">Skrbnik
          <ul>
            <br/>
            <li><a href="#">Ustvari test</a></li>
            <li><a href="#">Pregled ocen in testov</a></li>
            <li><a href="#">Pregled uporabnik in izbris</a></li>
          </ul>
        </div>
        <?php
    }

    function desno($status = 0)
    {
        ?>
        <!-- zaključim DIV od .ogrodje -->
        </div>

        <div class="desno">
        <?php
        if($status != 0)
            desna_skatla()
        ?>
        </div>

        <!-- zaključek samega dokumenta HTML --> 
        </body>
        </html>
        <?php
        if(isset($conn))
            $conn->close();
    }
    /*navbar(1, "mainFunction()");
    levo(1);
    glava("Tvoja mater ima gej");*/
    /*
        vsebina same spletne strani
    */
    /*vnos_podatkov();
    desno(1);
    */

?>