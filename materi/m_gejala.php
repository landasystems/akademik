<?php 
  	require_once('config/config.php');
	require_once('config/login.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once('layout/head.php'); ?>
        <title>Homepage</title>   
    </head>
    <body data-offset="50" data-target=".subnav" data-spy="scroll">

        <?php require_once('layout/navbar.php') ?>
        <?php 
            if ($_GET['action']=='edit'){
                $sql = mysql_query("SELECT * FROM gejala WHERE id_gejala=".$_GET['id']);
                $dataEdit = mysql_fetch_array($sql);
            }
        ?>
        <!-- Admdk Container -->
        <div class="container">
            <!-- Sub Menu  -->
            <header class="jumbotron subhead" id="overview">
                <h2>Form Data Gejala</h2>
                <p class="lead">Data Gejala Merupakan Gejala Mengenai Penyulit Kehamilan</p>
            </header>
            <!-- END Sub Menu -->

            <!-- Content -->
          <div class="ig-contents row-fluid">
                <div class="span4 well">
                    <div class="ig-align-l ig-list-left">
                        <h3>Tambah Gejala</h3>
                        <div class="control-group">
                            <form class="" action="m_gejala_script.php" method="get" enctype="multipart/form-data">
                                <div class="control-label">
                                  <div class="controls"></div>
                                  Gejala
                                  <div class="controls"><input type="text" name="nama" placeholder="gejala" value="<?php echo $dataEdit['nama']?>"></div>
                                <div class="controls"></div>
                                </div>
                                <input type="hidden" name="id" value="<?php if (isset($_GET['id'])) {echo $_GET['id'];} ?>">
                                <input type="hidden" name="action" value="<?php if (isset($_GET['action'])) {echo $_GET['action'];} else {echo 'tambah';} ?>">
                                <div>
                                    <input type="submit" name="bSubmit" id="bSubmit" class="btn btn-success ig-width85" value="Simpan">
                                    <input id="bReset" class="btn" type="reset" value="Reset" name="bReset">
                                </div>
                            </form>
                        </div>        
                    </div>
                </div>

                <div class="span8">
                    <div class="">
                        <h3>Daftar Data Gejala</h3>
                        <div id="tbList_wrapper" class="dataTables_wrapper" role="grid">
                            <table class="table table-striped table-bordered dataTable" id="tbList">
                                <thead>
                                    <tr role="row">
                                        <th>Gejala</th>
                                        <th width="80"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = mysql_query("SELECT * FROM gejala");
                                    while ($data = mysql_fetch_array($sql)) {
                                        ?>
                                        <tr>
                                            <td class=""><?php echo $data['nama'] ?></td>
                                            <td class="">
                                                <div class="btn-group">
                                                    <a class="btn bEdit" href="m_gejala.php?action=edit&id=<?php echo $data['id_gejala'] ?>">
                                                        <i class="icon-pencil" title="Edit"></i>
                                                    </a>
                                                    <a class="btn" data-toggle="modal" href="#myModal_<?php echo $data['id_gejala'] ?>">
                                                        <i class="icon-trash" title="Hapus"></i>
                                                    </a>
                                                </div>
                                                <div class="modal fade" id="myModal_<?php echo $data['id_gejala'] ?>" style="display: none;">
                                                    <div class="modal-header">
                                                        <button class="close" data-dismiss="modal">x</button>
                                                        <h3>Konfirmasi</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda akan menghapus data <strong><?php echo $data['nama'] ?></strong></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="#" class="btn" data-dismiss="modal">Close</a>
                                                        <a href="m_gejala_script.php?action=hapus&id=<?php echo $data['id_gejala'] ?>" class="btn btn-primary bDel">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
                <!-- end of Content -->

                <!-- Footer -->
                <br class="clearfix">
                <div class="footer">
                    <div>
                        <a href="#" class="admdk-footer-back pull-right">Back to top</a>
                        <div class="admdk-footer-center pull-left"></div>
                    </div>
                </div>
                <!-- end of Footer -->

            </div>
            <!-- end of Content -->
            <?php require_once('layout/bottom.php'); ?>
        </div>
    </body>
</html>