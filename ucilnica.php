<?php
    require_once 'php/htmfunkcije.php';
    require_once 'php/dbconnect.php';
    require_once 'php/dbfunkcije.php';

    navbar(3, "mainFunction()");
    if(!isset($_GET['ucilnica']))
        header("Location: indeks.php");
    if(isset($_SESSION['ucilnica']))
        unset($_SESSION['ucilnica']);
    $ucilnica = $_GET['ucilnica'];
    $uporabnik = $_SESSION['username'];

    $q = "SELECT vrsta_ucilnice, kljuc FROM ucilnica WHERE imeucilnice = ?";
    $stmt = $conn->prepare($q);
    $stmt->bind_param("s", $ucilnica);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows != 1)
        header("Location: indeks.php");
    else
        $row = $result->fetch_assoc();
    
    //echo "Vrsta članstva: ".vrstaClanstva($ucilnica, $uporabnik);

    if(vrstaClanstva($ucilnica, $uporabnik) >= 1)
    {
        $_SESSION['ucilnica'] = $_GET['ucilnica'];
        levo(1);
        glava("$ucilnica");
    
        izpis_sklopov($ucilnica);
        //dodajanje FORM-a za vnos podatkov preko JS --- dodaj le uporabnikom, ki so admini
        if(vrstaClanstva($ucilnica, $uporabnik) == 1)
        {
            vnos_podatkov();
            desno(1);
        }    
    }
    //pogledam, če je nastavljeno geslo
    else if($row['vrsta_ucilnice'] == "zasebna" && isset($_POST['geslo']))
    {
        if($_POST['geslo'] == $row['kljuc'])
        {   
            if(dodajClanstvo($ucilnica, $_SESSION['username']))
            {
                $_SESSION['ucilnica'] = $_GET['ucilnica'];
                levo(1);
                glava("$ucilnica");
            
                izpis_sklopov($ucilnica);
                //dodajanje FORM-a za vnos podatkov preko JS -- dodeli le uporabnikom, ki so admini !!!
                vnos_podatkov();
                desno();
            }
            else 
                header("Location: indeks.php");
        }
        else
            header("Location: indeks.php");
    }
    else if($row['vrsta_ucilnice'] == "zasebna" && !isset($_POST['geslo']))
    {
        //preveri, če je uporabnik že včlanjen
        levo(0);
        ?>
        <div class="login">
        <h2><?php echo $ucilnica; ?></h2>
        <form method="post" >
        <div class="vnos">
            <input
            type="password"
            name="geslo"
            placeholder="Geslo"
            required
            />
        </div>
        <input type="submit" value="Prijavi se!" />
        </form>
    </div>
    <?php
    }
    else if($row['vrsta_ucilnice'] == "javna")
    {   
        //preveri, če je uporabnik že včlanjen
        //funkcija
        //dodam članstvo
        //dodajClanstvo($ucilnica, $_SESSION['username'])
        $_SESSION['ucilnica'] = $_GET['ucilnica'];
        if(vrstaClanstva($ucilnica, $uporabnik) < 1)
            dodajClanstvo($ucilnica, $uporabnik);
        
        levo(1);
        glava("$ucilnica");
    
        izpis_sklopov($ucilnica);
        //dodajanje FORM-a za vnos podatkov preko JS --- dodaj le uporabnikom, ki so admini
        vnos_podatkov();
        desno();
    }
    
    //izpis_sklopov($ucilnica);
?>