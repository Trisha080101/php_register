<?php

$host = "localhost";
$dbname = "php_practice";
$username = "root";
$password = "";

$mysql = new mysqli($host, $username, $password, $dbname);
                     
if ($mysql->connect_errno) {
    die("Connection error: " . $mysql->connect_error);
} else {
    // printf("success..".$mysql->host_info);
    return $mysql;
}





// $dbase = "user";
// // $con = mysql_connect("localhost", "root", "", "php_crud");
// $con = mysql_connect("localhost", "root", "");
// $res = mysql_select_db($dbase, $con);
// if (!$con){
//     die('Connection Failed'. mysql_connect_error()); 

// }


?>
