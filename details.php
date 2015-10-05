<?php
//vcs added
include "../incl/data.inc.php";

error_reporting(0);
ini_set("display_errors", 0);

$iducenika = $_GET['id'];
$sqlQuery = "SELECT ucenici.*,skole.skola_naziv FROM ucenici,skole WHERE ucenici.ucenik_id = $iducenika AND ucenici.skola_id = skole.skola_id";
$query = mysql_query($sqlQuery);
$row = mysql_fetch_assoc($query);

?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Podaci ucenika</title>
</head>

<body>
<div>

    <h3>PODACI UCENIKA</h3>
    <p>Ime ucenika:<?=$row['ucenik_ime']; ?></p>
    <p>Prezime ucenika:<?=$row['ucenik_prezime']; ?></p>
    <p>Godine ucenika:<?=$row['ucenik_godine']; ?></p>
    <p>Skola: <?=$row['skola_naziv'] ?></p>

</div>
</body>
</html>
