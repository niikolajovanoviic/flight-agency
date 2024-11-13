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
</head>
<body>
<footer>
        <div class="footer">
            <div class="container text-center">
                <div class="row">
                    <div class="col" id="footerLevo">
                        <h1 class="footerNaslov">Let na dlanu.</h1>
                        <div class="footerLinkovi">
                            <form method="post">
                                <?php
                                    if(isset($_SESSION['user_name']))
                                    {
                                        echo "<h1 class='fLink'><input type='submit' class='fLink' value='Odjavi se' style='border: none; background-color:#164863' name='odjaviSe'></input></h1>";
                                    }
                                    else
                                    {
                                        echo "<h1 class='fLink'><input type='submit' class='fLink' value='Prijavi se' style='border: none; background-color:#164863' name='prijaviSe'></input></h1>";
                                    }
                                    ?>
                                <h1 class="fLink">
                                <?php
                                    if(isset($_SESSION['user_name']))
                                    {
                                        echo "<a href='mojaRezervacije.php' class='fLink' id='footLink'>Moja rezervacija</a>";
                                    }
                                    else
                                    {
                                        echo "<a href='loginPage.php' class='fLink' id='footLink'>Moja rezervacija</a>";
                                    }
                                    ?>
                    
                                    
                                </h1>
                                <h1 class="fLink"><a href="oNama.php" class="fLink" id="footLink">O nama</a></h1>
                                <h1 class="fLink"><a href="kontakt.php" class="fLink" id="footLink">Kontakt</a></h1>
                            </form>
                        </div>
                        <div class="oKompaniji">
                            <h5 class="naslovKompanija">O kompaniji:</h5>
                            <p class="opisKompanija">Let na dlanu je agencija za letove posvećena pružanju udobnih, sigurnih i avanturističkih putovanja. Sa stručnim timom i pažljivim pristupom, osiguravamo nezaboravna iskustva za sve vrste putnika.</p>
                        </div>
                    </div>
                    <div class="col" id="footerDesno">
                        <div class="kontakt">
                            <p class="tekstKontakt" id="kontaktTelefon"><i class="fa-solid fa-phone" style="color: #e34b89;"></i> +381 668080569</p>
                            <p class="tekstKontakt" id="kontaktMail"><i class="fa-solid fa-envelope" style="color: #e34b89;"></i> jovanovicnn02@gmail.com</p>
                            <p class="tekstKontakt"><i class="fa-solid fa-location-dot" style="color: #e34b89;"></i> Ljuba Vučkovića 17, 11010 Beograd, Srbija</p>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2832.549824825968!2d20.47961887660074!3d44.76959497951461!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a70f9a1b7ada9%3A0x2fb918c6fb947942!2sLjuba%20Vu%C4%8Dkovic%CC%81a%2017%2C%20Beograd!5e0!3m2!1sen!2srs!4v1705631449361!5m2!1sen!2srs" width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="mapa"></iframe>
                        </div>
                        <div class="mreze">
                            <a href="https://www.instagram.com/jovanovic6e/"><i class="fa-brands fa-instagram" style="color: #e34b89;" id="ikonice"></i></a>
                            <a href=""><i class="fa-brands fa-facebook" style="color: #e34b89;" id="ikonice"></i></a>
                            <a href=""><i class="fa-brands fa-linkedin" style="color: #e34b89;" id="ikonice"></i></a>
                            <a href=""><i class="fa-brands fa-youtube" style="color: #e34b89;" id="ikonice"></i></a>
                            <a href=""><i class="fa-brands fa-square-x-twitter" style="color: #e34b89;" id="ikonice"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>