<?php
$this->setPageTitle('Hasil Ujian');
$this->breadcrumbs = array(
    'Hasil Ujian',
);

$resultColor = ($model->result >= 80) ? 'badge badge-success' : (($model->result >= 50) ? 'badge badge-warning' : 'badge badge-important');
$result = '<span class="' . $resultColor . '"><h1>' . round($model->result) . '</h1></span>';
?>

<div class="row-fluid">
    <div class="span5">

        <div class="box hover">

            <div class="title">

                <h4>
                    <span class="icon16 entypo-icon-write"></span>
                    <span>HASIL UJIAN :: <?php echo $modelTest->name ?></span>
                </h4>
            </div>
            <div class="content">
                <div class="well">
                    <div class="row-fluid">
                        <div class="span3" style="text-align: center">
                            <?php
                            $img = user()->avatar_img;
                            echo '<img src="' . $img['medium'] . '" alt="" class="image img-polaroid"/> ';
                            ?>
                                <h4 style="padding-top:10px">nilai</h4>
                                <?php echo $result ?>
                        </div>
                        <div class="span9">
                            <div style="padding-left: 30px">
                                <b><?php echo $model->User->name ?></b><br/><br/>
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td><b>Durasi</b></td>
                                            <td>:</td>
                                            <td><?php echo $modelTest->Exam->period . ' minutes' ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Waktu</b></td>
                                            <td>:</td>
                                            <td><?php echo date('d F Y', strtotime($modelTest->date_test)) . ', ' . date('H:i', strtotime($model->time_start)) . ' - '. date('H:i', strtotime($model->time_end))  ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Jml Soal</b></td>
                                            <td>:</td>
                                            <td><?php echo $modelTest->exam_total ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Benar</b></td>
                                            <td>:</td>
                                            <td><?php echo $model->correct_total ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Max Nilai</b></td>
                                            <td>:</td>
                                            <td><?php echo $modelTest->result_max ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>

        </div><!-- End .box -->

    </div>
    <div class="span7">

        <div class="box hover">

            <div class="title">

                <h4>
                    <span class="icon16 entypo-icon-write"></span>
                    <span>GRAFIK HASIL UJIAN - SELURUH SISWA</span>
                </h4>
            </div>
            <div class="content">
                <?php echo $this->renderPartial('_statsLi', array('test_id' => $_GET['id'], 'model' => $model)) ?>
            </div>

        </div><!-- End .box -->

    </div>
</div>


<hr/>

<?php
if ($modelTest->Exam->key) {
    ?>
    Evaluation :
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="30">No.</th>
                <th>Your Choise</th>
                <th>Correct Answer</th>
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
                } else {
                    $color = '';
                    $choice = '-';
                }

                if ($arrExamDetail->type != 'narrative') {
                    echo '<tr class="' . $color . '">
                    <td>' . $arrExamDetail['number'] . '. </td>
                    <td><b>' . $choice . '</td>
                    <td><b>' . $arrExamDetail['correct'] . '.</b> ' . $answer[$arrExamDetail['correct']] . '</td>
                 </tr>';
                }
            }
            ?>
        </tbody>
    </table>
<?php } ?>