<?php

/**
 * This is the model class for table "drivers".
 *
 * The followings are the available columns in table 'drivers':
 * @property string $driver_id
 * @property string $first_name
 * @property string $last_name
 * @property integer $gender
 * @property string $driver_img
 * @property string $contact_no
 * @property string $driver_no
 * @property integer $status
 * @property string $date_started
 * @property boolean $isVip
 */
class Driver extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Driver the static model class
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
			array('', 'required'),
			array('gender, status', 'numerical', 'integerOnly'=>true),
			array('driver_id', 'length', 'max'=>36),
			array('first_name, last_name, contact_no, driver_no', 'length', 'max'=>255),
			array('driver_img', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('driver_id, first_name, last_name, gender, driver_img, contact_no, driver_no, status, date_started,isVip', 'safe', 'on'=>'search'),
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
			'DriverStatus'=>array(self::HAS_ONE, 'DriverStatus', array( 'status_id' => 'status' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'driver_id' => 'Driver',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'gender' => 'Gender',
			'driver_img' => 'Driver Img',
			'contact_no' => 'Contact No',
			'driver_no' => 'Driver No',
			'status' => 'Status',
			'date_started' => 'Date Started',
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

		$criteria->compare('driver_id',$this->driver_id,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('driver_no',$this->driver_no,true);
		$criteria->compare('date_started',$this->date_started,true);
		$criteria->compare('date_started',$this->isVip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
                'defaultOrder'=>'status ASC, date_started DESC',
            ),
		));
	}

	public function beforeSave() {
        if(parent::beforeSave()) {
        	$this->date_started = date( 'Y-m-d H:i:s');
            if(($this->isNewRecord)) {
            	$this->driver_id = Yii::app()->db->createCommand('select UUID()')->queryScalar();
            }
            return true;
        } else 
            return false;
    } 
}