<?php
$this->setPageTitle('Dokumen Folder');
?>
<div class="row-fluid">
    <div class="span4 img-polaroid">
        <h3 style="text-align: center">KELAS 7</h3>
        <table class="table table-striped">
            <?php
            $kelas7 = DownloadCategory::model()->findAll(array('condition' => 'parent_id=1', 'order' => 'name ASC'));
            foreach ($kelas7 as $data) {
                echo'<tr><td><a href="' . bu('download/create/' . $data->id) . '"><div>' . $data->name . '</div></a></td></tr>';
            }
            ?>

        </table>
    </div>
    <div class="span4 img-polaroid">
        <h3 style="text-align: center">KELAS 8</h3>
        <table class="table table-striped">
            <?php
            $kelas8 = DownloadCategory::model()->findAll(array('condition' => 'parent_id=13', 'order' => 'name ASC'));
            foreach ($kelas8 as $data) {
                echo'<tr><td><a href="' . bu('download/create/' . $data->id) . '"><div>' . $data->name . '</div></a></td></tr>';
            }
            ?>
        </table>
    </div>
    <div class="span4 img-polaroid">
        <h3 style="text-align: center">KELAS 9</h3>
        <table class="table table-striped">
          <?php
            $kelas9 = DownloadCategory::model()->findAll(array('condition' => 'parent_id=25', 'order' => 'name ASC'));
            foreach ($kelas9 as $data) {
                echo'<tr><td><a href="' . bu('download/create/' . $data->id) . '"><div>' . $data->name . '</div></a></td></tr>';
            }
            ?>   
        </table>
    </div>
</div>