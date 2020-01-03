<?php
    //dodaj preverjanje, če je uporabnik prijavljen
    require_once 'htmfunkcije.php';
    require_once 'dbfunkcije.php';

    navbar(1, "dodajPoljeGeslo2()");
    levo();
    glava();
    
    ?>
    <div class="create">
     <p>Ustvari učilnico</p>
     <form name="createUcilnica" action="post.php">
      <?php izbor_kategorije(); ?><br/>
      <input class="create" type="text" name="imeucilnice" required placeholder="Ime učilnice"/><br/>
      <input class="create" type="text" name="opisucilnice" placeholder="Opis učilnice"/><br/>
      Zasebna učilnica: 
      DA<input type="radio" name="zaseben" value="1" onclick="dodajPoljeGeslo2()">
      NE<input type="radio" name="zaseben" value="2" checked onclick="dodajPoljeGeslo2()"><br/> 
     <input class="create" id="pass" type="password" placeholder="Geslo učilnice"/><br/> 
     <input type="submit" value="Potrdi" />
     </form>
    </div>

    <?php
    desno();
?>