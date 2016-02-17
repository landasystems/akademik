<?
$server="localhost";
$user="root";
$password="";
$database="landa_ams_smpplusalkautsar";
 
$konek=mysql_connect($server,$user,$password);
if ($konek)
{
 
//echo "Data Telah Terkoneksi !!";
 
}
 
Else
{
 
//echo "Data Telah Terkoneksi !!";
 
}
 
$pilihdatabase=mysql_select_db($database,$konek)
?>