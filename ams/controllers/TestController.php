<?php

class TestController extends Controller {

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
                'expression' => 'app()->controller->isValidAccess("Test","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view', 'stats', 'statsLi'),
                'expression' => 'app()->controller->isValidAccess("Test","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("Test","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("Test","d")'
            ),
            array('allow', // read for , mulai ujian
                'actions' => array('onGoing', 'finish', 'go'),
                'expression' => 'app()->controller->isValidAccess("Ongoing","r")'
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->actionStats($id);
//        $this->render('view', array(
//            'model' => $this->loadModel($id),
//        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        cs()->registerScript('test', '
                    
                    $("#Test_time_start").timepicker({"disableFocus":true,"showMeridian":false}).on("changeTime.timepicker", function(e) {
                          var $minute = (parseInt(e.time.minutes) + parseInt($("#period").val()))%60;
                          var $hour = parseInt((parseInt(e.time.minutes) + parseInt($("#period").val()))/60);
                          $("#Test_time_end").timepicker("setTime", e.time.hours + $hour + ":" + $minute);
                    });
                    $("#Test_time_end").timepicker({"disableFocus":true,"showMeridian":false});
                ');

        $model = new Test;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Test'])) {
            $model->attributes = $_POST['Test'];
            $model->date_test = date('Y-m-d', strtotime($model->date_test));


            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        cs()->registerScript('test', '
                    
                    $("#Test_time_start").timepicker({"disableFocus":true,"showMeridian":false}).on("changeTime.timepicker", function(e) {
                          var $minute = (parseInt(e.time.minutes) + parseInt($("#period").val()))%60;
                          var $hour = parseInt((parseInt(e.time.minutes) + parseInt($("#period").val()))/60);
                          $("#Test_time_end").timepicker("setTime", e.time.hours + $hour + ":" + $minute);
                    });
                    $("#Test_time_end").timepicker({"disableFocus":true,"showMeridian":false});
                ');

        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Test'])) {
            $model->attributes = $_POST['Test'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            Test::model()->deleteRec($id);

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Test('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Test'])) {
            $model->attributes = $_GET['Test'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->classroom_id))
                $criteria->addCondition('classroom_id = "' . $model->classroom_id . '"');


            if (!empty($model->exam_id))
                $criteria->addCondition('exam_id = "' . $model->exam_id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->description))
                $criteria->addCondition('description = "' . $model->description . '"');


            if (!empty($model->date_test))
                $criteria->addCondition('date_test = "' . $model->date_test . '"');


            if (!empty($model->time_start))
                $criteria->addCondition('time_start = "' . $model->time_start . '"');


            if (!empty($model->time_end))
                $criteria->addCondition('time_end = "' . $model->time_end . '"');


            if (!empty($model->exam_total))
                $criteria->addCondition('exam_total = "' . $model->exam_total . '"');


            if (!empty($model->created))
                $criteria->addCondition('created = "' . $model->created . '"');


            if (!empty($model->created_user_id))
                $criteria->addCondition('created_user_id = "' . $model->created_user_id . '"');


            if (!empty($model->modified))
                $criteria->addCondition('modified = "' . $model->modified . '"');
        }
        $session['Test_records'] = Test::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionOnGoing() {
        $this->layout = 'mainWide';
        $model = Test::model()->findAll(array('condition' => 'time_start <="' . date('H:i:s') . '" AND time_end >= "' . date('H:i:s') . '" AND (classroom_id=' . app()->session['global']['classroom_id'] . ' OR created_user_id=' . user()->id . ') AND date_test="' . date('Y-m-d') . '"'));
        $this->render('ongoing', array(
            'model' => $model,
        ));
    }

    public function actionStats($id) {
        $model = Test::model()->findByPk($id);

//        landa()->selfAccess($model->created_user_id);

        $this->render('stats', array(
            'model' => $model,
        ));
    }

    public function actionStatsLi($id) {
        echo $this->renderPartial('_statsLi', array('test_id' => $id));
    }

    public function actionGo($id) {
        $this->layout = 'mainWide';
        cs()->registerScript('', '$(".alert .close").live("click", function(e) {
                    $(this).parent().fadeOut();
                });
                
                function undelegatedAnswer() {
                    $("body").undelegate("#optionA","click")
                    $("body").undelegate("#optionB","click")
                    $("body").undelegate("#optionC","click")
                    $("body").undelegate("#optionD","click")
                    $("body").undelegate("#optionE","click")
                    $("body").undelegate("#optionF","click")
                }
                
                function clearAnswer(){
                    $("#a .lbl").html("");
                    $("#b .lbl").html("");
                    $("#c .lbl").html("");
                    $("#d .lbl").html("");
                    $("#e .lbl").html("");
                    $("#f .lbl").html("");
                }
                
                $(document).bind("contextmenu",function(e){
                        e.preventDefault();
                    });
', CClientScript::POS_BEGIN);
        cs()->registerCss('', '#number{margin-right:10px; font-weight:bold;font-size: 18px;}
                              #answer{margin-left:25px}
                              #question{margin:5px 5px 15px -25px ;font-size:18px}
                              #question p{font-size:18px}
                              
                              .liUjian li{
                                border: 1px solid #ccc;
                                padding: 5px;
                              }
                              .liUjian input{
                                display: inline !important;
                              }
                              
            ');

        $session = new CHttpSession;
        $session->open();
        
        //pengecekan user di kelas tersebut ada ujiannya atau tidak
        $model = Test::model()->findAll(array('condition' => 'id=' . $id . ' AND time_start <="' . date('H:i:s') . '" AND time_end >= "' . date('H:i:s') . '" AND (classroom_id=' . app()->session['global']['classroom_id'] . ' OR created_user_id=' . user()->id . ') AND date_test="' . date('Y-m-d') . '"'));
        if (empty($model)) {
            throw new CHttpException(403, 'Anda tidak mempunyai akses untuk melakukan ujian ini!');
        }

        $model = TestResult::model()->find(array('condition' => 'test_id=' . $id . ' AND user_id=' . user()->id));
        $modelTest = Test::model()->findByPk($id);
        //insert test result
        if (empty($model)) {
//            $modelExamLoop = TestResult::model()->find(array('condition' => 'exam_id=' . $modelTest->exam_id . ' AND user_id=' . user()->id));

            $model = new TestResult;
            $model->test_id = $id;
            $model->time_start = date('H:i:s');
            $model->exam_id = $modelTest->exam_id;
//            $model->is_fix = (empty($modelExamLoop)) ? 1 : 0;
            $model->is_fix = 0;
            $model->save();

            unset($session['test_result_id']);
            unset($session['examDetail']);
            unset($session['test_id']);
        }

        //check if time end has value, so the student have examination this exam && check if time server more than time end
        if (!empty($model->time_end) || (strtotime(date('Y-m-d H:i:s')) > strtotime($modelTest->date_test . ' ' . $modelTest->time_end)))
            $this->redirect(url('test/finish/' . $id));

        //check only the user_id can access
        landa()->selfAccess($model->user_id);

        if (!isset($session['examDetail'])) {
            $session['test_result_id'] = $model->id;
            //stored to the examdetail for the choose exam
            $modelExamDetail = ExamDetail::model()->findAll(array('condition' => 'exam_id=' . $modelTest->exam_id, 'order' => 'number', 'index' => 'id'));
            $session['examDetail'] = landa()->shuffle_assoc($modelExamDetail);
            $session['test_id'] = $modelTest->id;
        }

        $this->render('go', array(
            'model' => $modelTest,
            'modelExamDetail' => $session['examDetail'],
        ));
    }

    public function actionFinish($id) {
        cs()->registerScript('', '
                $(document).bind("contextmenu",function(e){
                        e.preventDefault();
                    });
', CClientScript::POS_BEGIN);
//        landa()->selfAccess();
        $this->layout = 'mainWide';

        $modelTest = Test::model()->findByPk($id);
        $model = TestResult::model()->find(array('condition' => 'test_id=' . $id . ' AND user_id=' . user()->id));
        if (empty($model))
            throw new CHttpException(403, 'You are not authorized to perform this action.');

        $modelTestResultDetail = TestResultDetail::model()->findAll(array('condition' => 'test_result_id=' . $model->id . ' AND correct=1'));

        $model->result = round((count($modelTestResultDetail) / $modelTest->exam_total) * $modelTest->result_max);
        $model->correct_total = count($modelTestResultDetail);
        $model->time_end = date('H:i:s');
        $model->save();
//        trace($model->user_id);  
//        $model->result = 5;
//        $model->correct_total = 4;
//        $model->time_end = date('H:i:s');
//        $model->save();      
        //clean session
        $_SESSION['exam_detail_answer'] = array();

        $this->render('finish', array(
            'model' => $model,
            'modelTest' => $modelTest,
            'modelTestResultDetail' => $modelTestResultDetail,
            'modelExamDetail' => ExamDetail::model()->findAll(array('condition' => 'exam_id=' . $modelTest->exam_id, 'order' => 'number', 'index' => 'id')),
            'exam_detail_answer' => TestResultDetail::model()->findAll(array('condition' => 'test_result_id=' . $model->id, 'index' => 'exam_detail_id'))
        ));
    }

    public function actionResultDetail($id) {
        // exam id stored in session
//        session_start();
//        $session = session();
//        if (empty($session['exam_detail_answer'])){
//            $session['exam_detail_answer'] = array($id => $_POST['choice']);
//        }
        if (!isset($_SESSION['exam_detail_answer'])) {
            $_SESSION['exam_detail_answer'] = array($id => $_POST['choice']);
        } else {
            $_SESSION['exam_detail_answer'][$id] = $_POST['choice'];
        }

//        if (in_array($id, $session['exam_detail_answer'])){
//            $session['exam_detail_answer'][$id] = 'AAAAA';
//        }else{
//            $session['exam_detail_answer'] = $session['exam_detail_answer'] + array($id => $_POST['choice']);
//        }

        $model = TestResultDetail::model()->find(array('condition' => 'test_result_id=' . $_SESSION['test_result_id'] . ' AND exam_detail_id=' . $id));
        $modelExamDetail = ExamDetail::model()->findByPk($id);
        
        $modelTestResult = TestResult::model()->findByPk($_SESSION['test_result_id']);

        //check if time end has value, so the student have examination this exam && check if time server more than time end
        if (!empty($modelTestResult->time_end) || (strtotime(date('Y-m-d H:i:s')) > strtotime($modelTestResult->Test->date_test . ' ' . $modelTestResult->Test->time_end))){
//        if (!empty($model->TestResult->time_end) || (strtotime(date('Y-m-d H:i:s')) > strtotime($model->TestResult->Test->date_test . ' ' . $model->TestResult->Test->time_end))){
            echo "refresh";
//            logs("aaa");
            return false;
//            logs("ccc");
        }
//        logs("bbb");

        //check only the user_id can access
//        landa()->selfAccess($model->TestResult->user_id);
        
        // edit or save the test result detail
        if (empty($model)) {
            $model = new TestResultDetail;
        }
        $model->test_result_id = $_SESSION['test_result_id'];
        $model->exam_detail_id = $id;
        $model->answer = $_POST['choice'];
        $model->correct = ($_POST['choice'] == $modelExamDetail->correct) ? 1 : 0;
        $model->number = $_POST['number'];
        $model->save();

        //update correct total
//        $model = TestResult::model()->findByPk($_SESSION['test_result_id'] );
//        $model->correct_total += ;
        //set the choice to session
//        $session = session();
//        $examDetail = $session['examDetail'];
//        $examDetailAttr = $examDetail[$id];
//        $examDetailAttr->answer = 'aaa';
//        $examDetail[$id] = $examDetailAttr;
    }

    /**
     * Manages all models.
     */
//    public function actionAdmin() {
//        $model = new Test('search');
//        $model->unsetAttributes();  // clear any default values
//        if (isset($_GET['Test']))
//            $model->attributes = $_GET['Test'];
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
        $model = Test::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'test-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
   
    
    public function actionDynaClass() {
        $t_data = Classroom::model()->findAll('school_year_id=:school_year_id', array(':school_year_id' => (int) $_POST['cc']));
        $data = CHtml::listData($t_data, 'id', 'name');
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }
    public function actionDynaExam() {
        $t_data = Exam::model()->findAll('school_year_id=:school_year_id', array(':school_year_id' => (int) $_POST['school_year_id']));
        $data = CHtml::listData($t_data, 'id', 'name');
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

}
