<?php
    require_once "inc/tietokanta.php";

    // luodaan kysely
    $sql = "SELECT * FROM asiakas";

    // suoritetaan kysely ja tallennetaan tulosjoukko
    $result = mysqli_query($link, $sql);

    //Haetaan sivun header
    require_once "inc/header.php";
?>
    <!-- Asiakastiedot taulukko -->      
    <h1>Asiakastiedot</h1>
    
    <a class="btn btn-success" href="lisaa_asiakas.php">Lisää asiakas</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Etunimi</th>
                <th scope="col">Sukunimi</th>
                <th scope="col">Puhelin</th>
                <th scope="col">Toiminto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // tulostetaan asiakastiedot rivi kerrallaan
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td>" . $row['asiakasID'] . "</td>";
                    echo "<td>" . $row['etunimi'] . "</td>";
                    echo "<td>" . $row['sukunimi'] . "</td>";
                    echo "<td>" . $row['puhelin'] . "</td>";
                    echo "<td>";
                    echo "<a class='btn' href='katso_asiakas.php?asiakasID=" . $row['asiakasID'] . "'>Katso</a>";
                    echo " ";
                    echo "<a class='btn btn-success' href='paivita_asiakas.php?asiakasID=" . $row['asiakasID'] . "'>Päivitä</a>";
                    echo " ";
                    echo "<a class='btn btn-danger' href='poista_asiakas.php?asiakasID=" . $row['asiakasID'] . "'>Poista</a>";
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