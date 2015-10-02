<?php

class TestResultController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // c
                'actions' => array('create'),
                'expression' => 'app()->controller->isValidAccess("TestResult","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("TestResult","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("TestResult","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("TestResult","d")'
            )
        );
    }

    public function loadModel($id) {
        $model = TestResult::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionIndex() {
        $modelClassroom = new Classroom;
        if (isset($_POST['Classroom'])) {
            $modelClassroom->attributes = $_POST['Classroom'];
        }

//        trace($modelClassroom->id);

        $modelExam = new Exam;
        if (isset($_POST['Exam'])) {
            $modelExam->attributes = $_POST['Exam'];
        }
        $this->render('results', array('modelClassroom' => $modelClassroom, 'modelExam' => $modelExam));
    }

    public function actionUpdateFix($id) {
        $model = $this->loadModel($id);

        //update user id & exam id which same to is_fix false
        $modelUpdate = TestResult::model()->findAll(array('condition' => 'user_id=' . $model->user_id . ' AND exam_id=' . $model->exam_id));
        foreach ($modelUpdate as $o) {
            $o->is_fix = 0;
            $o->save();
        }

        //save is_fix which on click
        $model->is_fix = 1;
        $model->save();
    }

    public function actionDelete($id) {
//        logs($id);
//            delete test result detail
        TestResultDetail::model()->deleteAll(array('condition' => 'test_result_id=' . $id));

        //delete test result
        $this->loadModel($id)->delete();
    }

    public function actionView($id) {
//        $modelTest = Test::model()->findByPk($id);
        $model = TestResult::model()->findByPk($id);
        if (empty($model))
            throw new CHttpException(403, 'Data Not Found.');
        
        $modelTestResultDetail = TestResultDetail::model()->findAll(array('condition' => 'test_result_id=' . $model->id . ' AND correct=1'));
        $_SESSION['exam_detail_answer'] = array();

        $this->render('view', array(
            'model' => $model,
//            'modelTest' => $modelTest,
            'modelTestResultDetail' => $modelTestResultDetail,
            'modelExamDetail' => ExamDetail::model()->findAll(array('condition' => 'exam_id=' . $model->Test->exam_id, 'order' => 'number', 'index' => 'id')),
            'exam_detail_answer' => TestResultDetail::model()->findAll(array('condition' => 'test_result_id=' . $model->id, 'index' => 'exam_detail_id'))
        ));
    }

}

?>