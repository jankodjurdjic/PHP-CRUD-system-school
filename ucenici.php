<?php
include "../incl/data.inc.php"; //ukljucujemo fajl data.inc.php, koji ce nam javiti greske pri povezivanju sa bazom ili odredjenom tabelom
include_once("libraries/bootstrap_pagination/pagination.php");
include_once("libraries/AlertObject.php");

error_reporting(1);   //iskljucujemo prijavu svih gresaka
ini_set("display_errors", 1); /*funkcija ini_set postavlja vrijednosti konfiguracionih opcija; ovde se opcija
 display_errors postavlja na nula, gdje string display_errors odredjuje da li ce potencijalne greske biti pri-
 kazane korisniku; difoultna vrijednost je 1, ako se postavi na 0 pretpostavljam da se greske NECE prikazati  */

//set initial state for alert
$alert = new AlertObject();

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(isset($_POST['modal_new']) && $_POST['modal_new'] == 'new_student')
    {
        $selektovanje = "SELECT MAX(ucenici.ucenik_id) AS max_id FROM ucenici";
        $sel = mysql_query($selektovanje);
        $row = mysql_fetch_assoc($sel);
        $noviid = $row['max_id'] + 1;

        $novaskola = $_POST["schools"];
        $novoime = $_POST["name"];
        $novoprezime = $_POST["surname"];
        $novegodine = $_POST["years"];
        $upit = "INSERT INTO ucenici (ucenik_id,skola_id,ucenik_ime,ucenik_prezime,ucenik_godine) VALUES ('$noviid','$novaskola','$novoime','$novoprezime','$novegodine')";
        mysql_query($upit);

        $inserted = mysql_affected_rows();


        if($inserted > 0)
            $alert->setSuccessAlert('Uspjesno ste unjeli novog ucenika!');
        else
            $alert->setErrorAlert('Doslo je do greske prilikom unosa ucenika!');
    }

    if(isset($_POST['modal_edit']) && $_POST['modal_edit'] == 'edit_student')
    {
        $editime = $_POST["name"];
        $editprezime = $_POST["surname"];
        $editgodine = $_POST["years"];
        $editskola = $_POST["schools"];
        $id = $_POST["student-id"];

        $editovano = "UPDATE ucenici SET ucenik_ime = '$editime',ucenik_prezime = '$editprezime',ucenik_godine = '$editgodine',skola_id = '$editskola' WHERE ucenik_id = $id";
        mysql_query($editovano);

        $edited = mysql_affected_rows();

        if($edited > 0)
            $alert->setSuccessAlert('Uspjesno ste editovali ucenika!');
        else
            $alert->setErrorAlert('Doslo je do greske prilikom editovanja ucenika!');
    }

    if(isset($_POST['modal_delete']) && $_POST['modal_delete'] == 'delete_student')
    {
        $iddelete = $_POST["student_id"];

        $brisanje = "DELETE FROM ucenici WHERE ucenik_id = $iddelete";
        mysql_query($brisanje);

        $deleted = mysql_affected_rows();

        if($deleted > 0)
            $alert->setSuccessAlert('Ucenik je uspjesno obrisan');
        else
            $alert->setErrorAlert('Doslo je do greske prilikom brisanja ucenika!');
    }
}

$and_clause = '';
$default_url = 'ucenici.php';
$pagination_url = 'ucenici.php?p=[p]';
$search_term = '';
if($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if(isset($_GET['search']))
    {
        $and_clause = " AND (ucenici.ucenik_ime LIKE '%".$_GET['search']."%' OR ucenici.ucenik_prezime LIKE '%" . $_GET['search'] . "%')";

        $default_url = 'ucenici.php?search='.$_GET['search'];
        $pagination_url = 'ucenici.php?search='.$_GET['search'].'&p=[p]';
        $search_term = $_GET['search'];
    }
}

$pageSize = 10;

if(isset($_GET['p']))
    $pageNumber = $_GET['p'];
else
    $pageNumber = 1;

$limitPage = ((int)$pageNumber - 1) * $pageSize;

$limit_clause = " LIMIT ". $limitPage .",".$pageSize;

$sqlQuery = "SELECT ucenici.*,skole.skola_naziv FROM ucenici, skole WHERE ucenici.skola_id = skole.skola_id";

$sqlQuery .= $and_clause . $limit_clause;

/*ovde iz baze selektujemo sve kolone iz tabele ucenici i nazive skola iz tabele skole, pri cemu ih uparujemo
prema kljucu skola_id, ako se ne varam sa strane jedne tabele to je primarni kljuc, sa strane druge tabele to
je strani kljuc; ove podatke  pridruzujemo varijabli $sqlQuery */

$sqlQueryTotal = "SELECT ucenici.*,skole.skola_naziv FROM ucenici, skole WHERE ucenici.skola_id = skole.skola_id";
$sqlQueryTotal .= $and_clause;
$totalRecords = mysql_num_rows(mysql_query($sqlQueryTotal));


//$students = mysql_fetch_assoc(mysql_query($sqlQuery));
$query = mysql_query($sqlQuery);   //ovde saljemo upit bazi da povucemo prethodno selektovane podatke
while($row = mysql_fetch_assoc($query)) {
    $students [] = $row;
}
/*ova funkcija mysql_fetch_assoc cita red po red iz upita i kreira asocijativni niz nazivi_kolona-vrijednosti
_polja; pri svakom narednom pozivanju funkcije vrsi se inkrementiranje, sto znaci da u prvom pozivu cita prvi
red, u drugom pozivanju drugi itd; nakon pokupljanih svih redova iz upita, ova funkcija vraca FALSE sto ce ovde
znaciti i izlaz iz while petlje kada se procitaju svi ucenici_janko/njihove skole; ako se ne varam u ovoj petlji svaki
od procitanih redova se smjesta u niz $students[] */


$pg = new bootPagination();
$pg->pagenumber = $pageNumber;
$pg->pagesize = $pageSize;
$pg->totalrecords = $totalRecords;
$pg->showfirst = true;
$pg->showlast = true;
$pg->paginationcss = "pagination-large";
$pg->paginationstyle = 1; // 1: advance, 0: normal
$pg->defaultUrl = $default_url;
$pg->paginationUrl = $pagination_url;

//get all skole for modal
$sqlSkole = 'SELECT * FROM skole';
$query = mysql_query($sqlSkole);   //ovde saljemo upit bazi da povucemo prethodno selektovane podatke
while($row = mysql_fetch_assoc($query)) {
    $schools [] = $row;
}


//set active menu item
$active_menu_item = 'ucenici';

//set breadcrumb
$breadcrumbs = array(
    array(
        'title' => 'Home',
        'active' => true,
        'link' => 'ucenici.php'
    ),
);
?>

<!DOCTYPE html>
<html>
<head>

    <title>Ucenici</title>    <!--naslov stranice koji se prikazuje u brouzeru-->
    <!-- link rel="stylesheet" href="http://followapp.walter-dev.com/powerpoint/addons/css/bootstrap.min.css"-->
    <link rel="stylesheet" href="http://jpdesign.ba/sime_test/ucenici_janko/assets/css/bootstrap.css">
    <!--ovde ukljucujemo css fajl bootstrap koji formatira/stilizuje kompletnu stranicu-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="assets/js/myScriptJanko.js"></script>
</head>
<!--u tijelu html fajla preko atributa class koji su definisani u bootstrap.css fajlu fomratirana je ova stranica;
kreirana je tabela na nacin da je prvo kreiran red headinga tabele, gdje se koriste <th> tagovi (od table header);
potom se uz pomoc foreach petlje prolazi prethodno kreirani niz $students i u svakom prolazu petlje kreira se novi
red tabele(za razliku od headinga tabele, ovde se za redove koriste <td> tagovi); u svakomo redu ce se nalaziti ime,
prezime i godine ucenika, te naziv skole iz tabele skole; na kraju reda su ubacene tri linkovane slicice koje za sada
ne vode nigdje kada se klikne na njih-->
<body>

<? include("modals_janko/modal_new_student.php"); ?>

<? include("modals_janko/modal_edit_student.php"); ?>

<? include("modals_janko/modal_delete_student.php"); ?>

<div style="position: absolute; top: 0;left: 0;bottom: 0;right: 0;margin: auto;">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <!--ovde smo fajl organizovali uz pomoc ovih predefinisanih klasa iz bootstrapa; fajl u kom nam je tabela
          smo fakticki organizovali kao red (row), a uz pomoc col-md klasa smo taj red izdjelili u kolone; u sredini
          je kolona sirene 66,6% i u ovom polju nam je tabela, sa strana su kolone sirine definisane klasom col-md-2
          koje zauzimaju 16,6% povrsine dokumenta-->

            <blockquote class="blockquote-reverse">
               Simanic company
            </blockquote>

            <? include("components_janko/main_menu.php"); ?>

            <? include("components_janko/breadcrumbs.php") ?>

            <? include("components_janko/alert.php"); ?>

            <button type="button" class="btn btn-primary" data-toggle="modal" href="#myModal">Novi ucenik</button>

            <h2>Spisak ucenika</h2>



            <table class="table table-bordered">
                <tr>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Godine</th>
                    <th>Naziv skole</th>
                    <th>Opcije</th>
                </tr>
                <? foreach($students as $student) : ?>
                    <tr>
                        <td><?=$student['ucenik_ime'] ?></td>
                        <td><?=$student['ucenik_prezime'] ?></td>
                        <td><?=$student['ucenik_godine'] ?></td>
                        <td><?=$student['skola_naziv'] ?></td>
                        <td><a href="http://jpdesign.ba/sime_test/ucenici_janko/details.php?id=<?=$student['ucenik_id']?>"><img src="assets/img/details.png"></a>&nbsp<a href="" class="btn-edit-student" data-id="<?=$student['ucenik_id'] ?>" data-name="<?=$student['ucenik_ime'] ?>" data-surname="<?=$student['ucenik_prezime'] ?>" data-years="<?=$student['ucenik_godine'] ?>" data-school="<?=$student['skola_id'] ?>"><img src="assets/img/edit.png"></a>&nbsp<a href="" class="btn-delete-student" data-id="<?=$student['ucenik_id'] ?>"><img src="assets/img/delete.png"></a></td>
                    </tr>
                <? endforeach; ?>
            </table>

            <!-- ATTENTION ON NEXT COMMENT LINE SIMANIC!!!! -->
            <!-- this is one kind of showing modal, i will explain you another with jquery later -->
            <!--a data-toggle="modal" href="#myModal">Novi ucenik</a-->

            <div class="row">
                <div class="col-md-8"><? echo  $pg->process(); ?></div>
                <div class="col-md-4">
                    <div class="pagination pagination-large pull-right">
                        <ul class="list-group">
                            <li class="list-group-item active">
                                Ukupno:
                                <span class="badge">&nbsp;<?=$pg->totalrecords ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <hr>  <!-- ovim tagom smo liniju samo dunuli ispod tabele-->
            <footer>
                <p>&copy; <?php echo date('Y') ?> Simanic company</p>
            </footer>
            <!-- ovde smo dodali footer fajla; ispod stranice ubacen znak &copy, prikazana godina i tekst;
            copyright znak i tekst Simanic company su nam staticki kod, godina je dinamicki php kod koji ce prikazivati trenutnu godinu-->
        </div>
        <div class="col-md-2"></div>
    </div>
    <p></p>

</div>
</body>
</html>
