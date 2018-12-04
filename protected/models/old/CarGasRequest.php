<?php

/**
 * This is the model class for table "car_gas_request".
 *
 * The followings are the available columns in table 'car_gas_request':
 * @property integer $car_gas_request_id
 * @property string $gas_volume
 * @property string $gas_amount
 * @property string $car
 * @property string $driver
 * @property integer $saved_by
 * @property string $saved_date
 */
class CarGasRequest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'car_gas_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gas_volume, gas_amount, car, driver', 'required'),
			array('saved_by', 'numerical', 'integerOnly'=>true),
			array('gas_volume, gas_amount', 'length', 'max'=>11),
			array('car, driver', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('car_gas_request_id, gas_volume, gas_amount, car, driver, saved_by, saved_date', 'safe', 'on'=>'search'),
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
			'Driver'=>array(self::HAS_ONE, 'Driver', array( 'driver_id' => 'driver' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'car_gas_request_id' => 'Car Gas Request',
			'gas_volume' => 'Gas Volume',
			'gas_amount' => 'Gas Amount',
			'car' => 'Car',
			'driver' => 'Driver',
			'saved_by' => 'Saved By',
			'saved_date' => 'Saved Date',
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

		$criteria->compare('car_gas_request_id',$this->car_gas_request_id);
		$criteria->compare('gas_volume',$this->gas_volume,true);
		$criteria->compare('gas_amount',$this->gas_amount,true);
		$criteria->compare('car',$this->car,true);
		$criteria->compare('driver',$this->driver,true);
		$criteria->compare('saved_by',$this->saved_by);
		$criteria->compare('saved_date',$this->saved_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CarGasRequest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
