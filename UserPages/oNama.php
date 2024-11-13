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
    <title>Let na dlanu | O nama</title>
    <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
    <link rel="shortcut icon" href="logo/favicon0.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="icons/css/all.css">
    <link rel="stylesheet" href="icons/css/all.min.css">
    <link rel="stylesheet" href="css/oNama.css?v=<?php echo time(); ?>">
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
        <main>
            <div class="container text-center">
                <div class="row" id="navbarPadding">
                    <div class="col-md-6" id="levo_oNama">
                        <div class="naslov_oNama">
                            <h1>Dobrodošli u Let na dlanu.</h1>
                        </div>
                        <div class="podnaslov_oNama">
                           <p>Mi smo vaša pouzdana destinacija za pronalaženje najjeftinijih letova i putovanja u celom svetu!</p> 
                        </div>
                        <div class="tekst_oNama">
                            <p>Mi smo strastveni tim entuzijasta koji vjeruje da putovanja trebaju biti dostupna svima. Naša misija je jednostavna - omogućiti vam da istražite svijet po najpovoljnijim cijenama, bez obzira na vaš budžet.</p>
                            <hr>
                            <p>Kroz našu platformu, nudimo vam širok izbor jeftinih letova i putovanja, kako unutar zemlje tako i internacionalno. Bez obzira želite li istražiti europske metropole, pobjeći na tropske otoke ili otkriti skrivene dragulje destinacija, mi smo ovdje da vam pomognemo pronaći savršeno putovanje po vašoj mjeri.</p>
                            <hr>
                            <p>Uz Let na dlanu, vaše snove o putovanju postaju stvarnost. Istražite našu ponudu, pronađite najbolje ponude i krenite na svoje sljedeće putovanje s nama!</p>
                            <a href="index.php" class="link_oNama">Rezervišite Vaš let već danas!</a>
                        </div>
                    </div>
                    <div class="col-md-6" id="desno_oNama">
                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <video src="navbarPages/oNamaVid1.mp4" class="d-block w-100" autoplay muted loop ></video>
                              </div>
                              <div class="carousel-item">
                                <img src="navbarPages/oNamaPic3.jpg" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                <video src="navbarPages/oNamaVid2.mp4" class="d-block w-100" autoplay muted loop ></video>
                              </div>
                              <div class="carousel-item">
                                <img src="navbarPages/oNamaPic4.jpg" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                <video src="navbarPages/oNamaVid3.mp4" class="d-block w-100" autoplay muted loop ></video>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <!-- pocetak footera -->
    <?php
        @include "footer.php";
    ?>
    <!-- kraj footera -->
    
    <script src="js/index.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!-- video -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>