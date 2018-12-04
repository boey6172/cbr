<?php

/**
 * This is the model class for table "reservations".
 *
 * The followings are the available columns in table 'reservations':
 * @property string $reservation_id
 * @property string $reservation_no
 * @property string $car_id
 * @property string $driver_id
 * @property string $reservation_date_start
 * @property string $reservation_date_end
 * @property string $pickup_location
 * @property string $dropoff_location
 * @property integer $no_passengers
 * @property integer $description
 * @property string $date_saved
 * @property string $date_edited
 * @property integer $status
 * @property string $saved_by
 * @property integer $type
 * @property integer $rate
 * @property integer $mileage
 */
class Reservation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Reservation the static model class
	 */

	public $date;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reservations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reservation_date_start, reservation_date_end', 'required'),
			array('no_passengers, status, type', 'numerical', 'integerOnly'=>true),
			array('reservation_id, reservation_no, driver_id, car_id, saved_by', 'length', 'max'=>36),
			array('pickup_location, description, dropoff_location', 'length', 'max'=>255),
			array('date_edited', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('reservation_id, reservation_no, car_id, driver_id, reservation_date_start, reservation_date_end, pickup_location, dropoff_location, no_passengers, description, date_saved, date_edited, status, saved_by, type, rate,mileage', 'safe', 'on'=>'search'),
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
			'Type'=>array(self::HAS_ONE, 'ReservationType', array( 'type_id' => 'type' )),
			'Car'=>array(self::HAS_ONE, 'Car', array( 'cars_id' => 'car_id' )),
			'Driver'=>array(self::HAS_ONE, 'Driver', array( 'driver_id' => 'driver_id' )),
			'User'=>array(self::HAS_ONE, 'User', array( 'user_id' => 'saved_by' )),
			'Status'=>array(self::HAS_ONE, 'ReservationStatus', array( 'status_id' => 'status' )),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'reservation_id' => 'Reservation Id',
			'reservation_no' => 'Reservation No',
			'car_id' => 'Car',
			'driver_id' => 'Driver',
			'reservation_date_start' => 'Reservation Date Start',
			'reservation_date_end' => 'Reservation Date End',
			'pickup_location' => 'Pickup Location',
			'dropoff_location' => 'Dropoff Location',
			'no_passengers' => 'No Passengers',
			'description' => 'Description',
			'date_saved' => 'Date Saved',
			'date_edited' => 'Date Edited',
			'status' => 'Status',
			'saved_by' => 'Saved By',
			'type' => 'Type',
			'mileage' => 'Mileage',
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

		$criteria->compare('reservation_id',$this->reservation_id);
		$criteria->compare('reservation_no',$this->reservation_no,true);
		$criteria->compare('car_id',$this->car_id,true);
		$criteria->compare('driver_id',$this->driver_id,true);
		$criteria->compare('reservation_date_start',$this->reservation_date_start,true);
		$criteria->compare('reservation_date_end',$this->reservation_date_end,true);
		$criteria->compare('pickup_location',$this->pickup_location,true);
		$criteria->compare('dropoff_location',$this->dropoff_location,true);
		$criteria->compare('no_passengers',$this->no_passengers);
		$criteria->compare('description',$this->description);
		$criteria->compare('date_saved',$this->date_saved,true);
		$criteria->compare('date_edited',$this->date_edited,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('saved_by',$this->saved_by,true);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=> array('defaultOrder'=>'date_saved DESC') 
		));
	}

	public function getCarReservations()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->alias = "Reservation";

		$date = date("Y-m-d", strtotime($this->date));

		$criteria->addCondition("Reservation.car_id = '{$this->car_id}' AND Reservation.status = '1' AND Reservation.reservation_date_start LIKE '%{$date}%'");

		$criteria->order = 'reservation_date_start';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function userReservations()
	{
		$criteria=new CDbCriteria;

		$criteria->alias = "Reservation";

		$this->saved_by = Yii::app()->user->id;

		$criteria->addCondition("Reservation.saved_by = '{$this->saved_by}' AND Reservation.status = '1'");

		$criteria->order = 'reservation_date_start';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getMaxItems()
	{
		$now = date('Y-m-d');

		$criteria=new CDbCriteria;
		$criteria->addCondition("date_saved",$now,'AND');
		$criteria->compare('type',$this->type);

		$model = Reservation::model()-> findAll($criteria);
		$count = count($model);

		return $count;
	}

	public function ticketNo()
	{
        $next = sprintf( '%04d', ( $this->getMaxItems() ));

        $preset = ($this->type == 3) ? "PD" : (($this->type == 1) ? "P" : "D") ;

        $ticketNo = $preset . date('ymd') . "-" . $next;
        return $ticketNo;
	}

	public function beforeSave() {
        if(parent::beforeSave()) {
        	$this->saved_by = Yii::app()->user->id;
        	$this->reservation_no = $this->TicketNo();
        	if(($this->isNewRecord)) {
        		$this->reservation_id = Yii::app()->db->createCommand('select UUID()')->queryScalar();
        		$this->date_saved = date('Y-m-d H:i:s');
            }
            else
            {
            	$this->date_edited = date( 'Y-m-d H:i:s');
            }
            return true;
        } else
            return false;
    }
}
