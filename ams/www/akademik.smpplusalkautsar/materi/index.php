<?php
include './koneksi.php';

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
<link href="SMP%20Plus%20Alkautsar%20Malang_files/theme.css" rel="stylesheet">
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
						<a href="index.php"><img src="SMP%20Plus%20Alkautsar%20Malang_files/index.png" style="width: 450px;" class="animated bounceInDown"></a>
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
									<button class="btn btn-default" type="SUBMIT" name="SUBMIT" id="SUBMIT">
									<span class="glyphicon glyphicon-search"></span> 
									</form></li></button>
								</a>
							</div>	
						</form>
					</nav>
					</div>
				</div>
			</div>
			</div>
			
				<div class="container">
					</a><div class="inner_content">
					<div class="pad30"></div>
					<!--info boxes-->
					<div class="span12">
					<div class="row">
					<div class="row">
					<div class="span3">
						</a><div class="tile animated fadeInUp">

						<class="tile-title"><b><h2>Recent Document</h2></b>
						
<style>
table, td, th {
    border: 0px solid green;
}

th {
    color: white;
}
</style>



<center>
<table>
  <tbody>

  
  
  
  <tr>
    <th>&nbsp &nbsp &nbsp &nbsp </th>
    <th>&nbsp &nbsp &nbsp &nbsp  </th>
    <th></th>
  </tr>
    <?php
	$no=0;
  $sql_tampil = mysql_query("SELECT  * from acca_download, acca_download_category where acca_download.download_category_id=acca_download_category.id order by acca_download.id desc limit 7");
	  while ($row = mysql_fetch_array($sql_tampil)){
	  $no++;
            echo ' <tr>
    <td>'.$no.'</td>
    <td><a href="" title="'.$row['url'].'">'.substr($row['url'],0,4).'...</a></td>
    <td><a href="/images/'.$row['path'].''.$row['url'].'" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-download-alt"></span></a></td>
  </tr>';	
								
	}
  
  ?>
  
  
   
</tbody>
</table></div>
				</div>
				
				</a>
				<div class="span3"><a href="#">
                                        
                                       
					</a><div class="tile animated fadeInUp">
						<img class="tile-image" alt="" src="a.png">
						<class="tile-title"><b><h1>Kelas 7</h1></b>
						<br>
                                                <h6><span class='button1'><a href="kelas-7/"><b>Lihat Mapel</b></a></h6></span>
					</div>
				</div>
				
			<div class="span3">
				<div class="tile animated fadeInUp">
					<img class="tile-image" alt="" src="c.png">
					<class="tile-title"><b><h1>Kelas 8</h1></b>
					<br>
					<h6><span class='button1'><a href="kelas-8/"><b>Lihat Mapel</b></a></h6></span>
				</div>
			</div>
			
			<div class="span3">
				<div class="tile animated fadeInUp">
					<img class="tile-image" alt="" src="d.png">
					<class="tile-title"><b><h1>Kelas 9</h1></b>
					<br>
                                        <h6><span class='button1'><a href="kelas-9/">Lihat Mapel</span></a></h6>
				</div>
			</div>
      </div><!-- /tiles -->
	</div>
		</div> 
		<!--//info boxes-->
		
		<div class="row">
		<!--col 1-->
			<div class="span12">
			
		</div>
	</div>
	</div>
		</div>

			<!-- footer -->
		<div id="footer">
		<div class="container">
				<div class="copyright"><h5>Copyright © 2015 - <a href="landa.co.id"><b>Landa System</b></a></div></h5>
				</div>
					</div>
		
<script type="text/javascript" src="SMP%20Plus%20Alkautsar%20Malang_files/request"></script><noscript>activate javascript</noscript>
</body>
</html>