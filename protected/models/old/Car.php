<?php

/**
 * This is the model class for table "cars".
 *
 * The followings are the available columns in table 'cars':
 * @property string $cars_id
 * @property string $plate_no
 * @property string $brand
 * @property string $model
 * @property integer $year
 * @property integer $passenger_cap
 * @property string $car_img
 * @property string $date_added
 * @property string $name
 * @property integer $status
 * @property integer $current_mileage
 * @property boolean $isVip
 */
class Car extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Car the static model class
	 */

	public $start_date;
	public $end_date;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cars';
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
			array('year, passenger_cap, status,current_mileage', 'numerical', 'integerOnly'=>true),
			array('cars_id', 'length', 'max'=>36),
			array('plate_no', 'length', 'max'=>50),
			array('brand, model', 'length', 'max'=>255),
			array('car_img, date_added', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cars_id, plate_no, brand, model, year, passenger_cap, car_img, date_added, status, isVip, name,current_mileage', 'safe', 'on'=>'search'),
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
			'CarStatus'=>array(self::HAS_ONE, 'CarStatus', array( 'status_id' => 'status' )),
			'Reservation'=>array(self::HAS_MANY, 'Reservation', array( 'car_id' => 'cars_id' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cars_id' => 'Cars',
			'plate_no' => 'Plate No',
			'brand' => 'Brand',
			'model' => 'Model',
			'year' => 'Year',
			'passenger_cap' => 'Passenger Cap',
			'car_img' => 'Car Img',
			'date_added' => 'Date Added',
			'status' => 'Status',
			'name' => 'Name',
			'current_mileage' => 'Current Mileage',
			'isVip' => 'isVip',
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

		$criteria->compare('cars_id',$this->cars_id,true);
		$criteria->compare('plate_no',$this->plate_no,true);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('passenger_cap',$this->passenger_cap);
		$criteria->compare('car_img',$this->car_img,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('isVip',$this->isVip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
                'defaultOrder'=>'status ASC, date_added DESC',
            ),
            'pagination'=>array(
		        'pageSize'=>8,
		    ),
		));
	}

	public function availableCars()
	{
		$criteria=new CDbCriteria;

		$criteria->alias = "Car";

		$criteria->with[] = 'Reservation';
            $criteria->together = true;

        // CHANGE CRITERIA

		$criteria->addCondition( "Car.status NOT IN (2,3) AND Car.isVip = 0 AND Car.passenger_cap >= '{$this->passenger_cap}' " );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
                'defaultOrder'=>'Car.passenger_cap ASC',
            ),
            'pagination'=>false,
		));
	}

	public function beforeSave() {
        if(parent::beforeSave()) {
        	$this->date_added = date( 'Y-m-d H:i:s');
            if(($this->isNewRecord)) {
            	$this->cars_id = Yii::app()->db->createCommand('select UUID()')->queryScalar();
            }
            return true;
        } else 
            return false;
    }
}