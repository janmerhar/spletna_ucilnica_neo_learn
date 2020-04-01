<?php
    require_once 'php/htmfunkcije.php';
    navbar(3);
    if(isset($_SESSION['username']))
        header("Location: indeks.php");

    levo();
    glava();
    ?>
    <div class="login">
        <h2>Prijava</h2>
        <form name="login" action="php/login.php" method="post" >
        <div class="vnos">
            <input
            type="text"
            name="username"
            placeholder="Uporabniško ime"
            required
            pattern="[a-zA-Z0-9]+"
            />
            <input
            type="password"
            name="password"
            placeholder="Geslo"
            required
            />
        </div>
        <input type="submit" value="Prijavi se!" />
        </form>
    </div>

    <?php
    desno();

?>