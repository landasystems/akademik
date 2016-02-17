<?php

class SmsController extends Controller {

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
        cs()->registerScript('', '        
                function calcMessage(str){
                    var msg;
                    msg = Math.ceil(str.length / 160);
                    return "<b>" + str.length + "</b> Huruf, <b>" + msg + "</b> Pesan";
                }

                $("#infoMess").html(calcMessage($("#Sms_last_message").val()));
                $("#Sms_last_message").bind("keyup change", function(){
                    $("#infoMess").html(calcMessage($(this).val()));
                });
            ');

        $model = $this->loadModel($id);
        $model->is_read = 1;
        $model->save();
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {

        cs()->registerScript('', '        
                function calcMessage(str){
                    var msg;
                    msg = Math.ceil(str.length / 160);
                    return "<b>" + str.length + "</b> Huruf, <b>" + msg + "</b> Pesan";
                }

                $("#infoMess").html(calcMessage($("#Sms_last_message").val()));
                $("#Sms_last_message").bind("keyup change", function(){
                    $("#infoMess").html(calcMessage($(this).val()));
                });
            ');

        $model = new Sms;
        if (isset($_POST['user_id_opp']) || isset($_POST['roles_id']) || isset($_POST['number'])) {
            if ($_POST['Sms']['type'] == "user") {
                if (count($_POST['user_id_opp']) > 1) {
                    $id = Sms::model()->insertMsgMass(app()->user->id, $_POST['user_id_opp'], $_POST['Sms']['last_message']);
                } else {
                    foreach ($_POST['user_id_opp'] as $user_id_opp) {
                        $id = Sms::model()->insertMsg(app()->user->id, $user_id_opp, $_POST['Sms']['last_message']);
                    }
                }
            } else if ($_POST['Sms']['type'] == "group") {
                $mUser = User::model()->findAll(array('select' => 'id', 'condition' => 'roles_id IN ("' . implode('","', $_POST['roles_id']) . '")'));
                if (count($mUser) < 1) {
                    $model->type = "group";
                    $this->render('create', array(
                        'model' => $model,
                    ));
                }

                $user_id_opps = array();
                foreach ($mUser as $o) {
                    $user_id_opps[] = $o->id;
                }
                Sms::model()->insertMsgGroup(app()->user->id, $user_id_opps, $_POST['Sms']['last_message'], 'group', $_POST['roles_id']);
            } else if ($_POST['Sms']['type'] == "classroom") { //khusus ams
                $mUser = UserClassroom::model()->findAll(array('select' => 'user_id', 'condition' => 'classroom_id IN ("' . implode('","', $_POST['classroom_id']) . '")'));
                if (count($mUser) < 1) {
                    $model->type = "classroom";
                    $this->render('create', array(
                        'model' => $model,
                    ));
                }

                $user_id_opps = array();
                if ($_POST['option'] == 'student') {
                    foreach ($mUser as $o) {
                        $user_id_opps[] = $o->user_id;
                    }
                    Sms::model()->insertMsgGroup(app()->user->id, $user_id_opps, $_POST['Sms']['last_message'], $_POST['option'], $_POST['classroom_id']);
                } else {  //kirim ke wali murid
                    foreach ($mUser as $o) {
                        $others = json_decode($o->User->others);
                        if (isset($others->parent_number) && !empty($others->parent_number)) {
                            $user_id_opps[] = $others->parent_number;
                        }
                    }
                    Sms::model()->insertMsgGroup(app()->user->id, json_encode($user_id_opps), $_POST['Sms']['last_message'], $_POST['option'], $_POST['classroom_id'], true);
                }
            } else {
                Sms::model()->insertMsgNumber(app()->user->id, $_POST['number'], $_POST['Sms']['last_message']);
            }
            $this->redirect(url('sms/index'));
        }
        $model->type = "group";
        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionCreateDetail() {
        if (isset($_POST['Sms']['last_message'])) {
            if ($_POST['type'] == "mass") {
                $id = Sms::model()->insertMsgMass(app()->user->id, $_POST['user_id_opp'], $_POST['Sms']['last_message'], 'mass', true);
            } elseif ($_POST['type'] == "user") {
                $id = Sms::model()->insertMsg(app()->user->id, $_POST['user_id_opp'], $_POST['Sms']['last_message'], true);
            } elseif ($_POST['type'] == "group" || $_POST['type'] == "student" || $_POST['type'] == "parent") {
                $opp = $_POST['user_id_opp'];
                $roles_ids = json_decode($_POST['type_roles_ids'], true);
                $id = Sms::model()->insertMsgGroup(app()->user->id, $opp, $_POST['Sms']['last_message'], 'group', $roles_ids, true);
            } elseif ($_POST['type'] == "phone") {
                $id = Sms::model()->insertMsgNumber(app()->user->id, $_POST['user_id_opp'], $_POST['Sms']['last_message']);
            }
            $model = SmsDetail::model()->findByPk($id['UserMessageDetailId']);
            $listUser = User::model()->listUser();
            $type = 'admin';
            $name = $listUser[app()->user->id]['name'];
            $img = Yii::app()->landa->urlImg('avatar/', $listUser[app()->user->id]['avatar_img'], app()->user->id);

            echo '<div class="nextMessage"></div>';
            $this->renderPartial('_viewDetailLi', array('type' => $type, 'userMessageDetail' => $model, 'img' => $img, 'name' => $name));
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
//    public function actionUpdate($id) {
//        $model = $this->loadModel($id);
//
//        // Uncomment the following line if AJAX validation is needed
//        // $this->performAjaxValidation($model);
//
//        if (isset($_POST['Sms'])) {
//            $model->attributes = $_POST['Sms'];
//            if ($model->save())
//                $this->redirect(array('view', 'id' => $model->id));
//        }
//
//        $this->render('update', array(
//            'model' => $model,
//        ));
//    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            SmsDetail::model()->deleteAll(array('condition'=>'sms_id='.$id));
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

        $model = new Sms('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Sms'])) {
            $model->attributes = $_GET['Sms'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->created_user_id))
                $criteria->addCondition('created_user_id = "' . $model->created_user_id . '"');


            if (!empty($model->last_date))
                $criteria->addCondition('last_date = "' . $model->last_date . '"');


            if (!empty($model->last_message))
                $criteria->addCondition('last_message = "' . $model->last_message . '"');


            if (!empty($model->count_message))
                $criteria->addCondition('count_message = "' . $model->count_message . '"');


            if (!empty($model->is_read))
                $criteria->addCondition('is_read = "' . $model->is_read . '"');


            if (!empty($model->phone))
                $criteria->addCondition('phone = "' . $model->phone . '"');


            if (!empty($model->type))
                $criteria->addCondition('type = "' . $model->type . '"');


            if (!empty($model->type_phones))
                $criteria->addCondition('type_phones = "' . $model->type_phones . '"');


            if (!empty($model->type_roles_ids))
                $criteria->addCondition('type_roles_ids = "' . $model->type_roles_ids . '"');
        }
        $session['Sms_records'] = Sms::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionOutbox() {
        $model = new SmsDetail('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Sms']))
            $model->attributes = $_GET['Sms'];

        $this->render('outbox', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
//        public $model->attributes = $_GET['Sms'];
//
//        $this->render('admin', array(
//            'model' => $model,
//        ));
//    }
// function actionAdmin() {
//        $model = new Sms('search');
//        $model->unsetAttributes();  // clear any default values
//        if (isset($_GET['Sms']))
//            $model->attributes = $_GET['Sms'];
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
        $model = Sms::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sms-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['Sms_records'])) {
            $model = $session['Sms_records'];
        } else
            $model = Sms::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $model
                        ), true)
        );
    }

    public function actionLogModem() {
        $listSiteConfig = SiteConfig::model()->listSiteConfig();
        $port = ($listSiteConfig['sms_port'] == 0) ? '' : $listSiteConfig['sms_port'];
        $this->render('logModem', array('log' => file_get_contents('/var/log/gammu-smsdrc' . $port)));
    }

}
