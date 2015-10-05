<?php

include "../incl/data.inc.php";

error_reporting(0);
ini_set("display_errors", 0);

$idskole = $_GET['id'];
$sqlQuery = "SELECT skole.* FROM skole WHERE skole.skola_id = $idskole";
$query = mysql_query($sqlQuery);
$row = mysql_fetch_assoc($query);

$breadcrumbs = array(
    array(
        'title' => 'Home',
        'active' => false,
        'link' => 'ucenici.php'
    ),
    array(
        'title' => 'Skole',
        'active' => false,
        'link' => 'skole_janko.php'
    ),
    array(
        'title' => 'Podaci o skoli',
        'active' => true,
        'link' => 'details_skole.php'
    ),
);

?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Podaci skole</title>
    <link rel="stylesheet" href="http://jpdesign.ba/sime_test/ucenici_janko/assets/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="assets/js/myScriptJanko.js"></script>
</head>

<body>

<div style="position: absolute; top: 0;left: 0;bottom: 0;right: 0;margin: auto;">
    <div class = "row">
        <div class = "col-md-3"></div>
        <div class = "col-md-6">

            <blockquote class="blockquote-reverse">
                Ministarstvo prosvete
            </blockquote>

            <? include("components_janko/breadcrumbs.php") ?>

            <table class = "table table-bordered" style="border-width: 2px ">
                <th colspan="2" class="text-center">PODACI O SKOLI</th>
                <tr>
                    <td>Naziv skole:</td>
                    <td><?=$row['skola_naziv']; ?></td>
                </tr>
                <tr>
                    <td>JIB skole:</td>
                    <td><?=$row['skola_jib']; ?></td>
                </tr>
                <tr>
                    <td>Adresa skole:</td>
                    <td><?=$row['skola_adresa']; ?></td>
                </tr>
                <tr>
                    <td>Broj telefona:</td>
                    <td><?=$row['skola_telefon'] ?></td>
                </tr>

            </table>
            <button type="button" class="btn btn-primary" id="btn-read-students" data-id="<?=$row['skola_id']; ?>">Ucitaj ucenike</button>

            <div class="row">
                <div class="col-md-12 col-md-offset-4" id="loading" style="display: none;"><img src="assets/img/loading_spinner.gif"></div>
            </div>
            <div id="students-table">

            </div>

            <hr>
            <footer>
                <p>&copy; <?php echo date('Y') ?> Vlada Republike Tunguzije</p>
            </footer>

        </div>
        <div class = "col-md-3"></div>

    </div>
</div>
</body>
</html>