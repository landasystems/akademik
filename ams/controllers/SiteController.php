<?php

class SiteController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('error', 'login', 'logout', 'icons'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        if (user()->roles_id == 1 || user()->roles_id == -1) {
            $this->layout = 'main';
            $this->render('index');
        }else{
            $this->redirect(url('test/onGoing'));
        }
    }

    public function actionTest() {
        $model = Test::model()->findAll(array('condition' => 'time_start <="' . date('H:i:s') . '" AND time_end >= "' . date('H:i:s') . '" AND (classroom_id=' . app()->session['global']['classroom_id'] . ' OR created_user_id=' . user()->id . ') AND date_test="' . date('Y-m-d') . '"'));
        $this->render('test', array(
            'model' => $model,
        ));
    }

    public function actionIcons() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
//        Yii::import("xupload.models.XUploadForm");
//        $model = new XUploadForm;
//        $this -> render('index', array('model' => $model, ));
        $this->layout = 'main';
        $this->render('themes/icons');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $this->layout = 'blank';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        //disable login page if logged
//        if (isset(user()->id)) {
//            $this->redirect(Yii::app()->user->returnUrl);
//        }


        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
//                $siteConfig = SiteConfig::model()->listSiteConfig();
                $ses = array();
                $ses['classroom_id'] = UserClassroom::model()->fieldClassroom_id;
                Yii::app()->session['global'] = $ses;

                //create user log
                $userLog = new UserLog;
                $userLog->save();

                $this->redirect(bu('index.php'));
            }
        }
        // display the login form
        $this->layout = 'blankHeader';
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        app()->cache->flush();
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->baseUrl . '/site/login.html');
    }

}
