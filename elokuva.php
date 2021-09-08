<?php
    require_once "inc/tietokanta.php";

    // luodaan kysely
    $sql = "SELECT * FROM elokuva";

    // suoritetaan kysely ja tallennetaan tulosjoukko
    $result = mysqli_query($link, $sql);

    //Haetaan sivun header
    require_once "inc/header.php";
?>
    <!-- Asiakastiedot taulukko -->      
    <h1>Elokuvatiedot</h1>
    
    <a class="btn btn-success" href="lisaa_elokuva.php">Lisää elokuva</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nimi</th>
                <th scope="col">Genre</th>
                <th scope="col">Kesto</th>
                <th scope="col">Vuosi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // tulostetaan asiakastiedot rivi kerrallaan
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td>" . $row['elokuvaID'] . "</td>";
                    echo "<td>" . $row['nimi'] . "</td>";
                    echo "<td>" . $row['genre'] . "</td>";
                    echo "<td>" . $row['kesto'] . "</td>";
                    echo "<td>" . $row['vuosi'] . "</td>";
                    echo "<td>";
                    echo "<a class='btn' href='katso_elokuva.php?elokuvaID=" . $row['elokuvaID'] . "'>Katso</a>";
                    echo " ";
                    echo "<a class='btn btn-success' href='paivita_elokuva.php?elokuvaID=" . $row['elokuvaID'] . "'>Päivitä</a>";
                    echo " ";
                    echo "<a class='btn btn-danger' href='poista_elokuva.php?elokuvaID=" . $row['elokuvaID'] . "'>Poista</a>";
                    echo "</td>";
                echo "</tr>";
            }
            // Suljetaan tietokantayhteys
            mysqli_close($link);
            ?>
        </tbody>
    </table>

<?php
    require_once "inc/footer.php";
?>