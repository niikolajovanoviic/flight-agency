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

@$idLeta=mysqli_real_escape_string($konekcija,$_SESSION['let_id']);

@$idKorisnika = mysqli_real_escape_string($konekcija,$_SESSION['user_id']);
@$idRezervacije = mysqli_real_escape_string($konekcija,$_SESSION['idRezervacije']);
@$pocetnaDestinacija_Drzava = mysqli_real_escape_string($konekcija,$_SESSION['pocetnaDestinacija_Drzava']);
@$pocetnaDestinacija_Grad = mysqli_real_escape_string($konekcija,$_SESSION['pocetnaDestinacija_Grad']);
@$aerodromPocetni = mysqli_real_escape_string($konekcija,$_SESSION['aerodromPocetni']);
@$aerodromKrajnji = mysqli_real_escape_string($konekcija,$_SESSION['aerodromKrajnji']);
@$datumPolaska = mysqli_real_escape_string($konekcija,$_SESSION['datumPolaska']);
@$datumDolaska = mysqli_real_escape_string($konekcija,$_SESSION['datumDolaska']);

if(isset($_POST["obrisiRez"]))
{
    $selectRez = "SELECT * FROM rezervacija WHERE idKorisnika = '$idKorisnika'";
                if($rez = mysqli_query($konekcija,$selectRez))
                {
                    if(mysqli_num_rows($rez)>0)
                    {
                        $row = mysqli_fetch_array($rez);
                        $idLeta = mysqli_real_escape_string($konekcija,$row['idLeta']);

                        //Oslobadjanje mesta
                        //@$idLetaSQL = mysqli_real_escape_string($konekcija,$_SESSION['let_id']);
                        $updateMestoLet = "UPDATE let SET brojSlobodnihMesta=brojSlobodnihMesta+1 WHERE idLeta = '$idLeta'";
                        mysqli_query($konekcija,$updateMestoLet);

                        $updateKorisnik = "UPDATE korisnik SET rezervisano=0, idRezervacije=null WHERE id='$idKorisnika'";
                        mysqli_query($konekcija,$updateKorisnik);

                    }
                }
                $deleteRez = "DELETE FROM rezervacija WHERE idLeta='$idLeta'";
                        if(mysqli_query($konekcija,$deleteRez))
                        {
                            unset($_SESSION['let_id']);
                            unset($_SESSION['idRezervacije']);
                            unset($_SESSION['pocetnaDestinacija_Drzava']);
                            unset($_SESSION['pocetnaDestinacija_Grad']);
                            unset($_SESSION['aerodromPocetni']);
                            unset($_SESSION['aerodromKrajnji']);
                            unset($_SESSION['datumPolaska']);
                            unset($_SESSION['datumDolaska']);
                            ?>
                            <script>
                                alert("Uspešno ste obrisali rezervaciju");
                            </script>
                            <?php
                        }
    
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Let na dlanu | Moja rezervacija</title>
    <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
    <link rel="shortcut icon" href="logo/favicon0.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="icons/css/all.css">
    <link rel="stylesheet" href="icons/css/all.min.css">
    <link rel="stylesheet" href="css/mojaRezervacija.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- pocetak navigacije -->
    <?php
    @include "navbar.php";
    ?>
    <!-- kraj navigacije -->
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <?php
                    $prikaziKorisnike = "SELECT * FROM korisnik k join rezervacija r on k.idRezervacije = r.idRezervacije join let l on l.idLeta = r.idLeta where k.id='$idKorisnika'";
                    
                    $rezultat = mysqli_query($konekcija,$prikaziKorisnike);
                    if(mysqli_num_rows($rezultat)>0)
                    {
                        ?>
                        <table>
                            <tr>
                                <th>Id rezervacije</th>
                                <th>Početna destinacija</th>
                                <th>Krajnja destinacija</th>
                                <th>Datum polaska</th>
                                <th>Datum povratka</th>
                            </tr>
                            
                            <?php
                            while($row = mysqli_fetch_assoc($rezultat))
                            {
                                ?>
                                <tbody>
                                    <tr>
                                        <th>#<?php echo $row['idRezervacije']; ?></th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14 mb-1"><?php echo $row['pocetnaDestinacija_Drzava']; ?>, <?php echo $row['pocetnaDestinacija_Grad'];?></h5>
                                                <p class="text-muted mb-0">Aerodrom <?php echo $row['aerodromPocetni']; ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14 mb-1"><?php echo $row['krajnjaDestinacija_Drzava']; ?>, <?php echo $row['krajnjaDestinacija_Grad'];?></h5>
                                                <p class="text-muted mb-0">Aerodrom <?php echo $row['aerodromKrajnji']; ?></p>
                                            </div>
                                        </td>
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
                                    </tr>
                                </tbody>
                                <?php
                            }
                            ?>
                            </table>
            </div>
                </div>
                    </div>
                        </div>
                            <div class="obrisiRez">
                                <form method="post">
                                    <input type="submit" value="Otkaži rezervaciju" id="submitObrisiRez" name="obrisiRez">
                                </form>
                            </div>
                            
                            <?php
                        }
                        else
                        {
                            ?>
                            <div class="nemaPodataka">
                                <span id='np'>Nemate rezervaciju</span>
                            </div>
                            <?php
                        }
                        
                        ?>
                     </div>
                </div>
                    </div>
                        </div>
        <!-- pocetak footera -->
        <?php
        @include "footer.php";
        ?>
        <!-- kraj footera -->
        <script src="js/bootstrap/bootstrap.min.js"></script>
    </body>
    </html>