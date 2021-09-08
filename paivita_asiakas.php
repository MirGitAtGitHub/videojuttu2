<?php

require_once "inc/tietokanta.php";

if(!empty( $_POST )){

    // Luetaan lomakkeen lähettämät tiedot 
    $asiakasID = $_GET['asiakasID'];
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
        
        // Suoritetaan asiakastietojen päivitys
        $sql = "UPDATE asiakas 
                SET henkilotunnus = '". $henkilotunnus ."', 
                etunimi = '". $etunimi ."', 
                sukunimi = '". $sukunimi ."', 
                sahkoposti = '". $sahkoposti ."',  
                lahiosoite = '". $lahiosoite ."',  
                postinumero = '". $postinumero ."', 
                postitoimipaikka = '". $postitoimipaikka ."', 
                puhelin = '". $puhelin ."'
                WHERE asiakasID=" . $asiakasID  ;

        // Suoritetaan päivitys ja katkaistaan yhteys
        mysqli_query($link, $sql);
        mysqli_close($link);

        //Ohjataan käyttäjä asiaskatietoihin
        header("Location: asiakas.php");
    }


} else {

    if(!empty($_GET['asiakasID'])){
        $asiakasID = $_GET['asiakasID'];
    } else {
        header("Location: asiakas.php");
    }

    //luodaan kysely asiakatietojen hakuun
    $sql = "SELECT * FROM asiakas WHERE asiakasID=" . $asiakasID;

    // suoritetaan kysely ja tallennetaan tulosjoukko
    $result = mysqli_query($link, $sql);

    //haetaan asiakkaan tiedot $row-muuttujaan
    $row = mysqli_fetch_array($result);

    //suljetaan tietokantayhteys
    mysqli_close($link);

    // Luetaan tietokannan tiedot muuttujiin 
    $henkilotunnus = $row['henkilotunnus'];
    $etunimi = $row['etunimi'];
    $sukunimi = $row['sukunimi'];
    $lahiosoite = $row['lahiosoite'];
    $postinumero = $row['postinumero'];
    $postitoimipaikka = $row['postitoimipaikka'];
    $sahkoposti = $row['sahkoposti'];
    $puhelin = $row['puhelin'];
}
require_once "inc/header.php";
?>
    <h1>Päivitä asiakastietoja</h1>

    <form action="paivita_asiakas.php?asiakasID=<?php echo $asiakasID; ?>" method="post">

        <div class="mb-3">
            <label for="henkilotunnus" class="form-label">Henkilötunnus</label>
            <input disabled type="text" class="form-control" value="<?php echo $henkilotunnus; ?>">
            <input type="hidden" name="henkilotunnus" value="<?php echo $henkilotunnus; ?>">
        </div>

        <div class="mb-3">
            <label for="etunimi" class="form-label">Etunimi</label>
            <input type="text" class="form-control <?php echo !empty($etunimiError) ? 'is-invalid' : ''; ?>" id="etunimi" name="etunimi" value="<?php echo !empty($etunimi) ? $etunimi : ''; ?>">
            <?php if( !empty($etunimiError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $etunimiError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="sukunimi" class="form-label">Sukunimi</label>
            <input type="text" class="form-control <?php echo !empty($sukunimiError) ? 'is-invalid' : ''; ?>" id="sukunimi" name="sukunimi" value="<?php echo !empty($sukunimi) ? $sukunimi : ''; ?>">
            <?php if( !empty($sukunimiError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $sukunimiError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="lahiosoite" class="form-label">Lähiosoite</label>
            <input type="text" class="form-control <?php echo !empty($lahiosoiteError) ? 'is-invalid' : ''; ?>" id="lahiosoite" name="lahiosoite" value="<?php echo !empty($lahiosoite) ? $lahiosoite : ''; ?>">
            <?php if( !empty($lahiosoiteError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $lahiosoiteError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="postinumero" class="form-label">Postinumero</label>
            <input type="text" class="form-control <?php echo !empty($postinumeroError) ? 'is-invalid' : ''; ?>" id="postinumero" name="postinumero" value="<?php echo !empty($postinumero) ? $postinumero : ''; ?>">
            <?php if( !empty($postinumeroError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $postinumeroError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="postitoimipaikka" class="form-label">Postitoimipaikka</label>
            <input type="text" class="form-control <?php echo !empty($postitoimipaikkaError) ? 'is-invalid' : ''; ?>" id="postitoimipaikka" name="postitoimipaikka" value="<?php echo !empty($postitoimipaikka) ? $postitoimipaikka : ''; ?>">
            <?php if( !empty($postitoimipaikkaError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $postitoimipaikkaError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="sahkoposti" class="form-label">Sähköposti</label>
            <input type="text" class="form-control <?php echo !empty($sahkopostiError) ? 'is-invalid' : ''; ?>" id="sahkoposti" name="sahkoposti" value="<?php echo !empty($sahkoposti) ? $sahkoposti : ''; ?>">
            <?php if( !empty($sahkopostiError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $sahkopostiError; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="puhelin" class="form-label">Puhelin</label>
            <input type="text" class="form-control <?php echo !empty($puhelinError) ? 'is-invalid' : ''; ?>" id="puhelin" name="puhelin" value="<?php echo !empty($puhelin) ? $puhelin : ''; ?>">
            <?php if( !empty($puhelinError) ): ?>
                <div class="form-text invalid-feedback"><?php echo $puhelinError; ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Tallenna</button>
    </form>

<?php
require_once "inc/footer.php";
?>