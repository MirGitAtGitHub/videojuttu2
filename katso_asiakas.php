<?php

if(!empty($_GET['asiakasID'])){
    $asiakasID = $_GET['asiakasID'];
} else {
    header("Location: asiakas.php");
}

require_once "inc/tietokanta.php";

//luodaan kysely asiakatietojen hakuun
$sql = "SELECT * FROM asiakas WHERE asiakasID=" . $asiakasID;

// suoritetaan kysely ja tallennetaan tulosjoukko
$result = mysqli_query($link, $sql);

//haetaan asiakkaan tiedot $row-muuttujaan
$row = mysqli_fetch_array($result);

//suljetaan tietokantayhteys
mysqli_close($link);

require_once "inc/header.php";
?>
    <h1>Katso asiakastietoja</h1>

    <div class="mb-3">
        <label for="henkilotunnus" class="form-label">Henkilötunnus</label>
        <input type="text" class="form-control" value="<?php echo $row['henkilotunnus']; ?>" disabled>
    </div>

    <div class="mb-3">
        <label for="etunimi" class="form-label">Etunimi</label>
        <input type="text" class="form-control" id="etunimi" value="<?php echo $row['etunimi']; ?>" disabled>
    </div>

    <div class="mb-3">
        <label for="sukunimi" class="form-label">Sukunimi</label>
        <input type="text" class="form-control" id="sukunimi" value="<?php echo $row['sukunimi']; ?>" disabled>
    </div>

    <div class="mb-3">
        <label for="lahiosoite" class="form-label">Lähiosoite</label>
        <input type="text" class="form-control"  value="<?php echo $row['lahiosoite']; ?>" disabled>
    </div>

    <div class="mb-3">
        <label for="postinumero" class="form-label">Postinumero</label>
        <input type="text" class="form-control" value="<?php echo $row['postinumero']; ?>" disabled>
    </div>

    <div class="mb-3">
        <label for="postitoimipaikka" class="form-label">Postitoimipaikka</label>
        <input type="text" class="form-control"  value="<?php echo $row['postitoimipaikka']; ?>" disabled>
    </div>

    <div class="mb-3">
        <label for="sahkoposti" class="form-label">Sähköposti</label>
        <input type="text" class="form-control" value="<?php echo $row['sahkoposti']; ?>" disabled>
    </div>

    <div class="mb-3">
        <label for="puhelin" class="form-label">Puhelin</label>
        <input type="text" class="form-control" value="<?php echo $row['puhelin']; ?>" disabled>
    </div>

    <a href="asiakas.php" class="btn btn-primary">Takaisin</a>

<?php
require_once "inc/footer.php";
?>