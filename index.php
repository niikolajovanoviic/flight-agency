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

//top ponude
//top1
$pocetnaDestinacijaTop;
$krajnjaDestinacijaTop;
$datumPolaskaTop;
$cenaTop;

$selectTop = "SELECT * FROM let WHERE topPonuda='da'";
$rezultatTop = mysqli_query($konekcija,$selectTop);

if(mysqli_num_rows($rezultatTop)>0)
{
    $pocetnaDestinacijaTop = array();
    $krajnjaDestinacijaTop = array();
    $datumPolaskaTop = array();
    $cenaTop = array();

    while($row = mysqli_fetch_assoc($rezultatTop))
    {
        $pocetnaDestinacijaTop[] = $row["pocetnaDestinacija_Grad"];
        $krajnjaDestinacijaTop[] = $row["krajnjaDestinacija_Grad"];
        $datumPolaskaTop[] = $row["datumPolaska"];
        $cenaTop[] = $row["Cena"];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Let na dlanu | Početna</title>
    <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
    <link rel="shortcut icon" href="logo/favicon0.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="icons/css/all.css">
    <link rel="stylesheet" href="icons/css/all.min.css">
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
</head>
<body onload="UcitajStranu()">
    <!-- pocetak navigacije -->
        <?php
        @include "navbar.php";
        ?>
        <!-- kraj navigacije -->
    <!-- centriranje kontenta -->
    <div class="container text-center">
        <!-- pocetak maina -->
        <main>
            <section>
                <!-- jumbotron pocetak -->

                <div class="row" id="navbarPadding">
                    <!-- prvi -->
                    <div id="divCitat">
                        <div class="jumbotron1">
                            <div>
                                <figure>
                                    <blockquote class="blockquote" id="citat">
                                        <p></p>
                                    </blockquote>
                                    <figcaption class="blockquote-footer" id="autor">
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                <div class="row" id="navbarPadding2">
                    <!-- drugi -->
                        <div class="jumbotron2 flex-container">
                            <div class="levo flex-item">
                            <?php
                            if(isset($_SESSION['user_name']))
                            {
                                ?>
                                    <form action="jednosmerniLetovi.php" method="post">
                                        <input type="submit" value="Jednosmerni letovi" class="submitButton">
                                    </form>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <form action="loginPage.php" method="post">
                                        <input type="submit" value="Jednosmerni letovi" class="submitButton">
                                    </form>
                                <?php
                            }
                            ?>
                            </div>

                            <div class="desno flex-item">
                            <?php
                            if(isset($_SESSION['user_name']))
                            {
                                ?>
                                    <form action="povratniLetovi.php" method="post">
                                        <input type="submit" value="Letovi sa povratkom" class="submitButton">
                                    </form>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <form action="loginPage.php" method="post">
                                        <input type="submit" value="Letovi sa povratkom" class="submitButton">
                                    </form>
                                <?php
                            }
                            ?>
                                
                            </div>
                        </div>
                </div>

            </section>
            <!-- jumbotron kraj -->
            <hr>
            <!-- poruke za korisnika -->
            <section>
                <div class="card-group">
                    <div class="card">
                        <img src="porukeZaKorisnikaBaneri/slika1.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a href="https://tripadmit.com/" class="porukaLink">Ture i aktivnosti</a></h5>
                            <p class="card-text">Let na dlanu i TripAdmit ti donose neke od najatraktivnijih tura i niz aktivnosti koje će tvoje putovanje učiniti nezaboravnim. </p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="porukeZaKorisnikaBaneri/slika2.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a href="https://www.rentalcars.com/" class="porukaLink">Najam vozila</a></h5>
                            <p class="card-text">Najam vozila nikada nije bio jednostavniji i povoljniji uz našeg partnera Rentalcars.com. Pretraži, odaberi i rezerviši vozilo kod više od 900 agencija, na preko 60,000 lokacija širom sveta. </p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="porukeZaKorisnikaBaneri/slika3.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a href="https://www.booking.com/index.en-gb.html?label=gen173nr-1BCAEoggI46AdIM1gEaMEBiAEBmAEJuAEXyAEP2AEB6AEBiAIBqAIDuAKrmqetBsACAdICJDgzZDlhOGU3LTBhZDYtNDFkNC05YjVlLTUwM2VhNWZiMWZjYtgCBeACAQ&sid=783beeae20070c213c44675ac345c353&aid=304142" class="porukaLink">Smeštaj</a></h5>
                            <p class="card-text">Pronađi najbolji smeštaj za svoje naredno putovanje preko našeg partnera Booking.com</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- kraj poruke za korisnika -->
            <hr>
            <!-- carousel pocetak -->
            <div class="carousel">
                <h1 class="naslov">Istražite destinacije za vaše sledeće putovanje</h1>
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="9500">
                    <div class="carousel-inner">
                        <div class="carousel-item active" >
                            <video src="Carousel/barcelonaVid.mp4" class="d-block w-100" alt="destinacija1" autoplay muted loop ></video>
                            <div class="carousel-caption d-none d-md-block" id="carouselTekstPozadina">
                                <h4 class="carouselNaslov">Barselona</h4>
                                <h5 class="carouselOpis">Gaudijeva arhitektura, plaže, kulinarski raj, pulsirajući noćni život.</h5>
                                <a href="saznajViseDestinacija1.php" id="saznajvise">Saznajte više</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <video src="Carousel/londonVid.mp4" class="d-block w-100" alt="destinacija1" autoplay muted loop></video>
                            <div class="carousel-caption d-none d-md-block" id="carouselTekstPozadina">
                                <h4 class="carouselNaslov">London</h4>
                                <h5 class="carouselOpis">Ljubitelji kulture, modnih trendova, istorije i svetskih kuhinja, doživite neponovljivu raznolikost Londona!</h5>
                                <a href="saznajViseDestinacija2.php" id="saznajvise">Saznajte više</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <video src="Carousel/pragVid.mp4" class="d-block w-100" alt="destinacija1" autoplay muted loop></video>
                            <div class="carousel-caption d-none d-md-block" id="carouselTekstPozadina">
                                <h4 class="carouselNaslov">Prag</h4>
                                <h5 class="carouselOpis">Srednjovekovna bajka, čarobna arhitektura, bogata istorija, nezaboravna atmosfera.</h5>
                                <a href="saznajViseDestinacija3.php" id="saznajvise">Saznajte više</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- carousel kraj -->
            <hr>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
</body>
</html>