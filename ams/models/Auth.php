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
            array('label' => 'Dashboard', 'url' => array('/dashboard')),
            array('label' => 'Dokumen', 'url' => array('/downloadCategory')),
            array('visible' =>user()->roles_id == -1,'label' => 'Akademik', 'url' => array('/User'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('auth_id' => 'User', 'label' => 'Guru', 'url' => array('/user'), 'crud' => array("r" => 1)),
                    array('auth_id' => 'Student', 'label' => 'Murid', 'url' => url('user/student'), 'crud' => array("r" => 1)),
                    array('auth_id' => 'SchoolYear', 'label' => 'Tahun Ajaran', 'url' => array('/schoolYear'), 'crud' => array("r" => 1)),
                    array('auth_id' => 'Classroom', 'label' => 'Kelas', 'url' => array('/classroom'), 'crud' => array("r" => 1)),
                    array('auth_id' => 'UserClassroom', 'label' => 'Penempatan Siswa', 'url' => array('/userClassroom'), 'crud' => array("r" => 1)),
                )),
            array('label' => 'Ujian', 'url' => array('/User'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('auth_id' => 'Exam', 'label' => 'Soal', 'url' => array('/exam'), 'crud' => array("r" => 1)),
                    array('auth_id' => 'Test', 'label' => 'Jadwal', 'url' => array('/test'), 'crud' => array("r" => 1)),
                    array('auth_id' => 'TestResult', 'label' => 'Hasil Ujian', 'url' => array('/testResult'), 'crud' => array("r" => 1)),
                )),
            array('visible' =>user()->roles_id == -1, 'label' => 'SMS', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('auth_id' => 'smsKeyword', 'label' => 'Keyword', 'url' => url('/smsKeyword'), 'crud' => array("r" => 1)),
                    array('auth_id' => 'outbox', 'label' => 'Outbox', 'url' => url('/sms/outbox'), 'crud' => array("r" => 1)),
                    array('auth_id' => 'Sms', 'label' => 'Inbox & Sentitems', 'url' => url('/sms'), 'crud' => array("r" => 1)),
                    array('auth_id' => 'logModem', 'label' => 'Log Status Modem', 'url' => url('/sms/logModem'), 'crud' => array("r" => 1)),
                )),
            array('visible' =>user()->roles_id == -1, 'label' => 'Absensi', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('auth_id' => 'Holiday', 'label' => 'Hari Libur', 'url' => url('/siteConfigHoliday'), 'crud' => array("r" => 1)),
                    array('auth_id' => 'ReportMonth', 'label' => 'Rekap', 'url' => url('/ReportAbsent'), 'crud' => array("r" => 1)),
                )),
            array('label' => 'Laporan', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => user()->roles_id == -1, 'auth_id' => 'Customer', 'label' => 'Pesan Terkirim', 'url' => url('/report/sentItem'), 'crud' => array("r" => 1)),
                    array('auth_id' => 'Report_Exam', 'label' => 'Nilai Ujian', 'url' => array('/report/examReport'), 'crud' => array("r" => 1)),
                    array('auth_id' => 'Report_Day', 'label' => 'Absensi Harian', 'url' => url('/ReportAbsent/ReportHarian'), 'crud' => array("r" => 1)),
                )),
        );
    }

}
