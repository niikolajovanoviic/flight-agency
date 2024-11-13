<?php
@include "config.php";
session_start();
@$email = "admin@admin.com";
@$ime = $_POST["ime"];
@$prezime = $_POST["prezime"];
@$sifra = $_POST["sifra"];

$regex_sifra = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$/";

if(isset($_POST["dodajAdmina1"]))
{
    if(empty($ime) || empty($prezime) || empty($sifra))
    {
        $error[] = "Morate popuniti sva polja!";
    }
    else
    {
        if(!(preg_match($regex_sifra,$sifra)))
        {
            $error[] = "Šifra mora imati:<br>- Min. 8; Max. 16 karatkera.<br>- Bar jedno veliko i malo slovo.<br>- Bar jedna broj.";
        }
        else
        {
            $emailSQL = mysqli_real_escape_string($konekcija,$email);
            $imeSQL = mysqli_real_escape_string($konekcija,$_POST["ime"]);
            $prezimeSQL = mysqli_real_escape_string($konekcija,$_POST["prezime"]);
            $sifraSQL = md5($_POST["sifra"]);

            $upitProvere = "SELECT * FROM korisnik WHERE sifra = '$sifraSQL'";
            $rezultatProvere = mysqli_query($konekcija,$upitProvere);
            if(mysqli_num_rows($rezultatProvere)>0)
            {
                $error[] = "Već postoji admin sa tom šifrom!";
            }
            else
            {
                $insert = "INSERT INTO korisnik (ime,prezime,email,sifra) VALUES('$imeSQL','$prezimeSQL','$emailSQL','$sifraSQL')";
                if(mysqli_query($konekcija,$insert))
                {
                    $_SESSION['noviAdmin'] = "Uspešno ste dodali novog admina!";
                    header("location:admin.php");
                }
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | DodajAdmina</title>
    <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
    <link rel="shortcut icon" href="logo/favicon0.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="icons/css/all.css">
    <link rel="stylesheet" href="icons/css/all.min.css">
    <link rel="stylesheet" href="css/dodajAdmina.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="ispisPodataka">
    <div class="forma">
        <form method="post">
            <div class="row mb-3">
                
                <label for="email" class="col-sm-2 col-form-label" id="labelInput">Email:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" value="admin@admin.com" id="adminInput" disabled>
                </div>
                
                <label for="ime" class="col-sm-2 col-form-label" id="labelInput">Ime:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="ime">
                </div>

                <label for="prezime" class="col-sm-2 col-form-label" id="labelInput">Prezime:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="prezime">
                </div>

                <label for="sifra" class="col-sm-2 col-form-label" id="labelInput">Sifra:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="sifra" id="sifra">
                </div>
            </div>
            <!-- ovde ide poruka za prazan unos -->
            <?php

            if(isset($error))
            {
                foreach($error as $error)
                {
                    echo"<span class='greskaPrazno'>".$error."</span>";
                }
                
            }

            ?>
            <input type="submit" value="Dodaj admina" id="formaSubmit" name="dodajAdmina1">
            <a href="admin.php" id="linkPocetna">Povratak na početnu</a>
        </form>
    </div>
</div>



    <script src="js/dodajAdmina.js"></script>        
    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>
</html>