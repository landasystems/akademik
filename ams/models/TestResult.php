<?php

/**
 * This is the model class for table "{{test_result}}".
 *
 * The followings are the available columns in table '{{test_result}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $test_id
 * @property integer $result
 * @property integer $correct_total
 * @property string $time_start
 * @property string $time_end
 */
class TestResult extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TestResult the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{test_result}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//            array('user_id, test_id', 'required'),
            array('user_id, test_id, result, correct_total', 'numerical', 'integerOnly' => true),
            array('time_start, time_end', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, test_id, result, correct_total, time_start, time_end', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Test' => array(self::BELONGS_TO, 'Test', 'test_id'),
            'User' => array(self::BELONGS_TO, 'User', 'user_id'),
            'Exam' => array(self::BELONGS_TO, 'Exam', 'exam_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'test_id' => 'Test',
            'result' => 'Result',
            'correct_total' => 'Correct Total',
            'time_start' => 'Time Start',
            'time_end' => 'Time End',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('test_id', $this->test_id);
        $criteria->compare('result', $this->result);
        $criteria->compare('correct_total', $this->correct_total);
        $criteria->compare('time_start', $this->time_start, true);
        $criteria->compare('time_end', $this->time_end, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeValidate() {
        if (empty($this->user_id))
            $this->user_id = user()->id;
        return parent::beforeValidate();
    }
    
    public function isFinish($test_id, $user_id){
//        $results = cmd()
//                ->select('tr.time_end')
//                ->from('test t')
//                ->join('test_result tr', 'tr.test_id=t.id')
//                ->where('tr.user_id='.$user_id.' AND t.exam_id='.$exam_id)
//                ->queryRow();
        $results = cmd()
                ->select('tr.time_end')
                ->from('test t')
                ->join('test_result tr', 'tr.test_id=t.id')
                ->where('tr.user_id='.$user_id.' AND t.id='.$test_id)
                ->queryRow();
        
        return (empty($results)) ? false : (!empty($results['time_end'])) ? true : false;
        return '';
    }
    
    public function getExamCat(){
        if(isset($this->Exam->ExamCategory["name"])){
            
        }
    }
    public function getExamName(){
        if(isset($this->Exam->name)){
            
        }
    }

}