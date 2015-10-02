<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'test-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>
    <fieldset>
        <legend>
            <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
        </legend>

        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>


        <?php //echo $form->textFieldRow($model,'classroom_id',array('class'=>'span5'));  ?>
        <div class="well">
            <h4>Pilih Kelas</h4>
            <div class="control-group ">
                <?php
                echo CHtml::activeLabel($model, 'school_year_id', array('class' => 'control-label', 'label' => 'Tahun Ajaran'));
                ?>
                <div class="controls">
                    <?php
                    echo CHtml::dropDownList('cc', (isset($model->Classroom->school_year_id)) ? $model->Classroom->school_year_id : '', CHtml::listData(SchoolYear::model()->findAll(), 'id', 'school_year'), array(
                        'class' => 'span3',
                        'empty' => t('choose', 'global'),
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createUrl('test/dynaclass'),
                            'update' => '#Test_classroom_id',
                        ),
                    ));
                    ?>  
                </div>
            </div>


            <?php echo $form->dropDownListRow($model, 'classroom_id', CHtml::listData(Classroom::model()->findAll('school_year_id=:school_year_id', array(':school_year_id' => (int) (isset($model->Classroom->school_year_id)) ? $model->Classroom->school_year_id : '')), 'id', 'name'), array('class' => 'span3')); ?>

        </div>
        <div class="well">
            <h4>Pilih Ujian</h4>
            <div class="control-group ">
                <?php
                echo CHtml::activeLabel($model, 'school_year_id', array('class' => 'control-label', 'label' => 'Tahun Ajaran'));
                ?>
                <div class="controls">
                    <?php
                    echo CHtml::dropDownList('school_year_id', (isset($model->Exam->school_year_id)) ? $model->Classroom->school_year_id : '', CHtml::listData(SchoolYear::model()->findAll(), 'id', 'school_year'), array(
                        'class' => 'span3',
                        'empty' => t('choose', 'global'),
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createUrl('test/dynaexam'),
                            'update' => '#Test_exam_id',
                        ),
                    ));
                    ?>  
                </div>
            </div>



            <div class="control-group ">
                <label class="control-label">Exam</label>
                <div class="controls">
                    <?php
                    echo $form->dropDownList($model, 'exam_id', CHtml::listData(Exam::model()->findAll('school_year_id=:school_year_id', array(':school_year_id' => (int) (isset($model->Classroom->school_year_id)) ? $model->Exam->school_year_id : '')), 'id', 'name'), array('empty' => 'Select Exam ', 'class' => 'span5',
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createUrl('exam/json'),
                            'update' => '#Minute',
                            'success' => 'js:function(data){ 
                                obj = JSON.parse(data);
                                $("#period").val(obj.period);
                                $("#Test_exam_total").val(obj.total);
                                $("#Test_time_start").trigger("blur");
                            }'
                        ),
                            )
                    );
                    ?>
                
                </div>
            </div>
        </div>
        <div class="well">
            <h4>Keterangan</h4>
            <?php echo $form->textFieldRow($model, 'name', array('class' => 'span3', 'maxlength' => 255)); ?>

        <?php
        echo $form->datepickerRow(
                $model, 'date_test', array(
            'options' => array('format' => 'yyyy-mm-dd'),
            'prepend' => '<i class="icon-calendar"></i>'
                )
        );
        ?>
        <div class="control-group ">
            <label class="control-label">Period</label>
            <div class="controls">
                <div class="input-append">
                    <?php echo CHtml::textField('period', (isset($model->Exam->period)) ? $model->Exam->period : '', array('class' => 'span1', 'append' => 'minutes', 'disabled' => 'disabled')); ?>
                    <span class="add-on">minutes</span>
                </div>
            </div>
        </div>

        <?php
        echo $form->timepickerRow(
                $model, 'time_start', array(
            'class' => 'input-small',
                )
        );
        ?>
        <?php
        echo $form->timepickerRow(
                $model, 'time_end', array(
            'class' => 'input-small',
            'readonly' => 'readonly',
                )
        );
        ?>


        <?php echo $form->textFieldRow($model, 'exam_total', array('class' => 'span1', 'readonly' => 'readonly')); ?>
        <?php echo $form->textFieldRow($model, 'result_max', array('class' => 'span1', 'hint' => 'Score maksimal untuk hasil ujian', 'maxlength' => 3)); ?>

        <?php /* echo $form->textFieldRow($model,'created',array('class'=>'span5')); ?>

          <?php echo $form->textFieldRow($model,'created_user_id',array('class'=>'span5')); ?>

          <?php echo $form->textFieldRow($model,'modified',array('class'=>'span5')); */ ?>
        <?php
        echo $form->html5EditorRow(
                $model, 'description', array(
            'class' => 'span2',
            'rows' => 5,
            'height' => '200',
            'options' => array('color' => true)
                )
        );
        ?>
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
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'reset',
                'icon' => 'remove',
                'label' => 'Reset',
            ));
            ?>
        </div>
    </fieldset>

    <?php $this->endWidget(); ?>

</div>
