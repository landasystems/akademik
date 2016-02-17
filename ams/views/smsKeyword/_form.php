<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'sms-keyword-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>
    <fieldset>
        <legend>Globals</legend>

        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>

        <?php
        if ($model->isNewRecord == false) {
            echo $form->dropDownListRow($model, 'type', SmsKeyword::model()->type(), array('class' => 'span3', 'empty' => t('choose', 'global'),
//            'disabled'=>true,
                'ajax' => array(
                    'type' => 'POST',
                    'url' => url('smsKeyword/keywordConfiguration'), 'success' => 'function(data){
                                        if (data!=""){                                                                                                                                                    
                                         $("#cc").html(data);                                                                        
                                        }
                                 }',
                ),));
            echo'';
        } else {
            echo $form->dropDownListRow($model, 'type', SmsKeyword::model()->type(), array('class' => 'span3', 'empty' => t('choose', 'global'),
                'ajax' => array(
                    'type' => 'POST',
                    'url' => url('smsKeyword/keywordConfiguration'),
                    'success' => 'function(data){
                                        if (data!=""){                                                                                                                                                    
                                         $("#cc").html(data);                                                                        
                                        }
                                 }',),));
        }
        ?>
        <input type="hidden" name="id" value="<?php echo $model->id ?>">
        <div class="control-group example-register" >
            <label class="control-label"></label>
            <div class="controls">
                <div class="well">
                    <ul>
                        <li><span class="label">{code}</span>  Mengembalikan ke field Nomor Identitas</li>
                        <li><span class="label">{name}</span>  Mengembalikan ke field Nama</li>
                        <li><span class="label">{address}</span>  Mengembalikan ke field Alamat</li>
                        <li><span class="label">{bank_name}</span>  Mengembalikan ke field Nama Bank , etc BCA, Mandiri, BRI</li>
                        <li><span class="label">{bank_account}</span>  Mengembalikan ke field Nomor Rekening Pemilik</li>
                        <li><span class="label">{bank_account_name}</span>  Mengembalikan ke field Nama Rekening Pemilik</li>
                        <li><span class="label">{password}</span> Mengembalikan ke field password</li>
                        <li>Contoh : daftar#{address}#{name}#{bank_name}#{bank_account}#{bank_account_name}#{password}</li>
                    </ul>
                </div>
            </div>        
        </div>
        <div class="control-group example-update" >
            <label class="control-label"></label>
            <div class="controls">
                <div class="well">
                    <ul>
                        <li><span class="label">{code}</span>  Mengembalikan ke field Nomor Identitas</li>
                        <li><span class="label">{name}</span>  Mengembalikan ke field Nama</li>
                        <li><span class="label">{address}</span>  Mengembalikan ke field Alamat</li>
                        <li><span class="label">{bank_name}</span>  Mengembalikan ke field Nama Bank , etc BCA, Mandiri, BRI</li>
                        <li><span class="label">{bank_account}</span>  Mengembalikan ke field Nomor Rekening Pemilik</li>
                        <li><span class="label">{bank_account_name}</span>  Mengembalikan ke field Nama Rekening Pemilik</li>
                        <li><span class="label">{password}</span> Mengembalikan ke field password</li>
                        <li><span class="label">{password_new}</span> Mengembalikan ke field password baru</li>
                        <li>Contoh : update#{address}#{name}#{bank_name}#{bank_account}#{bank_account_name}#{password}#{password_new}</li>
                    </ul>
                </div>
            </div>        
        </div>
        <div class="control-group example-saldo" style="display:none">
            <label class="control-label"></label>
            <div class="controls">
                <div class="well">
                    <ul>
                        <li>Contoh : saldo</li>
                    </ul>
                </div>
            </div>        
        </div>
        <div class="control-group example-transfer" style="display:none">
            <label class="control-label"></label>
            <div class="controls">
                <div class="well">
                    <ul>
                        <li><span class="label">{amount}</span>  Mengembalikan ke field amount</li>
                        <li><span class="label">{phone}</span>  Mengembalikan ke field phone</li>
                        <li><span class="label">{password}</span> Mengembalikan ke field password</li>

                        <li>Contoh : transfer#{password}#{amount}#{phone}</li>
                    </ul>
                </div>
            </div>        
        </div>
        <div class="control-group example-play2d" style="display:none">
            <label class="control-label"></label>
            <div class="controls">
                <div class="well">
                    <ul>
                        <li><span class="label">{output}</span>  Mengembalikan ke field keluaran server angka</li>
                        <li><span class="label">{number}</span>  Mengembalikan ke field Number</li>
                        <li><span class="label">{amount}</span>  Mengembalikan ke field Amount</li>
                        <li><span class="label">{password}</span> Mengembalikan ke field password</li>

                        <li>Contoh : pasang2d#{password}#{output}#{number}#{amount}</li>
                    </ul>
                </div>
            </div>        
        </div>
        <div class="control-group example-play3d" style="display:none">
            <label class="control-label"></label>
            <div class="controls">
                <div class="well">
                    <ul>
                        <li><span class="label">{output}</span>  Mengembalikan ke field keluaran server angka</li>
                        <li><span class="label">{number}</span>  Mengembalikan ke field Number</li>
                        <li><span class="label">{amount}</span>  Mengembalikan ke field Amount</li>
                        <li><span class="label">{password}</span> Mengembalikan ke field password</li>

                        <li>Contoh : pasang3d#{password}#{output}#{number}#{amount}</li>
                    </ul>
                </div>
            </div>        
        </div>
        <div class="control-group example-play4d" style="display:none">
            <label class="control-label"></label>
            <div class="controls">
                <div class="well">
                    <ul>
                        <li><span class="label">{output}</span>  Mengembalikan ke field keluaran server angka</li>
                        <li><span class="label">{number}</span>  Mengembalikan ke field Number</li>
                        <li><span class="label">{amount}</span>  Mengembalikan ke field Amount</li>
                        <li>Contoh : pasang4d#{output}#{number}#{amount}</li>
                    </ul>
                </div>
            </div>        
        </div>
        <div class="control-group example-deposit" style="display:none">
            <label class="control-label"></label>
            <div class="controls">
                <div class="well">
                    <ul>
                        <li><span class="label">{amount}</span>  Mengembalikan ke field Jumlah</li>
                        <li><span class="label">{bank_account}</span>  Mengembalikan ke tujuan transfer</li>
                        <li>Contoh : deposit#{amount}</li>
                    </ul>
                </div>
            </div>        
        </div>
        <div class="control-group example-withdrawal" style="display:none">
            <label class="control-label"></label>
            <div class="controls">
                <div class="well">
                    <ul>
                        <li><span class="label">{amount}</span>  Mengembalikan ke field Jumlah</li>
                        <li>Contoh : withdrawal#{amount}</li>
                    </ul>
                </div>
            </div>        
        </div>
        <div class="control-group example-playresult" style="display:none">
            <label class="control-label"></label>
            <div class="controls">
                <div class="well">
                    <ul>
                        <li><span class="label">{output}</span>  Mengembalikan ke field keluaran server angka</li>
                        <li>Contoh : rekap#{output}</li>
                    </ul>
                </div>
            </div>        
        </div>

        <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255, 'hint' => 'Pemisah antar keyword menggunakan <b>#</b>, Huruf kecil/besar tidak dipermasalahkan')); ?>

        <?php echo $form->textAreaRow($model, 'description', array('class' => 'span5', 'maxlength' => 255)); ?>

        <legend>Keywords Configuration</legend>

        <span id="cc">
            <?php
            if ($model->isNewRecord == false) {

                $this->renderPartial('_keywordConfig', array('type' => $model->type, 'model' => $model));
            }
            ?>
        </span>



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
<script>
    function hideAll() {
        $(".example-reply-all").hide();
        $(".example-register").hide();
        $(".example-saldo").hide();
        $(".example-transfer").hide();
        $(".example-play2d").hide();
        $(".example-play3d").hide();
        $(".example-play4d").hide();
        $(".example-deposit").hide();
        $(".example-withdrawal").hide();
        $(".example-playresult").hide();
        $(".example-update").hide();
        $(".generate").hide();
        $(".enabled").hide();
        $(".roles").hide();
        $(".saldo").hide();
        $(".reply-saldo").hide();
    }

    $("#SmsKeyword_type").on("change", function() {
        hideAll();
        if ($(this).val() == "register") {
            $(".example-register").fadeIn();
            $(".generate").fadeIn();
            $(".enabled").fadeIn();
        }
        if ($(this).val() == "update") {
            $(".example-update").fadeIn();
            $(".generate").fadeIn();
            $(".enabled").fadeIn();
        }
        if ($(this).val() == "saldo") {
            $(".example-saldo").fadeIn();
            $(".generate").fadeOut();
            $(".enabled").fadeOut();

        }
        if ($(this).val() == "transfer") {
            $(".example-transfer").fadeIn();
            $(".reply-transfer").fadeIn();
        }
        if ($(this).val() == "2d") {
            $(".example-play2d").fadeIn();
            $(".reply-play2d").fadeIn();
        }
        if ($(this).val() == "3d") {
            $(".example-play3d").fadeIn();
            $(".reply-play2d").fadeIn();
        }
        if ($(this).val() == "4d") {
            $(".example-play4d").fadeIn();
            $(".reply-play2d").fadeIn();
        }
        if ($(this).val() == "deposit") {
            $(".example-deposit").fadeIn();
            $(".roles").fadeIn();
            $(".saldo").fadeIn();
            $(".reply-deposit").fadeIn();
        }
        if ($(this).val() == "withdrawal") {
            $(".example-withdrawal").fadeIn();
            $(".roles").fadeIn();
            $(".saldo").fadeIn();
            $(".reply-withdrawal").fadeIn();
        }
        if ($(this).val() == "playresult") {
            $(".example-playresult").fadeIn();
            $(".reply-playresult").fadeIn();
        }
    });

    $("#SmsKeyword_type").trigger('change');
</script>