<?php ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />

    <link href="css/nav.css" rel="stylesheet" type="text/css" />
    <link href="css/login.css" rel="stylesheet" type="text/css" />
   
    <link rel="icon" href="images/favicon.png" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/form.js"></script>
    <title>Learn</title>
  </head>

  <body onload="mainFunction()">
    <header>
      <a href="#"><img src="images/logo.png" alt="logo"/></a>
      <nav>
        <ul class="nav_links">
          <li><a href="#" class="underline">Tečaji</a></li>
          <?php
            if(isset($_SESSION['username'])
            {?>
              <li><a href="#" class="underline">Moji tečaji</a></li>'
            <?php}?>
        </ul>
      </nav>
      <?php
        if(isset($_SESSION['username'])
        {?>
        <div class="cta">
          <a class="cta" href="#"><button>LOGIN</button></a>
          <a class="cta" href="#"><button>LOGOUT</button></a>
        </div>
      <?php
        } 
        else
        { ?>
      <div class="dropdown">
        <button class="dropbtn"><!--ime uporabnika-->
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="#">Link 1</a>
          <a href="#">Link 2</a>
          <a href="#">Link 3</a>
        </div>
      </div> 
        <?php }?>
    </header>

    <div class="ogrodje">
      <div class="levo">
        <div class="leva_skatla">
          Uporabnik
          <ul>
            <br/>
            <li>Testi in ocene/zgodovina</li>
            <li>Izpis iz učilnice</li>
          </ul>
        </div>
      </div>

      <div class="vsebina">
        <!--dodaj ID za ime baze, če ne bo možno z AJAX-om in $_SESSION to izvesti--> 
        <div class="glava">
          Načrtovanje in postavljanje podatkovnih baz<br />
        </div>

        <!--ID določi PHP strežnik, ostalo pa naredi AJAX - izbris-->
        <div class="vsebina_sklopa" id="1">
          <p>
            Vzpostavitev povezave z MySQL strežnikom
          </p>
          <ul>
            <li>djiadoijasoidjoasida</li>
            <li>djiadoijasoidjoasidadjiadoijasoidjoasida</li>
            <li>djiadoijasoidjoasida</li>
          </ul>
        </div>

        
        <!--ID določi PHP strežnik, ostalo pa naredi AJAX - izbris-->
        <div class="vsebina_sklopa" id="2">
          <p>
            Vzpostavitev povezave s Firebird strežnikom
          </p>
          <ul>
            <li>dgdjkhgjfkdhgjkdfhjkghjfkalols</li>
            <li>90ur90u n08zr0u0s f ds if'0isd</li>
            <li>lolurmom</li>
          </ul>
        </div>
      <div class="vnos_podatkov">
         <div id="formdiv">

         </div>
       </div>
      </div>
      <div class="desno">
        <div class="desna_skatla">Skrbnik
          <ul>
            <br/>
            <li>Ustvari test</li>
            <li>Pregled ocen in testov</li>
            <li>Pregled uporabnik in izbris</li>
          </ul>
        </div>
      </div>
    </div>
    <!--div za konec ogrodja-->
  </body>
</html>
