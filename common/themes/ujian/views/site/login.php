<style>
  
    #login-form .field {
        position: relative;
        margin: 0 50px;
    }

    #login-form .field i {
        font-size: 14px;
        left: 0px;
        top: 0px;
        position: absolute;
        height: 40px;
        width: 40px;
        color: #f7f3eb;
        background: #676056;
        text-align: center;
        line-height: 44px;
        transition: all 0.3s ease-out;
        pointer-events: none;
    }
</style>
<center><div class="logo"></center>
<div class="login"> <!-- Login -->
    <h1>UJIAN ONLINE</h1>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>
    <?php // echo $form->error($model, 'username'); ?>

    <p class="field">
        <?php // echo $form->textField($model, 'username', array('class' => 'span12','required')); ?>
         <!--<input type="hidden" name="uo" value="uo">-->
        <input class="span2"  name="LoginForm[username]" id="LoginForm_username" type="text" placeholder="Nomor Induk Siswa" required>

        <i class="icon-user">

        </i>
    </p>

    <p class="field">
        <?php // echo $form->passwordField($model, 'password', array('class' => 'span12')); ?>
        <?php // echo $form->error($model, 'password'); ?>
        <input class="span2"  name="LoginForm[password]" id="LoginForm_password" placeholder="Masukkan Password" type="password" required>
        <i class="icon-lock">
            <span class="glyphicon glyphicon-lock"></span>
        </i>
    </p>

    <p class="submit">
        <button type="submit" class="btn btn-success" type="button">Mulai Ujian</button>
    </p>

    <p class="well" style="text-align: justify">
        <span class="label label-warning">PERHATIAN</span> Kecurangan yang dilakukan ke dalam systems dalam ujian online ini akan terekam, bagi siapapun yang mencoba melakukan kecurangan untuk ujian online. Nilai siswa yang bersangkutan akan kami hapus secara otomatis & kami laporkan kepada Wali Muridnya.
    </p>
    
    <?php $this->endWidget(); ?>
</div> <!--/ Login-->

