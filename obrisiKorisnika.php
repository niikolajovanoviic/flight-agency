<?php

@include "config.php";
session_start();

@$idKorisnika = $_POST["brisanjeKorisnika"];
if(isset($_POST["brisiKorisnika"]))
{
    if(empty($idKorisnika))
    {
        $error[]="Morate uneti id korisnika za brisanje!";
    }
    else
    {
        $idKorisnikaSQL = mysqli_real_escape_string($konekcija,$_POST["brisanjeKorisnika"]);

        $upitProvere = "SELECT * FROM korisnik WHERE id='$idKorisnikaSQL' ";
        if($rezultatProvere = mysqli_query($konekcija,$upitProvere))
        {
            if(mysqli_num_rows($rezultatProvere)>0)
            {
                $selectRez = "SELECT * FROM rezervacija WHERE idKorisnika = '$idKorisnikaSQL'";
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
                    }
                }

                $brisanje = "DELETE FROM korisnik WHERE id='$idKorisnikaSQL'";
                if(mysqli_query($konekcija,$brisanje))
                {
                    $uspesno = "Uspešno brisanje";
                }

                //brisanje rezervacije ako postoji
                $brisanjeRezervacije = "DELETE FROM rezervacija WHERE idKorisnika = '$idKorisnikaSQL'";
                mysqli_query($konekcija,$brisanjeRezervacije);

            }
            else
            {
                $error[] = "Ne postoji korisnik sa Id: ".$idKorisnika."";
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
    <title>Let na dlanu | BrisanjeKorisnika</title>
    <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
    <link rel="shortcut icon" href="logo/favicon0.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="icons/css/all.css">
    <link rel="stylesheet" href="icons/css/all.min.css">
    <link rel="stylesheet" href="css/obrisiKorisnika.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="ispisPodataka">
    <div class="forma">
        <form method="post">
            <div class="row mb-3">
                <h1 class="formaNaslov">Brisanje korisnika</h1>
                
                <label for="brisanjeKorisnika" class="col-sm-2 col-form-label" id="labelInput">Id: </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="brisanjeKorisnika">
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
            <input type="submit" value="Obriši korisnika" id="formaSubmit" name="brisiKorisnika">
            <a href="admin.php" id="linkPocetna">Povratak na početnu</a>
        </form>
    </div>
</div>
<?php
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

    ?>



<script src="js/bootstrap/bootstrap.min.js"></script>
</body>
</html>