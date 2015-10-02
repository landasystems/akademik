<?php
$this->setPageTitle('User Classrooms');
$this->breadcrumbs = array(
    'User Classrooms',
);
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'user-classroom-form',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
    }
?>

<div class="well">
    <h4>Filter : </h4>
    <div class="control-group ">
        <label class="control-label">School Year</label>
        <div class="controls">
            <?php
            echo CHtml::dropDownList('school_year_id', array(date('Y')), SchoolYear::model()->listData(), array(
                'empty' => t('choose', 'global'),
                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('classroom/dyna'),
                    'update' => '#classroom_id',
            )));
            ?>
        </div>
    </div>

    <div class="control-group ">
        <label class="control-label">Classroom</label>
        <div class="controls">
            <?php
            echo CHtml::dropDownList('classroom_id', array(), array(), array(
                'empty' => t('choose', 'global'),
                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('userClassroom/user'),
                    'update' => '#box2View',
            )));
            ?>
        </div>
    </div>
</div>  

<div class="well">
    <?php
    $this->widget('common.extensions.dualselect.DualSelect', array('title' => array('box1View' => 'haven`t get Classroom', 'box2View' => 'in Class'),
        'value' => array('box1View' => Classroom::model()->haventClass, 'box2View' => array())));
    ?>


    <div class="form-actions">

        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'icon' => 'ok white',
            'label' => 'Save',
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>
</div>