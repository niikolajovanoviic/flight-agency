<?php
@include "config.php";
session_start();

@$pocetnaDrzava = $_POST["pocetnaDrzava"];
@$pocetnaGrad = $_POST["pocetnaGrad"];
@$krajnjaDrzava = $_POST["krajnjaDrzava"];
@$krajnjaGrad = $_POST["krajnjaGrad"];
@$pocetniAerodrom = $_POST["pocetniAerodrom"];
@$krajnjiAerodrom = $_POST["krajnjiAerodrom"];
@$datumPolazak = $_POST["datumPolazak"];
@$datumPovratak = $_POST["datumPovratak"];
@$cena = $_POST["cena"];
@$kapacitet = $_POST["kapacitet"];
@$topPonuda = $_POST["topPonuda"];

if(isset($_POST["dodajLet1"]))
{
    if(empty($pocetnaDrzava) || empty($pocetnaGrad) || empty($krajnjaDrzava) || empty($krajnjaGrad) || 
    empty($datumPolazak) || empty($cena) || empty($kapacitet) || empty($topPonuda) || 
    empty($pocetniAerodrom) || empty($krajnjiAerodrom))
    {
        $error[] = "Morate popuniti sva obavezna polja";
    }
    else
    {
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
        $topPonudaSQL = mysqli_real_escape_string($konekcija,$_POST["topPonuda"]);

        $upitProvere = "SELECT * FROM let WHERE krajnjaDestinacija_Grad='$krajnjaGradSQL' && datumPolaska='$formatiran_datum_polazakSQL'";
        $rezultatProvere = mysqli_query($konekcija,$upitProvere);

        if(mysqli_num_rows($rezultatProvere)>0)
        {
            $error[] = "Već postoji let iz ".$pocetnaGrad."-a tog datuma";
        }
        else
        {
            $insert = "INSERT INTO let (pocetnaDestinacija_Drzava,pocetnaDestinacija_Grad,krajnjaDestinacija_Drzava,krajnjaDestinacija_Grad,
            aerodromPocetni,aerodromKrajnji, datumPolaska,datumDolaska,Cena,brojMesta,brojSlobodnihMesta,topPonuda) VALUES ('$pocetnaDrzavaSQL', '$pocetniGradSQL', '$krajnjaDrzavaSQL', 
            '$krajnjaGradSQL','$pocetniAerodromSQL','$krajnjiAerodromSQL' ,'$formatiran_datum_polazakSQL', '$formatiran_datum_povratakSQL', '$cenaSQL', '$kapacitetSQL', '$kapacitetSQL', '$topPonudaSQL')";
            if(mysqli_query($konekcija,$insert))
            {
                $_SESSION['uspesnoUbacen'] = "Uspešno ste ubacili let u bazu!";
                header("location:admin.php");
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | DodajLet</title>
    <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
    <link rel="shortcut icon" href="logo/favicon0.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="icons/css/all.css">
    <link rel="stylesheet" href="icons/css/all.min.css">
    <link rel="stylesheet" href="css/dodajLet.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="ispisPodataka">
    <div class="forma">
        <form method="post">
            <hr>
            <div class="row mb-3">
                <h1 class="formaNaslov">Pocetna desitnacija</h1>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Drzava:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="pocetnaDrzava">
                </div>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Grad:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="pocetnaGrad">
                </div>
            </div>
            
            <hr>
            
            <div class="row mb-3">
                <h1 class="formaNaslov">Krajnja desitnacija</h1>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Drzava:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="krajnjaDrzava">
                </div>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Grad:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="krajnjaGrad">
                </div>
            </div>
            
            <hr>

            <div class="row mb-3">
                <h1 class="formaNaslov">Aerodrom</h1>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Početni:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="pocetniAerodrom">
                </div>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Krajnji:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="krajnjiAerodrom">
                </div>
            </div>
            
            <hr>


            
            <div class="row mb-3">
                <h1 class="formaNaslov">Datum</h1>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Polazak:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="datumPolazak" min="<?php echo date("Y-m-d"); ?>">
                </div>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Povratak:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="datumPovratak" min="<?php echo date("Y-m-d", strtotime('tomorrow')); ?>">
                </div>
            </div>
            <p><i>Polje za povratak može ostati prazno</i></p>
            <hr>
            
            <div class="row mb-3">
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Cena:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="cena">
                </div>
            </div>
            <p><i>Cena treba biti izražena u evrima</i></p>
            
            <hr>
            
            <div class="row mb-3">
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Kapacitet:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="kapacitet">
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                
                <label for="topPonuda" class="col-sm-2 col-form-label" id="labelInput">Top:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="topPonuda">
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
            <input type="submit" value="Dodaj let" id="formaSubmit" name="dodajLet1">
            <a href="admin.php" id="linkPocetna">Povratak na početnu</a>
        </form>
    </div>
</div>




    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>
</html>