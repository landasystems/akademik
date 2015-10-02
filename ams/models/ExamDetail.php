<?php

/**
 * This is the model class for table "{{exam_detail}}".
 *
 * The followings are the available columns in table '{{exam_detail}}':
 * @property integer $id
 * @property integer $exam_id
 * @property string $number
 * @property string $question
 * @property string $answer
 * @property string $type
 */
class ExamDetail extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ExamDetail the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{exam_detail}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('question, type', 'required'),
            array('exam_id, number', 'numerical', 'integerOnly' => true),
            array('type', 'length', 'max' => 45),
            array('correct', 'length', 'max' => 1),
            array('answer, question', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, exam_id, question, answer, type', 'safe', 'on' => 'search'),
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
            'exam_id' => 'Exam',
            'number' => 'Nomor Soal',
            'question' => 'Pertanyaan',
            'answer' => 'Jawaban',
            'type' => 'Tipe',
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
        $criteria->compare('exam_id', $this->exam_id);
        $criteria->compare('number', $this->number, true);
        $criteria->compare('question', $this->question, true);
        $criteria->compare('answer', $this->answer, true);
        $criteria->compare('type', $this->type, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}