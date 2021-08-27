<?php
/*
This file contains database configuration assuming you are running mysql using user "shahzeb" and password "123456"
*/

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'shahzeb');
define('DB_PASSWORD', '123456');
define('DB_NAME', 'shahzeb');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>