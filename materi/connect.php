<?php
$host = "localhost";
$user = "root";
$pass = "landak";
$dbName = "landa_ams_smpplusalkautsar";
mysql_connect($host, $user, $pass);
mysql_select_db($dbName)
or die ("Connect Failed !! : ".mysql_error());
?>