<?php
$this->setPageTitle('Exam Online Test');
$this->breadcrumbs = array(
    'Ongoing Examination',
);
?>

<?php
foreach ($model as $arr) {
    ?>
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
                <td><b>Mata Pelajaran</b></td>
                <td style="width: 10px">:</td>
                <td><?php echo (isset($arr->Exam->ExamCategory->name)) ? $arr->Exam->ExamCategory->name : ''?></td>

                <td class="span3"><b>Waktu</b></td>
                <td style="width: 10px">:</td>
                <td><?php echo (isset($arr->Exam->period)) ? $arr->Exam->period . ' minutes' : ''?></td>
            </tr>
            <tr>
                <td><b>Nama Ujian</b></td>
                <td>:</td>
                <td><?php echo $arr->name ?></td>

                <td><b>Waktu Mulai</b></td>
                <td>:</td>
                <td><?php echo $arr->date_test . ' , ' . $arr->time_start ?></td>
            </tr>
            <tr>
                <td><b>Description</b></td>
                <td>:</td>
                <td><?php echo $arr->description ?></td>

                <td><b>Waktu Selesai</b></td>
                <td>:</td>
                <td><?php echo $arr->date_test . ' , ' . $arr->time_end ?></td>
            </tr>
            <tr>    
                <td><b>Jumlah Soal</b></td>
                <td>:</td>
                <td><?php echo $arr->exam_total ?></td>

                <td><b>Creator</b></td>
                <td>:</td>
                <td><?php echo $arr->User->name ?></td>
            </tr>
            <tr>    
                <td><b>Max Nilai yg Diperoleh</b></td>
                <td>:</td>
                <td><?php echo $arr->result_max ?></td>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>    
                <td colspan="6">
                    <?php
                    if ($arr->created_user_id == user()->id) {
                        echo'<a class="btn btn-primary" href=" ' . url('test/stats/' . $arr->id) . '"><i class="icon-signal icon-white"></i> Statistic</a>';
                    }
                    ?>

                    <?php
                    if (TestResult::model()->isFinish($arr->id, user()->id)) {
                        echo '<a class="btn btn-success pull-right" href="' . url('test/finish/' . $arr->id) . '"><i class="icon-ok icon-white"></i> Result Your Exam</a> ';
                    } else {
                        echo '<a class="btn btn-primary pull-right" href="' . url('test/go/' . $arr->id) . '"><i class="icon-arrow-right icon-white"></i> Mulai Ujian Sekarang</a> ';
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>

    <?php
}
?>

<?php
if (empty($model)) {
    echo '<div class="alert fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>No Exam for you!</strong> We cannot trace any condition to examination in your class.
          </div>';
}
?>