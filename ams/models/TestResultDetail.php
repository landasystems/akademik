<?php

/**
 * This is the model class for table "{{test_result_detail}}".
 *
 * The followings are the available columns in table '{{test_result_detail}}':
 * @property integer $id
 * @property integer $test_result_id
 * @property integer $exam_detail_id
 * @property string $answer
 * @property integer $correct
 */
class TestResultDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TestResultDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{test_result_detail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('test_result_id, exam_detail_id, correct, number', 'numerical', 'integerOnly'=>true),
			array('answer', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, test_result_id, exam_detail_id, answer, correct', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'test_result_id' => 'Test Result',
			'exam_detail_id' => 'Exam Detail',
			'answer' => 'Answer',
			'correct' => 'Correct',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('test_result_id',$this->test_result_id);
		$criteria->compare('exam_detail_id',$this->exam_detail_id);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('correct',$this->correct);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}