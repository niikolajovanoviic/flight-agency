<?php

@include "config.php";
session_start();

@$idLeta = $_POST["brisanjeLeta"];
if(isset($_POST["brisiLet"]))
{
    if(empty($idLeta))
    {
        $error[]="Morate uneti id leta za brisanje!";
    }
    else
    {
        @$idLetaSQL = mysqli_real_escape_string($konekcija,$_POST["brisanjeLeta"]);
        
        $upitProvere = "SELECT * FROM let WHERE idLeta='$idLetaSQL' ";
        $rezultatProvere = mysqli_query($konekcija,$upitProvere);
        if(mysqli_num_rows($rezultatProvere)>0)
        {
            $selectRez = "SELECT * FROM let WHERE idLeta = '$idLetaSQL'";
            if($rez = mysqli_query($konekcija,$selectRez))
            {
                if(mysqli_num_rows($rez)>0)
                {
                    $row = mysqli_fetch_array($rez);
                    $idLeta = mysqli_real_escape_string($konekcija,$row['idLeta']);
                    
                    $select_r_idRez = "SELECT * FROM rezervacija WHERE idLeta = '$idLeta'";
                    $rez_r_idRez = mysqli_query($konekcija,$select_r_idRez);
                    if($rez_r_idRez)
                    {
                        if(mysqli_num_rows($rez_r_idRez)>0)
                        {
                            $row = mysqli_fetch_array($rez_r_idRez);
                            $idRezervacije = mysqli_real_escape_string($konekcija,$row['idRezervacije']);

                            $updateKorisnik = "UPDATE korisnik SET idRezervacije=null, rezervisano=0 WHERE idRezervacije='$idRezervacije'";
                            mysqli_query($konekcija,$updateKorisnik);

                            //brisanje rezervacije ako postoji
                            $brisanjeRezervacije = "DELETE FROM rezervacija WHERE idLeta = '$idLeta'";  
                            mysqli_query($konekcija,$brisanjeRezervacije);
                        }
                    }

                   
                }
            }
            
            
            $brisanje = "DELETE FROM let WHERE idLeta='$idLetaSQL'";
            if(mysqli_query($konekcija,$brisanje))
            {
                $uspesno = "Uspešno brisanje";
            }
        }
        else
        {
            $error[] = "Ne postoji let sa Id: ".$idLeta."";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Let na dlanu | BrisanjeLeta</title>
<link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
<link rel="shortcut icon" href="logo/favicon0.png" type="image/x-icon">
<link rel="stylesheet" href="css/bootstrap/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="icons/css/all.css">
<link rel="stylesheet" href="icons/css/all.min.css">
<link rel="stylesheet" href="css/obrisiLet.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="ispisPodataka">
<div class="forma">
<form method="post">
<div class="row mb-3">
<h1 class="formaNaslov">Brisanje leta</h1>

<label for="brisanjeLeta" class="col-sm-2 col-form-label" id="labelInput">Id: </label>
<div class="col-sm-10">
<input type="number" class="form-control" name="brisanjeLeta">
</div>
</div>
<?php
if(isset($uspesno))
{
    echo"<span class='uspesno'>".$uspesno."</span>";
}
if(isset($error))
{
    foreach($error as $error)
    {
        echo"<span class='greskaPrazno'>".$error."</span>";
    }
    
}

?>
<input type="submit" value="Obriši let" id="formaSubmit" name="brisiLet">
<a href="admin.php" id="linkPocetna">Povratak na početnu</a>
</form>
</div>
</div>
<?php
$prikaziKorisnike = "SELECT * FROM let";

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

?>



<script src="js/bootstrap/bootstrap.min.js"></script>
</body>
</html>