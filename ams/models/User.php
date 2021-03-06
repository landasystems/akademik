<?php

/**
 * This is the model class for table "{{m_user}}".
 *
 * The followings are the available columns in table '{{m_user}}':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $employeenum
 * @property string $name
 * @property integer $city_id
 * @property string $address
 * @property string $phone
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class User extends CActiveRecord {

    public $cache;

//    public function __construct() {
//        $this->cache = Yii::app()->cache;
//    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
//    public function getDbConnection() {
//        return Yii::app()->db2;
//    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('city_id, roles_id', 'required'),
            array('city_id,saldo, created_user_id', 'numerical', 'integerOnly' => true),
            array('username, phone', 'length', 'max' => 20),
            array('', 'length', 'max' => 100),
            array('name, password, name,description, address', 'length', 'max' => 255),
            array('code', 'length', 'max' => 25),
            array('modified, enabled', 'safe'),
            array('username, email', 'unique', 'message' => '{attribute} : {value} already exists!'),
            array('email', 'email'),
            array('username, email', 'required'),
            array('username, email', 'safe', 'message' => '{attribute} : {value} already exists!'),
            array('id, username, email,saldo, password, code, name, city_id, address, phone, created, created_user_id, modified,description,others', 'safe', 'on' => 'search'),
            array('avatar_img', 'unsafe'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'code' => 'Nomor Induk',
            'name' => 'Nama',
            'city_id' => 'Kota',
            'province_id' => 'Provinsi',
            'address' => 'Alamat',
            'phone' => 'No. Telephone',
            'created' => 'Created',
            'created_user_id' => 'Created Userid',
            'modified' => 'Modified',
        );
    }

    public function search($type = 'user') {
        $criteria = new CDbCriteria;
        $criteria->with = array('Roles');
        $criteria->together = true;

        $criteria->compare('username', $this->username, true);
        $criteria->compare('email', $this->email, true);
//        $criteria->compare('password', $this->password, true);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('phone', $this->phone, true);

        if ($type == 'student') {
            $criteria->compare('roles_id', 2);
        } else {
            $criteria->compare('roles_id', 1);
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 't.id Desc',)
        ));
    }

    public function listUser() {
//        if (!app()->session['listUser']) {
//            $result = array();
        $users = $this->findAll(array('index' => 'id'));
//            app()->session['listUser'] = $users;
//        }
        return $users;
//        return app()->session['listUser'];
    }

    public function listUserPhone() {
//        if (!app()->session['listUserPhone']) {
//            $result = array();
        $users = $this->findAll(array('index' => 'phone'));
//            app()->session['listUserPhone'] = $users;
//        }

        return $users;
//        return app()->session['listUserPhone'];
    }

    public function roles() {
        $result = Roles::model()->findAll();
        return $result;
    }

    public function role($user_id) {
        $role = User::model()->findByPk($user_id);

        if (isset($role->Roles->name)) {
            $result = $role->Roles->name;
        } else {
            $result = '';
        }

        return $result;
    }

    public function listUsers($type = '') {
        $siteConfig = SiteConfig::model()->listSiteConfig();
        if ($type == 'user') {
//             $criteria->with = array('Roles');
//            $criteria->together = true;
            $sResult = User::model()->with('Roles')->findAll(array('condition' => 'Roles.is_allow_login=1'));
        } elseif ($type == 'supplier') {
            $sCriteria = json_decode($siteConfig->roles_supplier, true);
            $list = '';
            foreach ($sCriteria as $o) {
                $list .= '"' . $o . '",';
            }
            $list = substr($list, 0, strlen($list) - 1);
            $sResult = User::model()->findAll(array('condition' => 'roles_id in(' . $list . ')'));
        } elseif ($type == 'customer') {
            $sCriteria = json_decode($siteConfig->roles_customer, true);
            $list = '';
            foreach ($sCriteria as $o) {
                $list .= '"' . $o . '",';
            }
            $list = substr($list, 0, strlen($list) - 1);
            $sResult = User::model()->findAll(array('condition' => 'roles_id in(' . $list . ')'));
        } elseif ($type == 'contact') {
            $sCriteria = json_decode($siteConfig->roles_contact, true);
            $list = '';
            foreach ($sCriteria as $o) {
                $list .= '"' . $o . '",';
            }
            $list = substr($list, 0, strlen($list) - 1);
            $sResult = User::model()->findAll(array('condition' => 'roles_id in(' . $list . ')'));
        }
        return $sResult;
    }

    public function typeRoles($sType = 'user') {
        $siteConfig = SiteConfig::model()->listSiteConfig();
        $result = array();

        if ($sType == 'user') {
            if (Yii::app()->user->roles_id == -1) {
                $array = array(-1 => 'Super User');
            } else {
                $array = array();
            }

            $sResult = Roles::model()->findAll(array('condition' => 'is_allow_login=1'));
            $result = $array + Chtml::listdata($sResult, 'id', 'name');
        } elseif ($sType == 'customer') {
            $customers = json_decode($siteConfig->roles_customer, true);
            $list = '';
            foreach ($customers as $customer) {
                $list .= '"' . $customer . '",';
            }
            $list = substr($list, 0, strlen($list) - 1);
            $sResult = Roles::model()->findAll(array('condition' => 'id in(' . $list . ')'));
            $result = Chtml::listdata($sResult, 'id', 'name');
        } elseif ($sType == 'supplier') {
            $customers = json_decode($siteConfig->roles_supplier, true);
            $list = '';
            foreach ($customers as $customer) {
                $list .= '"' . $customer . '",';
            }
            $list = substr($list, 0, strlen($list) - 1);
            $sResult = Roles::model()->findAll(array('condition' => 'id in(' . $list . ')'));
            $result = Chtml::listdata($sResult, 'id', 'name');
        } elseif ($sType == 'employment') {
            $customers = json_decode($siteConfig->roles_employment, true);
            $list = '';
            foreach ($customers as $customer) {
                $list .= '"' . $customer . '",';
            }
            $list = substr($list, 0, strlen($list) - 1);
            $sResult = Roles::model()->findAll(array('condition' => 'id in(' . $list . ')'));
            $result = Chtml::listdata($sResult, 'id', 'name');
        } elseif ($sType == 'contact') {
            $contact = json_decode($siteConfig->roles_contact, true);
            $list = '';
            foreach ($contact as $contact) {
                $list .= '"' . $contact . '",';
            }
            $list = substr($list, 0, strlen($list) - 1);
            $sResult = Roles::model()->findAll(array('condition' => 'id in(' . $list . ')'));
            $result = Chtml::listdata($sResult, 'id', 'name');
        }


        return $result;
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'City' => array(self::BELONGS_TO, 'City', 'city_id'),
            'Payment' => array(self::HAS_MANY, 'Payment', 'id'),
            'SaldoDeposit' => array(self::HAS_MANY, 'SaldoDeposit', 'id'),
            'SaldoWithdrawal' => array(self::HAS_MANY, 'SaldoWithdrawal', 'id'),
            'FormBuilder' => array(self::HAS_MANY, 'FormBuilder', 'id'),
            'Roles' => array(self::BELONGS_TO, 'Roles', 'roles_id'),
            'UserLog' => array(self::HAS_MANY, 'UserLog', 'id'),
        );
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password) {
        return $this->hashPassword($password) === $this->password;
    }

    /**
     * Generates the password hash.
     * @param string password
     * @param string salt
     * @return string hash
     */
    public function hashPassword($password) {
        return sha1($password);
    }

    public function getUrlFull() {
        return param('urlImg') . $this->DownloadCategory->path . $this->url;
    }

    public function getUrlDel() {
        return createUrl('download/' . $this->Download->id);
    }

    public function getImgUrl() {
        return landa()->urlImg('avatar/', $this->avatar_img, $this->id);
    }

    public function getUrl() {

        return url('user/' . $this->id);
    }

    public function getTagImg() {
        return '<img src="' . $this->imgUrl['small'] . '" class="img-polaroid" width="50"/><br>';
    }

    public function getTagBiodata() {
        return '<div class="row-fluid" style="min-height: 0;">
                    <div class="span3" style="text-align:left">
                        <b>Nama</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->name . '
                    </div>
                </div>
                <div class="row-fluid" style="min-height: 0;">
                    <div class="span3" style="text-align:left">
                        <b>Provinsi</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->City->Province->name . '
                    </div>
                </div>
                <div class="row-fluid" style="min-height: 0;">
                    <div class="span3" style="text-align:left">
                        <b>Kota/Kab</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->City->name . '
                    </div>
                </div>
                <div class="row-fluid" style="min-height: 0;">
                    <div class="span3" style="text-align:left">
                        <b>Telepon</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        +62' . $this->phone . '
                    </div>
                </div>
                ';
    }

    public function getTagAccess() {
        $enabled = ($this->enabled == 0) ? "<span class=\"label label-important\">No</span>" :
                "<span class=\"label label-info\">Yes</span>";
        $roles = (isset($this->Roles->name)) ? $this->Roles->name : '';
        return '<div class="row-fluid" style="min-height: 0;">
                    <div class="span3" style="text-align:left">
                        <b>Username</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->username . '
                    </div>
                </div>
                <div class="row-fluid" style="min-height: 0;">
                    <div class="span3" style="text-align:left">
                        <b>E-mail</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->email . '
                    </div>
                </div>
                <div class="row-fluid" style="min-height: 0;">
                    <div class="span3" style="text-align:left"  >
                        <b>Enabled</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $enabled . '
                    </div>
                </div>';
    }

    function getFullContact() {
        return $this->name . ' (0' . $this->phone . ')';
    }

//    public function getEnable(){
//        return '$this->enabled == 1 ? 'badge badge-success' : (($model->result >= 80) ? 'badge badge-warning' : 'badge badge-important');
//$result = '<span class="' . $resultColor . '"><h1>' . $model->result . '</h1></span>';';
//    }
}
