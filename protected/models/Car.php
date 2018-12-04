<?php

/**
 * This is the model class for table "car".
 *
 * The followings are the available columns in table 'car':
 * @property integer $car_id
 * @property string $plate_no
 * @property string $car_model
 * @property string $car_brand
 * @property string $picture
 * @property string $car_type
 * @property string $engine_type
 * @property integer $passenger_capacity
 * @property string $gas_capacity
 * @property string $distance_capacity
 * @property string $current_mileage
 * @property integer $default_driver
 * @property integer $car_status
 */
class Car extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'car';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('plate_no, car_model, car_brand, passenger_capacity, distance_capacity, car_status', 'required'),
			array(
		      '', 'required', 'on' => 'driverremove',
		    ),
			array('passenger_capacity, default_driver, car_status', 'numerical', 'integerOnly'=>true),
			array('plate_no', 'length', 'max'=>16),
			array('car_model, car_brand, car_type, engine_type', 'length', 'max'=>64),
			array('gas_capacity, distance_capacity, current_mileage', 'length', 'max'=>11),
			array('picture', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('car_id, plate_no, car_model, car_brand, picture, car_type, engine_type, passenger_capacity, gas_capacity, distance_capacity, current_mileage, default_driver, car_status', 'safe', 'on'=>'search'),
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
			'car_id' => 'Car',
			'plate_no' => 'Plate No',
			'car_model' => 'Model',
			'car_brand' => 'Brand',
			'picture' => 'Picture',
			'car_type' => 'Car Type',
			'engine_type' => 'Engine Type',
			'passenger_capacity' => 'Passenger Capacity',
			'gas_capacity' => 'Gas Capacity',
			'distance_capacity' => 'Distance Capacity',
			'current_mileage' => 'Current Mileage',
			'default_driver' => 'Assigned Driver',
			'car_status' => 'Car Status',
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

		$criteria->compare('car_id',$this->car_id);
		$criteria->compare('plate_no',$this->plate_no,true);
		$criteria->compare('car_model',$this->car_model,true);
		$criteria->compare('car_brand',$this->car_brand,true);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('car_type',$this->car_type,true);
		$criteria->compare('engine_type',$this->engine_type,true);
		$criteria->compare('passenger_capacity',$this->passenger_capacity);
		$criteria->compare('gas_capacity',$this->gas_capacity,true);
		$criteria->compare('distance_capacity',$this->distance_capacity,true);
		$criteria->compare('current_mileage',$this->current_mileage,true);
		$criteria->compare('default_driver',$this->default_driver);
		$criteria->compare('car_status',$this->car_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Car the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
