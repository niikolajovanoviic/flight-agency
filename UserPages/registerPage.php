<?php

@include "config.php";

session_start();

@$imeProvera = $_POST["ime"];
@$prezimeProvera = $_POST["prezime"];
@$emailProvera = $_POST["email"];
@$sifraProvera = $_POST["sifra"];

$regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$regex_sifra = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$/";

if(isset($_POST["registrujSe"]))
{
    if(empty($imeProvera)||empty($prezimeProvera)||empty($emailProvera)||empty($sifraProvera))
    {
        $error[] = "Morate popuniti sva polja za unos!";   
    }
    else
    {
        if(!(preg_match($regex_email,$emailProvera)) || !(preg_match($regex_sifra,$sifraProvera)))
        {
            if(!(preg_match($regex_email,$emailProvera)))
            {
                $errorEmail = "Neispravna e-mail adresa!";
            }
            else
            {
                $errorEmail = "";
            }
            if(!(preg_match($regex_sifra,$sifraProvera)))
            {
                $errorSifra = "Šifra mora imati:<br>- Min. 8; Max. 16 karatkera.<br>- Bar jedno veliko i malo slovo.<br>- Bar jedna broj.";
            }
            else
            {
                $errorSifra = "";
            }
        }
        else
        {
            $ime = mysqli_real_escape_string($konekcija,$_POST["ime"]);
            $prezime = mysqli_real_escape_string($konekcija,$_POST["prezime"]);
            $email = mysqli_real_escape_string($konekcija,$_POST["email"]);
            $sifra =md5($_POST["sifra"]);

            $upitProvere = "SELECT * FROM korisnik WHERE email='$email'";
            $rezultatProvere = mysqli_query($konekcija,$upitProvere);

            if(mysqli_num_rows($rezultatProvere)>0)
            {
                $error[] = "Korisnik je već registrovan!";
            }
            else
            {
                // $uspesnaReg = "Uspešno ste se registrovali!";
                $insert = "INSERT INTO korisnik (ime,prezime,email,sifra) VALUES('$ime','$prezime','$email','$sifra')";
                if(mysqli_query($konekcija,$insert))
                {
                    $_SESSION['uspesnaReg'] = "Uspešno ste se registrovali!";
                    header("location:loginPage.php");
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
    <title>Let na dlanu | Registracija</title>
    <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
    <link rel="shortcut icon" href="logo/favicon0.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="icons/css/all.css">
    <link rel="stylesheet" href="icons/css/all.min.css">
    <link rel="stylesheet" href="css/registerPage.css?v=<?php echo time(); ?>"> 
    <!-- echo time potreban za rad css-a u php kodu -->
    
</head>
<body onload="Reset()">
    <main>
        <!-- center -->
        <div class="position-absolute top-50 start-50 translate-middle"> 
            <!-- loginbox -->
            <div class="card mb-3" style="max-width: 18rem;" id="loginbox">
                <form class="card-body" method="post" action="">
                    
                    <!-- logo -->
                    <a href="index.php"><img src="logo/logoLogReg_bluered.png" class="rounded mx-auto d-block" style="width: 225px; height: 150px;"></a>
                     <!-- ime -->
                     <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user" style="color: #164863;"></i></span>
                        <input type="text" class="form-control" placeholder="Ime" aria-describedby="basic-addon1" id="ime" name="ime">
                    </div>
                    <!-- prikaz greske usled unosa imena -->
                    <p id="greskaIme"></p>

                     <!-- prezime -->
                     <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user" style="color: #164863;"></i></span>
                        <input type="text" class="form-control" placeholder="Prezime" aria-describedby="basic-addon1" id="prezime" name="prezime">
                    </div>
                    <!-- prikaz greske usled unosa prezimena -->
                    <p id="greskaPrezime"></p>

                    <!-- email -->
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-envelope" style="color: #164863;"></i></span>
                        <input type="text" class="form-control" placeholder="E-mail adresa" aria-describedby="basic-addon1" id="email" name="email">
                    </div>
                    <!-- prikaz greske usled unosa email-a -->
                    <?php
                    
                    if(isset($errorEmail))
                    {
                        echo"<p id='greskaEmail'>".$errorEmail."</p>";
                    }

                    ?>                
                    
                    <!-- password -->
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock" style="color: #164863;"></i></span>
                        <input type="password" class="form-control" placeholder="Šifra" aria-describedby="basic-addon1" id="sifra" maxlength="16" name="sifra">
                        <span class="input-group-text" id="passwordEye" onclick="PrikaziPassword()"><i id="oko" class="fa-regular fa-eye fa-lg" style="color: #164863;"></i></span>
                    </div>
                    
                    <!-- prikaz greske usled unosa sifre -->
                    <?php
                    
                    if(isset($errorSifra))
                    {
                        echo"<p id='greskaSifra'>".$errorSifra."</p>";
                    }

                    ?>                    

                    <!-- prikaz greske usled praznog unosa -->
                    <?php
                    
                    if(isset($error))
                    {
                        foreach($error as $error)
                        {
                            echo"<span class='greskaPrazno'>".$error."</span>";
                        } 
                    }

                    ?>
                    
                    <!-- napravi nalog -->
                    <div>
                        <p id="napraviNalog">Već imate nalog? <a href="loginPage.php" id="link">Prijavi se!</a></p>
                    </div>
                    
                    <!-- button registruj se -->
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <input type="submit" class="btn btn-outline-light" id="button" name="registrujSe" value="Registruj se"></input>
                    </div>   
                    
                </form>  
            </div>
            <!-- kraj loginboxa -->
        </div>
        <!-- center kraj -->

    </main>
    <script src="js/register.js"></script>
</body>
</html>