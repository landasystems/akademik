<?php

/**
 * This is the model class for table "{{site_config}}".
 *
 * The followings are the available columns in table '{{site_config}}':
 * @property integer $id
 * @property string $client_name
 * @property string $client_logo
 * @property integer $city_id
 * @property string $address
 * @property string $phone
 * @property string $email
 */
class SiteConfig extends CActiveRecord {

    public $cache;

    public function __construct() {
        $this->cache = Yii::app()->cache;
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SiteConfig the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{site_config}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('city_id', 'numerical', 'integerOnly' => true),
            array('client_name, client_logo, address', 'length', 'max' => 255),
            array('phone,fax,email, language_default', 'length', 'max' => 45),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, client_name, city_id, address, phone, email,fax', 'safe', 'on' => 'search'),
            array('site_messages', 'safe'),
            array('client_logo', 'unsafe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'City' => array(self::BELONGS_TO, 'City', 'city_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'client_name' => 'Client Name',
            'client_logo' => 'Client Logo',
            'city_id' => 'City',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'fax' => 'Fax',
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
        $criteria->compare('client_name', $this->client_name, true);
        $criteria->compare('client_logo', $this->client_logo, true);
        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('email', $this->email, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getFullAddress() {
        return $this->address . ', ' . $this->City->name . ', ' . $this->City->Province->name;
    }

    public function listSiteConfig() {

//        return SiteConfig::model()->findByPk(param('id'));
//        trace ($this->cache['listSiteConfig']);

        if (empty(Yii::app()->session['site'])) {
//            trace('bb');
            Yii::app()->session['site'] = $this->findByPk(param('id'));
        }
//        trace ($this->cache['listSiteConfig']);
        return Yii::app()->session['site'];
    }

}