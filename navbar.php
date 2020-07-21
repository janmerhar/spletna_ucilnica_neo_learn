

    <?php
      function navbar($status = 1, $jsfunkcija = "")
      {
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
          <nav class="navbar navbar-expand-lg navbar-dark nav-bg">
            <a class="navbar-brand nav-font-color" href="#">
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
                      Odjava
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
      ?>

<!--
    <nav class="navbar navbar-expand-lg navbar-dark nav-bg">
      <a class="navbar-brand nav-font-color" href="#">
        <img
          src="images/logo.svg"
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
          <li class="nav-item active">
            <a class="nav-link nav-font-color underline" href="#">Učilnice </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link nav-font-color underline" href="#"
              >Moje učilnice</a
            >
          </li>
        </ul>

        <a href="#">
          <button class="btn btn-outline-info my-2 my-sm-0" type="submit">
            Login
          </button>
        </a>
        <a href="#">
          <button class="btn btn-outline-info my-2 my-sm-0 ml-1" type="submit">
            Register
          </button>
        </a>
      </div>
    </nav>
    -->
    <?php
      // klic funkcije
      navbar(3);
    ?>
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
      integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
