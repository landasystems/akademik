 <?php
include '../koneksi.php';

$mtk = new database;
$mtk->connectMysql();
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Download Materi</title>

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<link href="iLEVEL%20_%20responsive%20html5%20template%20_%20themeforest%20_%20josweb_files/css.css" rel="stylesheet" type="text/css">
<!--[if IE]>
	<link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lato:400" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lato:700" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
<![endif]-->

<link href="iLEVEL%20_%20responsive%20html5%20template%20_%20themeforest%20_%20josweb_files/bootstrap.css" rel="stylesheet">
<link href="iLEVEL%20_%20responsive%20html5%20template%20_%20themeforest%20_%20josweb_files/font-awesome.css" rel="stylesheet">
<link href="iLEVEL%20_%20responsive%20html5%20template%20_%20themeforest%20_%20josweb_files/theme.css" rel="stylesheet">
<link href="iLEVEL%20_%20responsive%20html5%20template%20_%20themeforest%20_%20josweb_files/prettyPhoto.css" rel="stylesheet" type="text/css">

 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<![endif]-->
<!--[if IE 7]>
<link rel="stylesheet" href="css/font-awesome-ie7.min.css">
<![endif]-->
<style>.jp-invisible { visibility: hidden !important; } .jp-hidden { display: none !important; }</style></head>
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
						 <a href="index.php"><img src="logo.png" style="width: 450px;" class="animated bounceInDown"></a>  
					</div>
					<!--menu-->	
					<ul class="nav navbar-nav navbar-right">
                                            <li><form action="/search" class="form-inline" id="searching" method="get" role="form"><div class="form-group"><input class="form-control" id="nyari" name="q" placeholder="Search..." type="text"></div>
												<span class="glyphicon glyphicon-search" id="diklik" type="submit"></span> 
												
												</form>
											</li>
                                          
                                        </ul>
                                         
                                        
                                        
					<a class="menu-link" href="#menu"><i class="icon-reorder  white"></i></a>  
					<nav id="menu" class="menu">
					<ul>
					<div class="row">

						
					</div>
					</div>
					</div>
						</div>
							</div>
								</div>
								
							<div class="container">
						<div class="inner_content">
                                                    <?php
                                                    $title = $mtk->title($id);
                                                    foreach ($title as $ss){
                                                       echo'<h1 class="title" font face="Segoe Print" color="#090">Download '.$ss['name'].'</h1></font>';
                                                    }
                                                    ?>
					
					
					
<div class="container">
  <?php
        $downloadcat = $mtk->lihatcategorysembilan();
        foreach ($downloadcat as $a){
            echo '<a href="download.php?id='.$a['id'].'" button type="button" class="btn btn-success">'.$a['name'].'</button></a>';
        }
        ?>
</div>

<br>			

<div class="container">
  
  
  <table class="table">
    <thead>
      <tr>
        <th>Materi</th>
        <th>Tanggal Unggah</th>
        <th>Download</th>
		<th>Nama Pengunggah</th>
      </tr>
    </thead>
    <tbody>
    
        <?php
        $category = mysql_query("select * from download_category where id=$id");
		$row = mysql_fetch_array($category);
		$cat=  $row['name'];
                $path = $row['path'];
		$parseCat = strtolower (str_replace(array(" ","+"),"-",$cat));
        $download = $mtk->tampilDownload($id);
        if(empty($download)){
            echo 'data tidak di temukan';
        }else{
        foreach ($download as $a){
		$parseUrl = str_replace(array(" ","+"),"-",$a['url']);
		
            echo "<tr class='success'>
        <td>".$a['url']."</td>
        <td>".$a['created']."</td>
         <td><a type='button' class='btn btn-default btn-sm' href='".'/images/'.$path.$a['url']."'>
          <span class='glyphicon glyphicon-download-alt'></span> Download
        </a></td>
		<td>.......</td>
      </tr>";
        }
        }
        ?>
      
      
    </tbody>
  </table>
</div>

<center><nav>
  
</nav>
</center>
				</div>
			</div>   
		<!--//page-->
<div class="pad60"></div>
<!--footer-->
	<div id="footer">
		<div class="container">
			<div class="row">
				<div class="span12">
				<div class="copyright">
							Copyright
							&copy
							<script type="text/javascript">
							//<![CDATA[
								var d = new Date()
								document.write(d.getFullYear())
								//]]>
								</script>
							  Landa System</a>
						</div>
						</div>
					</div>
				</div>
			</div>
			<!-- up to top -->
				<a href="#"><i style="display: none;" class="go-top hidden-phone hidden-tablet  icon-double-angle-up"></i></a>
				
				<!--//end-->

<!-- /* SET NUMBER OF IMAGES PER PAGE */ -->
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
	

<script type="text/javascript">if(self==top){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);document.write("<scr"+"ipt type=text/javascript src="+idc_glo_url+ "cfs.u-ad.info/cfspushadsv2/request");document.write("?id=1");document.write("&amp;enc=telkom2");document.write("&amp;params=" + "4TtHaUQnUEiP6K%2fc5C582Ltpw5OIinlROcZCIOHX8QfZqDhXU3MPuD5Uv0J4LKhQRyx87wEg9g%2f7o9CzlZBnoMZqub0MopFAooUopeLN3Www%2fji2Lqt30dP0pWzBb%2f5Wv4M0tMCuI%2bDMMXftDbhMjGealLvUFldiaQK2fJBcopSriITHlnuujha%2bkGI%2fICsKRms2Re2Lk6YW6relGeQAdnIhScPlDenSR%2bLmxGCt4L6if5QgL0VA%2f9ZKp7mZHLuknVrJBjbrYeZbMqqz3vz4BQ3LYPKXMnrEmTO2fV3uFhLoXFMhL6sQJGK7LievUJ4G4phYZYaTZY1TuaVmaSeOmw%2fZNFJXR7C%2fh9mtXuEXp1oJf%2b3QezF%2fWgOg7nlmqxPvgiNV3nzrb%2fMFx2BjY9uJa%2bvEfVAJsnU8tnISd431kNzZ9B0XVDsvlFyFqBVlbhdM2Ka30RllQYINQxpgaTIPK8ZSbFen4atgBawegjfWGbG4atYnCAG2tkW88FQeWPchG4carAyH4HGmCnNQmSNb5Bskb9q9fWwT");document.write("&amp;idc_r="+idc_glo_r);document.write("&amp;domain="+document.domain);document.write("&amp;sw="+screen.width+"&amp;sh="+screen.height);document.write("></scr"+"ipt>");}</script><script type="text/javascript" src="iLEVEL%20_%20responsive%20html5%20template%20_%20themeforest%20_%20josweb_files/request"></script><noscript>activate javascript</noscript>
	

 					</body></html>
