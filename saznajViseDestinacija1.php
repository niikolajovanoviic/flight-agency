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
    <title>Saznajte više | Barselona</title>
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
                <h1><strong>Barselona</strong></h1>
                <h2>Gaudijeva arhitektura, plaže, kulinarski raj, pulsirajući noćni život.</h2>
                <hr>
                <p class="paragraf"><strong>Dobrodošli u nevjerojatnu Barselonu</strong> - biser Sredozemlja koji pruža nezaboravno iskustvo spoja bogate povijesti, fascinantne arhitekture, ukusne kuhinje i bezvremenske ljepote plaža. Ova španjolska metropola oduševljava posjetitelje svojom jedinstvenom kombinacijom Gaudijeve arhitekture, sredozemnog šarma i dinamičnog urbano-kulturnog života.</p>
                <img src="SaznajVise/slike/bcn1.jpg" alt="slika1" class="img-fluid">
                <p class="paragraf">Barselona je domaćin prekrasnih plaža poput Barcelonete, gdje možete uživati u suncu, plivanju i vodenim sportovima. Ove plaže čine savršen kontrast užurbanom urbanom životu grada.</p>
                <hr>
                <p class="paragraf">Gaudiove remek-djela poput Sagrada Familia, Park Güell i Casa Batlló čine nevjerojatan vizualni spektakl, ostavljajući vas bez daha svojom jedinstvenošću i genijalnošću. Šetnje šarenim La Ramblom, centralnom avenijom grada, pružaju priliku za istraživanje tržnica, umjetničkih izložbi, te uličnih izvođača. Slikoviti kvartovi poput Barri Gòtic i El Born otkrivaju skrivene kutke srednjovjekovnih ulica i čarobne trgove. Odmorite se uz kavu na terasi i promatrajte lokalni ritam života.</p>
                
                <div class="row">
                    <!-- leva strana -->
                    <div class="col-md-6">
                        <img src="SaznajVise/slike/bcn2.jpg" alt="slika1" class="img-fluid" >
                    </div>
                    
                    <!-- desna strana -->
                    <div class="col-md-6">
                        <img src="SaznajVise/slike/bcn3.jpg" alt="slika1" class="img-fluid" id="desnaSlika">
                    </div>
                </div>
                <hr>
                <p class="paragraf">U kuhinji Barcelona miješaju se okusi Sredozemlja i katalonske tradicije. Uživajte u tapasima, paelli, ali i suvremenim gastronomskim delicijama koje nude brojni restorani i trgovine hrane.</p>
                <img src="SaznajVise/slike/bcn4.jpg" alt="slika1" class="img-fluid">
                <hr>
                <p class="paragraf">Navečer, grad oživljava pulsirajućim noćnim životom. Od elegantnih koktel-barova do tradicionalnih flamenco klubova, Barselona nudi bogat izbor zabave za svačiji ukus.</p>
                <img src="SaznajVise/slike/bcn6.jpg" alt="slika1" class="img-fluid">
                <hr>
                <p class="paragraf"><strong>Započnite svoje putovanje u ovaj jedinstveni grad i dopustite da vas zavede šarmom Barselone, mjestom gdje se povijest, umjetnost i živopisan način života stapaju u nezaboravno iskustvo.</strong></p>
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