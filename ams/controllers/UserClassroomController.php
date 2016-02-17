<?php

class UserClassroomController extends Controller {

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
    public function actionCreate() {
        $model = new UserClassroom;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UserClassroom'])) {
            $model->attributes = $_POST['UserClassroom'];
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UserClassroom'])) {
            $model->attributes = $_POST['UserClassroom'];
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
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        if (!empty($_POST['classroom_id']) && !empty($_POST['school_year_id'])) {
            $model = new UserClassroom;

//            
            //firstly delete all user in class
            $model->deleteAll(array('condition' => 'classroom_id=' . $_POST['classroom_id']));
//            
            foreach ($_POST['box2View'] as $id) {
                $model = new UserClassroom;
                $model->classroom_id = $_POST['classroom_id'];
                $model->user_id = $id;
                $model->save();
            }

            Yii::app()->user->setFlash('success', "Data saved!");
        }

        $model = new UserClassroom;
        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new UserClassroom('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['UserClassroom']))
            $model->attributes = $_GET['UserClassroom'];

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
        $model = UserClassroom::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-classroom-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

  
    public function actionUser() {
        $t_data = UserClassroom::model()->findAll(array('condition' => 'classroom_id=' . $_POST['classroom_id']));
        echo landa()->option(CHtml::listData($t_data, 'user_id', 'User.name'), false);
    }

}
