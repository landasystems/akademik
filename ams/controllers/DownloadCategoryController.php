<?php

class DownloadCategoryController extends Controller {

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
        $model = new DownloadCategory;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['DownloadCategory'])) {
            if ($_POST['DownloadCategory']['parent_id']) {
                $root = $model->findByPk($_POST['DownloadCategory']['parent_id']);

                $child = new DownloadCategory;
                $child->attributes = $_POST['DownloadCategory'];
                $child->path = $root->path . Yii::app()->landa->urlParsing($child->name) . '/';

                // trace($child->path );

                if ($child->appendTo($root)) {
                    mkdir('images/' . $child->path, 0775);
                    $this->redirect(array('view', 'id' => $child->id));
                }
            } else {
                $model->attributes = $_POST['DownloadCategory'];
                $model->path = 'download/' . Yii::app()->landa->urlParsing($model->name) . '/';
                mkdir('images/' . $model->path, 0777);
                if ($model->saveNode())
                    $this->redirect(array('view', 'id' => $model->id));
            }
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
//        rename('images/download/adad/','download/aaadddddd/adad/');
        
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['DownloadCategory'])) {
            $oldfolderpath = 'images/' . $model->path;

            if ($_POST['DownloadCategory']['parent_id']) {
                $model->attributes = $_POST['DownloadCategory'];

                $root = $model->findByPk($_POST['DownloadCategory']['parent_id']);
                $model->path = $root->path . Yii::app()->landa->urlParsing($model->name) . '/';

                if ($model->saveNode()) {
                    $model->moveAsFirst($root);

                    //move the folder
                    $newfolderpath = 'images/' . $model->path;
                    rename($oldfolderpath, $newfolderpath);

                    $this->redirect(array('view', 'id' => $model->id));
                }
            } else {

                $model->attributes = $_POST['DownloadCategory'];
                $model->path = 'download/' . Yii::app()->landa->urlParsing($model->name) . '/';

                //move the folder
                $newfolderpath = 'images/' . $model->path ;
                rename($oldfolderpath, $newfolderpath);

                $model->saveNode();
                if (!($model->isRoot()))
                    $model->moveAsRoot();
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

            $model = $this->loadModel($id);

            //delete download where have child
            $descendants = $model->children()->findAll();
            $sWhere[] = $id;
            foreach ($descendants as $o) {
                $sWhere[] = $o->id;
            }

            landa()->deleteDir('images/' . $model->path);
            cmd('DELETE FROM download WHERE download_category_id IN (' . implode(',', $sWhere) . ')')->execute();

            // we only allow deletion via POST request
            $model->deleteNode();

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

        $model = new DownloadCategory('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['DownloadCategory'])) {
            $model->attributes = $_GET['DownloadCategory'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->description))
                $criteria->addCondition('description = "' . $model->description . '"');


            if (!empty($model->level))
                $criteria->addCondition('level = "' . $model->level . '"');


            if (!empty($model->lft))
                $criteria->addCondition('lft = "' . $model->lft . '"');


            if (!empty($model->rgt))
                $criteria->addCondition('rgt = "' . $model->rgt . '"');


            if (!empty($model->root))
                $criteria->addCondition('root = "' . $model->root . '"');


            if (!empty($model->path))
                $criteria->addCondition('path = "' . $model->path . '"');


            if (!empty($model->parent_id))
                $criteria->addCondition('parent_id = "' . $model->parent_id . '"');
        }
        $session['DownloadCategory_records'] = DownloadCategory::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new DownloadCategory('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['DownloadCategory']))
            $model->attributes = $_GET['DownloadCategory'];

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
        $model = DownloadCategory::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'download-category-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    

}
