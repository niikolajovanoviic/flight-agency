<?php

@include "config.php";

session_start();
if(isset($_POST["odjaviSe"]))
{
    session_unset();
    session_destroy();
    header("location:loginPage.php");
}
if(isset($_POST["prijaviSe"]))
{
    header("location:loginPage.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saznajte više | Prag</title>
    <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
    <link rel="shortcut icon" href="logo/favicon0.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="icons/css/all.css">
    <link rel="stylesheet" href="icons/css/all.min.css">
    <link rel="stylesheet" href="css/saznajViseDestinacija.css">
</head>
<body onload="UcitajStranu()">
    <!-- 300px - 900px JE SREDINA -->
    <!-- pocetak navigacije -->
    <?php
        @include "navbar.php";
        ?>
        <!-- kraj navigacije -->
    <!-- centriranje kontenta -->
    <div class="container text-center">
        <!-- pocetak maina -->
        <main>
           <div class="text">
                <h1><strong>Prag</strong></h1>
                <h2>Srednjovekovna bajka, čarobna arhitektura, bogata istorija, nezaboravna atmosfera.</h2>
                <hr>
                <p class="paragraf"><strong>Dobrodošli u bajkoviti Prag</strong> - grad koji oduzima dah svojom bogatom poviješću, spektakularnom arhitekturom i neponovljivom atmosferom. Ovaj evropski dragulj smješten na obalama rijeke Vltave mami posjetitelje svojim slikovitim krajolicima, romantičnim ulicama i legendarnim spomenicima.</p>
                <img src="SaznajVise/slike/prg1.jpg" alt="slika1" class="img-fluid">
                <p class="paragraf">Započnite svoje istraživanje srednjovjekovnom ljepotom Praškog dvorca, najveće drevne kraljevske rezidencije na svijetu, koja dominira panoramom grada. Prošećite preko Karlovog mosta, remek-djela barokne arhitekture, prepunog umjetničkih djela, uličnih svirača i trgovaca.</p>
                <hr>
                <p class="paragraf">Stari grad, sagrađen u 9. stoljeću, očarava svojim uskim ulicama popločanim kamenom, slikovitim trgovima i impozantnim crkvama. Posjetite Staromestski trg, srce Praga, gdje se nalazi legendarna Astronomska ura i crkva sv. Nikole.</p>
                
                <div class="row">
                    <!-- leva strana -->
                    <div class="col-md-6">
                        <img src="SaznajVise/slike/prg2.jpg" alt="slika1" class="img-fluid" >
                    </div>
                    
                    <!-- desna strana -->
                    <div class="col-md-6">
                        <img src="SaznajVise/slike/prg3.jpg" alt="slika1" class="img-fluid" id="desnaSlika">
                    </div>
                </div>
                <hr>
                <p class="paragraf">Nastavite svoje putovanje u četvrti poput Malá Strana, gdje ćete pronaći prekrasne barokne palače i skrivene vrtove, te Židovski kvart, domaćin bogate židovske povijesti i kulture.</p>
                <img src="SaznajVise/slike/prg4.jpg" alt="slika1" class="img-fluid">
                <hr>
                <p class="paragraf">Prag je također poznat po svojoj pivarskoj tradiciji, stoga ne propustite posjetiti neku od tradicionalnih pivnica i kušati autentična češka piva. Uživajte u bogatom kulturnom životu grada posjetom nekom od brojnih kazališta, koncerata ili opernih predstava.</p>
                <img src="SaznajVise/slike/prg5.jpg" alt="slika1" class="img-fluid">
                <hr>
                <p class="paragraf">Navečer, grad oživljava svojim šarenim noćnim životom, s brojnim barovima, klubovima i pivnicama koji nude raznoliku zabavu za sve ukuse.</p>
                <img src="SaznajVise/slike/prg6.jpg" alt="slika1" class="img-fluid">
                <hr>
                <p class="paragraf"><strong>Oduševite svoja osjetila u Pragu, gradu koji spaja povijest i modernost, romantiku i dinamičnu energiju, ostavljajući neizbrisiv dojam na svakog posjetitelja.</strong></p>
            </div>
        </main>
        <!-- kraj maina -->
        
    </div>
    <!-- kraj centriranje kontenta -->
    <!-- pocetak footera -->
    <?php
        @include "footer.php";
    ?>
    <!-- kraj footera -->
    
    
    <script src="js/index.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    
</body>
</html>