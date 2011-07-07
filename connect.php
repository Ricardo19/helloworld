<?php

$servidor = "localhost";
$username = "root";
$password = "rui06ricardo19lena27";
    $con = mysql_connect($localhost, $root, $rui06ricardo19lena27)
            if(!$con)
            { 
                die('Could not connect: ' . mysql_error());
            }
    mysql_select_db("muvi", $con);
?>
