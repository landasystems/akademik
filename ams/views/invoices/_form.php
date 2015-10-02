<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'invoices-form',
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


        <?php //echo $form->textFieldRow($model, 'payment', array('class' => 'span5')); ?>

        <?php
        echo $form->textFieldRow(
                $model, 'payment', array(
            'prepend' => 'Rp',)
        );
        ?>


        <?php
        echo $form->datepickerRow(
                $model, 'due_date', array(
            'options' => array(),
            'prepend' => '<i class="icon-calendar"></i>'
                )
        );
        ?>

        <?php echo $form->textFieldRow($model, 'client', array('class' => 'span5', 'maxlength' => 255)); ?>






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
