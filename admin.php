<?php

@include "config.php";
session_start();
if(isset($_POST["odjaviSe"]))
{
    session_unset();
    session_destroy();
    header("location:loginPage.php");
}

// automatsko brisanje leta na osnovu datuma
$trenutniDatum = date("Y-m-d");

$selectIdLetaTrenutniDatum = "SELECT * FROM let WHERE datumPolaska='$trenutniDatum'";
$rezIdLetaTrenutniDatum = mysqli_query($konekcija,$selectIdLetaTrenutniDatum);
if($rezIdLetaTrenutniDatum)
{
    if(mysqli_num_rows($rezIdLetaTrenutniDatum)>0)
    {
        while($row = mysqli_fetch_assoc($rezIdLetaTrenutniDatum))
        {
            $selectIdRez = "SELECT * FROM rezervacija";
            if($rez_selectIdRez = mysqli_query($konekcija,$selectIdRez))
            {
                if(mysqli_num_rows($rez_selectIdRez)>0)
                {
                    $idRezervacije = mysqli_real_escape_string($konekcija,$row['idRezervacije']);

                    // $updateKor = "UPDATE korisnik SET rezervisano=0, idRezervacije=null, WHERE idRezervacije = '$idRezervacije'";
                    // mysqli_query($konekcija,$updateKor);
                }
            }
            $idLeta = mysqli_real_escape_string($konekcija,$row['idLeta']);
            $brisanjeRezervacijeTrenutniDatum = "DELETE FROM rezervacija WHERE idLeta='$idLeta'";
            mysqli_query($konekcija,$brisanjeRezervacijeTrenutniDatum);    
        }
    }
}


$brisanjeDatuma = "DELETE FROM let WHERE datumPolaska<='$trenutniDatum' ";
mysqli_query($konekcija,$brisanjeDatuma);


//broji korisnike
$brojKorisnikaUpit = "SELECT * FROM korisnik";
$brojKorisnika = mysqli_query($konekcija,$brojKorisnikaUpit);
mysqli_num_rows($brojKorisnika);
$bKorisnika = mysqli_num_rows($brojKorisnika);

//broji letove
$brojLetovaUpit = "SELECT * FROM let";
$brojLetova = mysqli_query($konekcija,$brojLetovaUpit);
mysqli_num_rows($brojLetova);
$bLetova = mysqli_num_rows($brojLetova);


//racunaj profit
$profit = 0;
$profitUpit = "SELECT * FROM let";
$rez = mysqli_query($konekcija,$profitUpit);

if(mysqli_num_rows($rez)>0)
{
    while($row = mysqli_fetch_assoc($rez))
    {
        $profit += ($row["brojMesta"]-$row["brojSlobodnihMesta"]) * $row["Cena"];
    }
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Let na dlanu | Admin panel</title>
<link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
<link rel="shortcut icon" href="logo/favicon0.png" type="image/x-icon">
<link rel="stylesheet" href="css/bootstrap/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="icons/css/all.css">
<link rel="stylesheet" href="icons/css/all.min.css">
<link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
</head>
<body>
<?php
//provera da li je admin ulogovan
if(isset($_SESSION['admin_name']))
{
    ?>
    <!-- sidenav -->
    <div id="myNav" class="overlay">
    
    <!-- Button to close the overlay navigation -->
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    
    <!-- Overlay content -->
    <div class="overlay-content">
    <form action="dodajLet.php" method="post">
    <input type="submit" value="Dodaj novi let" class="buttonMenu" name="dodajLet">
    </form>
    <form action="izmeniLet.php">
    <input type="submit" value="Izmeni let" class="buttonMenu" name="izmeniLet">
    </form>
    <form action="obrisiLet.php">
    <input type="submit" value="Obriši let" class="buttonMenu" name="obrisiLet">
    </form>
    <form action="obrisiKorisnika.php">
    <input type="submit" value="Obriši korisnika" class="buttonMenu" name="obrisiKorisnika">
    </form>
    <form action="dodajAdmina.php" method="post">
    <input type="submit" value="Dodaj admina" class="buttonMenu" name="dodajAdmina">
    </form>
    
    <form action="pregledPoruka.php" method="post">
    <input type="submit" value="Pregled poruka" class="buttonMenu" name="pregledPoruka">
    </form>
    
    <form method="post">
    <input type="submit" value="Odjavi se" id="buttonOdjaviSe" name="odjaviSe">
    </form>
    </div>
    
    </div>
    <!-- sidenav kraj -->
    
    
    <!-- navigacia -->
    <div class="topnav">
    <a href="#" onclick="openNav()">Upravljanje podacima</a>
    <?php
    echo "<a class='split'>".$_SESSION['admin_name']." ".$_SESSION['admin_lastname']."</a>";
    if($_SESSION['admin_name']=='Nikola' && $_SESSION['admin_lastname']=='Jovanovic')
    {
        ?>
        <a class="split"> <img src="AdminProfilePic/profilna1.jpg" id="profilna"></a>
        <?php
    }
    else
    {
        ?>
        <a class="split"> <img src="AdminProfilePic/profilnaUni.png" id="profilna"></a>
        <?php
    }
    ?>
    
    </div>
    <!-- navigacia kraj -->
    
    <main>
    <div class="container text-center">
    <div class="row">
    <div class="col-sm" id="korisnici">
    <h1 class="naslov">Broj korisnika</h1>
    <i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i>
    <h1 class="prikazVrednost" id="prikazV">0</h1>
    <input type="text" value="<?php echo $bKorisnika; ?>" class="pravaVrednost" id="pVrednost">
    <div class="submit">
    <form method="post">
    <input type="submit" value="Prikaži sve korisnike" class="submitButton1" name="prikaziSveKorisnike">
    </form>
    </div>
    </div>
    <div class="col-sm" id="letovi">
    <h1 class="naslov">Broj letova </h1>
    <i class="fa-solid fa-plane-up fa-2xl" style="color: #ffffff;"></i>
    <h1 class="prikazVrednost" id="prikazV1">0</h1>
    <input type="text" value="<?php echo $bLetova; ?>" class="pravaVrednost" id="pVrednost1">
    <div class="submit">
    <form method="post">
    <input type="submit" value="Prikaži sve letove" class="submitButton2" name="prikaziSveLetove">
    </form>
    </div>
    </div>
    <div class="col-sm" id="profit">
    <h1 class="naslov">Profit</h1>
    <i class="fa-solid fa-money-bill fa-2xl" style="color: #ffffff;"></i>
    <div class="spoji">
    <h1 class="prikazVrednost" id="prikazV2">0</h1>
    <h1 class="prikazVrednost">&euro;</h1>
    <input type="text" value="<?php echo $profit; ?>" class="pravaVrednost" id="pVrednost2">
    </div>
    <div class="submit">
    <form method="post">
    <input type="submit" value="Prikaži letove sa najviše rezervacija" class="submitButton3" name="prikaziProfit">
    </form>
    </div>
    </div>
    </div>
    </div>   
    <!-- ispis podataka iz baze u zavisnosti koje dugme je kliknuto -->
    <div class="ispisPodataka">
    <?php
    
    // uspesno ubacen novi admin
    if(isset($_SESSION['noviAdmin']))
    {
        echo"<span class='uspesnoUbacen'>".$_SESSION['noviAdmin']."</span>";
        unset($_SESSION['noviAdmin']);
    }
    
    // uspesno ubacen let
    if(isset($_SESSION['uspesnoUbacen']))
    {
        echo"<span class='uspesnoUbacen'>".$_SESSION['uspesnoUbacen']."</span>";
        unset($_SESSION['uspesnoUbacen']);
    }
    
    //korisnici
    if(isset($_POST["prikaziSveKorisnike"]))
    {
        
        $prikaziKorisnike = "SELECT * FROM korisnik ORDER BY CASE WHEN email='admin@admin.com' THEN 0 ELSE 1 END, email";
        
        $rezultat = mysqli_query($konekcija,$prikaziKorisnike);
        if(mysqli_num_rows($rezultat)>0)
        {
            ?>
            <table>
            <tr>
            <th>Id</th>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Email</th>
            <th>Id rezervacije</th>
            </tr>
            
            <?php
            while($row = mysqli_fetch_assoc($rezultat))
            {
                ?>
                <tr>
                <?php
                if($row["email"]=="admin@admin.com")
                {
                    ?>
                    <td>x</td>
                    <td><?php echo $row["ime"]?></td>
                    <td><?php echo $row["prezime"]?></td>
                    <td>
                    <span class="admin">ADMIN</span>
                    </td>
                    <td>/</td>
                    <?php
                }
                else
                {
                    ?>
                    <td><?php echo $row["id"]?></td>
                    <td><?php echo $row["ime"]?></td>
                    <td><?php echo $row["prezime"]?></td>
                    <td><?php echo $row["email"]?></td>
                    <td>
                    <?php   
                    if($row["rezervisano"]<=0 || $row["rezervisano"]==null || $row["rezervisano"]=="")
                    {
                        echo "Nema rezervaciju";
                    }
                    else
                    {
                        echo $row['idRezervacije'];
                    }
                    ?>
                    </td>
                    <?php
                }
                ?>
                </tr>
                <?php
            }
            ?></table><?php
        }
        else
        {
            ?>
            <div class="nemaPodataka">
            <span id='np'>Nema podataka u bazi!</span>
            </div>
            <?php
        }
        
        
    }  
        //Letovi
        if(isset($_POST["prikaziSveLetove"]))
        {
            $prikaziLet = "SELECT * FROM let";
            
            $rezultat = mysqli_query($konekcija,$prikaziLet);
            if(mysqli_num_rows($rezultat)>0)
            {
                ?>
                <table>
                <tr>
                <th>Id leta</th>
                <th>Pocetna destinacija</th>
                <th>Krajnja destinacija</th>
                <th>Datum polaska</th>
                <th>Datum povratka</th>
                <th>Cena</th>
                <th>Broj slobodnih mesta</th>
                <th>Top ponuda</th>
                </tr>
                
                <?php
                while($row = mysqli_fetch_assoc($rezultat))
                {
                    ?>
                    <tr>
                    <td><?php echo $row["idLeta"]?></td>
                    <td><?php echo $row["pocetnaDestinacija_Drzava"]?>, <?php echo $row["pocetnaDestinacija_Grad"]?></td>
                    <td><?php echo $row["krajnjaDestinacija_Drzava"]?>, <?php echo $row["krajnjaDestinacija_Grad"]?></td>
                    <td>
                    <?php 
                        $datumP = $row["datumPolaska"];
                        $timestamp = strtotime($datumP);
                        $formDateP = date('d.m.Y',$timestamp);
                        echo $formDateP;
                    ?>
                    </td>
                    <td>
                    <?php
                    if($row["datumDolaska"]==null || $row["datumPolaska"]==$row["datumDolaska"] || $row["datumDolaska"]=="1970-01-01")
                    {
                        echo "/";
                    }
                    else
                    {
                        $datumP = $row["datumDolaska"];
                        $timestamp = strtotime($datumP);
                        $formDateP = date('d.m.Y',$timestamp);
                        echo $formDateP;
                    }
                    ?>
                    </td>
                    <td><?php echo $row["Cena"]?> &euro;</td>
                    <td><?php echo $row["brojSlobodnihMesta"]?></td>
                    <td>
                    <?php
                    if($row["topPonuda"]=="ne" || $row["topPonuda"]==null)
                    {
                        echo "Ne";
                    }
                    else if($row["topPonuda"]=="da")
                    {
                        echo "Da";
                    }
                    else
                    {
                        echo "Nedefinisano";
                    }
                    ?>
                    </td>
                    </tr>
                    <br>
                    <?php
                }
                ?></table><?php
            }
            else
            {
                ?>
                <div class="nemaPodataka">
                <span id='np'>Nema podataka u bazi!</span>
                </div>
                <?php
            }
        }
    
    //Letovi sa najvecom popunjenmosti
    if(isset($_POST["prikaziProfit"]))
    {
        
        $prikaziKorisnike = "SELECT * FROM let ORDER BY ((brojMesta-brojSlobodnihMesta)/brojMesta) *100 DESC";
        
        $rezultat = mysqli_query($konekcija,$prikaziKorisnike);
        if(mysqli_num_rows($rezultat)>0)
        {
            ?>
            <table>
            <tr>
            <th>Id leta</th>
            <th>Pocetna destinacija</th>
            <th>Krajnja destinacija</th>
            <th>Datum polaska</th>
            <th>Datum povratka</th>
            <th>Cena</th>
            <th>Procenat popunjenosti</th>
            <th>Top ponuda</th>
            </tr>
            
            <?php
            while($row = mysqli_fetch_assoc($rezultat))
            {
                
                ?>
                <tr>
                <td><?php echo $row["idLeta"]?></td>
                <td><?php echo $row["pocetnaDestinacija_Drzava"]?>, <?php echo $row["pocetnaDestinacija_Grad"]?></td>
                <td><?php echo $row["krajnjaDestinacija_Drzava"]?>, <?php echo $row["krajnjaDestinacija_Grad"]?></td>
                <td>
                    <?php 
                    $datumP = $row["datumPolaska"];
                    $timestamp = strtotime($datumP);
                    $formDateP = date('d.m.Y',$timestamp);
                    echo $formDateP;
                    ?>
                </td>
                <td>
                <?php
                if($row["datumDolaska"]==null || $row["datumPolaska"]==$row["datumDolaska"] || $row["datumDolaska"]=="1970-01-01")
                {
                    echo "/";
                }
                else
                {
                    $datumP = $row["datumDolaska"];
                    $timestamp = strtotime($datumP);
                    $formDateP = date('d.m.Y',$timestamp);
                    echo $formDateP;
                }
                ?>
                </td>
                <td><?php echo $row["Cena"]?> &euro;</td>
                <td>
                <?php
                
                @$procenat;
                $procenat = (($row["brojMesta"]-$row["brojSlobodnihMesta"])/$row["brojMesta"])*100;
                echo round($procenat,2)."%";
                ?>
                </td>
                <td>
                <?php
                if($row["topPonuda"]=="ne" || $row["topPonuda"]==null)
                {
                    echo "Ne";
                }
                else
                {
                    echo "Da";
                }
                ?>
                </td>
                </tr>
                <br>
                <?php
            }
            ?></table><?php
        }
        else
        {
            ?>
            <div class="nemaPodataka">
            <span id='np'>Nema podataka u bazi!</span>
            </div>
            <?php
        }
    }
    ?>
    </div>    
    </main>
    <?php
}
else
{
    ?>
    <div class="nijeUlogovan">
    <span id='adminNijeUlogovan'>Morate biti ulogovani kao admin da bi pristupili Admin panel-u ! <br> <a href="loginPage.php" id="linkNijeUlogovan">Vrati se na login</a></span>
    </div>
    <?php
}
?>
<script src='https://code.jquery.com/jquery-1.8.2.js'></script>
<script src="js/admin.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
</body>
</html>