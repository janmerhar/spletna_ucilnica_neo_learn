<?php

    function navbar($status = 1, $jsfunkcija = "")
    {
        session_start();
        ?>
        <!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="utf-8" />
            <meta
              name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no"
            />
            <link
              rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
              integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
              crossorigin="anonymous"
            />
        <?php
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
        ?>
          <title>Neo learn</title>
        </head>

        <body onload="<?php echo $jsfunkcija ?>">
          <nav class="navbar navbar-expand-md navbar-dark nav-bg fixed-top">
            <a class="navbar-brand nav-font-color" href="<?= $status != 1 ? 'indeks.php' : '../indeks.php' ?>">
              <img
                src="<?= $status != 1 ? 'images/logo.svg' : '../images/logo.svg' ?>"
                width="30"
                height="30"
                class="d-inline-block align-top"
                alt="Learn"
                loading="lazy"
              />
              Neo learn
            </a>
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarTogglerDemo02"
              aria-controls="navbarTogglerDemo02"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0 mx-auto">
              <?
                if(isset($_SESSION['username']))
                {
                  ?>
                    <li class="nav-item active">
                      <a class="nav-link nav-font-color underline" href="<?= $status == 1 ? '../indeks.php' : 'indeks.php' ?>">Učilnice </a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link nav-font-color underline" href="<?= $status == 1 ? 'upUcilnice.php' : 'php/upUcilnice.php' ?>"
                        >Moje učilnice</a>
                    </li>
                  <?php
                }
              ?>
              </ul>
              <?php
                if(isset($_SESSION['username']))
                {
                  ?>
                  <a href="<?= $status != 1 ? "php/logout.php": "logout.php" ?>" class="btn btn-outline-info my-2 my-sm-0">
                      <?php echo htmlspecialchars($_SESSION['username']); ?> (odjava)
                  </a>
                  <?php
                }
                else
                {
                  ?>
                  <a href="<?= $status != 0 ? "tmplogin.php" : "../tmplogin.php" ?>" class="btn btn-outline-info my-2 my-sm-0 ml-1" type="submit">
                      Prijava
                  </a>
                  <a href="<?= $status != 0 ? "tmpregister.php" : "../tmpregister.php" ?>" class="btn btn-outline-info my-2 my-sm-0 ml-1" type="submit">
                      Registracija
                  </a>
                  <?php
                }
              ?>
            </div>
          </nav>
        <?php
      }

    function leva_skatla()
    {
        ?>
        <div class="container-fluid mt-md-5 mt-3 border-blue text-center">
        <p class="text-center"> Uporabnik </p>
          <ul class="list-group-flush">
            <li class="i list-group-item bg-greyish">
              <a href="php/ocene_zgodovina.php">Testi in ocene</a>
            </li>
            <?php
                $user = $_SESSION['username'];
            ?>
            <li class="i list-group-item bg-greyish">
              <a href="php/izbris_iz_ucilnice.php<?php
                echo '?uporabnik='.$user;
            ?>">Izpis iz učilnice</a>
            </li>
          </ul>
        </div>
        <?php
    }

    function levo($status = 0)    
    {
        ?>
        <div class="container-fluid nav-odmik">
          <div class="row">
            <div class="col-md-2 order-md-1 order-1">

        <?php
        if($status != 0)
            leva_skatla();
        ?>
            </div>
        <?php
    }

    function glava($besedilo = "")
    {
        ?>
        <div class="col order-md-2 order-3">
            <?php
            if(strlen($besedilo) >= 1)
            {
                ?>
            <div class="glava text-center mt-3 mt-md-0">
            <?php
              echo $besedilo;
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
        <div class="container-fluid mt-md-5 mt-3 border-blue text-center">
          Skrbnik
          <ul class="list-group-flush">
            <br/>
            <li class="i list-group-item bg-greyish">
              <a href="php/create_test.php">Ustvari test</a>
            </li>
            <li class="i list-group-item bg-greyish">
              <a href="php/pregled_ocen.php">Ocene in testi</a>
            </li>
            <li class="i list-group-item bg-greyish">
              <a href="php/pregled_izbris_uporabnikov.php">Pregled uporabnikov</a>
            </li>
          </ul>
        </div>
        <?php
    }

    // tudi za header
    function desno($status = 0)
    {
        ?>
        </div>

        <div class="col-md-2 order-md-3 order-2">
        <?php
        if($status != 0)
            desna_skatla();
        ?>
        </div>

        <!--
          zakljucim .row
        -->

        </div>
        </div>
        <div class="container-fluid footer-dark text-center">
          Jan Merhar @ github.com/janmerhar/spletna_ucilnica_neo_learn
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