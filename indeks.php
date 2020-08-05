<?php
    require_once 'php/dbconnect.php';
    require_once 'php/htmfunkcije.php';

    navbar(3);
    if(!isset($_SESSION['username']))
        header("Location: tmplogin.php");
    levo();
    glava("Iskalnik tečajev");
    ?>
        <form>
        <div class="input-group mt-4">
            <input type="text" class="form-control" placeholder="Iskanje učilnic" name="search" aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
                <input type="submit" class="btn btn-outline-info my-2 my-sm-0" type="button" id="button-addon2" value="Išči" />
            </div>
        </div>
        </form>
        <div class="row">
            <div class="vsebina_sklopa mt-3" style="border: none;">

        <?php

    if(isset($_GET['search']) && !empty($_GET['search']))
    {
        $search = strtolower($conn->real_escape_string($_GET['search']));
        $q = "SELECT imeucilnice, vrsta_ucilnice, kljuc, kategorija_imekategorije
        FROM ucilnica  WHERE lower(imeucilnice) LIKE '%$search%'
        ORDER BY imeucilnice"; 
        $result = $conn->query($q);
        echo "Rezultati iskanja za $search:";

        // začetek dela, kjer so izpisane kartice
        echo '<div class="row row-cols-sm-2 row-cols-lg-3 row-cols-1 m-0">';

        while($row = $result->fetch_assoc())
        {
            ?>
            <div class="col ">
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
        echo '<div class="row row-cols-sm-2 row-cols-lg-3 row-cols-1 m-0">';
        
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
        echo '<div class="row row-cols-sm-2 row-cols-lg-3 row-cols-1 m-0">';

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
    echo '<a href="createucilnica.php"><button class="mb-5 mt-3 gumb">Ustvari učilnico</button></a>';
    desno();
?>