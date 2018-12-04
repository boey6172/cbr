<?php

/**
 * This is the model class for table "drivers".
 *
 * The followings are the available columns in table 'drivers':
 * @property string $id
 * @property string $full_name
 * @property string $picture
 * @property string $contact_no
 * @property string $email
 * @property string $password
 * @property string $rating
 * @property integer $rating_count
 * @property string $remember_token
 * @property integer $driver_status
 */
class Driver extends CActiveRecord
{
	public $car;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'drivers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('full_name, contact_no, driver_status', 'required'),
			array('rating_count, driver_status', 'numerical', 'integerOnly'=>true),
			array('full_name, remember_token', 'length', 'max'=>100),
			array('contact_no, rating', 'length', 'max'=>11),
			array('email, password', 'length', 'max'=>128),
			array('picture', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, full_name, picture, contact_no, email, password, rating, rating_count, remember_token, driver_status', 'safe', 'on'=>'search'),
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
			'full_name' => 'Full Name',
			'picture' => 'Picture',
			'contact_no' => 'Contact No',
			'email' => 'Email',
			'password' => 'Password',
			'rating' => 'Rating',
			'rating_count' => 'Rating Count',
			'remember_token' => 'Remember Token',
			'driver_status' => 'Driver Status',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('contact_no',$this->contact_no,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('rating',$this->rating,true);
		$criteria->compare('rating_count',$this->rating_count);
		$criteria->compare('remember_token',$this->remember_token,true);
		// $criteria->compare('driver_status',$this->driver_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function hashPassword($password) {
        return CPasswordHelper::hashPassword($password);
    }
    
    public function beforeSave() {
        if(parent::beforeSave()) {
            if(($this->isNewRecord) || isset($this->password)) {
                $newPassword = $this->hashPassword( $this->password );
                $this->password = $newPassword;
            }
            return true;
        } else 
            return false;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Driver the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
