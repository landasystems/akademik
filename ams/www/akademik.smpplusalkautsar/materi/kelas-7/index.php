 <?php
include '../koneksi.php';

$mtk = new database;
$mtk->connectMysql();
?>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Download Materi Kelas </title>
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

<link href="SMP Plus Alkautsar Malang_files/bootstrap.css" rel="stylesheet">
<link href="SMP Plus Alkautsar Malang_files/theme1.css" rel="stylesheet">

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
                        <a href="../index.php"><img src="SMP%20Plus%20Alkautsar%20Malang_files/index.png" style="width: 450px;" class="animated bounceInDown"></a> 
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					</div>
					<!--menu-->	
					<br>
					<a class="menu-link" href="#"></a>  
					<nav id="menu" class="menu">
						<form class="navbar-form navbar-right" role="search">
							<div class="form-group">
								<a href="#">
									<form action="<?$_SERVER['PHP_SELF']?>" method="POST" class="form-inline" id="searching" method="get" role="form"><div class="form-group"><input class="form-control" id="nyari" name="q" placeholder="Search document..." type="text"></div><button class="btn btn-default" id="diklik" type="submit"><span class="glyphicon glyphicon-search"></span> </button></form></li>
									</form>
								</a>
							</div>	
						</form>
					</nav>
					</div>
				</div>
			</div>
			</div>
							</div>
								</div>
								<!--//header-->
								
								<!--page-->
							<div class="container">
						<div class="inner_content">
					<h1 class="title">Download Materi Kelas 7</h1>
<div class="container">
  <?php
        $downloadcat = $mtk->lihatcategorytujuh();
        foreach ($downloadcat as $a){
            echo '<a href="download.php?id='.$a['id'].'" button type="button" class="btn btn-success">'.$a['name'].'</button></a>';
        }
        ?>

</div>


				</div>
			</div>   
		<!--//page-->
<div class="pad60"></div>
			<!-- footer -->
		<div id="footer">
		<div class="span12">
				<div class="copyright">
							Copyright 
							 &copy
							<script type="text/javascript">
							//<![CDATA[
								var d = new Date()
								document.write(d.getFullYear())
								//]]>
								</script><a href="landa.co.id">
							Landa System</a>
						</div>
						</div>
					</div>
<script type="text/javascript" src="SMP%20Plus%20Alkautsar%20Malang_files/request"></script><noscript>activate javascript</noscript>
			<!-- up to top -->
				<a href="#"><i style="display: none;" class="go-top hidden-phone hidden-tablet  icon-double-angle-up"></i></a>
				
<script type="text/javascript">
//<![CDATA[
  $(function(){
$("#itemContainer").show();
   $("div.holder").jPages({
        containerID  : "itemContainer",
        perPage      : 12,
		keyBrowse   : true
    });
});
//]]>
</script>
</body>
</html>