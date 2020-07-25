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

        // začetek dela, kjer so izpisane kartice
        echo '<div class="row row-cols-sm-2 row-cols-lg-3 row-cols-1">';

        while($row = $result->fetch_assoc())
        {
            ?>
            <div class="col">
                <div class="card mt-3 bg-greyish border-blue">
                    <div class="card-body">
                        <p class="card-title font-weight-bolder"><?php echo $row['imeucilnice']; ?></p>
                        <p class="card-text">Kategorija: <?php echo strtolower($row['kategorija_imekategorije']); ?></p>
                        <p>
                            <a href="ucilnica.php?ucilnica=<?php echo $row['imeucilnice']; ?>" class="btn btn-outline-info my-2 my-sm-0">
                                Vstop <?php echo $row['vrsta_ucilnice'] == "zasebna" ? 'z geslom' : '' ?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <?php
        }
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

        // začetek dela, kjer so izpisane kartice
        echo '<div class="row row-cols-md-3 row-cols-2">';
        
        while($row = $result->fetch_assoc())
        {
            ?>
            <div class="col">
                <div class="card mt-3 bg-greyish border-blue">
                    <div class="card-body">
                        <p class="card-title font-weight-bolder"><?php echo $row['imeucilnice']; ?></p>
                        <p class="card-text">Kategorija: <?php echo strtolower($row['kategorija_imekategorije']); ?></p>
                        <p>
                            <a href="ucilnica.php?ucilnica=<?php echo $row['imeucilnice']; ?>" class="btn btn-outline-info my-2 my-sm-0">
                                Vstop <?php echo $row['vrsta_ucilnice'] == "zasebna" ? 'z geslom' : '' ?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    else
    {

        $q = "SELECT imeucilnice, vrsta_ucilnice, kljuc, kategorija_imekategorije
        FROM ucilnica ORDER BY imeucilnice "; 
        $result = $conn->query($q);
        if($result->num_rows < 1)
            header('indeks.php');
        
        // začetek dela, kjer so izpisane kartice
        echo '<div class="row row-cols-md-3 row-cols-2">';

        while($row = $result->fetch_assoc())
        {

            ?>
            <div class="col">
                <div class="card mt-3 bg-greyish border-blue">
                    <div class="card-body">
                        <p class="card-title font-weight-bolder"><?php echo $row['imeucilnice']; ?></p>
                        <p class="card-text">Kategorija: <?php echo strtolower($row['kategorija_imekategorije']); ?></p>
                        <p>
                            <a href="ucilnica.php?ucilnica=<?php echo $row['imeucilnice']; ?>" class="btn btn-outline-info my-2 my-sm-0">
                                Vstop <?php echo $row['vrsta_ucilnice'] == "zasebna" ? 'z geslom' : '' ?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?></div></div></div><?php
    echo '<a href="createucilnica.php"><button id="ustvari_test">Ustvari učilnico</button></a>';
    desno();
?>