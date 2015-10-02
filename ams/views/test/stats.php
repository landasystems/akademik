<?php
$this->setPageTitle('Exam Statistic');
$this->breadcrumbs = array(
    'Exam Statistic',
);
?>
<?php
//$hasil = $this->renderPartial('_statsFix', array('model' => $arr));
?>
<script>
    setInterval(function () {
        $('#hasil').load('<?php echo url('test/statsLi/' . $_GET['id']) ?>');
    }, 5000);

</script>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="span3"><b>Kategori Ujian</b></td>
            <td style="width: 10px">:</td>
            <td><?php echo $model->Exam->ExamCategory->name ?></td>

            <td class="span3"><b>Waktu</b></td>
            <td style="width: 10px">:</td>
            <td><?php echo $model->Exam->period . ' minutes' ?></td>
        </tr>
        <tr>
            <td><b>Ujian/ Mata Pelajaran</b></td>
            <td>:</td>
            <td><?php echo $model->name ?></td>

            <td><b>Waktu Mulai</b></td>
            <td>:</td>
            <td> <?php echo date('d F Y', strtotime($model->date_test)) . ' , ' . $model->time_start ?></td>
        </tr>
        <tr>
            <td><b>Description</b></td>
            <td>:</td>
            <td><?php echo $model->description ?></td>

            <td><b>Waktu Selesai</b></td>
            <td>:</td>
            <td> <?php echo date('d F Y', strtotime($model->date_test)) . ' , ' . $model->time_end ?></td>
        </tr>
        <tr>    
            <td><b>Jumlah Soal</b></td>
            <td>:</td>
            <td><?php echo $model->exam_total ?></td>

            <td><b>Creator</b></td>
            <td>:</td>
            <td><?php echo $model->User->name ?></td>
        </tr>
        <tr>    
            <td><b>Max Nilai yg Diperoleh</b></td>
            <td>:</td>
            <td><?php echo $model->result_max ?></td>

            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>

<div>
    <div class="box gradient hover">
        <div class="title">
            <h4>
                <span class="icon16 entypo-icon-thumbs-up"></span>
                <span>Exam Statistic</span>
            </h4>
        </div>
        <div class="content" style="display: block;">
            <ul class="unstyled" id="hasil">
                <?php echo $this->renderPartial('_statsLi', array('test_id' => $_GET['id'], 'model' => $model)) ?>
            </ul>
        </div>
    </div>
</div>

