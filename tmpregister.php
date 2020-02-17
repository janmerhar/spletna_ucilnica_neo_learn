<?php
    require_once 'php/htmfunkcije.php';
    navbar(3, "");
    if(isset($_SESSION['username']))
      header("Location: indeks.php");

    levo();
    glava();
    ?>
    <div class="login">
          <h2>Registracija</h2>
          <form action="php/register.php" method="post">
            <!--dodaj JS, da bo spremenilo REQUIRED sporočilo 
                  da bo ustrazalo imenu polja
                -->
            <div class="vnos">
              <input
                type="text"
                name="username"
                placeholder="Uporabniško ime"
                required
                pattern="[a-zA-Z0-9]+"
              />

              <input type="text" name="ime" placeholder="Ime" required 
              pattern="[a-zA-Z ]+"
              />

              <input
                type="text"
                name="priimek"
                placeholder="Priimek"
                required
                pattern="[a-zA-Z ]+"
              />

              <input
                type="password"
                name="geslo"
                placeholder="Geslo"
                required
              />
              <input
                type="password"
                name="geslo2"
                placeholder="Ponovi geslo"
                required
              />
            </div>
            <input type="submit" value="Registracija" required 
            onclick="registerForm()"/>
          </form>
        </div>

    <?php
    desno();

?>