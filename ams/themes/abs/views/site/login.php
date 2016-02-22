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
        height: 44px;
        width: 44px;
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
    <h1>Login Absensi Online</h1>

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

        <input class="span2"  name="LoginForm[username]" id="LoginForm_username" type="text" placeholder="Username" required>

        <i class="icon-user">

        </i>
    </p>

    <p class="field">
        <?php // echo $form->passwordField($model, 'password', array('class' => 'span12')); ?>
        <?php // echo $form->error($model, 'password'); ?>
        <input class="span2"  name="LoginForm[password]" id="LoginForm_password" placeholder="password" type="password" required>
        <i class="icon-lock">
            <span class="glyphicon glyphicon-lock"></span>
        </i>
    </p>

    <p class="submit">
        <button type="submit" class="btn btn-danger" type="button">Login</button>
    </p>



    <?php $this->endWidget(); ?>
</div> <!--/ Login-->
<div class="copyright">
    <p>Copyright &copy; 2015. Created by <a href="www.landa.co.id" target="_blank">Landa System</a></p>
</div>