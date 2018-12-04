<?php

/**
 * This is the model class for table "car_part_request".
 *
 * The followings are the available columns in table 'car_part_request':
 * @property integer $car_part_request_id
 * @property string $item_request
 * @property integer $item_qty
 * @property string $item_amount
 * @property string $car
 * @property string $driver
 * @property integer $saved_by
 * @property string $saved_date
 */
class CarPartRequest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'car_part_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_request, item_qty, item_amount, car, driver,', 'required'),
			array('item_qty, saved_by', 'numerical', 'integerOnly'=>true),
			array('item_request, car, driver', 'length', 'max'=>255),
			array('item_amount', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('car_part_request_id, item_request, item_qty, item_amount, car, driver, saved_by, saved_date', 'safe', 'on'=>'search'),
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
			'Car'=>array(self::HAS_ONE, 'Car', array( 'cars_id' => 'car' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'car_part_request_id' => 'Car Part Request',
			'item_request' => 'Item Request',
			'item_qty' => 'Item Qty',
			'item_amount' => 'Item Amount',
			'car' => 'Car',
			'driver' => 'Requestor',
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

		$criteria->compare('car_part_request_id',$this->car_part_request_id);
		$criteria->compare('item_request',$this->item_request,true);
		$criteria->compare('item_qty',$this->item_qty);
		$criteria->compare('item_amount',$this->item_amount,true);
		$criteria->compare('car',$this->car,true);
		$criteria->compare('driver',$this->driver,true);
		$criteria->compare('saved_by',$this->saved_by);
		$criteria->compare('saved_date',$this->saved_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => false,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CarPartRequest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
