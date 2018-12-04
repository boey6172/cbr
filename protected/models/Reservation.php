<?php

/**
 * This is the model class for table "reservations".
 *
 * The followings are the available columns in table 'reservations':
 * @property string $reservation_id
 * @property string $reservation_no
 * @property integer $car
 * @property integer $driver
 * @property string $reserved_date
 * @property string $arrival_date
 * @property string $hq_arrival_date
 * @property string $pick_up_location
 * @property string $drop_off_location
 * @property string $passengers
 * @property integer $no_of_passengers
 * @property string $distance
 * @property string $mileage_start
 * @property string $mileage_end
 * @property integer $reservation_type
 * @property integer $reservation_status
 * @property integer $user_cancelled
 * @property string $saved_by
 * @property string $saved_date
 * @property string $cancellation_remarks
 */
class Reservation extends CActiveRecord
{
	public $canceled;
    public $reserved;
    public $transit;
    public $arrived;
    public $done;
    public $estimated_time;
    //public $estimated_fare;
    public $year;
    public $month;

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
			array('car, driver, reserved_date, pick_up_location, drop_off_location, no_of_passengers, reservation_type, contact_no', 'required', 'on' => 'carreservation'),
			array(
		      'driver, reserved_date, pick_up_location, drop_off_location, reservation_type', 'required', 'on' => 'driverreservation',
		    ),
			array('car, driver, no_of_passengers, reservation_type, reservation_status, user_cancelled', 'numerical', 'integerOnly'=>true),
			array('reservation_no', 'length', 'max'=>32),
			array('pick_up_location, drop_off_location', 'length', 'max'=>128),
			array('passengers, cancellation_remarks', 'length', 'max'=>255),
			array('distance, mileage_start, mileage_end,estimated_fare, contact_no', 'length', 'max'=>11),
			array('saved_by', 'length', 'max'=>36),
			array('arrival_date, hq_arrival_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('reservation_id, reservation_no, car, driver, reserved_date, arrival_date, hq_arrival_date, pick_up_location, drop_off_location, passengers, no_of_passengers, distance, mileage_start, mileage_end, reservation_type, reservation_status, user_cancelled, saved_by, saved_date, cancellation_remarks', 'safe', 'on'=>'search'),
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
			'ReservationStatus'=>array(self::HAS_ONE, 'ReservationStatus', array( 'status_id' => 'reservation_status' )),
			'ReservationType'=>array(self::HAS_ONE, 'ReservationType', array( 'type_id' => 'reservation_type' )),
			'User'=>array(self::HAS_ONE, 'User', array( 'user_id' => 'saved_by' )),
			'Car'=>array(self::HAS_ONE, 'Car', array( 'car_id' => 'car' )),
			'Driver'=>array(self::HAS_ONE, 'Driver', array( 'id' => 'driver' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'reservation_id' => 'Reservation',
			'reservation_no' => 'Reservation No',
			'car' => 'Car',
			'driver' => 'Driver',
			'reserved_date' => 'Reserved Date',
			'arrival_date' => 'Arrival Date',
			'hq_arrival_date' => 'Hq Arrival Date',
			'pick_up_location' => 'Pick Up Location',
			'drop_off_location' => 'Drop Off Location',
			'passengers' => 'Passengers',
			'no_of_passengers' => 'No Of Passengers',
			'distance' => 'Distance',
			'mileage_start' => 'Mileage Start',
			'mileage_end' => 'Mileage End',
			'reservation_type' => 'Reservation Type',
			'reservation_status' => 'Reservation Status',
			'user_cancelled' => 'User Cancelled',
			'saved_by' => 'Saved By',
            'saved_date' => 'Saved Date',
			'contact_no' => 'Contact Number',
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

		$criteria->compare('reservation_id',$this->reservation_id,true);
		$criteria->compare('car',$this->car);
		$criteria->compare('driver',$this->driver);
		$criteria->compare('arrival_date',$this->arrival_date,true);
		$criteria->compare('hq_arrival_date',$this->hq_arrival_date,true);
		$criteria->compare('pick_up_location',$this->pick_up_location,true);
		$criteria->compare('drop_off_location',$this->drop_off_location,true);
		$criteria->compare('passengers',$this->passengers,true);
		$criteria->compare('no_of_passengers',$this->no_of_passengers);
		$criteria->compare('distance',$this->distance,true);
		$criteria->compare('mileage_start',$this->mileage_start,true);
		$criteria->compare('mileage_end',$this->mileage_end,true);
		$criteria->compare('reservation_type',$this->reservation_type);
		$criteria->compare('reservation_status',$this->reservation_status);
		$criteria->compare('user_cancelled',$this->user_cancelled);
		$criteria->compare('saved_by',$this->saved_by,true);
		$criteria->compare('saved_date',$this->saved_date,true);

		if(isset($this->reservation_no) && $this->reservation_no != '')
		{
			$criteria->addCondition("reservation_no = '{$this->reservation_no}'");
		}

		if(isset($this->reserved_date) && $this->reserved_date != '')
		{
			$criteria->compare('reserved_date',date('Y-m-d', strtotime($this->reserved_date)),true);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                 'pageSize'=>'2',
            ),
            'sort'=>array(
	          'defaultOrder'=>'saved_date DESC',
	        ),
		));
	}

	public function Today()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $date = date("Y-m-d");
        $criteria->compare('reservation_id',$this->reservation_id);
        $criteria->compare('reservation_no',$this->reservation_no,true);
        $criteria->compare('car',$this->car);
        $criteria->compare('driver',$this->driver);
        $criteria->compare('reserved_date',$date,true);
        $criteria->compare('arrival_date',$this->arrival_date,true);
        $criteria->compare('hq_arrival_date',$this->hq_arrival_date,true);
        $criteria->compare('pick_up_location',$this->pick_up_location,true);
        $criteria->compare('drop_off_location',$this->drop_off_location,true);
        $criteria->compare('passengers',$this->passengers,true);
        $criteria->compare('no_of_passengers',$this->no_of_passengers);
        $criteria->compare('distance',$this->distance,true);
        $criteria->compare('mileage_start',$this->mileage_start,true);
        $criteria->compare('mileage_end',$this->mileage_end,true);
        $criteria->compare('reservation_type',$this->reservation_type);
        $criteria->compare('reservation_status',$this->reservation_status);
        $criteria->compare('saved_by',$this->saved_by);
        $criteria->compare('saved_date',$this->saved_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function TodaysUserCancelled()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        //$date = date("Y-m-d");
        $userCancelled = 1;
        $reserved = 1;
        
      //  $criteria->compare('reserved_date',$date,true);
        $criteria->compare('user_cancelled',$userCancelled ,true);
        $criteria->compare('reservation_status',$reserved);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>false
        ));
    }
    public function TodaysCancelled()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $date = date("Y-m-d");
        $userCancelled = 1;
        $reserved = 0;
        
        $criteria->compare('reserved_date',$date,true);
        $criteria->compare('user_cancelled',$userCancelled ,true);
        $criteria->compare('reservation_status',$reserved);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>false
        ));
    }
	public function TodaysIntransit()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $date = date("Y-m-d");
        // $userCancelled = 0;
        $reserved = 2;
        
        $criteria->compare('reserved_date',$date,true);
        // $criteria->compare('user_cancelled',$userCancelled ,true);
        $criteria->compare('reservation_status',$reserved);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>false
        ));
    }
	
	public function TodaysDone()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $date = date("Y-m-d");
        //$userCancelled = 0;
        $reserved = 4;
        
        $criteria->compare('reserved_date',$date,true);
        //$criteria->compare('user_cancelled',$userCancelled ,true);
        $criteria->compare('reservation_status',$reserved);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>false
        ));
    }
// all display	
	public function AllReservations()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        // $date = date("Y-m-d");
        // $userCancelled = 0;
        $reserved = 1;
        
        // $criteria->compare('reserved_date',$date,true);
        // $criteria->compare('user_cancelled',$userCancelled ,true);
        $criteria->compare('reservation_status',$reserved);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>false
        ));
    }
	    public function AllUserCancelled()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        //$date = date("Y-m-d");
        $userCancelled = 1;
        $reserved = 1;
        
      //  $criteria->compare('reserved_date',$date,true);
        $criteria->compare('user_cancelled',$userCancelled ,true);
        $criteria->compare('reservation_status',$reserved);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>false
        ));
    }
    public function AllCancelled()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $date = date("Y-m-d");
        $userCancelled = 1;
        $reserved = 0;
        
        // $criteria->compare('reserved_date',$date,true);
        // $criteria->compare('user_cancelled',$userCancelled ,true);
        $criteria->compare('reservation_status',$reserved);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>false
        ));
    }
	public function AllIntransit()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $date = date("Y-m-d");
        // $userCancelled = 0;
        $reserved = 2;
        
        // $criteria->compare('reserved_date',$date,true);
        // $criteria->compare('user_cancelled',$userCancelled ,true);
        $criteria->compare('reservation_status',$reserved);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>false
        ));
    }
	
	public function AllDone()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $date = date("Y-m-d");
        $userCancelled = 0;
        $reserved = 3;
        
        // $criteria->compare('reserved_date',$date,true);
        $criteria->compare('user_cancelled',$userCancelled ,true);
        $criteria->compare('reservation_status',$reserved);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>false
        ));
    }
	
	public function DriverReport()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        
        $criteria->compare('driver',$this->driver,true);
		$criteria->compare('DATE_FORMAT(reserved_date,"%Y")',$this->year,true);
		$criteria->compare('DATE_FORMAT(reserved_date,"%m")',$this->month,true);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>false
        ));
    }


	public function getMaxItems()
	{
		$now = date('Y-m-d');

		$criteria=new CDbCriteria;
		$criteria->addCondition("saved_date",$now,'AND');
		$criteria->compare('reservation_type',$this->reservation_type);

		$model = Reservation::model()-> findAll($criteria);
		$count = count($model);

		return $count;
	}

	public function ticketNo()
	{
        $next = sprintf( '%02d', ( $this->getMaxItems() ));

        // $preset = ($this->reservation_type == 3) ? "PD" : (($this->reservation_type == 1) ? "P" : "D") ;
        // $ticketNo = $preset . date('ymd') . "-" . $next;

        $preset = ($this->reservation_type == 3) ? "9" : (($this->reservation_type == 1) ? "3" : "5") ;
        $ticketNo = $preset . date('ymd') . $next;

        return $ticketNo;
	}

	public function beforeSave() {
        if(parent::beforeSave()) {
        	$this->saved_by = Yii::app()->user->id;
        	if(($this->isNewRecord)) {
        		$this->reservation_no = $this->TicketNo();
        		$this->saved_date = date('Y-m-d H:i:s');
        		$this->reservation_status = '1'; // RESERVED
            }
            return true;
        } else
            return false;
    }
	
	public function getLogs($date)
	{
		$formatted_date = date('Y-m-d', strtotime($date));

		// $alc = new CDbCriteria();
		// $alc->alias = "Attendance";
		// $alc->addCondition("Attendance.user_id = {$this->id} AND Attendance.created_at LIKE '%{$formatted_date}%'");
		// $alc->order = 'created_at ASC';

		// $attendance_logs = Attendance::model()->findAll($alc);

		$tlc = new CDbCriteria();
		$tlc->alias = "TrackingLog";
		$tlc->addCondition("TrackingLog.reservation = {$this->reservation_no}");
		// $tlc->order = 'created_at ASC';

		$track_logs = TrackingLog::model()->findAll($tlc);

		$logs = array();

		// foreach($attendance_logs as $a_log)
		// {
			// $new_log = (object) array();
			// $new_log->longitude = $a_log->longitude;
			// $new_log->latitude = $a_log->latitude;
			// $new_log->log_time = $a_log->created_at;
			// $new_log->log_att_type = $a_log->type_id; // IN-OUT TYPE
			// $new_log->user = $a_log->user_id;

			// $logs[] = $new_log;

		// }

		foreach($track_logs as $t_log)
		{
			$new_log = (object) array();
			$new_log->longitude = $t_log->longitude;
			$new_log->latitude = $t_log->latitude;
			$new_log->log_time = $t_log->saved_date;
			$new_log->log_att_type = null; // NULL FOR TRACK LOGS
			$new_log->user = $t_log->driver;

			$logs[] = $new_log;	
		}

		return $logs;

	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Reservation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
