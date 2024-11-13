<?php
@include "config.php";
session_start();

@$od = $_POST["od"];
@$do = $_POST["do"];
@$datumPolazak = $_POST["datumPolazak"];
@$datumPovratak = $_POST["datumPovratak"];

@$idKorisnika = $_SESSION['user_id'];

if(isset($_POST["pretraziLet"]))
{
    if(empty($od) || empty($do) || empty($datumPolazak) || empty($datumPovratak))
    {
        $error[] = "Morate popuniti sva polja!";
    }
}

@$odSQL = mysqli_real_escape_string($konekcija,$_POST["od"]);
@$doSQL = mysqli_real_escape_string($konekcija,$_POST["do"]);
@$datumPolazakSQL = mysqli_real_escape_string($konekcija,$_POST["datumPolazak"]);
@$datumPovratakSQL = mysqli_real_escape_string($konekcija,$_POST["datumPovratak"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Let na dlanu | Rezervisi</title>
    <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
    <link rel="shortcut icon" href="logo/favicon0.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="icons/css/all.css">
    <link rel="stylesheet" href="icons/css/all.min.css">
    <link rel="stylesheet" href="css/povratniLetovi.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="ispisPodataka">
    <div class="forma">
        <form method="post">
            <div class="row mb-3">
                <h1 class="formaNaslov">Rezerviši</h1>
                <label for="od" class="col-sm-2 col-form-label" id="labelInput">Od:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="od" placeholder="Unesite grad" list="od_jedanSmer">
                    <datalist id="od_jedanSmer">
                    <?php
                    $select_OdJedanSmer = "SELECT DISTINCT pocetnaDestinacija_Grad FROM let WHERE datumPolaska!=datumDolaska and datumDolaska is not null and datumDolaska!='1970-01-01'";
                    if($rez = mysqli_query($konekcija,$select_OdJedanSmer))
                    {
                        if(mysqli_num_rows($rez)>0)
                        {
                            while($row = mysqli_fetch_assoc($rez))
                            {
                                ?>
                                <option value="<?php echo $row['pocetnaDestinacija_Grad']; ?>">
                                <?php
                            }
                        }
                    }
                    ?>
                    </datalist>
                </div>

                <label for="do" class="col-sm-2 col-form-label" id="labelInput">Do:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="do" placeholder="Unesite grad" list="do_JedanSmer">
                    <datalist id="do_JedanSmer">
                    <?php
                    $select_DoJedanSmer = "SELECT DISTINCT krajnjaDestinacija_Grad FROM let WHERE datumPolaska!=datumDolaska and datumDolaska is not null and datumDolaska!='1970-01-01'";
                    if($rez = mysqli_query($konekcija,$select_DoJedanSmer))
                    {
                        if(mysqli_num_rows($rez)>0)
                        {
                            while($row = mysqli_fetch_assoc($rez))
                            {
                                ?>
                                <option value="<?php echo $row['krajnjaDestinacija_Grad']; ?>">
                                <?php
                            }
                        }
                    }
                    ?>
                    </datalist>
                </div>
                <hr>
                <div class="row mb-3">
                <h1 class="formaNaslov">Period</h1>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Od:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="datumPolazak" min="<?php echo date("Y-m-d"); ?>">
                </div>
                
                <label for="pocetnaDrzava" class="col-sm-2 col-form-label" id="labelInput">Do:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="datumPovratak" min="<?php echo date("Y-m-d", strtotime('tomorrow')); ?>">
                </div>
            </div>
            </div>
            <?php
            if(isset($error))
            {
                foreach($error as $error)
                {
                    echo"<span class='greskaPrazno'>".$error."</span>";
                }
                
            }

            ?>
            <input type="submit" value="Pretraži" id="formaSubmit" name="pretraziLet">
            <a href="index.php" id="linkPocetna">Povratak na početnu</a>
        </form>
    </div>
</div>
<?php
    if(isset($_POST["pretraziLet"]) && !(empty($od) || empty($do) || empty($datumPolazak) || empty($datumPovratak)))
    {
            $prikaziKorisnike = "SELECT * FROM let WHERE pocetnaDestinacija_Grad='$odSQL' && 
            krajnjaDestinacija_Grad='$doSQL' && datumPolaska='$datumPolazakSQL' && datumDolaska='$datumPovratakSQL'";

            $rezultat = mysqli_query($konekcija,$prikaziKorisnike);
            if(mysqli_num_rows($rezultat)>0)
            {
                ?>
                <table>
                    <tr>
                        <th>Id leta</th>
                        <th>Početna destinacija</th>
                        <th>Krajnja destinacija</th>
                        <th>Datum polaska</th>
                        <th>Datum povratka</th>
                        <th>Cena</th>
                        <th>Broj slobodnih mesta</th>
                    </tr>
                
                <?php
                while($row = mysqli_fetch_assoc($rezultat))
                {
                    $idLeta = $row["idLeta"];
                    $_SESSION['let_id'] = $row["idLeta"];
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
                            $datumP = $row["datumDolaska"];
                            $timestamp = strtotime($datumP);
                            $formDateP = date('d.m.Y',$timestamp);
                            echo $formDateP;
                            ?>
                        </td>
                        <td><?php echo $row["Cena"]?> &euro;</td>
                        <td><?php echo $row["brojSlobodnihMesta"]?></td>
                    </tr>
                    <?php
                }
                ?></table><?php
            }
            else
            {
                ?>
                <div class="nemaPodataka">
                    <span id='np'>Nema rezultata</span>
                </div>
                <?php
            }
        }
    

    ?>
<div class="ispisPodataka">
    <div class="forma">
        <form method="post">
            <div class="row mb-3">
            <label for="datum" class="col-sm-2 col-form-label" id="labelInput">Id:</label>
                <div class="col-sm-10">
                    <?php
                    if(isset($idLeta))
                    {
                        ?>
                        <input type="number" class="form-control" name="datum" placeholder="Id leta za rezervaciju" value="<?php echo $_SESSION['let_id']?>" disabled>
                        <input type="submit" value="Rezerviši" id="formaSubmit" name="rezervisiLet" class="buttonRez">
                        <?php
                    }
                    else
                    {
                        ?>
                        <input type="number" class="form-control" name="datum" placeholder="Id leta za rezervaciju" disabled>
                        <input type="submit" value="Rezerviši" id="formaSubmitdis" name="rezervisiLet" class="buttonRez" disabled>
                        <?php
                    }
                    ?>
                    
                </div>
        </form>
    </div>
</div>
<?php
if(isset($_POST["rezervisiLet"]))
{
    @$idKorisnika = mysqli_real_escape_string($konekcija,$_SESSION['user_id']);
    @$idLetaSQL = mysqli_real_escape_string($konekcija,$_SESSION['let_id']);

    $selectProvera = "SELECT * FROM korisnik WHERE id='$idKorisnika' && rezervisano>0";
    if($rezProvere=mysqli_query($konekcija,$selectProvera))
    {
        if(mysqli_num_rows($rezProvere)>0)
        {
            ?>
                <script>
                    alert("Već imate rezervaciju!")
                </script>
            <?php
        }
        else
        {
            $insertRezervacija = "INSERT INTO rezervacija (idLeta, idKorisnika ) VALUES ('$idLetaSQL', '$idKorisnika')";
            if(mysqli_query($konekcija,$insertRezervacija))
            {
                $selectrez = "SELECT * FROM rezervacija WHERE idKorisnika='$idKorisnika' && idLeta='$idLetaSQL' ";
                if($rezultat = mysqli_query($konekcija,$selectrez))
                {
                    if(mysqli_num_rows($rezultat)>0)
                    {
                        $row = mysqli_fetch_array($rezultat);
                        $idRezervacije = mysqli_real_escape_string($konekcija,$row['idRezervacije']);
                        $_SESSION['idRezervacije'] = $row['idRezervacije'];

                        $updateKorisnik = "UPDATE korisnik SET rezervisano=1, idRezervacije='$idRezervacije' where id='$idKorisnika'";
                        if(mysqli_query($konekcija,$updateKorisnik))
                        {
                            $updateLet = "UPDATE let SET brojSlobodnihMesta=brojSlobodnihMesta-1 WHERE idLeta='$idLetaSQL'";
                            if(mysqli_query($konekcija,$updateLet))
                            {
                                echo "<script type='text/javascript'>window.top.location='uspesnaRezervacija.php';</script>";
                            }
                        }

                        $selectlet = "SELECT * FROM let WHERE idLeta='$idLetaSQL'";
                        if($rezlet = mysqli_query($konekcija,$selectlet))
                        {
                            if(mysqli_num_rows($rezlet)>0)
                            {
                                $row = mysqli_fetch_array($rezlet);
                                $_SESSION['idLeta'] = $row['idLeta'];
                                $_SESSION['pocetnaDestinacija_Drzava'] = $row['pocetnaDestinacija_Drzava'];
                                $_SESSION['pocetnaDestinacija_Grad'] = $row['pocetnaDestinacija_Grad'];
                                $_SESSION['krajnjaDestinacija_Drzava'] = $row['krajnjaDestinacija_Drzava'];
                                $_SESSION['krajnjaDestinacija_Grad'] = $row['krajnjaDestinacija_Grad'];
                                $_SESSION['aerodromPocetni'] = $row['aerodromPocetni'];
                                $_SESSION['aerodromKrajnji'] = $row['aerodromKrajnji'];
                                $_SESSION['datumPolaska'] = $row['datumPolaska'];
                                $_SESSION['datumDolaska'] = $row['datumDolaska'];
                                $_SESSION['Cena'] = $row['Cena'];
                            }
                        }

                    }
                }

                
            }
        }
    }
}
?>
<script src="js/bootstrap/bootstrap.min.js"></script>
</body>
</html>