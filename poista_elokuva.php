<?php

require_once "inc/tietokanta.php";

if (!empty($_POST)){
    $elokuvaID = $_POST['elokuvaID'];

    $sql = "DELETE FROM elokuva
            WHERE elokuvaID = " . $elokuvaID;

    // suoritetaan kysely ja tallennetaan tulosjoukko
    $result = mysqli_query($link, $sql);

    //suljetaan tietokantayhteys
    mysqli_close($link);

    header("Location: elokuva.php");    

} else {
    if (!empty($_GET['elokuvaID'])){
        $elokuvaID = $_GET['elokuvaID'];
    } else {
        header("Location: elokuva.php");
    }
}

$sql = "SELECT elokuvaID, nimi 
        FROM elokuva  
        WHERE elokuvaID = " . $elokuvaID;

// suoritetaan kysely ja tallennetaan tulosjoukko
$result = mysqli_query($link, $sql);

//haetaan asiakkaan tiedot $row-muuttujaan
$row = mysqli_fetch_array($result);

//suljetaan tietokantayhteys
mysqli_close($link);

require_once "inc/header.php";
?>
    <h1>Elokuvatietojen poistaminen</h1>

    <p>Haluatko varmasti poistaa elokuvan <strong><?php echo $row['nimi'] ;?></strong> tiedot?</p>

    <form action="poista_elokuva.php" method="post">
        <input type="hidden" name="elokuvaID" value="<?php echo $elokuvaID; ?>">

        <button type="submit" class="btn btn-danger">Poista</button>
        <a href="elokuva.php" class="btn">Takaisin</a>

    </form>


<?php
require_once "inc/footer.php";    