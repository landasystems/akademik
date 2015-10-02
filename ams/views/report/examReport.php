<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'results',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>
<?php
$this->setPageTitle('Results');
$this->breadcrumbs = array(
    'Results',
);

//$exam_category_id = (isset($model->Exam->exam_category_id)) ? $model->Exam->exam_category_id : 0;
//$school_year_id = (isset($model->Classroom->school_year_id)) ? $model->Classroom->school_year_id : 0;
?>

<div class="well">
    <div class="row-fluid">
        <div class="span6">
            <div class="control-group ">
                <?php
                echo CHtml::activeLabel($modelClassroom, 'school_year_id', array('class' => 'control-label'));
                ?>
                <div class="controls">
                    <?php
                    echo CHtml::dropDownList('Classroom[school_year_id]', $modelClassroom->school_year_id, CHtml::listData(SchoolYear::model()->findAll(), 'id', 'school_year'), array(
                        'empty' => t('choose', 'global'),
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createUrl('report/dynayear'),
                            'update' => '#Classroom_id',
                            
                        ),'label'=>'sdfsdf'
                    ));
                    ?>  
                </div>
            </div>

            <?php echo $form->dropDownListRow($modelClassroom, 'id', CHtml::listData(Classroom::model()->findAll('school_year_id=:school_year_id', array(':school_year_id' => (int) $modelClassroom->school_year_id)), 'id', 'name'),array('class' => 'span6','labelOptions'=>array('label'=>'Kelas'))); ?>
        </div>
        <div class="span6">
            <div class="control-group ">
                <?php
                echo CHtml::activeLabel($modelExam, 'exam_category_id', array('class' => 'control-label'));
                ?>
                <div class="controls">
                    <?php
                    echo CHtml::dropDownList('Exam[exam_category_id]', $modelExam->exam_category_id, CHtml::listData(ExamCategory::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname'), array(
                        'class' => 'span8',
                        'empty' => t('choose', 'global'),
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createUrl('exam/dynaexam'),
                            'update' => '#Exam_id',
                        ),
                    ));
                    ?>  
                </div>
            </div>

            <?php echo $form->dropDownListRow($modelExam, 'id', CHtml::listData(Exam::model()->findAll('exam_category_id=:exam_category_id', array(':exam_category_id' => (int) $modelExam->exam_category_id)), 'id', 'name'), array('class' => 'span8','labelOptions'=>array('label'=>'Soal'))); ?>

        </div>
    </div>
    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'icon' => 'ok white',
            'label' => 'View Report',
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>
</div>

<?php
if (isset($_POST['Exam']['id']) && isset($_POST['Classroom']['id'])  ) {
//    $classname = $_POST['Classroom']['name'];
    $user_classroom = UserClassroom::model()->findAll(array('condition' => 'classroom_id=' . $_POST['Classroom']['id']));
//    $testResult = TestResult::model()->findAll(array('condition'=>'exam_id='. $_POST['Exam']['id'].' AND is_fix=1'));
    $test = Test::model()->findAll(array('condition'=>'classroom_id='.$_POST['Classroom']['id'].' AND exam_id='. $_POST['Exam']['id'], 'order'=>'id'));  
    $test_id = array();
    foreach ($test as $o){
        $test_id[] = $o->id;
    }
    
    if (empty($test_id)){
        $arrTestResult = array();
        $testResult = array();
    }else{
        $testResult = TestResult::model()->findAll(array('condition'=>'test_id IN ('.  implode(',', $test_id).')'));
    }
    
    $arrTestResult = array();
    foreach($testResult as $o){
        $arrTestResult[$o->test_id][$o->user_id] = array('id'=> $o->id, 'result'=> $o->result, 'is_fix'=>$o->is_fix);
    }
    $class = Classroom::model()->findByPk($_POST['Classroom']['id']);
    $exam = Exam::model()->findByPk($_POST['Exam']['id']);
    $this->renderPartial('_examReportResult', array('userClassroom' => $user_classroom, 'arrTestResult'=>$arrTestResult,'classroom'=>$class->name,'schoolyear'=>$class->SchoolYear->school_year,
        'examCategory'=>$exam->ExamCategory->name,'exam'=>$exam->name,'test'=>$test));
}
?>

