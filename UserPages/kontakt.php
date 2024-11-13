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


if(isset($_POST["posaljiPoruku"]))
{
    $ime = mysqli_real_escape_string($konekcija,$_POST["ime"]); 
    $prezime = mysqli_real_escape_string($konekcija,$_POST["prezime"]); 
    $brTelefona = mysqli_real_escape_string($konekcija,$_POST["brTelefona"]); 
    $email = mysqli_real_escape_string($konekcija,$_POST["email"]); 
    $poruka = mysqli_real_escape_string($konekcija,$_POST["poruka"]); 

    $insert = "INSERT INTO pitanje (ime,prezime,brTelefona,email,poruka) VALUES ('$ime', '$prezime', '$brTelefona', '$email', '$poruka')";
    
    if(mysqli_query($konekcija,$insert))
    {
        echo "<script>
                alert ('Uspešno ste poslali poruku!');
            </script>";
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Let na dlanu | Kontakt</title>
    <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
    <link rel="shortcut icon" href="logo/favicon0.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="icons/css/all.css">
    <link rel="stylesheet" href="icons/css/all.min.css">
    <link rel="stylesheet" href="css/kontakt.css?v=<?php echo time(); ?>">
</head>
<body onload="UcitajStranu()">
    <!-- pocetak navigacije -->
    <?php
    @include "navbar.php";
    ?>
    <!-- kraj navigacije -->
    <!-- centriranje kontenta -->
    <div class="container text-center">
        <main>
            <div class="naslov">
                <h1>Kontaktirajte nas</h1>
            </div>
            <div class="container text-center">
                <div class="row" id="navbarPadding">
                    <div class="col-md-6" id="levo_oNama">
                        <div class="naslovLevo">
                            <h1>Da li želite nešto da nas pitate?</h1>
                        </div>
                        <form method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="formKontakt" placeholder="Unesite vaše ime" aria-label="Username" aria-describedby="basic-addon1" id="kontaktIme" name="ime" required>
                            </div>
                            
                            
                            <div class="input-group mb-3">
                            
                                <input type="text" class="formKontakt" placeholder="Unesite vaše prezime" aria-label="Username" aria-describedby="basic-addon1" id="kontaktPrezime" name="prezime" required>
                            </div>
                            
                            
                            <div class="input-group mb-3">
                            
                                <input type="text" class="formKontakt" placeholder="Unesite vaš broj telefona" aria-label="Username" aria-describedby="basic-addon1" id="kontaktBrojTelefona" name="brTelefona" required>
                            </div>
                            
                            
                            <div class="input-group mb-3">
                                
                                <input type="email" class="formKontakt" placeholder="Unesite vašu email adresu" aria-label="Username" aria-describedby="basic-addon1" id="kontaktEmail" name="email" required>
                            </div>
                            
                            
                            <div class="input-group">
                            <p>Vaša poruka:</p>
                                <textarea class="formKontakt" aria-label="With textarea" id="tekstPoruke" name="poruka" required></textarea>
                            </div>
                            
                            <p id="greskaPrazno"></p>
                            
                            <div class="d-grid gap-2 col-6 mx-auto" id="buttonDiv">
                                <input type="submit" id="button" value="Pošalji poruku" name="posaljiPoruku">
                            </div> 
                        </form>
                    </div>
                    <div class="col-md-6" id="desno_oNama">
                        <div class="naslovDesno">
                            <h1>Kontakt informacije</h1>
                        </div>
                        <div class="kontaktDesno">
                            <p class="tekstKontaktDesno">Broj telefona: +381 668080569</p>
                            <p class="tekstKontaktDesno">Email adresa: jovanovicnn02@gmail.com</p>
                            <p class="tekstKontaktDesno">Adresa: Ljuba Vučkovića 17, 11010 Beograd, Srbija</p>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2832.549824825968!2d20.47961887660074!3d44.76959497951461!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a70f9a1b7ada9%3A0x2fb918c6fb947942!2sLjuba%20Vu%C4%8Dkovic%CC%81a%2017%2C%20Beograd!5e0!3m2!1sen!2srs!4v1705631449361!5m2!1sen!2srs" width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="mapa"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <!-- pocetak footera -->
   <!-- pocetak footera -->
   <?php
        @include "footer.php";
    ?>
    <!-- kraj footera -->
    
    <script src="js/kontakt.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
</body>
</html>