<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $user_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $surname
 * @property string is_activated
 * @property string $profile_pic
 */
class User extends CActiveRecord
{
	public $confirm_password;
	public $inactive;
	public $active;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username', 'required'),	
			array('username, password, email', 'length', 'max'=>128),
			array('first_name, surname', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username, password, email, first_name, surname, is_activated, profile_pic, department', 'safe', 'on'=>'search'),
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
            'Department'=>array(self::HAS_ONE, 'Department', array( 'department_id' => 'department' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'username' => 'Username',
			'first_name' => 'First Name',
			'surname' => 'Surname',
			'password' => 'Password',
			'is_activated' => 'Activated',
			'email' => 'Email',
			'profile_pic' => 'pic',
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

		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('surname',$this->surname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
                'defaultOrder'=>'is_activated ASC',
            ),
		));
	}
    
    public function validatePassword($password) {
        return CPasswordHelper::verifyPassword($password,$this->password);
    }
    
    public function hashPassword($password) {
        return CPasswordHelper::hashPassword($password);
    }
	
	public function decryptCredential($credential)
    {
    	return base64_encode(Yii::app()->getSecurityManager()->encrypt($credential));
    }
    
    public function beforeSave() {
        if(parent::beforeSave()) {

        	if(trim($this->email) != "" && isset($this->email)) {
				$this->email = base64_encode(Yii::app()->getSecurityManager()->encrypt($this->email));
        	}
        	if(trim($this->first_name) != "" && isset($this->first_name)) {
				$this->first_name = base64_encode(Yii::app()->getSecurityManager()->encrypt($this->first_name));
        	}
        	if(trim($this->surname) != "" && isset($this->first_name)) {
				$this->surname = base64_encode(Yii::app()->getSecurityManager()->encrypt($this->surname));
        	}
        	if(trim($this->password) != "" && isset($this->password)) {
	            $newPassword = $this->hashPassword( $this->password );
	            $this->password = $newPassword;
        	}
        	else {
        		unset($this->password);
        	}

            if(($this->isNewRecord)) {
            	$this->user_id = Yii::app()->db->createCommand('select UUID()')->queryScalar();
            }
            return true;
        } else 
            return false;
    }

    protected function afterFind() {
    
    	if($this->email != "") {
			$this->email = Yii::app()->getSecurityManager()->decrypt(base64_decode(utf8_decode($this->email)));
    	}
    	if($this->first_name != "") {
			$this->first_name = Yii::app()->getSecurityManager()->decrypt(base64_decode(utf8_decode($this->first_name)));
    	}
    	if($this->surname != "") {
			$this->surname = Yii::app()->getSecurityManager()->decrypt(base64_decode(utf8_decode($this->surname)));
    	}

        parent::afterFind();
    }
      
    
}