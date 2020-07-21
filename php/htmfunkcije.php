<?php

    function metaHead($status = 1)
    {
        if($status == 1)
        {
            ?>
            <link href="../css/nav.css" rel="stylesheet" type="text/css" />
        
            <link rel="icon" href="../images/favicon.svg" />

            <script src="../js/form.js"></script>
            <?php
        }
        else
        {
            ?>
            <link href="css/nav.css" rel="stylesheet" type="text/css" /> 
            
            <link rel="icon" href="images/favicon.svg" />

            <script src="js/form.js"></script>
            <?php
        }
    }

    function navbar($status = 1, $jsfunkcija = "")
    {
        session_start();
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


            <?php metaHead($status) ?>
            <!--
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            -->
            <title>Neo learn</title>
        </head>

        <body onload="<?php echo $jsfunkcija ?>">
            <header>
                <?php
                if($status == 1)
                {
                    ?>
                    <a href="../indeks.php"><img src="../images/logo.svg" alt="logo"/></a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="indeks.php"><img src="images/logo.svg" alt="logo"/></a>
                    <?php
                }?>
            <nav>
                <ul class="nav_links">
                <li><a href="
                <?php
                    if($status == 1)
                    echo '../indeks.php';
                    else 
                    echo 'indeks.php';
                ?>" class="underline">Tečaji</a></li>
                <?php
                if(isset($_SESSION['username']))
                {?>
                <li><a href="<?php
                    if($status != 1)
                        echo 'php/upUcilnice.php';
                    else
                        echo 'upUcilnice.php';
                ?>" class="underline">Moji tečaji</a></li>
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
                <a href="
                <?php 
                if($status != 1)
                    echo "php/logout.php";
                else
                    echo "logout.php";
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
            <li><a href="php/ocene_zgodovina.php">Testi in ocene</a></li>
            <?php
                $user = $_SESSION['username'];
            ?>
            <li><a href="php/izbris_iz_ucilnice.php<?php
                echo '?uporabnik='.$user;
            ?>">Izpis iz učilnice</a></li>
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

    //uporabim za dodajanje FORM-a preko JS
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
            <li><a href="php/create_test.php">Ustvari test</a></li>
            <li><a href="php/pregled_ocen.php">Pregled ocen in testov</a></li>
            <li><a href="php/pregled_izbris_uporabnikov.php">Pregled uporabnikov in izbris</a></li>
          </ul>
        </div>
        <?php
    }

    // tudi za header
    function desno($status = 0)
    {
        ?>
        </div>

        <div class="desno">
        <?php
        if($status != 0)
            desna_skatla()
        ?>
        </div>

        <!--
             zakljucim div.ogrodje 
        -->
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

        </body>
        </html>
        <?php
        if(isset($conn))
            $conn->close();
    }

?>