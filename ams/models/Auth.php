<?php

/**
 * This is the model class for table "{{auth}}".
 *
 * The followings are the available columns in table '{{auth}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $alias
 * @property string $module
 * @property string $crud
 */
class Auth extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{auth}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, description', 'length', 'max' => 255),
            array('module, crud', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, description, crud', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'description' => 'Description',
//            'alias' => 'Alias',
//            'module' => 'Module',
            'crud' => 'Crud',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
//        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
//        $criteria->compare('alias', $this->alias, true);
//        $criteria->compare('module', $this->module, true);
        $criteria->compare('crud', $this->crud, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @return CDbConnection the database connection used for this class
     */
    public function getDbConnection() {
        return Yii::app()->db2;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Auth the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function modules() {

        return array(
            array('label' => '<span class="icon16 icomoon-icon-screen"></span>Halaman Depan', 'url' => array('/dashboard')),
            array('visible' => landa()->checkAccess('User', 'r'), 'auth_id' => 'User', 'label' => '<span class="icon16 icomoon-icon-user-3"></span>User', 'url' => array('/user'), 'crud' => array("r" => 1)),
            array('visible' => landa()->checkAccess('GroupTeacher', 'r') || landa()->checkAccess('Teacher', 'r'), 'label' => '<span class="icon16  entypo-icon-contact"></span>Guru', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('GroupTeacher', 'r'), 'auth_id' => 'GroupTeacher', 'label' => '<span class="icon16 entypo-icon-users"></span>Group Guru', 'url' => url('landa/roles/teacher'), 'crud' => array("r" => 1)),
                    array('visible' => landa()->checkAccess('Teacher', 'r'), 'auth_id' => 'Teacher', 'label' => '<span class="icon16  entypo-icon-user"></span>Guru', 'url' => url('user/teacher'), 'crud' => array("r" => 1)),
                )),
            array('visible' => landa()->checkAccess('GroupStudent', 'r') || landa()->checkAccess('Student', 'r'), 'label' => '<span class="icon16  entypo-icon-contact"></span>Murid', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('GroupStudent', 'r'), 'auth_id' => 'GroupStudent', 'label' => '<span class="icon16 entypo-icon-users"></span>Group Murid', 'url' => url('landa/roles/student'), 'crud' => array("r" => 1)),
                    array('visible' => landa()->checkAccess('Student', 'r'), 'auth_id' => 'Student', 'label' => '<span class="icon16  entypo-icon-user"></span>Murid', 'url' => url('user/student'), 'crud' => array("r" => 1)),
                )),
            array('visible' => landa()->checkAccess('Download', 'r'), 'auth_id' => 'Download', 'label' => '<span class="icon16 minia-icon-download"></span>Dokumen', 'url' => array('/downloadCategory')),
            array('visible' => landa()->checkAccess('SchoolYear', 'r') || landa()->checkAccess('Classroom', 'r') || landa()->checkAccess('UserClassroom', 'r'), 'label' => '<span class="icon16 typ-icon-cog"></span>Akademik', 'url' => array('/User'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('SchoolYear', 'r'), 'auth_id' => 'SchoolYear', 'label' => '<span class="icon16 minia-icon-calendar"></span>Tahun Ajaran', 'url' => array('/schoolYear'), 'crud' => array("r" => 1)),
                    array('visible' => landa()->checkAccess('Classroom', 'r'), 'auth_id' => 'Classroom', 'label' => '<span class="icon16 minia-icon-office"></span>Kelas', 'url' => array('/classroom'), 'crud' => array("r" => 1)),
                    array('visible' => landa()->checkAccess('UserClassroom', 'r'), 'auth_id' => 'UserClassroom', 'label' => '<span class="icon16 typ-icon-users"></span>Penempatan Siswa', 'url' => array('/userClassroom'), 'crud' => array("r" => 1)),
                )),
            array('visible' => landa()->checkAccess('ExamCategory', 'r') || landa()->checkAccess('Exam', 'r') || landa()->checkAccess('Test', 'r') || landa()->checkAccess('TestResult', 'r'), 'label' => '<span class="icon16 minia-icon-book"></span>Ujian', 'url' => array('/User'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('ExamCategory', 'r'), 'auth_id' => 'ExamCategory', 'label' => '<span class="icon16 iconic-icon-list-nested"></span>Kategori', 'url' => array('/examCategory'), 'crud' => array("r" => 1)),
                    array('visible' => landa()->checkAccess('Exam', 'r'), 'auth_id' => 'Exam', 'label' => '<span class="icon16 typ-icon-views"></span>Soal', 'url' => array('/exam'), 'crud' => array("r" => 1)),
                    array('visible' => landa()->checkAccess('Test', 'r'), 'auth_id' => 'Test', 'label' => '<span class="icon16 wpzoom-timer"></span>Jadwal', 'url' => array('/test'), 'crud' => array("r" => 1)),
                    array('visible' => landa()->checkAccess('TestResult', 'r'), 'auth_id' => 'TestResult', 'label' => '<span class="icon16 minia-icon-checked"></span>Hasil Ujian', 'url' => array('/testResult'), 'crud' => array("r" => 1)),
                )),
//                array('visible' => landa()->checkAccess('Ongoing', 'r'), 'label' => '<span class="icon16 cut-icon-arrow-right"></span>Mulai Ujian', 'url' => array('/test/ongoing'), 'auth_id' => 'Ongoing', 'submenuOptions' => array('class' => 'sub'), 'items' => array(
//                    )),
            array('visible' => landa()->checkAccess('Sms', 'r'), 'label' => '<span class="icon16 wpzoom-phone-3"></span>SMS', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('smsKeyword', 'r'), 'auth_id' => 'smsKeyword', 'label' => '<span class="icon16 icomoon-icon-key-2"></span>Keyword', 'url' => url('/smsKeyword'), 'crud' => array("r" => 1)),
                    array('visible' => landa()->checkAccess('outbox', 'r'), 'auth_id' => 'outbox', 'label' => '<span class="icon16 entypo-icon-comment"></span>Outbox', 'url' => url('/sms/outbox'), 'crud' => array("r" => 1)),
                    array('visible' => landa()->checkAccess('Sms', 'r'), 'auth_id' => 'Sms', 'label' => '<span class="icon16 entypo-icon-inbox"></span>Inbox & Sentitems', 'url' => url('/sms'), 'crud' => array("r" => 1)),
                    array('visible' => landa()->checkAccess('logModem', 'r'), 'auth_id' => 'logModem', 'label' => '<span class="icon16 icomoon-icon-mobile-2"></span>Log Status Modem', 'url' => url('/sms/logModem'), 'crud' => array("r" => 1)),
                )),
            array('visible' => landa()->checkAccess('ReportMonth', 'r') || landa()->checkAccess('ReportDay', 'r'), 'label' => '<span class="icon16 cut-icon-list"></span>Absensi', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('Holiday', 'r'), 'auth_id' => 'Holiday', 'label' => '<span class="icon16 brocco-icon-calendar"></span>Hari Libur', 'url' => url('/siteConfigHoliday'), 'crud' => array("r" => 1)),
                    array('visible' => landa()->checkAccess('ReportMonth', 'r'), 'auth_id' => 'ReportMonth', 'label' => '<span class="icon16 brocco-icon-calendar"></span>Rekap', 'url' => url('/ReportAbsent'), 'crud' => array("r" => 1)),
                )),
            array('visible' => landa()->checkAccess('Report_Exam', 'r') || landa()->checkAccess('Report_Userlist', 'r'), 'label' => '<span class="icon16 cut-icon-printer-2"></span>Laporan', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('Sms', 'r'), 'auth_id' => 'Customer', 'label' => '<span class="icon16 icomoon-icon-mail"></span>Pesan Terkirim', 'url' => url('/report/sentItem'), 'crud' => array("r" => 1)),
                    array('visible' => landa()->checkAccess('Report_Exam', 'r'), 'auth_id' => 'Report_Exam', 'label' => '<span class="icon16 entypo-icon-list"></span>Nilai Ujian', 'url' => array('/report/examReport'), 'crud' => array("r" => 1)),
                    array('visible' => landa()->checkAccess('Report_Day', 'r'), 'auth_id' => 'Report_Day', 'label' => '<span class="icon16  brocco-icon-window"></span>Absensi Harian', 'url' => url('/ReportAbsent/ReportHarian'), 'crud' => array("r" => 1)),
                //array('label' => '<span class="icon16 entypo-icon-list"></span>Classroom', 'url' => array('#')),
//                        array('visible'=>landa()->checkAccess('Report_Userlist','r'),'label' => '<span class="icon16 entypo-icon-list"></span>Daftar User', 'url' => array('/user'),'auth_id'=>'Report_Userlist'),
//                        array('visible'=>landa()->checkAccess('Report_Classroomlist','r'),'label' => '<span class="icon16 entypo-icon-list"></span>Daftar Kelas', 'url' => array('/classroom'),'auth_id'=>'Report_ClassroomList'),
                )),
            array('visible' => landa()->checkAccess('Chart_ExamComparison', 'r'), 'label' => '<span class="icon16 icomoon-icon-bars"></span>Chart', 'url' => array('/User'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('Chart_ExamComparison', 'r'), 'auth_id' => 'Chart_ExamComparison', 'label' => '<span class="icon16 entypo-icon-list"></span>Ujian Pembanding', 'url' => array('/chart/examComparison'), 'crud' => array("r" => 1)),
                )),
        );
    }

}
