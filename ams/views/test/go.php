<?php
$this->setPageTitle('UJIAN ONLINE :: ' . $model->name);
?>
<style>
    input[type=radio] {
        display: block;
        position: relative;
    }
</style>
<div class="well">
    <div class="row-fluid">
        <div class="span10">
            <?php
            $session = session();
            $no = 1;
            foreach ($modelExamDetail as $arrExamDetail) {
                //checking answer
                if (empty($session['exam_detail_answer'][$arrExamDetail->id])) {
                    $color = '';
                } else {
                    $color = 'btn-success';
                }

                if ($arrExamDetail->type == 'narrative') {
                    //do nothing
                } else {
//                                $arrExamDetail->number
                    echo CHtml::button($no, array('ajax' => array(
                            'type' => 'POST',
                            'beforeSend' => 'undelegatedAnswer()',
                            'url' => url('examDetail/answer', array('id' => $arrExamDetail->id, 'rn' => $no)),
                            'update' => '#answer',
                        ), 'class' => 'btn '.$color, 'id' => $arrExamDetail->id));
                    $no++;
                }
            }
            
            //narative di taruh di bawah sendiri
            foreach ($modelExamDetail as $arrExamDetail) {
                if ($arrExamDetail->type == 'narrative') {
                    echo CHtml::button('N', array('ajax' => array(
                            'type' => 'POST',
                            'beforeSend' => 'undelegatedAnswer()',
                            'url' => url('examDetail/answer/' . $arrExamDetail->id),
                            'success' => 'js:function(data){ 
                                            $("#answer").show();
                                            $("#narrative").html(data);
                                            $(".alert").fadeIn()
                                        }'
                        ), 'class' => 'btn btn-small btn-warning', 'id' => $arrExamDetail->id));
                } 
                
            }
            ?> 
        </div>
        <div class="span2">

            <button href="#myModal" role="button" class="btn btn-primary pull-right" data-toggle="modal"><i class="icon-ok icon-white"></i>SELESAI</button>

            <!-- Modal -->
            <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Attention!!</h3>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin dengan jawaban anda ?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-primary pull-right" onClick="parent.location = '<?php echo url('test/finish/' . $model->id) ?>'" ><i class="icon-check icon-white"></i> Yes</button>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="box">
    <div class="title">
        <h4>
            <span class="icon16 icon-time pull-left"></span>
            <span class="pull-left">
                <?php
                $this->widget('common.extensions.ecountdown.ECountDown', array(
                    'seconds' => strtotime($model->date_test . ' ' . $model->time_end) - strtotime(date('Y-m-d H:i:s')),
                    'follow' => url('test/finish/' . $model->id)
                ));
                ?>
            </span>&nbsp;
            <span class="pull-right" style="margin-right: 20px">HARAP TENANG & JANGAN MENCONTEK</span>
        </h4>
    </div>
    <div class="content" style="min-height:300px;padding: 10px 20px 10px 20px">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'test--result-detail-form',
            'enableAjaxValidation' => false,
            'method' => 'post',
            'type' => 'horizontal',
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data'
            )
        ));

        echo CHtml::hiddenField('test_id', $model->id);
        ?>
        <div class="alert alert-block" style="display:none">
            <button type="button" class="close">×</button>
            <div id="narrative"></div>
        </div>
        <div id="number" class="pull-left"></div> 
        <div id="answer">
            <div id="question">
                <div class="alert alert-info">
                    <button type="button" class="close">×</button>
                    <div class="well">
                        <ul>
                            <li><span class="label label-info">TIDAK CONNECT INTERNET</span> Ujian online ini tidak membutuhkan internet, maka jika komputer tidak konek internet tidak perlu bingung</li>
                            <li><span class="label label-info">WIFI Grade</span> Koneksikan Laptop Anda di WIFI yang telah tersedia di Grade masing - masing (Jangan di <b>@wifi.id</b> / <b>Indischool@wifi.id</b>) </li>
                            <li><span class="label label-info">DNS Server</span> Jika TETAP TIDAK BISA terkoneksi kedalam akademik.smpplusalkautsar.sch.id, silahkan di isikan manual di dalam DNS Server : <b>192.168.10.1</b></li>
                            <li><span class="label label-info">Selamat Mengerjakan</span> Kerjakan dengan tenang, karena soal di acak (setiap nomor soal yang di dapatkan siswa tidak sama)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php
//                $this->widget('common.extensions.EUserFlash', array(
//            'bootstrapLayout' => true));
//            foreach (Yii::app()->user->getFlashes() as $key => $message) {
//                echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
//            }
            ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<div class="well well-small">
    <b>Keterangan Warna</b>
    <ul>
        <span class="label label">Belum Terjawab</span>
        <span class="label label-info">Nomor Sekarang</span>
        <span class="label label-success">Sudah Terjawab</span>
    </ul>
</div>
