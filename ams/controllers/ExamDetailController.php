<?php

class ExamDetailController extends Controller {

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
                'expression' => 'app()->controller->isValidAccess("Exam","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("Exam","r")'
            ),
            array('allow', // u
                'actions' => array('index', 'update'),
                'expression' => 'app()->controller->isValidAccess("Exam","u")'
            ),
            array('allow', // d
                'actions' => array('index', 'delete'),
                'expression' => 'app()->controller->isValidAccess("Exam","d")'
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id) {
//        cs()->registerScript('', '
//                var c = 0;
//                $("#copylink").on("click",function(){
//                    alert($("#answer").html());
//                    $("#answer .add-on").last().html(c);
//                    c += 1;
//                });
//             ');

        $model = new ExamDetail;
        $modelExam = Exam::model()->findByPk($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ExamDetail'])) {
            $model->attributes = $_POST['ExamDetail'];
            
            if ($model->type != 'narrative') {
                $modelExam->total += 1;
                $modelExam->save();
            }

            if (isset($_POST['ExamDetail'])) {
                $letters = range('A', 'F');
                $arrAnswer = array_combine($letters, $_POST['answer']);


                if ($model->type == 'narrative') {
                    $model->answer = null;
                } else {
                    $model->answer = json_encode($arrAnswer);
                }

                $model->save();
                $model = new ExamDetail;
            }
        }

        $modelExamDetail = ExamDetail::model()->findAll(array('condition' => 'exam_id=' . $id, 'order' => 'number'));

        $model->number = count($modelExamDetail) + 1;
        $model->correct = 'A';
        $model->type = 'choice';
        
        $this->render('create', array(
            'modelExam' => $modelExam,
            'modelExamDetail' => $modelExamDetail,
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ExamDetail'])) {
            $model->attributes = $_POST['ExamDetail'];
            if (isset($_POST['ExamDetail'])) {
                $letters = range('A', 'F');
                $arrAnswer = array_combine($letters, $_POST['answer']);

                if ($model->type == 'narrative') {
                    $model->answer = null;
                } else {
                    $model->answer = json_encode($arrAnswer);
                }

                $model->save();
            }
        }

        $modelExam = Exam::model()->findByPk($model->exam_id);
        $modelExamDetail = ExamDetail::model()->findAll(array('condition' => 'exam_id=' . $model->exam_id, 'order' => 'number'));
        $this->render('update', array(
            'modelExam' => $modelExam,
            'modelExamDetail' => $modelExamDetail,
            'model' => $model,
        ));
    }

    public function actionCreateSave() {
        //update total exam
        $modelExam = Exam::model()->findByPk($model->exam_id);

        $modelExam->total += 1;
        $modelExam->save();

        //save new exam detail
        $model = new ExamDetail;

        if (isset($_POST['ExamDetail'])) {
            $model->attributes = $_POST['ExamDetail'];
            $model->save();
        }
    }

    /**
     * Manages all models.
     */
//    public function actionAdmin() {
//        $model = new ExamDetail('search');
//        $model->unsetAttributes();  // clear any default values
//        if (isset($_GET['ExamDetail']))
//            $model->attributes = $_GET['ExamDetail'];
//
//        $this->render('admin', array(
//            'model' => $model,
//        ));
//    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = ExamDetail::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

//    public function actionJson($id) {
//
//        $session = new CHttpSession;
//        $session->open();
//
//        $model = $session['examDetail'][$id];
//        echo json_encode($model->getAttributes());
////        $model = ExamDetail::model()->findByPk($id);
////        echo json_encode($model->getAttributes());
//
//        Yii::app()->user->setFlash('success', "Your choice has been sent!");
//    }

    public function actionAnswer($id) {
        Yii::app()->clientScript->reset();
        Yii::app()->clientScript->corePackages = array();
//        logs($_GET);
        $session = new CHttpSession;
        $session->open();

        $model = $session['examDetail'][$id];
        $model = $model->getAttributes();

        //set choose answer if any
        $choose = '';
        if (isset($session['exam_detail_answer'][$id])) {
            $choose = $session['exam_detail_answer'][$id];
        }

        if ($model['type'] == 'narrative') {
            echo $model['question'];
        } else {
            $this->renderPartial('_answer', array('model' => $model, 'choose' => $choose, 'rn'=>$_GET['rn']), false, true);
        }
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);

        //update total exam number, if narrative no need to update
        if ($model->type == 'narrative') {
            
        } else {
            //update all which has higher number , min 1
            cmd('UPDATE acca_exam_detail SET number=number-1 WHERE number > ' . $model->number . ' AND exam_id=' . $_GET['exam_id'])->execute();

            $modelExam = Exam::model()->findByPk($_GET['exam_id']);
            $modelExam->total -= 1;
            $modelExam->save();
        }

        $model->delete();

        $this->redirect(url('examDetail/create/' . $_GET['exam_id']));
    }

}
