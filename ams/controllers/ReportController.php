<?php

class ReportController extends Controller {

    public $breadcrumbs;
    public $layout = 'main';


    public function actionExamReport() {
//        $modelClassroom = new Classroom;
//        $modelExam = new Exam;
//        $this->render('examReport', array('modelClassroom'=>$modelClassroom,'modelExam'=>$modelExam));
        $modelClassroom = new Classroom;
        if (isset($_POST['Classroom'])) {
            $modelClassroom->attributes = $_POST['Classroom'];
        }

//        trace($modelClassroom->id);

        $modelExam = new Exam;
        if (isset($_POST['Exam'])) {
            $modelExam->attributes = $_POST['Exam'];
        }
        $this->render('examReport', array('modelClassroom' => $modelClassroom, 'modelExam' => $modelExam));
    }

    public function actionDynaYear() {
        $t_data = Classroom::model()->findAll('school_year_id=:school_year_id', array(':school_year_id' => (int) $_POST['Classroom']['school_year_id']));
        $data = CHtml::listData($t_data, 'id', 'name');
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function actionGenerateExcelTestResult() {
        $exam = $_GET['exam_id'];
        $classroom = str_replace(".html", "", $_GET['classroom_id']);
        $class = Classroom::model()->findByPk($classroom);
        $exams = Exam::model()->findByPk($exam);
        $userClassroom = UserClassroom::model()->findAll(array('condition' => 'classroom_id=' . $classroom));
//        $testResult = TestResult::model()->findAll(array('condition' => 'exam_id=' . $exam . ' AND is_fix=1'));
        $test = Test::model()->findAll(array('condition' => 'classroom_id=' . $classroom . ' AND exam_id=' . $exam, 'order' => 'id'));
        $test_id = array();
        foreach ($test as $o) {
            $test_id[] = $o->id;
        }

        if (empty($test_id)) {
            $arrTestResult = array();
            $testResult = array();
        } else {
            $testResult = TestResult::model()->findAll(array('condition' => 'test_id IN (' . implode(',', $test_id) . ')'));
        }

        $arrTestResult = array();
        foreach ($testResult as $o) {
            $arrTestResult[$o->test_id][$o->user_id] = array('id' => $o->id, 'result' => $o->result, 'is_fix' => $o->is_fix);
        }
        Yii::app()->request->sendFile('laporan-nilai-' . date('YmdHis') . '.xls', $this->renderPartial('excelReportTestResult', array('userClassroom' => $userClassroom, 'arrTestResult' => $arrTestResult, 'class' => $class, 'exam' => $exams,'test'=>$test), true)
        );
    }

}

?>
