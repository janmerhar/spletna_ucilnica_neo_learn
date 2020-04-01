<?php
    require_once 'php/phpfunkcije.php';
    require_once 'php/htmfunkcije.php';
    require_once 'php/dbfunkcije.php';
    
    navbar(3, "dodajPoljeGeslo2()");
    preveriLogin(0);
    levo(0);
    glava();

    if(!isset($_SESSION['username']))
        header("location:tmplogin.php")
    ?>
    <div class="create">
     <p>Ustvari učilnico</p>
     <form action="php/adducilnica.php" method="post">
      <?php izbor_kategorije(); ?><br/>
      <input class="create" type="text" name="imeucilnice" required placeholder="Ime učilnice"/><br/>
      Zasebna učilnica: 
      DA<input type="radio" name="zaseben" value="1" onclick="dodajPoljeGeslo2()">
      NE<input type="radio" name="zaseben" value="2" checked onclick="dodajPoljeGeslo2()"><br/> 
     <input name="geslo" class="create" id="pass" type="password" placeholder="Geslo učilnice"/><br/> 
     <input type="submit" value="Potrdi" />
     </form>
    </div>
    <?php

    desno(0);

?>