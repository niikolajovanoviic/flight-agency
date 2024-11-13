<?php
@include "config.php";
session_start();

@$idLeta = $_SESSION["idLeta"];
@$pocetnaDrzava = $_POST["pocetnaDrzava"];
@$pocetnaGrad = $_POST["pocetnaGrad"];
@$krajnjaDrzava = $_POST["krajnjaDrzava"];
@$krajnjaGrad = $_POST["krajnjaGrad"];
@$datumPolazak = $_POST["datumPolazak"];
@$datumPovratak = $_POST["datumPovratak"];
@$pocetniAerodrom = $_POST["pocetniAerodrom"];
@$krajnjiAerodrom = $_POST["krajnjiAerodrom"];
@$cena = $_POST["cena"];
@$kapacitet = $_POST["kapacitet"];
@$slobodnaMesta = $_POST["slobodnaMesta"];
@$topPonuda = $_POST["topPonuda"];


$select = "SELECT * FROM let WHERE idLeta='$idLeta'";
if($rezultat = mysqli_query($konekcija,$select))
{
    while($row = mysqli_fetch_assoc($rezultat))
    {
        $idLetaSQL = $row["idLeta"];
        $pocetnaDestinacija_DrzavaSQL = $row["pocetnaDestinacija_Drzava"];
        $pocetnaDestinacija_GradSQL = $row["pocetnaDestinacija_Grad"];
        $krajnjaDestinacija_DrzavaSQL = $row["krajnjaDestinacija_Drzava"];
        $krajnjaDestinacija_GradSQL = $row["krajnjaDestinacija_Grad"];
        $pocetniAerodromSQL = $row["aerodromPocetni"];
        $krajnjiAerodromSQL = $row["aerodromKrajnji"];
        $datumPolaskaSQL = $row["datumPolaska"];
        $datumDolaskaSQL = $row["datumDolaska"];
        $CenaSQL = $row["Cena"];
        $brojMestaSQL = $row["brojMesta"];
        $brojSlobodnihMestaSQL = $row["brojSlobodnihMesta"];
        $topPonudaSQL = $row["topPonuda"];
    }
}


if(isset($_POST["izmeniLet1"]))
{
    if(empty($pocetnaDrzava) || empty($pocetnaGrad) || empty($krajnjaDrzava) || empty($krajnjaGrad) || 
    empty($datumPolazak) || empty($cena) || empty($kapacitet))
    {
        $error[] = "Morate popuniti sva obavezna polja";
    }
    else
    {
        $idLeta = mysqli_real_escape_string($konekcija,$_SESSION["idLeta"]);
        $pocetnaDrzavaSQL = mysqli_real_escape_string($konekcija,$_POST["pocetnaDrzava"]);
        $pocetniGradSQL = mysqli_real_escape_string($konekcija,$_POST["pocetnaGrad"]);
        $krajnjaDrzavaSQL = mysqli_real_escape_string($konekcija,$_POST["krajnjaDrzava"]);
        $krajnjaGradSQL = mysqli_real_escape_string($konekcija,$_POST["krajnjaGrad"]);
        $pocetniAerodromSQL = mysqli_real_escape_string($konekcija,$_POST["pocetniAerodrom"]);
        $krajnjiAerodromSQL = mysqli_real_escape_string($konekcija,$_POST["krajnjiAerodrom"]);

        // formatiranje datuma
        $datumPolazakSQL = mysqli_real_escape_string($konekcija,$_POST["datumPolazak"]);
        $formatiran_datum_polazakSQL = date('Y-m-d', strtotime($datumPolazakSQL));
        $datumPovratkaSQL = mysqli_real_escape_string($konekcija,$_POST["datumPovratak"]);
        $formatiran_datum_povratakSQL = date('Y-m-d', strtotime($datumPovratkaSQL));

        $cenaSQL = mysqli_real_escape_string($konekcija,$_POST["cena"]);
        $kapacitetSQL = mysqli_real_escape_string($konekcija,$_POST["kapacitet"]);
        $slobodnaMesta = mysqli_real_escape_string($konekcija,$_POST["slobodnaMesta"]);
        $topPonudaSQL = mysqli_real_escape_string($konekcija,$_POST["topPonuda"]);

        $insert = "UPDATE let SET  pocetnaDestinacija_Drzava='$pocetnaDrzavaSQL', pocetnaDestinacija_Grad='$pocetniGradSQL', 
        krajnjaDestinacija_Drzava='$krajnjaDrzavaSQL', krajnjaDestinacija_Grad='$krajnjaGradSQL', aerodromPocetni='$pocetniAerodromSQL',aerodromKrajnji='$krajnjiAerodromSQL', 
        datumPolaska='$formatiran_datum_polazakSQL', datumDolaska='$formatiran_datum_povratakSQL', 
        Cena='$cenaSQL', brojMesta='$kapacitetSQL', brojSlobodnihMesta='$slobodnaMesta', topPonuda='$topPonudaSQL' 
        WHERE idLeta='$idLeta' ";
        if(mysqli_query($konekcija,$insert))
        {
            $_SESSION['uspesnoIzmenjen'] = "Uspešno ste izmenili let iz baze!";
            header("location:izmeniLet.php");
        }
        
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | IzmeniLet</title>
    <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
    <link rel="shortcut icon" href="logo/favicon0.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="icons/css/all.css">
    <link rel="stylesheet" href="icons/css/all.min.css">
    <link rel="stylesheet" href="css/izmeniLetForma.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="ispisPodataka">
    <div class="forma">
        <form method="post">
            <div class="row mb-3">
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Id:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="pocetnaDrzava" value="<?php echo $_SESSION["idLeta"]?>" disabled>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <h1 class="formaNaslov">Pocetna desitnacija</h1>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Drzava:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="pocetnaDrzava" value="<?php echo $pocetnaDestinacija_DrzavaSQL?>">
                </div>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Grad:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="pocetnaGrad" value="<?php echo $pocetnaDestinacija_GradSQL?>">
                </div>
            </div>
            
            <hr>
            
            <div class="row mb-3">
                <h1 class="formaNaslov">Krajnja desitnacija</h1>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Drzava:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="krajnjaDrzava" value="<?php echo $krajnjaDestinacija_DrzavaSQL?>">
                </div>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Grad:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="krajnjaGrad" value="<?php echo $krajnjaDestinacija_GradSQL?>">
                </div>
            </div>
            
            <hr>

            <div class="row mb-3">
                <h1 class="formaNaslov">Aerodrom</h1>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Početni:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="pocetniAerodrom" value="<?php echo $pocetniAerodromSQL?>">
                </div>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Krajnji:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="krajnjiAerodrom" value="<?php echo $krajnjiAerodromSQL?>">
                </div>
            </div>
            
            <hr>
            
            <div class="row mb-3">
                <h1 class="formaNaslov">Datum</h1>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Polazak:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="datumPolazak" value="<?php echo $datumPolaskaSQL?>" min="<?php echo date("Y-m-d"); ?>">
                </div>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Povratak:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="datumPovratak" value="<?php echo $datumDolaskaSQL?>" min="<?php echo date("Y-m-d", strtotime('tomorrow')); ?>">
                </div>
            </div>
            <p><i>Polje za povratak može ostati prazno...</i></p>
            <hr>
            
            <div class="row mb-3">
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Cena:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="cena" value="<?php echo $CenaSQL?>">
                </div>
            </div>
            <p><i>Cena treba biti izražena u evrima...</i></p>
            
            <hr>
            
            <div class="row mb-3">
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Kapacitet:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="kapacitet" value="<?php echo $brojMestaSQL?>">
                </div>
            </div>

            <div class="row mb-3">
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Slobodno:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="slobodnaMesta" value="<?php echo $brojSlobodnihMestaSQL?>">
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                
                <label for="topPonuda" class="col-sm-2 col-form-label" id="labelInput">Top:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="topPonuda" value="<?php echo $topPonudaSQL?>">
                </div>
            </div>
            <p><i>Ako je let u top ponudi unesite <strong>Da</strong>, u suprotnom <strong>Ne</strong></i></p>
            <hr>
            <!-- ovde ide poruka za prazan unos -->
            <?php

            if(isset($error))
            {
                foreach($error as $error)
                {
                    echo"<span class='greskaPrazno'>".$error."</span>";
                }
                
            }

            ?>
            <input type="submit" value="Izmeni let" id="formaSubmit" name="izmeniLet1">
            <a href="izmeniLet.php" id="linkPocetna">Izaberite drugi let</a>
        </form>
    </div>
</div>




    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>
</html>