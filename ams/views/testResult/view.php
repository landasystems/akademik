<?php
$this->setPageTitle('Result  Exam');
$this->breadcrumbs = array(
    'Result Exam',
);

$resultColor = ($model->result >= 80) ? 'badge badge-success' : 'badge badge-warning';
$result = '<span class="' . $resultColor . '"><h1>' . round($model->result) . '</h1></span>';
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
            <td class="span3"><b>Kategori Ujian</b></td>
            <td style="width: 10px">:</td>
            <td><?php echo $model->Test->Exam->ExamCategory->name ?></td>

            <td class="span3"><b>Waktu</b></td>
            <td style="width: 10px">:</td>
            <td><?php echo $model->Test->Exam->period . ' minutes' ?></td>
        </tr>
        <tr>
            <td><b>Ujian/ Mata Pelajaran</b></td>
            <td>:</td>
            <td><?php echo $model->Test->name ?></td>

            <td><b>Waktu Mulai</b></td>
            <td>:</td>
            <td><?php echo date('d F Y', strtotime($model->Test->date_test)) . ' , ' . $model->Test->time_start ?></td>
        </tr>
        <tr>
            <td><b>Description</b></td>
            <td>:</td>
            <td><?php echo $model->Test->description ?></td>

            <td><b>Waktu Selesai</b></td>
            <td>:</td>
            <td><?php echo date('d F Y', strtotime($model->Test->date_test)) . ' , ' . $model->Test->time_end ?></td>
        </tr>
        <tr>    
            <td><b>Jumlah Soal</b></td>
            <td>:</td>
            <td><?php echo $model->Test->exam_total ?></td>

            <td><b>Creator</b></td>
            <td>:</td>
            <td><?php echo $model->Test->User->name ?></td>
        </tr>
        <tr>    
            <td><b>Max Nilai yg Diperoleh</b></td>
            <td>:</td>
            <td><?php echo $model->Test->result_max ?></td>

            <td><b></b></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>

<hr>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th></th>
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
            <td><b>Nama Siswa</b></td>
            <td>:</td>
            <td><?php echo $model->User->name ?></td>

            <td><b>Waktu Mulai Siswa</b></td>
            <td>:</td>
            <td><?php echo date('d F Y', strtotime($model->Test->date_test)) . ' , ' . $model->time_start ?></td>

            <td rowspan="2" style="text-align:center"> <?php echo $result ?></td>
        </tr>
        <tr>
            <td><b>Jumlah Soal Benar</b></td>
            <td>:</td>
            <td><?php echo $model->correct_total ?></td>

            <td><b>Waktu Selesai Siswa</b></td>
            <td>:</td>
            <td><?php echo date('d F Y', strtotime($model->Test->date_test)) . ' , ' . $model->time_end ?></td>
        </tr>
    </tbody>
</table>

<hr/>

Evaluation :
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="30">No.</th>
            <th>Choice</th>
            <th>Correct Answer</th>
            <th>Nomor Soal (di Siswa)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($modelExamDetail as $arrExamDetail) {
//            trace($exam_detail_answer[$arrExamDetail->id]['answer'] );

            $answer = json_decode($arrExamDetail->answer, true);
            if (isset($exam_detail_answer[$arrExamDetail->id]['answer'])) {
                $color = ($exam_detail_answer[$arrExamDetail->id]['answer'] == $arrExamDetail['correct']) ? 'success' : 'error';
                $choice = $exam_detail_answer[$arrExamDetail->id]['answer'] . '.</b> ' . $answer[$exam_detail_answer[$arrExamDetail->id]['answer']];
                $nr = $exam_detail_answer[$arrExamDetail->id]['number'];
            } else {
                $color = '';
                $choice = '-';
                $nr = '-';
            }

            if ($arrExamDetail->type != 'narrative') {
                echo '<tr class="' . $color . '">
                    <td>' . $arrExamDetail['number'] . '. </td>
                    <td><b>' . $choice . '</td>
                    <td><b>' . $arrExamDetail['correct'] . '.</b> ' . $answer[$arrExamDetail['correct']] . '</td>
                    <td>'.$nr.'</td>
                 </tr>';
            }
        }
        ?>
    </tbody>
</table>
