<?php

/**
 * This is the model class for table "attendance_logs".
 *
 * The followings are the available columns in table 'attendance_logs':
 * @property string $id
 * @property integer $driver
 * @property string $time_in
 * @property string $time_out
 * @property string $time_in_latitude
 * @property string $time_in_longitude
 * @property string $time_out_latitude
 * @property string $time_out_longitude
 */
class AttendanceLogs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'attendance_logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	 
	public $month;
	public $year;
	
	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('driver, time_in, time_in_latitude, time_in_longitude', 'required'),
			array('driver', 'numerical', 'integerOnly'=>true),
			array('time_in_latitude, time_in_longitude, time_out_latitude, time_out_longitude', 'length', 'max'=>10),
			array('time_out', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, driver, time_in, time_out, time_in_latitude, time_in_longitude, time_out_latitude, time_out_longitude', 'safe', 'on'=>'search'),
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
			'Driver'=>array(self::HAS_ONE, 'Driver', array( 'id' => 'driver' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Attendance',
			'driver' => 'Driver',
			'time_in' => 'Time In',
			'time_out' => 'Time Out',
			'time_in_latitude' => 'Time In Latitude',
			'time_in_longitude' => 'Time In Longitude',
			'time_out_latitude' => 'Time Out Latitude',
			'time_out_longitude' => 'Time Out Longitude',
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
		$criteria->compare('driver',$this->driver,true);
		$criteria->compare('DATE_FORMAT(time_in,"%Y")',$this->year,true);
		$criteria->compare('DATE_FORMAT(time_in,"%m")',$this->month,true);
		$criteria->compare('time_out',$this->time_out,true);
		$criteria->compare('time_in_latitude',$this->time_in_latitude,true);
		$criteria->compare('time_in_longitude',$this->time_in_longitude,true);
		$criteria->compare('time_out_latitude',$this->time_out_latitude,true);
		$criteria->compare('time_out_longitude',$this->time_out_longitude,true);
		
		$criteria->addCondition('driver != 0');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AttendanceLogs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
