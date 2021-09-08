<?php

if(!empty($_GET['elokuvaID'])){
    $elokuvaID = $_GET['elokuvaID'];
} else {
    header("Location: elokuva.php");
}

require_once "inc/tietokanta.php";

//luodaan kysely asiakatietojen hakuun
$sql = "SELECT * FROM elokuva WHERE elokuvaID=" . $elokuvaID;

// suoritetaan kysely ja tallennetaan tulosjoukko
$result = mysqli_query($link, $sql);

//haetaan asiakkaan tiedot $row-muuttujaan
$row = mysqli_fetch_array($result);

//suljetaan tietokantayhteys
mysqli_close($link);

require_once "inc/header.php";
?>
    <h1>Katso elokuvatietoja</h1>

    <div class="mb-3">
        <label for="nimi" class="form-label">Nimi</label>
        <input type="text" class="form-control" value="<?php echo $row['nimi']; ?>" disabled>
    </div>

    <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" class="form-control" id="genre" value="<?php echo $row['genre']; ?>" disabled>
    </div>

    <div class="mb-3">
        <label for="kesto" class="form-label">Kesto</label>
        <input type="text" class="form-control" id="kesto" value="<?php echo $row['kesto']; ?>" disabled>
    </div>

    <div class="mb-3">
        <label for="vuosi" class="form-label">Vuosi</label>
        <input type="text" class="form-control"  value="<?php echo $row['vuosi']; ?>" disabled>
    </div>

    <a href="elokuva.php" class="btn btn-primary">Takaisin</a>

<?php
require_once "inc/footer.php";
?>