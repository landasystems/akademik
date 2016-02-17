<?php

/**
 * This is the model class for table "{{test}}".
 *
 * The followings are the available columns in table '{{test}}':
 * @property integer $id
 * @property integer $classroom_id
 * @property integer $exam_id
 * @property string $name
 * @property string $description
 * @property string $date_test
 * @property string $time_start
 * @property string $time_end
 * @property integer $exam_total
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class Test extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Test the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{test}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('time_start, time_end', 'required'),
            array('classroom_id, exam_id, exam_total, created_user_id, result_max', 'numerical', 'integerOnly' => true),
            array('name, description', 'length', 'max' => 255),
            array('date_test, created, modified', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, classroom_id, exam_id, name, description, date_test, time_start, time_end, exam_total, created, created_user_id, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Classroom' => array(self::BELONGS_TO, 'Classroom', 'classroom_id'),
            'Exam' => array(self::BELONGS_TO, 'Exam', 'exam_id'),
            'User' => array(self::BELONGS_TO, 'User', 'created_user_id'),
            'TestResult' => array(self::HAS_MANY, 'TestResult', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'classroom_id' => 'Kelas',
            'exam_id' => 'Soal Ujian',
            'name' => 'Name',
            'description' => 'Keterangan',
            'date_test' => 'Tanggal',
            'time_start' => 'Mulai',
            'time_end' => 'Selesai',
            'exam_total' => 'Jumlah Soal',
            'created' => 'Created',
            'created_user_id' => 'Created By',
            'modified' => 'Modified',
            'result_max' => 'Nilai Maksimal',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = array('User');
        $criteria->with = array('Exam');
        $criteria->with = array('Classroom');
        $criteria->together = true;

        $criteria->compare('id', $this->id);
        $criteria->compare('classroom_id', $this->classroom_id, true);
        $criteria->compare('Exam.name', $this->exam_id, true);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('date_test', $this->date_test, true);
        $criteria->compare('time_start', $this->time_start, true);
        $criteria->compare('time_end', $this->time_end, true);
        $criteria->compare('exam_total', $this->exam_total);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_user_id', $this->created_user_id, true);
        $criteria->compare('modified', $this->modified, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.id Desc',
            ),
        ));
    }

    public function behaviors() {
        return array(
            'timestamps' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created',
                'updateAttribute' => 'modified',
                'setUpdateOnCreate' => true,
            ),
        );
    }

    protected function beforeValidate() {
        if (empty($this->created_user_id))
            $this->created_user_id = Yii::app()->user->id;
        return parent::beforeValidate();
    }

    public function deleteRec($id) {
        $mTestResult = TestResult::model()->findAll(array('condition' => 'test_id=' . $id));
        foreach ($mTestResult as $arrTestResult) {
            TestResultDetail::model()->deleteAll(array('condition' => 'test_result_id=' . $arrTestResult->id));
            $arrTestResult->delete();
        }
        $this->findByPk($id)->delete();
    }

    public function getKeterangan() {
        if ($this->date_test == date('Y-m-d')) {
            echo'<span class="label label-info">Berlangsung</span>';
        } elseif ($this->date_test > date('Y-m-d')) {
            echo '<span class="label label-warning">Belum</span>';
        } else {
            echo'<span class="label label-success">Selesai</span>';
        }
    }

}
