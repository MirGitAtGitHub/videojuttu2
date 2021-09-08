<?php

require_once "inc/tietokanta.php";

if (!empty($_POST)){
    $asiakasID = $_POST['asiakasID'];

    $sql = "DELETE FROM asiakas
            WHERE asiakasID = " . $asiakasID;

    // suoritetaan kysely ja tallennetaan tulosjoukko
    $result = mysqli_query($link, $sql);

    //suljetaan tietokantayhteys
    mysqli_close($link);

    header("Location: asiakas.php");    

} else {
    if (!empty($_GET['asiakasID'])){
        $asiakasID = $_GET['asiakasID'];
    } else {
        header("Location: asiakas.php");
    }
}

$sql = "SELECT asiakasID, CONCAT(etunimi, ' ', sukunimi) nimi 
        FROM asiakas  
        WHERE asiakasID = " . $asiakasID;

// suoritetaan kysely ja tallennetaan tulosjoukko
$result = mysqli_query($link, $sql);

//haetaan asiakkaan tiedot $row-muuttujaan
$row = mysqli_fetch_array($result);

//suljetaan tietokantayhteys
mysqli_close($link);

require_once "inc/header.php";
?>
    <h1>Asiakastietojen poistaminen</h1>

    <p>Haluatko varmasti poistaa asiakkaan <strong><?php echo $row['nimi'] ;?></strong> tiedot?</p>

    <form action="poista_asiakas.php" method="post">
        <input type="hidden" name="asiakasID" value="<?php echo $asiakasID; ?>">

        <button type="submit" class="btn btn-danger">Poista</button>
        <a href="asiakas.php" class="btn">Takaisin</a>

    </form>


<?php
require_once "inc/footer.php";    