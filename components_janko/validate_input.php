<?php
include "../../incl/data.inc.php";

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    //first get name of variable
    $var_name = $_POST['input_name'];
    $var_value = $_POST[$var_name];

    if(strlen($var_value) < 10)
    {
        print json_encode(array('validation_state' => 'has-warning has-feedback','validation_message' => $var_name . ' je prekratak!','save_button' => 'enabled'));
        return;
    }
    else
    {
        if(strlen($var_value) > 10)
        {
            print json_encode(array('validation_state' => 'has-warning has-feedback','validation_message' => $var_name . ' je predug!','save_button' => 'enabled'));
            return;
        }
        else
        {
            //check is there same in database
            $sqlQuery = "SELECT * FROM skole WHERE skola_jib LIKE '".$var_value."'";
            $totalRecords = mysql_num_rows(mysql_query($sqlQuery));

            if($totalRecords == 0)
            {
                print json_encode(array('validation_state' => 'has-success has-feedback','validation_message' => '','save_button' => 'enabled'));
                return;
            }
            else
            {
                print json_encode(array('validation_state' => 'has-error has-feedback','validation_message' => 'Greska ovaj '.$var_value. ' vec postoji!','save_button' => 'disabled'));
                return;
            }

        }
    }
}