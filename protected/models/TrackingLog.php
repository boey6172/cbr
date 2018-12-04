<?php

/**
 * This is the model class for table "tracking_logs".
 *
 * The followings are the available columns in table 'tracking_logs':
 * @property string $tracking_id
 * @property integer $car
 * @property integer $driver
 * @property integer $reservation
 * @property string $longitude
 * @property string $latitude
 * @property string $saved_date
 */
class TrackingLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tracking_logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('car, driver, reservation, longitude, latitude, saved_date', 'required'),
			array('car, driver, reservation', 'numerical', 'integerOnly'=>true),
			array('longitude, latitude', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tracking_id, car, driver, reservation, longitude, latitude, saved_date', 'safe', 'on'=>'search'),
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
			'tracking_id' => 'Tracking',
			'car' => 'Car',
			'driver' => 'Driver',
			'reservation' => 'Reservation',
			'longitude' => 'Longitude',
			'latitude' => 'Latitude',
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

		$criteria->compare('tracking_id',$this->tracking_id,true);
		$criteria->compare('car',$this->car);
		$criteria->compare('driver',$this->driver);
		$criteria->compare('reservation',$this->reservation);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('saved_date',$this->saved_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TrackingLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
