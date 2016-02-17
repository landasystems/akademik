<?php

class SmsKeywordController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

  

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
    public function actionKeywordConfiguration(){
        Yii::app()->clientScript->reset();
        Yii::app()->clientScript->corePackages = array();
        
        $smsKey = SmsKeyword::model()->findByPk($_POST['id']);
//        $model = json_decode($smsKey->options);
//        $model = json_decode($smsKey->autoreplys);
        $type = $_POST['SmsKeyword']['type'];
//         $this->renderPartial('_keywordConfig');
         $this->renderPartial('_keywordConfig',array('type'=>$type,'smsKey'=>$smsKey),false,true);
//        }
    }


    public function actionCreate() {
        $model = new SmsKeyword;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SmsKeyword'])) {
            $model->attributes = $_POST['SmsKeyword'];
            $model->name = strtolower($model->name);
            $model->options = (isset($_POST['options'])) ? json_encode($_POST['options']) : '[]';
            $model->autoreplys = (isset($_POST['autoreplys'])) ? json_encode($_POST['autoreplys']) : '[]';

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
        $model = $this->loadModel($id);
        $model->options = json_decode($model->options) ;
        $model->autoreplys = json_decode($model->autoreplys);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SmsKeyword'])) {
            $model->attributes = $_POST['SmsKeyword'];
            $model->name = strtolower($model->name);
            $model->options = (isset($_POST['options'])) ? json_encode($_POST['options']) : '[]';
            $model->autoreplys = (isset($_POST['autoreplys'])) ? json_encode($_POST['autoreplys']) : '[]';
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
            $this->loadModel($id)->delete();

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

        $model = new SmsKeyword('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['SmsKeyword'])) {
            $model->attributes = $_GET['SmsKeyword'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->description))
                $criteria->addCondition('description = "' . $model->description . '"');


            if (!empty($model->type))
                $criteria->addCondition('type = "' . $model->type . '"');


            if (!empty($model->options))
                $criteria->addCondition('options = "' . $model->options . '"');


            if (!empty($model->autoreplys))
                $criteria->addCondition('autoreplys = "' . $model->autoreplys . '"');
        }
        $session['SmsKeyword_records'] = SmsKeyword::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new SmsKeyword('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SmsKeyword']))
            $model->attributes = $_GET['SmsKeyword'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = SmsKeyword::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sms-keyword-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

  

}
