<?php
include "../../incl/data.inc.php";

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $search_term = $_POST['search_term'];
    if($search_term != '')
    {
        $sqlQuery = "SELECT ucenici.*,skole.skola_naziv FROM ucenici, skole WHERE ucenici.skola_id = skole.skola_id AND (ucenici.ucenik_ime LIKE '%".$search_term."%' OR ucenici.ucenik_prezime LIKE '%" . $search_term . "%')";

        $query = mysql_query($sqlQuery);   //ovde saljemo upit bazi da povucemo prethodno selektovane podatke
        $students = array();
        while($row = mysql_fetch_assoc($query)) {
            $students [] = $row;
        }

        header('Content-Type: application/json');
        print json_encode($students);
    }
    else
    {
        $no_result [] = 'no-results';
        header('Content-Type: application/json');
        print json_encode($no_result);
    }
}
else
{
    header('Content-Type: application/json');
    print 'You do not have permission to access this file!!!';
}
