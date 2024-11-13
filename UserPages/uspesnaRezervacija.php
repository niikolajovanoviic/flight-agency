<?php
@include "config.php";
session_start();

$idKorisnika=mysqli_real_escape_string($konekcija,$_SESSION['user_id']);
$idLeta=mysqli_real_escape_string($konekcija,$_SESSION['let_id']);

$select = "SELECT * FROM rezervacija WHERE idKorisnika = '$idKorisnika' && idLeta='$idLeta'";
if($rez = mysqli_query($konekcija,$select))
{
    if(mysqli_num_rows($rez)>0)
    {
        $row = mysqli_fetch_assoc($rez);
        
        $_SESSION['rezervacija_id'] = $row['idRezervacije'];
        
        
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uspešna rezervacija</title>
    <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
    <link rel="shortcut icon" href="logo/favicon0.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="icons/css/all.css">
    <link rel="stylesheet" href="icons/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/uspesnaRezervacija.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="container">
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-15">Id rezervacije: #<?php echo $_SESSION['idRezervacije']; ?> <span class="badge bg-success font-size-12 ms-2">Uspešno rezervisan</span></h4>
                        <div class="mb-4">
                           <h2 class="mb-1 text-muted">Letnadlanu.com</h2>
                        </div>
                        <div class="text-muted">
                            <p class="mb-1">Ljuba Vučkovića 17, 11010 Beograd, Srbija</p>
                            <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> jovanovicnn02@gmail.com</p>
                            <p><i class="uil uil-phone me-1"></i> +381 668080569</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Kupac:</h5>
                                <h5 class="font-size-15 mb-2"> <?php echo $_SESSION['user_name']; ?> <?php echo $_SESSION['user_lastName']; ?> </h5>
                                <p class="mb-1"><?php echo $_SESSION['user_email']; ?></p>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-6">
                            <div class="text-muted text-sm-end">
                                <div>
                                    <h5 class="font-size-15 mb-1">Id rezervacije:</h5>
                                    <p>#<?php echo $_SESSION['idRezervacije']; ?></p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Datum rezervacije:</h5>
                                    <p><?php echo date("d.m.Y"); ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    
                    <div class="py-2">
                        <h5 class="font-size-15">Vaša rezervacija</h5>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>Id leta</th>
                                        <th>Od</th>
                                        <th>Do</th>
                                        <?php
                                        if(isset($_SESSION['datumDolaska']))
                                        {
                                            ?>
                                                <th>Datum polaska</th>
                                                <th>Datum povratka</th>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <th>Datum polaska</th>
                                            <?php
                                        }
                                        ?>
                                        <th>Cena</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    <tr>
                                        <th><?php echo $_SESSION['idLeta']; ?></th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14 mb-1"><?php echo $_SESSION['pocetnaDestinacija_Drzava']; ?>, <?php echo $_SESSION['pocetnaDestinacija_Grad'];?></h5>
                                                <p class="text-muted mb-0">Aerodrom <?php echo $_SESSION['aerodromPocetni']; ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14 mb-1"><?php echo $_SESSION['krajnjaDestinacija_Drzava']; ?>, <?php echo $_SESSION['krajnjaDestinacija_Grad'];?></h5>
                                                <p class="text-muted mb-0">Aerodrom <?php echo $_SESSION['aerodromKrajnji']; ?></p>
                                            </div>
                                        </td>
                                        <?php
                                        if(isset($_SESSION['datumDolaska']))
                                        {
                                            ?>
                                                <td>
                                                    <?php 
                                                    $datumP = $_SESSION['datumPolaska']; 
                                                    $timestamp = strtotime($datumP);
                                                    $formDateP = date('d.m.Y',$timestamp);
                                                    echo $formDateP;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $datumP = $_SESSION['datumDolaska']; 
                                                    $timestamp = strtotime($datumP);
                                                    $formDateP = date('d.m.Y',$timestamp);
                                                    echo $formDateP; 
                                                    ?>
                                                </td>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <td>
                                                    <?php 
                                                    $datumP = $_SESSION['datumPolaska']; 
                                                    $timestamp = strtotime($datumP);
                                                    $formDateP = date('d.m.Y',$timestamp);
                                                    echo $formDateP;
                                                    ?>
                                                </td>
                                            <?php
                                        }
                                        ?>
                                        <td><?php echo $_SESSION['Cena']; ?>&euro;</td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">Ukupno:</th>
                                        <td class="border-0 text-end"><h4 class="m-0 fw-semibold"><?php echo $_SESSION['Cena']; ?>&euro;</h4></td>
                                    </tr>
                                    <!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
                        <div class="d-print-none mt-4">
                            <div class="float-end">
                                <a href="index.php" class="btn btn-primary w-md">Povratak na početnu strnicu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
</div>




<!-- <div class="ispisPodataka">
    <div class="nemaPodataka">
        <span id='np'>Uspešno ste rezervisali let!</span>
        <br>
        <span id='np'>Vaš id rezervacije je: <?php echo "$idRezervacije" ?>!</span>
    </div>
</div> -->


<script src="js/bootstrap/bootstrap.min.js"></script>
</body>
</html>