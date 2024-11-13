<?php

@include "config.php";

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container justify-content-center" id="nav">
        <a class="navbar-brand" href="index.php">
            <img src="logo/logoLogReg_bluered.png" alt="Bootstrap" width="90" height="60" id="navbarLogo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item" id="ulogujSe">
                    <?php
                    if(isset($_SESSION['user_name']))
                    {
                        echo "<a class='nav-link' href='#'><h5 class='NavTextIme'>Zdravo ".$_SESSION['user_name']."!</h5></a>";
                    }
                    else
                    {
                        echo "<a class='nav-link' href='loginPage.php'><h5 class='NavTextUloguj'>Prijavi se</h5></a>";
                    }
                    ?>
                </li>
                <li class="nav-item" id="mojaRezervacija">
                <?php
                    if(isset($_SESSION['user_name']))
                    {
                        echo "<a class='nav-link' href='mojaRezervacije.php'><h5 class='NavText' id='navMojaRez'>Moja rezervacija</h5></a>";
                    }
                    else
                    {
                        echo "<a class='nav-link' href='loginPage.php'><h5 class='NavText' id='navMojaRez'>Moja rezervacija</h5></a>";
                    }
                    ?>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="oNama.php"><h5 class="NavText" id="navOnama">O nama</h5></a>
                </li>
                <li class="nav-item" id="kontakt">
                    <a class="nav-link" href="kontakt.php"><h5 class="NavText" id="navKontakt">Kontakt</h5></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

</body>
</html>