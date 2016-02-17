<style>
    .message{
        width: 70%;
        height: 200px;
    }
</style>
<div class="form">
    <?php
    $settings = json_decode($model->settings);
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'site-config-form',
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
        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#site">Site Config</a></li>
            <li><a href="#common">Message Setting</a></li>
            <li><a href="#message_in">Format Message Time In</a></li>
            <li><a href="#message_out">Format Message Time Out</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="site">
                <?php echo $form->textFieldRow($model, 'client_name', array('class' => 'span5', 'maxlength' => 255)); ?>
                <?php echo $form->fileFieldRow($model, 'client_logo', array('class' => 'span5')); ?>
                <?php // echo $form->dropDownListRow($model, 'language_default', array('id'=>'Indonesia','en'=>'English')); ?>
                <div class="control-group ">
                    <?php
                    echo CHtml::activeLabel($model, 'province_id', array('class' => 'control-label'));
                    ?>
                    <div class="controls">
                        <?php
                        echo CHtml::dropDownList('province_id', $model->City->province_id, CHtml::listData(Province::model()->findAll(), 'id', 'name'), array(
                            'empty' => t('choose', 'global'),
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => CController::createUrl('landa/city/dynacities'),
                                'update' => '#SiteConfig_city_id',
                            ),
                        ));
                        ?>  
                    </div>
                </div>
                <?php echo $form->dropDownListRow($model, 'city_id', CHtml::listData(City::model()->findAll('province_id=:province_id', array(':province_id' => (int) $model->City->province_id)), 'id', 'name'), array('class' => 'span3')); ?>
                <?php echo $form->textFieldRow($model, 'address', array('class' => 'span5', 'maxlength' => 255)); ?>
                <?php echo $form->textFieldRow($model, 'phone', array('class' => 'span5', 'maxlength' => 45)); ?>

                <?php echo $form->textFieldRow($model, 'fax', array('class' => 'span5', 'maxlength' => 45)); ?>

                <?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 45)); ?>
            </div>
            <div class="tab-pane" id="common">
                <?php echo $form->toggleButtonRow($model, 'site_messages'); ?>
            </div>
            <div class="tab-pane" id="message_in">
                <div class="control-group"> 
                    <label class="control-label">Format SMS Masuk</label>
                    <div class="controls"> 
                        <?php echo CHtml::textArea('SiteConfig[settings][sms_in]', (isset($settings->sms_in)) ? $settings->sms_in : '', array('class' => 'message')); ?>
                    </div> 
                </div>
                <div class="well">
                    <ul>
                        <li>Design layout SMS notifikasi siswa masuk. Gunakan format berikut untuk men-generate data siswa.</li>
                        <li><b>{name}</b> : Mengembalikan nama siswa</li>
                        <li><b>{classroom}</b> : Mengembalikan kelas siswa</li>
                        <li><b>{time}</b> : Mengembalikan waktu absen siswa (absen masuk)</li>
                        <li><b>{date}</b> : Mengembalikan tanggal absen siswa</li>
                    </ul>
                </div>
            </div>
            <div class="tab-pane" id="message_out">
                <div class="control-group"> 
                    <label class="control-label">Format SMS Keluar</label>
                    <div class="controls"> 
                        <?php echo CHtml::textArea('SiteConfig[settings][sms_out]', (isset($settings->sms_out)) ? $settings->sms_out : '', array('class' => 'message')); ?>
                    </div> 
                </div>
                <div class="well">
                    <ul>
                        <li>Design layout SMS notifikasi siswa pulang. Gunakan format berikut untuk men-generate data siswa.</li>
                        <li><b>{name}</b> : Mengembalikan nama siswa</li>
                        <li><b>{classroom}</b> : Mengembalikan kelas siswa</li>
                        <li><b>{time}</b> : Mengembalikan waktu absen siswa (absen pulang)</li>
                        <li><b>{date}</b> : Mengembalikan tanggal absen siswa</li>
                    </ul>
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
