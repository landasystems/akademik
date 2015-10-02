<table class="table table-striped">
    <tbody>
        <tr>
            <td><b>Kategori</b></td>
            <td style="width: 10px">:</td>
            <td><?php echo $modelExam->ExamCategory->name ?></td>

            <td><b>Waktu</b></td>
            <td style="width: 10px">:</td>
            <td><?php echo $modelExam->period . ' menit' ?></td>
        </tr>
        <tr>
            <td><b>Nama Ujian</b></td>
            <td>:</td>
            <td><?php echo $modelExam->name ?></td>

            <td><b>Catatan</b></td>
            <td>:</td>
            <td><?php echo $modelExam->description ?></td>
        </tr>
        <tr>    
            <td><b>Nomor Soal</b></td>
            <td>:</td>
            <td colspan="4">
                <?php
                foreach ($modelExamDetail as $arrExamDetail) {
                    $sel = '';
                    if ((!$model->isNewRecord) && $_GET['id'] == $arrExamDetail->id) {
                        $sel = 'btn-primary';
                    }
                    $sTxt = ($arrExamDetail->type == 'narrative') ? 'N' : $arrExamDetail->number;
                    echo '<a class="btn btn-small '.$sel.'" href="' . url('examDetail/update/' . $arrExamDetail->id) . '">' . $sTxt . '</a>';
                }

                //$current = ($model->number == $arrExamDetail->number) ? 'btn-primary' : '';
                    $sel = '';
                    if ($model->isNewRecord){
                        $sel = 'btn-primary';
                    }
                    echo '<a class="btn btn-small '.$sel.'" href="' . url('examDetail/create/' . $modelExam->id) . '">Tambah Soal</a>';
                ?>
            </td>
        </tr>
    </tbody>
</table>

<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'exam-detail-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    
    $answer = json_decode($model->answer);
    ?>
    <fieldset>
        <?php echo CHtml::hiddenField('ExamDetail[exam_id]', $modelExam->id) ?>
        <?php echo CHtml::hiddenField('ExamDetail[number]', $model->number) ?>
        <?php echo $form->textFieldRow($model, 'number', array('class' => 'angka')); ?>
        <?php echo $form->radioButtonListRow($model, 'type', array('choice' => 'choice', 'narrative' => 'narrative'), array('onchange' => '($(this).val()=="narrative") ?$("#answer").fadeOut():$("#answer").fadeIn();')); ?>
        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>
        <?php echo $form->ckEditorRow($model, 'question', array('options' => array('fullpage' => 'js:true', 'filebrowserBrowseUrl' => $this->createUrl("fileManager/indexBlank")))); ?>

        <div class="control-group" id="answer" <?php if ($model->type=='narrative') {echo 'style="display:none"'; }?>>
            <label class="control-label">Answer </label>
            <div class="controls">
                <?php echo CHtml::radioButton('ExamDetail[correct]', ($model->correct=='A') ? TRUE : FALSE , array('value' => 'A', 'style'=>'display:inline-block')) ?>
                <div class="input-prepend">
                    <span class="add-on">A</span>
                    <?php echo CHtml::textField('answer[]', (isset($answer->A)) ? $answer->A : '', array('class' => 'span6')) ?>
                </div><br/>
                <?php echo CHtml::radioButton('ExamDetail[correct]', ($model->correct=='B') ? TRUE : FALSE, array('value' => 'B', 'style'=>'display:inline-block')) ?>
                <div class="input-prepend">
                    <span class="add-on">B</span>
                    <?php echo CHtml::textField('answer[]', (isset($answer->B)) ? $answer->B : '', array('class' => 'span6')) ?>
                </div><br/>
                <?php echo CHtml::radioButton('ExamDetail[correct]', ($model->correct=='C') ? TRUE : FALSE, array('value' => 'C', 'style'=>'display:inline-block')) ?>
                <div class="input-prepend">
                    <span class="add-on">C</span>
                    <?php echo CHtml::textField('answer[]', (isset($answer->C)) ? $answer->C : '', array('class' => 'span6')) ?>
                </div><br/>
                <?php echo CHtml::radioButton('ExamDetail[correct]', ($model->correct=='D') ? TRUE : FALSE, array('value' => 'D', 'style'=>'display:inline-block')) ?>
                <div class="input-prepend">
                    <span class="add-on">D</span>
                    <?php echo CHtml::textField('answer[]', (isset($answer->D)) ? $answer->D : '', array('class' => 'span6')) ?>
                </div><br/>
                <?php echo CHtml::radioButton('ExamDetail[correct]', ($model->correct=='E') ? TRUE : FALSE, array('value' => 'E', 'style'=>'display:inline-block')) ?>
                <div class="input-prepend">
                    <span class="add-on">E</span>
                    <?php echo CHtml::textField('answer[]', (isset($answer->E)) ? $answer->E : '', array('class' => 'span6')) ?>
                </div><br/>
                <?php echo CHtml::radioButton('ExamDetail[correct]', ($model->correct=='F') ? TRUE : FALSE, array('value' => 'F', 'style'=>'display:inline-block')) ?>
                <div class="input-prepend">
                    <span class="add-on">F</span>
                    <?php echo CHtml::textField('answer[]', (isset($answer->F)) ? $answer->F : '', array('class' => 'span6')) ?>
                </div>
            </div>
        </div>


        <div class="form-actions">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'icon' => 'ok white',
                'label' => $model->isNewRecord ? 'Tambah' : 'Simpan',
            ));
            ?>
        </div>
    </fieldset>

    <?php $this->endWidget(); ?>

</div>
