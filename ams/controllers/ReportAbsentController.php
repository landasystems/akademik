<?php

class ReportAbsentController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

   

    public function actionIndex() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Absent('search');
        if (isset($_GET['thn'])) {
            $thn = $_GET['thn'];
        } else {
            $thn = '-';
        }

        cs()->registerScript('', '$(".pop").popover();');
        $absent = '';
        $holiday = '';
        $classroom = '';
        $arrAbsent = array();
        $arrHoliday = array();
        $bln = '';
        $thn = '';
        $kelas = '';
        if (!empty($_POST['month']) and !empty($_POST['year']) and !empty($_POST['classroom'])) {
            $bln = $_POST['month'];
            $kelas = $_POST['classroom'];
            $thn = $_POST['year'];
        } else if (!empty($_GET['thn']) and !empty($_GET['kls']) and !empty($_GET['bln'])) {
            $bln = $_GET['bln'];
            $kelas = $_GET['kls'];
            $thn = $_GET['thn'];
        }

        if (!empty($bln) && !empty($thn)) {
            $amountDay = landa()->daysInMonth($bln, $thn);
            $amountDay = landa()->daysInMonth($bln, $thn);
            $classroom = UserClassroom::model()->findAll(array('condition' => 'classroom_id="' . $kelas . '"'));
            $absent = Absent::model()->findAll(array('condition' => 'month(date_absent)=' . $bln . ' AND year(date_absent)=' . $thn));
            $holiday = SiteConfigHoliday::model()->findAll(array('condition' => 'month(date_holiday)="' . $bln . '"'));

            foreach ($absent as $o) {
                $arrAbsent[$o->dayAbsent][$o->user_id] = $o;
            }

            foreach ($holiday as $ho) {
                $arrHoliday[] = $ho->date_holiday;
            }

            // trace($arrAbsent);
        } else {
            $amountDay = 0;
        }

        $this->render('index', array(
            'classroom' => $classroom,
            'kelas' => $kelas,
            'amountDay' => $amountDay,
            'mAbsent' => $arrAbsent,
            'year' => $thn,
            'month' => $bln,
            'dateHoliday' => $arrHoliday,
        ));
    }

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

    public function actionReportHarian() {
        $classroom = "";
        $arrAbsent = array();
        $tgl = date("m/d/Y");

        if (!empty($_POST['date']) and !empty($_POST['classroom'])) {
            $classroom = UserClassroom::model()->findAll(array('condition' => 'classroom_id="' . $_POST['classroom'] . '"'));
            $date = explode("/", $_POST['date']);
            $tgl = $date[2] . '-' . $date[0] . '-' . $date[1];
            $absent = Absent::model()->findAll(array('condition' => 'date_absent= "' . $tgl . '" '));

            foreach ($absent as $o) {
                $arrAbsent[$o->date_absent][$o->user_id] = $o;
            }
        }
        $this->render('ReportHarian', array(
            'classroom' => $classroom,
            'mAbsent' => $arrAbsent,
            'date' => $tgl
        ));
    }

    public function actionGenerateExcelSentItem() {
        $month = str_replace(".html", "", $_GET['bln']);
        $absent = '';
        $holiday = '';
        $classroom = '';
        $arrAbsent = array();
        $arrHoliday = array();
        $bln = '';
        $thn = '';
        $kelas = '';
        if (!empty($_GET['thn']) and !empty($_GET['kls']) and !empty($_GET['bln'])) {
            $bln = $month;
            $kelas = $_GET['kls'];
            $thn = $_GET['thn'];
        }

        if (!empty($bln) && !empty($thn)) {
            $amountDay = landa()->daysInMonth($bln, $thn);
            $amountDay = landa()->daysInMonth($bln, $thn);
            $classroom = UserClassroom::model()->findAll(array('condition' => 'classroom_id="' . $kelas . '"'));
            $namaKelas = Classroom::model()->find(array('condition' => 'id="' . $kelas . '"'));
            $absent = Absent::model()->findAll(array('condition' => 'month(date_absent)=' . $bln . ' AND year(date_absent)=' . $thn));
            $holiday = SiteConfigHoliday::model()->findAll(array('condition' => 'month(date_holiday)="' . $bln . '"'));

            foreach ($absent as $o) {
                $arrAbsent[$o->dayAbsent][$o->user_id] = $o;
            }

            foreach ($holiday as $ho) {
                $arrHoliday[] = $ho->date_holiday;
            }
        } else {
            $amountDay = 0;
        }


        Yii::app()->request->sendFile('RekapAbsensi' . $namaKelas->name . '(Bulan' . $bln . 'Tahun' . $thn . ')' . '.xls', $this->renderPartial('excelReportSentItem', array(
                    'classroom' => $classroom,
                    'kelas' => $namaKelas->name,
                    'amountDay' => $amountDay,
                    'mAbsent' => $arrAbsent,
                    'year' => $thn,
                    'month' => $bln,
                    'dateHoliday' => $arrHoliday,
                        ), true)
        );
    }

}

?>
