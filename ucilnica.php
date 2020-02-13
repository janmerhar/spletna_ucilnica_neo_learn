<?php
    require_once 'php/htmfunkcije.php';
    require_once 'php/dbconnect.php';
    require_once 'php/dbfunkcije.php';

    navbar(3, "mainFunction()");
    if(!isset($_GET['ucilnica']))
        header("Location: indeks.php");
    $_SESSION['ucilnica'] = $_GET['ucilnica'];
    $ucilnica = $_SESSION['ucilnica'];

    $q = "SELECT vrsta_ucilnice, kljuc FROM ucilnica WHERE imeucilnice = ?";
    $stmt = $conn->prepare($q);
    $stmt->bind_param("s", $ucilnica);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows != 1)
        header("Location: indeks.php");
    else
        $row = $result->fetch_assoc();

    //pogledam, če je nastavljeno geslo
    if(isset($_POST['geslo']))
    {
        if($_POST['geslo'] == $row['kljuc'])
        {
            levo(1);
            glava("$ucilnica");
        
            izpis_sklopov($ucilnica);
            //dodajanje FORM-a za vnos podatkov preko JS
            vnos_podatkov();
        }
        else
            header("Location: indeks.php");
    }
    else if($row['vrsta_ucilnice'] == "zasebna" && !isset($_POST['geslo']))
    {
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
        levo(1);
        glava("$ucilnica");
    
        izpis_sklopov($ucilnica);
        //dodajanje FORM-a za vnos podatkov preko JS
        vnos_podatkov();
    }
    
    desno();
    //izpis_sklopov($ucilnica);
?>