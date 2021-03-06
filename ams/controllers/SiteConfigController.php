<?php

class SiteConfigController extends Controller {

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
//    public function actionCreate() {
//        $model = new SiteConfig;
//
//        // Uncomment the following line if AJAX validation is needed
//        // $this->performAjaxValidation($model);
//
//        if (isset($_POST['SiteConfig'])) {
//            $model->attributes = $_POST['SiteConfig'];
//            if ($model->save())
//                $this->redirect(array('view', 'id' => $model->id));
//        }
//
//        $this->render('create', array(
//            'model' => $model,
//        ));
//    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        cs()->registerScript('tab', '$("#myTab a").click(function(e) {
                                        e.preventDefault();
                                        $(this).tab("show");
                                    })');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

       

        if (isset($_POST['SiteConfig'])) {
            $model->attributes = $_POST['SiteConfig'];
            $model->settings = (isset($_POST['SiteConfig'])) ? json_encode($_POST['SiteConfig']['settings']) : '[]';

            $file = CUploadedFile::getInstance($model, 'client_logo');
            if (is_object($file)) {
                $model->client_logo = Yii::app()->landa->urlParsing($model->client_name) . '.' . $file->extensionName;
            } else {
                unset($model->client_logo);
            }


            if ($model->save()) {
                if (is_object($file)) {
                    $file->saveAs('images/site/' . $model->client_logo);
                    app()->landa->createImg('site/', $model->client_logo, $model->id);
                }
                
                //clear session site
                unset(Yii::app()->session['site']);
                
                $this->redirect(array('view', 'id' => $model->id));
            }
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
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new SiteConfig('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['SiteConfig'])) {
            $model->attributes = $_GET['SiteConfig'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->client_name))
                $criteria->addCondition('client_name = "' . $model->client_name . '"');


            if (!empty($model->client_logo))
                $criteria->addCondition('client_logo = "' . $model->client_logo . '"');


            if (!empty($model->language_default))
                $criteria->addCondition('language_default = "' . $model->language_default . '"');


            if (!empty($model->city_id))
                $criteria->addCondition('city_id = "' . $model->city_id . '"');


            if (!empty($model->address))
                $criteria->addCondition('address = "' . $model->address . '"');


            if (!empty($model->phone))
                $criteria->addCondition('phone = "' . $model->phone . '"');


            if (!empty($model->fax))
                $criteria->addCondition('fax = "' . $model->fax . '"');


            if (!empty($model->email))
                $criteria->addCondition('email = "' . $model->email . '"');
        }
        $session['SiteConfig_records'] = SiteConfig::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new SiteConfig('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SiteConfig']))
            $model->attributes = $_GET['SiteConfig'];

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
        $model = SiteConfig::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'site-config-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
