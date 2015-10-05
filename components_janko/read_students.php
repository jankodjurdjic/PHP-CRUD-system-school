<?php
include "../../incl/data.inc.php";

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $skola_id = $_POST['skola_id'];

    $sqlQuery = "SELECT * FROM `ucenici` WHERE ucenici.skola_id = ".$skola_id;

    $query = mysql_query($sqlQuery);   //ovde saljemo upit bazi da povucemo prethodno selektovane podatke
    $students = array();
    while($row = mysql_fetch_assoc($query)) {
        $students [] = $row;
    }

    include("students_table.php");
    exit();
}