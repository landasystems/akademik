<?php
$this->setPageTitle('Report Absensi (Harian)');
$this->breadcrumbs = array(
    'Report Absensi',
);
?>

<style>
    .label-reservation{
        background-color: #4AC3FF;
    }
    .dropdown-menu>li>a{
        padding:3px;
    }
</style>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'room-view-form',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>


<div class="well">

    <div class="row-fluid">
        <div class="span12">
            <?php
            $class = CHtml::listData(Classroom::model()->findAll(), 'id', 'name');
            ?>
            Tanggal : <?php
            $this->widget(
                    'bootstrap.widgets.TbDatePicker', array(
                'name' => 'date',
                    )
            );
            ?> &nbsp;&nbsp;
            Kelas : <?php echo CHtml::dropDownList('classroom', (!empty($_POST['classroom'])) ? $_POST['classroom'] : '', $class, array('empty' => t('choose', 'global'))); ?>&nbsp;&nbsp;

            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'icon' => 'search white',
                'label' => 'View',
            ));
            ?>
        </div>         
    </div>
</div>
<hr/>
<?php if (!empty($_POST['date']) and !empty($_POST['classroom'])) { 
$tgl = explode("-", $date);
$tgl = $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
?>
<ul id="yw1" class="nav nav-pills"><li><a href="#">Tanggal : <b><?php echo $tgl?></b></a></li><li><a target="_blank" href="GenerateExcelSentItem?date=<?php echo $date?>&kelas=<?php echo $_POST['classroom']?>"><i class="icon-download"></i> Export ke Excel</a></li></ul>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="text-align:center">NIS</th>
                <th style="text-align:center">Nama</th>
                <th style="text-align:center">Masuk</th>
                <th style="text-align:center">Keluar</th>
                <th style="text-align:center">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($classroom as $arr) {
                $date = $date;
                $code = (isset($arr->User->code)) ? $arr->User->code : '-';
                $nama = (isset($arr->User->name)) ? $arr->User->name : '-';
                if (isset($mAbsent[$date][$arr->user_id])) {
                    if ($mAbsent[$date][$arr->user_id]->status == "presen" and !empty($mAbsent[$date][$arr->user_id]->time_out)) {
                        $status = '<span class="label label-success">Masuk</span>';
                    } else if ($mAbsent[$date][$arr->user_id]->status == "presen" and empty($mAbsent[$date][$arr->user_id]->time_out)) {
                        $status = '<span class="label label-inverse">Masuk (Belum Pulang)</span>';
                    } else if ($mAbsent[$date][$arr->user_id]->status == "sick") {
                        $status = '<span class="label label-info">Sakit</span>';
                    } else if ($mAbsent[$date][$arr->user_id]->status == "permit") {
                        $status = '<span class="label label-warning">Ijin</span>';
                    }

                    if (!empty($mAbsent[$date][$arr->user_id]->time_out)) {
                        $time_out = $mAbsent[$date][$arr->user_id]->time_out;
                    } else {
                        $time_out = '-';
                    }
                    $time_in = $mAbsent[$date][$arr->user_id]->time_in;
                } else {
                    $status = '<span class="label label-important">Tidak Masuk</span>';
                    $time_in = '-';
                    $time_out = '-';
                }
                ?>
                <tr>
                    <td><?php echo $code ?></td>
                    <td><?php echo $nama ?></td>
                    <td style="text-align:center"><?php echo $time_in ?></td>
                    <td style="text-align:center"><?php echo $time_out ?></td>
                    <td style="text-align:center"><?php echo $status ?></td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
<?php } ?>
<?php $this->endWidget(); ?>

