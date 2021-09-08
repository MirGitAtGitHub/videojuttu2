<?php
    //require_once 'funktiot.php';

    if (!empty($_POST)){

        // Luetaan lomakkeen lähettämät tiedot 
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
            $henkilotunnusError = "Syötä henkilötunnus";
            $valid = false;
        }

        if(empty($genre)){
            $etunimiError = "Syötä etunimi";
            $valid = false;
        }

        if(empty($kesto)){
            $sukunimiError = "Syötä sukunimi";
            $valid = false;
        }

        if(empty($vuosi)){
            $lahiosoiteError = "Syötä lähiosoite";
            $valid = false;
        }
        if($valid){
            require_once "inc/tietokanta.php";
            
            // Attempt insert query execution
            $sql = "INSERT INTO elokuva (nimi, genre, kesto, vuosi) 
                VALUES ('". $nimi ."', '" . $genre . "', '" . $kesto . "', '" . $vuosi . "')";

            // Suoritetaan INSERT ja katkaistaan yhteys
            mysqli_query($link, $sql);
            mysqli_close($link);

            //Ohjataan käyttäjä asiaskatietoihin
            header("Location: elokuva.php");
        }
    }

    // haetaan header
    require_once "inc/header.php";
?>
    <!-- Asiastietojen syöttölomake -->    
    <h1>Lisää elokuva</h1>

    <form action="lisaa_elokuva.php" method="post">

        <div class="mb-3">
            <label for="nimi" class="form-label">Nimi</label>
            <input type="text" class="form-control <?php echo !empty($nimiError) ? 'is-invalid' : ''; ?>" id="nimi" name="nimi" value="<?php echo !empty($nimi) ? $nimi : ''; ?>">
            <?php if( !empty($nimiError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $nimiError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" class="form-control <?php echo !empty($genreError) ? 'is-invalid' : ''; ?>" id="genre" name="genre">
            <?php if( !empty($genreError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $genreError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="kesto" class="form-label">Kesto</label>
            <input type="text" class="form-control <?php echo !empty($kestoError) ? 'is-invalid' : ''; ?>" id="kesto" name="kesto">
            <?php if( !empty($kestoError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $kestoError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="vuosi" class="form-label">Vuosi</label>
            <input type="text" class="form-control <?php echo !empty($vuosiError) ? 'is-invalid' : ''; ?>" id="vuosi" name="vuosi">
            <?php if( !empty($vuosiError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $vuosiError; ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Tallenna</button>
    </form>

<?php
    // haetaan footer
    require_once "inc/footer.php";
?>