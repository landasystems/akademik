<?php

/**
 * This is the model class for table "{{exam}}".
 *
 * The followings are the available columns in table '{{exam}}':
 * @property integer $id
 * @property integer $exam_category_id
 * @property string $name
 * @property string $description
 * @property integer $period
 * @property integer $public
 * @property integer $key
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class Exam extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Exam the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{exam}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, period', 'required'),
            array('exam_category_id,school_year_id, period, public, key, created_user_id', 'numerical', 'integerOnly' => true),
            array('name, description', 'length', 'max' => 255),
            array('created, modified, id', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, exam_category_id,school_year_id, name, description, period, public, key, created, created_user_id, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'ExamCategory' => array(self::BELONGS_TO, 'ExamCategory', 'exam_category_id'),
            'Test' => array(self::HAS_MANY, 'Test', 'id'),
            'TestResult' => array(self::HAS_MANY, 'TestResult', 'id'),
            'User' => array(self::BELONGS_TO, 'User', 'created_user_id'),
            'SchoolYear' => array(self::BELONGS_TO, 'SchoolYear', 'school_year_id'),

        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'exam_category_id' => 'Kategori Soal',
            'school_year_id' => 'Tahun ajaran',
            'name' => 'Nama Soal',
            'description' => 'Description',
            'period' => 'Waktu',
            'public' => 'Guru lain boleh memakai soal ini',
            'key' => 'Tampilkan kunci jawaban setelah siswa selesai',
            'created' => 'Created',
            'created_user_id' => 'Created Exam',
            'modified' => 'Modified',
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
        $criteria->with = array('ExamCategory');
        $criteria->with = array('User');
        $criteria->together = true;

        $criteria->compare('id', $this->id);
        $criteria->compare('exam_category_id', $this->exam_category_id, true);
        $criteria->compare('school_year_id', $this->school_year_id, true);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('period', $this->period);
        $criteria->compare('public', $this->public);
        $criteria->compare('key', $this->key);
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

    public function listExam() {
        if (!isset($_SESSION['listExam'])) {
            $result = array();
            $exams = $this->findAll();
            foreach ($exams as $exam) {
                $result[$exam->id] = array('name' => $exam->name);
            }
            $_SESSION['listExam'] = $result;
        }
        return $_SESSION['listExam'];
    }

    public function examResult($ids, $exam_id) {
        $results = cmd('SELECT u.id, test.result FROM user u LEFT JOIN 
                        (
                            SELECT tr.result, tr.user_id
                            FROM test t INNER JOIN test_result tr
                            ON tr.test_id = t.id
                            WHERE t.exam_id = ' . $exam_id . ' AND tr.is_fix=1
                        ) AS test
                        ON test.user_id = u.id
                        WHERE u.id IN (' . $ids . ')')
                ->queryAll();

        return $results;
    }

    public function deleteRec($id) {
        //delete exam detail
        ExamDetail::model()->deleteAll(array('condition' => 'exam_id=' . $id));
        //delete exam
        $this->findByPk($id)->delete();
    }

    public function getUrlExamDet() {
        $detail = url('examDetail/create/' . $this->id);
        return '<a href="' . $detail . '" class="btn btn-small icon-list"></a>';
    }

}
