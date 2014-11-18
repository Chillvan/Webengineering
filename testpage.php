<?php

include_once 'dbfunctions.php';
include_once 'configPDO.php';

$frei = dbfunctions::wohnungsCheck($dbh);

$text = "";
        
        foreach($frei as $i){
        
        $text = $text.'<option value="'.$i.'">'.$i.'</option>';
        }
        
        echo $text;
?>