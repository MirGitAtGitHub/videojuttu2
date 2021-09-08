<?php

require_once "inc/tietokanta.php";

if(!empty( $_POST )){

    // Luetaan lomakkeen lähettämät tiedot 
    $elokuvaID = $_GET['elokuvaID'];
    $nimi = $_POST['nimi'];
    $genre = $_POST['genre'];
    $kesto = $_POST['kesto'];
    $vuosi = $_POST['vuosi'];

    // Puuttuvien kenttien ohjetekstit
    $nimiError = '' ;
    $genreError = '';
    $kestoError = '';
    $vuosiError = '';

    // Tarkistetaan
    $valid = true;

    // Tarkistetaan lomakkeen kenttät. Eivät saa olla tyhjiä.
    if(empty($nimi)){
        $nimiError = "Syötä henkilötunnus";
        $valid = false;
    }

    if(empty($genre)){
        $genreError = "Syötä etunimi";
        $valid = false;
    }

    if(empty($kesto)){
        $kestoError = "Syötä sukunimi";
        $valid = false;
    }

    if(empty($vuosi)){
        $vuosiError = "Syötä lähiosoite";
        $valid = false;
    }

    if($valid){
        
        // Suoritetaan asiakastietojen päivitys
        $sql = "UPDATE elokuva 
                SET nimi = '". $nimi ."', 
                genre = '". $genre ."', 
                kesto = '". $kesto ."', 
                vuosi = '". $vuosi ."'
                WHERE elokuvaID=" . $elokuvaID;

        // Suoritetaan päivitys ja katkaistaan yhteys
        mysqli_query($link, $sql);
        mysqli_close($link);

        //Ohjataan käyttäjä asiaskatietoihin
        header("Location: elokuva.php");
    }


} else {

    if(!empty($_GET['elokuvaID'])){
        $elokuvaID = $_GET['elokuvaID'];
    } else {
        header("Location: elokuva.php");
    }

    //luodaan kysely asiakatietojen hakuun
    $sql = "SELECT * FROM elokuva WHERE elokuvaID=" . $elokuvaID;

    // suoritetaan kysely ja tallennetaan tulosjoukko
    $result = mysqli_query($link, $sql);

    //haetaan asiakkaan tiedot $row-muuttujaan
    $row = mysqli_fetch_array($result);

    //suljetaan tietokantayhteys
    mysqli_close($link);

    // Luetaan tietokannan tiedot muuttujiin 
    $nimi = $row['nimi'];
    $genre = $row['genre'];
    $kesto = $row['kesto'];
    $vuosi = $row['vuosi'];
}
require_once "inc/header.php";
?>
    <h1>Päivitä elokuvatietoja</h1>

    <form action="paivita_elokuva.php?elokuvaID=<?php echo $elokuvaID; ?>" method="post">

        <div class="mb-3">
            <label for="nimi" class="form-label">Nimi</label>
            <input type="text" class="form-control" name="nimi" value="<?php echo $nimi; ?>">
        </div>

        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" class="form-control <?php echo !empty($genreError) ? 'is-invalid' : ''; ?>" id="genre" name="genre" value="<?php echo !empty($genre) ? $genre : ''; ?>">
            <?php if( !empty($genreError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $genreError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="kesto" class="form-label">Kesto</label>
            <input type="text" class="form-control <?php echo !empty($kestoError) ? 'is-invalid' : ''; ?>" id="kesto" name="kesto" value="<?php echo !empty($kesto) ? $kesto : ''; ?>">
            <?php if( !empty($kestoError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $kestoError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="vuosi" class="form-label">Vuosi</label>
            <input type="text" class="form-control <?php echo !empty($vuosiError) ? 'is-invalid' : ''; ?>" id="vuosi" name="vuosi" value="<?php echo !empty($vuosi) ? $vuosi : ''; ?>">
            <?php if( !empty($vuosiError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $vuosiError; ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Tallenna</button>
    </form>

<?php
require_once "inc/footer.php";
?>