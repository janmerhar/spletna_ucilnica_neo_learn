<?php
    require_once 'php/dbconnect.php';
    require_once 'php/htmfunkcije.php';

    navbar(3);
    if(!isset($_SESSION['username']))
        header("Location: tmplogin.php");
    levo();
    glava("Iskalnik tečajev");
    ?>
        <form id="form" class="form" action="">
        <div class="row">
                <div class="col-10">
                    <input type="text" name="search" placeholder="Iskanje tečajev" required/>
                </div>
                <div class="col-2">
                    <input type="submit" value="Išči" style="width: 100% !important"/> 
                </div>
            </form>
        </div>
        <div class="row">
            <div class="vsebina_sklopa ml-2 mt-3" style="border: none;">
        
        <?php

    if(isset($_GET['search']) && !empty($_GET['search']))
    {
        $search = $_GET['search'];
        $q = "SELECT imeucilnice, vrsta_ucilnice, kljuc, kategorija_imekategorije
        FROM ucilnica  WHERE lower(imeucilnice) LIKE '%$search%'
        ORDER BY imeucilnice"; 
        $result = $conn->query($q);
        echo "Rezultati iskanja za $search:";
        echo '<ul>';
        while($row = $result->fetch_assoc())
        {
            echo '<li><a href="ucilnica.php?ucilnica='.$row['imeucilnice'].'">'.$row['imeucilnice'].' <strong>'. $row['vrsta_ucilnice'].'</strong> ['.$row['kategorija_imekategorije'].']'.'</a></li>';
        }
        echo '</ul>';
    }
    //izpiše uporabnikove včlanjene učilnice
    else if(isset($_GET['clanstvo']))
    {
        if(!isset($_SESSION['username']))
            header("Location: indeks.php");
        $q = "SELECT imeucilnice, kategorija_imekategorije
        FROM ucilnica u INNER JOIN vclanjen v ON u.imeucilnice = v.ucilnica_imeucilnice 
        WHERE uporabnik_upime = ? 
        ORDER BY imeucilnice "; 

        $stmt = $conn->prepare($q);
        $stmt->bind_param("s", $_SESSION['username']);
        if(!$stmt->execute())
            header("Location: indeks.php");

        $result = $stmt->get_result(); 
        if($result->num_rows < 1)
            header('indeks.php');
        echo '<ul>';
        while($row = $result->fetch_assoc())
        {
            $link = $row['imeucilnice'];
            echo '<li><a href="ucilnica.php?ucilnica='. $link .'">'.$row['imeucilnice'].' '.$row['kategorija_imekategorije'].'</a></li>';
        }
        echo '</ul>';
    }
    else
    {

        $q = "SELECT imeucilnice, vrsta_ucilnice, kljuc, kategorija_imekategorije
        FROM ucilnica ORDER BY imeucilnice "; 
        $result = $conn->query($q);
        if($result->num_rows < 1)
            header('indeks.php');
        
        echo '<ul>';
        while($row = $result->fetch_assoc())
        {
            $link = $row['imeucilnice'];
            if($row['vrsta_ucilnice'] == "zasebna")
                $link .= "&p=true";
            echo '<li><a href="ucilnica.php?ucilnica='. $link .'">'.$row['imeucilnice'].' <strong>'. $row['vrsta_ucilnice'].'</strong> ['.$row['kategorija_imekategorije'].']'.'</a></li>';
        }
        echo '</ul>';
    }
    ?></div></div><?php
    echo '<a href="createucilnica.php"><button id="ustvari_test">Ustvari učilnico</button></a>';
    desno();
?>