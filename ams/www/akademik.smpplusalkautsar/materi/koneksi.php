<?php
error_reporting(0);
$data='';
class database {

    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPassword = "landak";
    private $dbName = "landa_ams_smpplusalkautsar";

    function connectMysql() {
        mysql_connect($this->dbHost, $this->dbUser, $this->dbPassword);
        mysql_select_db($this->dbName) or die("Database tidak di temukan");
    }

    function tampilDownload($id) {
        $data = '';
        $sql_tampil = mysql_query("SELECT * FROM acca_download  where download_category_id=$id");
        while ($row = mysql_fetch_array($sql_tampil))
            $data[] = $row;
        return $data;
    }
    
    function title($id){
        $data='';
         $sql_tampil = mysql_query("SELECT * FROM acca_download_category where id=$id");
        while ($row = mysql_fetch_array($sql_tampil))
            $data[] = $row;
        return $data;
    }

    function lihatdownload($id) {

        $sql_tampil = mysql_query("SELECT * FROM acca_download where id='$id'");
        while ($row = mysql_fetch_array($sql_tampil))
            $data[] = $row;
        return $data;
		
    }

     function lihatcategorytujuh() {
        $sql_tampil = mysql_query("SELECT * FROM acca_download_category where parent_id=209");
        while ($row = mysql_fetch_array($sql_tampil))
            $data[] = $row;
        return $data;
    }
    
    function lihatcategorydelapan() {
        $sql_tampil = mysql_query("SELECT * FROM acca_download_category where parent_id=197");
        while ($row = mysql_fetch_array($sql_tampil))
            $data[] = $row;
        return $data;
    }


    function lihatcategorysembilan() {
        $sql_tampil = mysql_query("SELECT * FROM acca_download_category where parent_id=185");
        while ($row = mysql_fetch_array($sql_tampil))
            $data[] = $row;
        return $data;
    }
	public function selectCategory(){
		$query = mysql_query("select * from acca_download_category");
		while($row = mysql_fecth_assoc($query)){
			$data[] = $row;
		}
	}
	
	function recent() {
	$sql_tampil = mysql_query("SELECT  * from acca_download, acca_download_category where acca_download.download_category_id=acca_download_category.id");
	  while ($row = mysql_fetch_array($sql_tampil)){
            $data[] = $row;
        return $data;		
								
	}
}
}

?>