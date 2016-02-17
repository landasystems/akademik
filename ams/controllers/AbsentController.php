<?php

class AbsentController extends Controller {

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
        $model = new Absent;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Absent'])) {
            $model->attributes = $_POST['Absent'];
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

        if (isset($_POST['Absent'])) {
            $model->attributes = $_POST['Absent'];
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

        $model = new Absent('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Absent'])) {
            $model->attributes = $_GET['Absent'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->user_id))
                $criteria->addCondition('user_id = "' . $model->user_id . '"');


            if (!empty($model->time_in))
                $criteria->addCondition('time_in = "' . $model->time_in . '"');


            if (!empty($model->time_out))
                $criteria->addCondition('time_out = "' . $model->time_out . '"');


            if (!empty($model->date_absent))
                $criteria->addCondition('date_absent = "' . $model->date_absent . '"');


            if (!empty($model->description))
                $criteria->addCondition('description = "' . $model->description . '"');


            if (!empty($model->status))
                $criteria->addCondition('status = "' . $model->status . '"');


            if (!empty($model->created))
                $criteria->addCondition('created = "' . $model->created . '"');


            if (!empty($model->created_user_id))
                $criteria->addCondition('created_user_id = "' . $model->created_user_id . '"');


            if (!empty($model->modified))
                $criteria->addCondition('modified = "' . $model->modified . '"');
        }
        $session['Absent_records'] = Absent::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Absent('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Absent']))
            $model->attributes = $_GET['Absent'];

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
        $model = Absent::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'absent-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function sendSMS($param, $name, $class, $time, $date, $phone) {
        $listSiteConfig = SiteConfig::model()->listSiteConfig();
        $settings = json_decode($listSiteConfig['settings']);

        if ($param == 'sms_in') {
            $teks = $settings->sms_in;
        } elseif ($param == 'sms_out') {
            $teks = $settings->sms_out;
        }

        $sReply = str_replace("{name}", $name, $teks);
        $sReply = str_replace("{classroom}", $class, $sReply);
        $sReply = str_replace("{time}", $time, $sReply);
        $sReply = str_replace("{date}", date('d-M-Y', strtotime($date)), $sReply);

        Sms::model()->insertMsgNumber(0, $phone, $sReply, false, '', true);
        return;
    }

    public function actionRetUser() {
        $nim = $_GET['id'];
        $m = User::model()->find(array('condition' => 'code="' . $nim . '"'));

        //pengecekan jika user tidak ada
        if (empty($m)) {
            echo 'error';
            exit();
        }

        $cek = Absent::model()->find(array('condition' => 'user_id="' . $m->id . '" and date_absent="' . date("Y-m-d") . '"  '));
        $classRoom = UserClassroom::model()->className($m->id);
        //  logs($m->name . '|' . date("H:m:s") ."|". $m->imgUrl['medium'] . "|" . $classRoom);

        $phone = json_decode($m->others);

        if (empty($cek)) {
            $model = new Absent;
            $timeAbsent = date("H:i:s");
            $date = date("Y-m-d");
            $model->user_id = $m->id;
            $model->time_in = $timeAbsent;
            $model->date_absent = $date;
            $model->status = "presen";
            $model->save();

            $ketAbsent = '<div class="span11" id="masuk" align="center">
                                <div class="control-group">
                                    <h3>Masuk <br> ' . $timeAbsent . '</h3>
                                </div>
                            </div>';

            //kirim sms ke orang tua
            if (isset($phone->parent_number) && !empty($phone->parent_number))
                $this->sendSMS('sms_in', $m->name, $classRoom, $timeAbsent, $date, $phone->parent_number);
        } else if (empty($cek->time_out)) {

            $id = $cek->id;
            $timeAbsent = date("H:i:s");
            $date = date("Y-m-d");
            Absent::model()->updateByPk($id, array('time_out' => $timeAbsent, 'modified' => date('Y-m-d H:i')));
            $ketAbsent = '<div class="span11" id="pulang" align="center">
                                <div class="control-group">
                                    <h3>Pulang <br> ' . $timeAbsent . '</h3>
                                </div>
                            </div>';

            //kirim sms ke orang tua
            if (isset($phone->parent_number) && !empty($phone->parent_number))
                $this->sendSMS('sms_out', $m->name, $classRoom, $timeAbsent, $date, $phone->parent_number);
        } else {
            $ketAbsent = '<div class="span11" id="selesai" align="center">
                                <div class="control-group">
                                    <h3>Anda telah absen masuk dan pulang</h3>
                                </div>
                            </div>';
        }
        $listAbsent = Absent::model()->findAll(array('condition' => 'date_absent="' . date("Y-m-d") . '"', 'order' => 'modified desc'));
        $grid = "";
        foreach ($listAbsent as $key => $value) {
            $code = (isset($value->User->code)) ? $value->User->code : '-';
            $nama = (isset($value->User->name)) ? $value->User->name : '-';
            $timeIn = (isset($value->time_in)) ? $value->time_in : '-';
            $timeOut = (isset($value->time_out)) ? $value->time_out : '-';
            $grid .='<tr>
                        <td>' . $code . '</td>
                        <td>' . $nama . '</td>
                        <td>' . $timeIn . '</td>
                        <td>' . $timeOut . '</td>
                    </tr>';
        }
        $img = str_replace('absensi', 'akademik', $m->imgUrl['medium']);
        echo $m->name . "|" . date("H:i:s") . "|" . $img . "|" . $classRoom . "|" . $nim . "|" . $ketAbsent . "|" . $grid;
    }

    public function actionFrontend() {
        if (!isset(user()->roles_id) || user()->roles_id != -1)
            $this->redirect(url('site/logout'));

        $this->layout = 'blankHeader';
        cs()->registerScript('frontend', '
                    $("#codeSiswa").bind("cut copy paste", function(e) {         
                    e.preventDefault();     
                    });
                    $("#codeSiswa").keyup(function(){
                        var count = $(this).val().length;
                        var id=$("#codeSiswa").val();
                       if( count >= 7){
                       $("#codeSiswa").val("");
                        $.ajax({
                            url : "' . url('absent/retUser') . '",
                            data : "id="+id,
                            cache : false,
                            success : function(msg){
                               if (msg=="error"){
                                    $("#ket").html("<span class=\"label label-important\">Data anda tidak terdaftar di database kami.</span>");
                               }else{
                                    hsl=msg.split("|");
                                    $("#namaSiswa").html(hsl[0]);
                                    $("#waktuAbsensi").html(hsl[1]);
                                    $("#avatarSiswa").attr("src", hsl[2]);
                                    $("#kelasSiswa").html(hsl[3]);
                                    $("#nimSiswa").html(hsl[4]);
                                    $("#ket").html(hsl[5]);
                                    $("#listAbsent").html(hsl[6]);
                               }
                               
                               $("#codeSiswa").focus();
                            }
                        });
                        }
                    });
                    $("#codeSiswa").focus();
                    ');
        cs()->registerScript('time', '
               var serverTime = ' . time() * 1000 . ';
                    var localTime = +Date.now();
                    var timeDiff = serverTime - localTime;

                    setInterval(function () {
                        var realtime = +Date.now() + timeDiff;
                        var date = new Date(realtime);
                        var hours = date.getHours();
                        var minutes = date.getMinutes();
                        var seconds = date.getSeconds();
                        var formattedTime = hours + ":" + minutes + ":" + seconds;
                         $("#clock").html(formattedTime);
                    }, 1000);
                    
                setInterval(function(){$("#codeSiswa").focus();$("#codeSiswa").val("")}, 5000);');
        $arrHoliday = array();
        $grid = '';
        $holiday = '';
        $listAbsent = '';
        $holiday = SiteConfigHoliday::model()->findAll(array('condition' => 'month(date_holiday)="' . date("m") . '"'));
        $listAbsent = Absent::model()->findAll(array('condition' => 'date_absent="' . date("Y-m-d") . '"', 'order' => 'modified desc'));
        foreach ($listAbsent as $key => $value) {
            $code = (isset($value->User->code)) ? $value->User->code : '-';
            $nama = (isset($value->User->name)) ? $value->User->name : '-';
            $timeIn = (isset($value->time_in)) ? $value->time_in : '-';
            $timeOut = (isset($value->time_out)) ? $value->time_out : '-';
            $grid .='<tr>
                        <td>' . $code . '</td>
                        <td>' . $nama . '</td>
                        <td>' . $timeIn . '</td>
                        <td>' . $timeOut . '</td>
                    </tr>';
        }
        foreach ($holiday as $ho) {
            $arrHoliday[] = $ho->date_holiday;
        }

        $this->render('frontend', array(
            'dateHoliday' => $arrHoliday,
            'grid' => $grid,
        ));
    }

    public function actionChange() {
        if ($_GET['status'] == 'absent') {
            $id = $_GET['absentId'];
            $del = Absent::model()->deleteByPK($id);
        } else {
            $id = $_GET['absentId'];
            $status = $_GET['status'];
            Absent::model()->updateByPk($id, array('status' => $status, 'time_in' => '07:00:00', 'time_out' => '13:00:00'));
            //  $this->render("reportAbsent/", array("thn" => $_GET['tahun'], "bln" => $_GET['bulan'], "kls" => $_GET['kelas']));
        }
        $kelas = str_replace(".html", "", $_GET['kelas']);
        $this->redirect(array("reportAbsent/index", "thn" => $_GET['tahun'], "bln" => $_GET['bulan'], "kls" => $kelas));
    }

    public function actionAddAbsent() {
        $userId = $_GET['userId'];
        $dateAbsent = $_GET['date'];
        $status = $_GET['status'];
        $model = new Absent;
        $model->user_id = $userId;
        $model->time_in = "07:00:00";
        $model->time_out = "13:00:00";
        $model->date_absent = $dateAbsent;
        $model->status = $status;
        $model->save();
        //$this->redirect(array('reportAbsent/'));
        $kelas = str_replace(".html", "", $_GET['kelas']);
        $this->redirect(array("reportAbsent/index", "thn" => $_GET['tahun'], "bln" => $_GET['bulan'], "kls" => $kelas));
    }

}

?>
