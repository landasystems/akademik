<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'sms-form',
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

        <div class="control-group ">
            <label class="control-label" for="Sms_created_user_id">Target</label>
            <div class="controls">
                <?php   
                $this->widget('bootstrap.widgets.TbButtonGroup', array(
                    'type' => 'primary',
                    'toggle' => 'radio', // 'checkbox' or 'radio'
                    'buttons' => Sms::model()->button()
                ));
                echo CHtml::activeHiddenField($model, 'type');

                Yii::app()->clientScript->registerScript('buttonGroup', "
                    $(function(){
                        $('.btn-group a').click(function(){
                            var fieldId = $(this).data('field');
                            var value = $(this).data('value');
                            $('#Sms_type').val(value);
                            if (value=='user'){
                               $('#control-user').fadeIn();
                               $('#control-roles').fadeOut();
                               $('#control-number').fadeOut();
                               $('.control-classroom').fadeOut();
                            }else if(value=='group'){
                               $('#control-user').fadeOut();
                               $('#control-roles').fadeIn();
                               $('#control-number').fadeOut();
                               $('.control-classroom').fadeOut();
                            }else if(value=='classroom'){
                               $('#control-user').fadeOut();
                               $('#control-roles').fadeOut();
                               $('#control-number').fadeOut();
                               $('.control-classroom').fadeIn();
                            }else{
                                $('#control-user').fadeOut();
                               $('#control-roles').fadeOut();
                               $('#control-number').fadeIn();
                               $('.control-classroom').fadeOut();
                            }
                                                 
                        });
                    });
                    ", CClientScript::POS_END);
                ?>
            </div>
        </div>

        <div class="control-group" id="control-user" style="display: none">
            <label class="control-label">User</label>
            <div class="controls">
                <?php
                $this->widget('bootstrap.widgets.TbSelect2', array(
                    'asDropDownList' => TRUE,
                    'data' => CHtml::listData(User::model()->findAll(array(
                                'group' => 't.phone',
                                'distinct' => true,
                            )), 'id', 'fullContact'),
                    'name' => 'user_id_opp',
                    'options' => array(
                        'placeholder' => yii::t('global', 'choose'),
                        'width' => '60%',
                        'tokenSeparators' => array(',', ' ')
                    ),
                    'htmlOptions' => array(
                        'multiple' => 'multiple',
                    )
                ));
                ?>
            </div>
        </div>

        <div class="control-group" id="control-roles" >
            <label class="control-label">Roles</label>
            <div class="controls">
                <?php
                $this->widget('bootstrap.widgets.TbSelect2', array(
                    'asDropDownList' => TRUE,
                    'data' => CHtml::listData(User::model()->roles(), 'id', 'name'),
                    'name' => 'roles_id',
                    'options' => array(
                        'placeholder' => yii::t('global', 'choose'),
                        'width' => '60%',
                        'tokenSeparators' => array(',', ' ')
                    ),
                    'htmlOptions' => array(
                        'multiple' => 'multiple',
                    )
                ));
                ?>
            </div>
        </div>

        <div class="control-group" id="control-number" style="display: none" >
            <label class="control-label">Phone Number</label>
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on">+62</span>
                    <?php
                    echo CHtml::textField('number', '');
                    ?>
                </div>
            </div>
        </div>

        <div class="control-group control-classroom" style="display: none">
            <label class="control-label">Kelas</label>
            <div class="controls">
                <?php
                $this->widget('bootstrap.widgets.TbSelect2', array(
                    'asDropDownList' => TRUE,
                    'data' => CHtml::listData(Classroom::model()->findAll(), 'id', 'fullName'),
                    'name' => 'classroom_id',
                    'options' => array(
                        'placeholder' => yii::t('global', 'choose'),
                        'width' => '60%',
                        'tokenSeparators' => array(',', ' ')
                    ),
                    'htmlOptions' => array(
                        'multiple' => 'multiple',
                    )
                ));
                ?>
            </div>
        </div>
        <div class="control-group control-classroom" style="display: none">
            <label class="control-label">Kirim Ke</label>
            <div class="controls">
                <?php 
                    echo CHtml::radioButtonList('option','student', array('student'=>'Murid','parent'=>'Wali Murid'),array('separator'=>''));
                ?>
            </div>
        </div>

        <div class="control-group" id="control-number">
            <label class="control-label">Message</label>
            <div class="controls">
                <?php
                echo $form->textAreaRow($model, 'last_message', array("placeholder" => "Your text ...", 'label' => false, 'class' => 'span6', 'rows' => '5',));
                ?>
                <span id="infoMess"><b>168</b> Huruf, <b>2</b> Pesan</span>                
            </div>
        </div>        




        <div class="form-actions">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'icon' => 'ok white',
                'label' => $model->isNewRecord ? 'Send' : 'Simpan',
            ));
            ?>
        </div>
    </fieldset>

    <?php $this->endWidget(); ?>

</div>
