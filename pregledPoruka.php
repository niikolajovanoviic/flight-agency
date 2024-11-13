<?php

@include "config.php";
session_start();

@$idPoruke = $_POST["brisanjePoruke"];
if(isset($_POST["brisiPoruku"]))
{
    if(empty($idPoruke))
    {
        $error[]="Morate uneti id poruke za brisanje!";
    }
    else
    {
        @$idPorukeSQL = mysqli_real_escape_string($konekcija,$_POST["brisanjePoruke"]);

        $upitProvere = "SELECT * FROM pitanje WHERE idPitanja='$idPorukeSQL' ";
        $rezultatProvere = mysqli_query($konekcija,$upitProvere);
        if(mysqli_num_rows($rezultatProvere)>0)
        {
            $brisanje = "DELETE FROM pitanje WHERE idPitanja='$idPorukeSQL'";
            if(mysqli_query($konekcija,$brisanje))
            {
                $uspesno = "Uspešno brisanje";
            }
        }
        else
        {
            $error[] = "Ne postoji poruka sa Id: ".$idPoruke."";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Let na dlanu | IzmeniLet</title>
    <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'>
    <link rel="shortcut icon" href="logo/favicon0.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="icons/css/all.css">
    <link rel="stylesheet" href="icons/css/all.min.css">
    <link rel="stylesheet" href="css/pregledPoruka.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="ispisPodataka">
    <div class="forma">
        <form method="post">
            <div class="row mb-3">
                <label for="brisanjePoruke" class="col-sm-2 col-form-label" id="labelInput">Id: </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="brisanjePoruke">
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
            <input type="submit" value="Obriši poruku" id="formaSubmit" name="brisiPoruku">
            <a href="admin.php" id="linkPocetna">Povratak na početnu</a>
        </form>
    </div>
</div>
<?php
    $prikaziPoruke = "SELECT * FROM pitanje";

    $rezultat = mysqli_query($konekcija,$prikaziPoruke);
    if(mysqli_num_rows($rezultat)>0)
    {
        ?>
        <table>
            <tr>
                <th>Id poruke</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Broj telefona</th>
                <th>Email</th>
                <th>Poruka</th>
            </tr>
        
        <?php
        while($row = mysqli_fetch_assoc($rezultat))
        {
            ?>
            <tr>
                <td><?php echo $row["idPitanja"]?></td>
                <td><?php echo $row["ime"]?></td>
                <td><?php echo $row["prezime"]?></td>
                <td><?php echo $row["brTelefona"]?></td>
                <td><?php echo $row["email"]?></td>
                <td><?php echo $row["poruka"]?></td>
            </tr>
            <?php
        }
        ?></table><?php
    }
    else
    {
        ?>
        <div class="nemaPodataka">
            <span id='np'>Nemate poruku</span>
        </div>
        <?php
    }

    ?>



<script src="js/bootstrap/bootstrap.min.js"></script>
</body>
</html>