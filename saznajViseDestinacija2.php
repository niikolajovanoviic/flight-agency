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
    <title>Saznajte više | London</title>
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
                <h1><strong>London</strong></h1>
                <h2>Ljubitelji kulture, modnih trendova, istorije i svetskih kuhinja, doživite neponovljivu raznolikost Londona!</h2>
                <hr>
                <p class="paragraf"><strong>Dobrodošli u London</strong> - grad kontrasta, gdje povijest susreće modernost, a kulturna raznolikost prožima svaki kutak. Ova globalna metropola prepuna je atrakcija koje će oduševiti svakog putnika.</p>
                <img src="SaznajVise/slike/lnd1.jpg" alt="slika1" class="img-fluid">
                <p class="paragraf">Big Ben, ikonični simbol Londona, predstavlja ne samo impresivnu arhitekturu već i bogatu povijest i kulturu grada. Ovaj legendarni satni toranj, smješten u srcu britanske prijestolnice, impresionira svojom visinom i elegancijom te oduševljava posjetitelje diljem svijeta svojim monumentalnim zvukom koji odzvanja gradskim krajolicima. Big Ben nije samo sat, već i simbol vremena, tradicije i trajne ljepote koja obilježava London kao jedno od najuzbudljivijih odredišta na svijetu.</p>
                <hr>
                <p class="paragraf">Započnite svoje istraživanje ikoničnim simbolima poput Buckinghamske palače, Trafalgar Squarea i Kule mosta. Ovaj grad obiluje povijesnim spomenicima, poput Westminsterske opatije i Tower of London, koji svjedoče o bogatoj prošlosti Velike Britanije.</p>
                <img src="SaznajVise/slike/lnd2.jpg" alt="slika1" class="img-fluid">
                <div class="row">
                    <!-- leva strana -->
                    <div class="col-md-6">
                        <img src="SaznajVise/slike/lnd3.jpg" alt="slika1" class="img-fluid" >
                    </div>
                    
                    <!-- desna strana -->
                    <div class="col-md-6">
                        <img src="SaznajVise/slike/lnd4.jpg" alt="slika1" class="img-fluid" id="desnaSlika">
                    </div>
                </div>
                <hr>
                <p class="paragraf">Londonski muzeji, poput Britanskog muzeja i Nacionalne galerije, čuvaju blago svjetske umjetnosti i kulture.</p>
                <img src="SaznajVise/slike/lnd5.jpg" alt="slika1" class="img-fluid">
                <p class="paragraf">Prošetajte kroz zelene površine Hyde Parka ili Regent's Parka kako biste se osvježili u mirnom okruženju.</p>
                <img src="SaznajVise/slike/lnd6.jpg" alt="slika1" class="img-fluid">
                <hr>
                <p class="paragraf">London noću oživljava svojim nevjerojatnim kazalištima na West Endu, pulsirajućim klubovima i tradicionalnim pubovima. Posjetite svjetlucavi West End kako biste doživjeli svjetski poznate predstave ili se zaputite do jednog od brojnih noćnih klubova.</p>
                <img src="SaznajVise/slike/lnd7.jpg" alt="slika1" class="img-fluid">
                <hr>
                <p class="paragraf">Gradski pejzaž rijeke Temze, s modernim neboderima poput The Sharda i The Gherkina, dodaje futuristički dodir tradicionalnom londonskom šarmu. Ova raznolikost čini London neodoljivom destinacijom za sve vrste putnika.</p>
                <img src="SaznajVise/slike/lnd8.jpg" alt="slika1" class="img-fluid">
                <hr>
                <p class="paragraf"><strong>Dopustite da vas London očara svojom energijom, elegantnim parkovima, umjetničkom scenom i jedinstvenom kombinacijom starog i novog.</strong></p>
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