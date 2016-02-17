<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'exam-form',
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


        <?php //echo $form->textFieldRow($model,'exam_category_id',array('class'=>'span5'));  ?>
        <?php echo $form->dropDownListRow($model, 'school_year_id', CHtml::listData(SchoolYear::model()->findAll(array('order' => 'id')), 'id', 'school_year'), array('class' => 'span3', 'empty' => 'Pilih tahun ajaran')); ?>
        <?php echo $form->dropDownListRow($model, 'exam_category_id', CHtml::listData(ExamCategory::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname'), array('class' => 'span3', 'empty' => 'root')); ?>

        <?php echo $form->textFieldRow($model, 'name', array('class' => 'span3', 'maxlength' => 255)); ?>

        <?php //echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>255));  ?>


        <?php
        echo $form->textFieldRow(
                $model, 'period', array('append' => 'minute', 'class' => 'span1')
        );
        ?>
<?php echo $form->toggleButtonRow($model, 'public'); ?>
        <?php echo $form->toggleButtonRow($model, 'key'); ?>


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
