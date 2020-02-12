<?php
    require_once 'php/dbconnect.php';
    require_once 'php/htmfunkcije.php';

    navbar(3);
    levo();
    glava("Iskalnik tečajev");
    ?>

    <form id="form" class="form" action="">
        <input type="text" name="search" placeholder="Iskanje tečajev" required/>
        <input type="submit" value="Išči"/> 
    </form><br/>
    <div class="vsebina_sklopa" style="border: none;">
    <?

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
            echo '<li><a href="ucilnica.php?ucilnica='.$row['imeucilnice'].'">'.$row['imeucilnice'].' <strong>'. $row['vrsta_ucilnice'].'</strong> ['.$row['kategorija_imekategorije'].']'.'</a></li>';
        }
        echo '</ul>';
    }
    ?></div><?php
    desno();
?>