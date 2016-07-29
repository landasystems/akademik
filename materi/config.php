<?php
session_start();
$server = "localhost";
$username = "root";
$password = "landak";
$database = "landa_ams_smpplusalkautsar";
error_reporting(NULL);
 
// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");

?>