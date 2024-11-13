<?php

$konekcija = mysqli_connect("localhost","root","","letnadlanu");

if($konekcija->connect_error)
{
    die("Connection error");
}

?>