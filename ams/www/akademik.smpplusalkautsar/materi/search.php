<?php
include 'koneksi.php';

$db = new database();
$db->connectMysql();
?>

<html lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>SMP Plus Alkautsar Malang</title>
<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<link href="SMP%20Plus%20Alkautsar%20Malang_files/css" rel="stylesheet" type="text/css">

<link href="SMP%20Plus%20Alkautsar%20Malang_files/bootstrap_002.css" rel="stylesheet">
<link href="SMP%20Plus%20Alkautsar%20Malang_files/font-awesome.css" rel="stylesheet">
<link href="style search/search.css" rel="stylesheet">
<link href="SMP%20Plus%20Alkautsar%20Malang_files/prettyPhoto.css" rel="stylesheet" type="text/css">
<link href="SMP%20Plus%20Alkautsar%20Malang_files/zocial.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="SMP%20Plus%20Alkautsar%20Malang_files/nerveslider.css">
</head>

<body class="js">
<!--header-->
	<div class="header">
	<div id="slider_header">
		<!--logo-->
			<div class="container">
			<div class="row">
				<div class="span12">
					<div class="navbar">
					<!--logo-->			
					<div class="logo">
						 <a href="index.php"><img src="SMP%20Plus%20Alkautsar%20Malang_files/index.png" style="width: 450px;"></a>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					</div>
					<!--menu-->	
					<br>
					<a class="menu-link" href="#"></a>  
					<nav id="menu" class="menu">
						<form class="navbar-form navbar-right" role="search" name="formcari" method="post" action="search.php">
							<div class="form-group">
								<a href="#">
									<div class="form-group">
									<input type="text" name="url" placeholder="Search document..." type="text"></div>&nbsp 
									<span class="glyphicon glyphicon-search" type="SUBMIT" name="SUBMIT" id="SUBMIT"></span> 
									</form></li>
								</a>
							</div>	
						</form>
					</nav>
					</div>
				</div>
			</div>
			</div>
<?php
$no=0;
include "connect.php";
$url= $_POST['url'];
$q = "SELECT * from download where url like '%$url%' ";
$result = mysql_query($q);

echo "<center>";
echo "<h2> Hasil Pencarian </h2>";
echo "<table border='3' cellpadding='5' cellspacing='8'>";
echo "
<tr bgcolor='green'>
<td><h3><center>&nbsp No &nbsp </center></h3></td>
<td><h3><center>&nbsp Data &nbsp </center></h3></td>
<td><h3><center>&nbsp Created &nbsp </center></h3></td>
<td><h3><center>&nbspDownload&nbsp</center></h3></td>
<td><h3><center>&nbsp Modified &nbsp </center></h3></td>
</tr>";
while ($data = mysql_fetch_array($result)) {
$no++;
echo "
<tr>
<td><center>".$no."</center></td>
<td>".$data['url']."</td>
<td><center>".$data['created']."</center></td>
<td><center><a class='glyphicon glyphicon-download-alt' href='".$data['created_user_id']."'></a></center></td>
<td><center>".$data['modified']."</center></td>
</tr>";
}
echo "</table>";
?>
			<!-- footer -->
		<div id="footer">
		<div class="container">
				<div class="copyright"><h5>Copyright © 2015 - <a href="landa.co.id"><b>Landa System</b></a></div></h5>
				</div>
					</div>
		
<script type="text/javascript" src="SMP%20Plus%20Alkautsar%20Malang_files/request"></script><noscript>activate javascript</noscript>
</body>
</html>