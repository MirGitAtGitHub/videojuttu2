<?php
    //require_once 'funktiot.php';

    if (!empty($_POST)){

        // Luetaan lomakkeen lähettämät tiedot 
        $henkilotunnus = $_POST['henkilotunnus'];
        $etunimi = $_POST['etunimi'];
        $sukunimi = $_POST['sukunimi'];
        $lahiosoite = $_POST['lahiosoite'];
        $postinumero = $_POST['postinumero'];
        $postitoimipaikka = $_POST['postitoimipaikka'];
        $sahkoposti = $_POST['sahkoposti'];
        $puhelin = $_POST['puhelin'];

        // Puuttuvien kenttien ohjetekstit
        $henkilotunnusError = '' ;
        $etunimiError = '';
        $sukunimiError = '';
        $lahiosoiteError = '';
        $postinumeroError = '';
        $postitoimipaikkaError = '';
        $sahkopostiError = '';
        $puhelinError = '';

        // Tarkistetaan
        $valid = true;

        // Tarkistetaan lomakkeen kenttät. Eivät saa olla tyhjiä.
        if(empty($henkilotunnus)){
            $henkilotunnusError = "Syötä henkilötunnus";
            $valid = false;
        }

        if(empty($etunimi)){
            $etunimiError = "Syötä etunimi";
            $valid = false;
        }

        if(empty($sukunimi)){
            $sukunimiError = "Syötä sukunimi";
            $valid = false;
        }

        if(empty($lahiosoite)){
            $lahiosoiteError = "Syötä lähiosoite";
            $valid = false;
        }

        if(empty($postinumero)){
            $postinumeroError = "Syötä postinumero";
            $valid = false;
        }

        if(empty($postitoimipaikka)){
            $postitoimipaikkaError = "Syötä postitoimipaikka";
            $valid = false;
        }

        if(empty($sahkoposti)){
            $sahkopostiError = "Syötä sähköposti";
            $valid = false;
        }

        if(empty($puhelin)){
            $puhelinError = "Syötä puhelinnumero";
            $valid = false;
        }

        if($valid){
            require_once "inc/tietokanta.php";
            
            // Attempt insert query execution
            $sql = "INSERT INTO asiakas (henkilotunnus, etunimi, sukunimi, sahkoposti,  lahiosoite, postinumero, postitoimipaikka, puhelin ) 
                VALUES ('". $henkilotunnus ."', '" . $etunimi . "', '" . $sukunimi . "', '" . $sahkoposti . "', '" . $lahiosoite . "', '" . $postinumero . "', '" . $postitoimipaikka . "' , '" . $puhelin . "')";

            // Suoritetaan INSERT ja katkaistaan yhteys
            mysqli_query($link, $sql);
            mysqli_close($link);

            //Ohjataan käyttäjä asiaskatietoihin
            header("Location: asiakas.php");
        }
    }

    // haetaan header
    require_once "inc/header.php";
?>
    <!-- Asiastietojen syöttölomake -->    
    <h1>Lisää asiakas</h1>

    <form action="lisaa_asiakas.php" method="post">

        <div class="mb-3">
            <label for="henkilotunnus" class="form-label">Henkilötunnus</label>
            <input type="text" class="form-control <?php echo !empty($henkilotunnusError) ? 'is-invalid' : ''; ?>" id="henkilotunnus" name="henkilotunnus" value="<?php echo !empty($henkilotunnus) ? $henkilotunnus : ''; ?>">
            <?php if( !empty($henkilotunnusError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $henkilotunnusError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="etunimi" class="form-label">Etunimi</label>
            <input type="text" class="form-control <?php echo !empty($etunimiError) ? 'is-invalid' : ''; ?>" id="etunimi" name="etunimi">
            <?php if( !empty($etunimiError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $etunimiError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="sukunimi" class="form-label">Sukunimi</label>
            <input type="text" class="form-control <?php echo !empty($sukunimiError) ? 'is-invalid' : ''; ?>" id="sukunimi" name="sukunimi">
            <?php if( !empty($sukunimiError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $sukunimiError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="lahiosoite" class="form-label">Lähiosoite</label>
            <input type="text" class="form-control <?php echo !empty($lahiosoiteError) ? 'is-invalid' : ''; ?>" id="lahiosoite" name="lahiosoite">
            <?php if( !empty($lahiosoiteError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $lahiosoiteError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="postinumero" class="form-label">Postinumero</label>
            <input type="text" class="form-control <?php echo !empty($postinumeroError) ? 'is-invalid' : ''; ?>" id="postinumero" name="postinumero">
            <?php if( !empty($postinumeroError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $postinumeroError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="postitoimipaikka" class="form-label">Postitoimipaikka</label>
            <input type="text" class="form-control <?php echo !empty($postitoimipaikkaError) ? 'is-invalid' : ''; ?>" id="postitoimipaikka" name="postitoimipaikka">
            <?php if( !empty($postitoimipaikkaError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $postitoimipaikkaError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="sahkoposti" class="form-label">Sähköposti</label>
            <input type="text" class="form-control <?php echo !empty($sahkopostiError) ? 'is-invalid' : ''; ?>" id="sahkoposti" name="sahkoposti">
            <?php if( !empty($sahkopostiError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $sahkopostiError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="puhelin" class="form-label">Puhelin</label>
            <input type="text" class="form-control <?php echo !empty($puhelinError) ? 'is-invalid' : ''; ?>" id="puhelin" name="puhelin">
            <?php if( !empty($puhelinError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $puhelinError; ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Tallenna</button>
    </form>

<?php
    // haetaan footer
    require_once "inc/footer.php";
?>