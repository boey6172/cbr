<?php

class AdminController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array('allow', 
				'actions'=>array(
					'index',
					'SaveVIPreservation',
					'DoneReservation',
					'ReservationToday',
					'ReservationOnTransit',
					'ReservationDoneToday',
					'ReservationCanceledToday',
					'CheckReservation',
					'CheckCancelledReservation',
					'SearchReservation',
					'map',
					'ReservationEmailArrived',
					'ReservationFullList',
					'finddriver',
                ),
				// 'roles'=>array('rxClient'),
				'roles'=>array('rxAdmin'),
			),
			
			array('deny',  // deny all other users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$vm = (object) array();
		$vm->reservation = new Reservation('search');
		$date = date("Y-m-d");
		$vm->menu = new AdminMenu('search');
	
		$this->render('index', array(
			'vm' => $vm,
		));
	}
	
	public function actionSaveVIPreservation()
	{
			$retVal = "";
			$retMessage = "";
		if(isset($_POST['Reservation']) && isset($_POST['reservation_date_start']) && isset($_POST['reservation_date_end']) 
			&& isset($_POST['pickup_location'])&& isset($_POST['dropoff_location'])&& isset($_POST['no_passengers'])&& isset($_POST['remarks_passenger'])
			&& isset($_POST['type']) &&  trim( $_POST['reservation_date_start']) != ''
			&& trim( $_POST['reservation_date_end']) != ''&& trim( $_POST['pickup_location']) != ''&& trim( $_POST['dropoff_location']) != ''
			&& trim( $_POST['no_passengers']) != '' && trim( $_POST['remarks_passenger']) != '')
		{
				$reservation = new Reservation('search');
				$objectreservation = new Reservation('search');
				$objectreservation->attributes = $_POST['Reservation'];
				$reservation->reservation_date_start =
												date("Y-m-d H:i:s", strtotime($_POST['reservation_date_start']));
				$reservation->reservation_date_end =
												date("Y-m-d H:i:s", strtotime($_POST['reservation_date_end']));
				$reservation->pickup_location = $_POST['pickup_location'];
				$reservation->dropoff_location = $_POST['dropoff_location'];
				$reservation->no_passengers = $_POST['no_passengers'];
				$reservation->remarks = $_POST['remarks_passenger'];
				$reservation->type = $_POST['type'];
				$reservation->car_id = $objectreservation->car_id;
				$reservation->driver_id = $objectreservation->driver_id;

				if($reservation->save())
				{
					$retVal = 'success';
					$retMessage = 'Your Reservation was Successfuly Save';

					$mail = new YiiMailer();
					$mail->setSmtp('redcat.com.ph', 465 , 'ssl', true, 'it@redcat.com.ph', 'P@$$w0rd');
					$mail->setView('mailContent');
					$mail->setData(array('message' => 'Message to send', 'name' => 'John Doe', 'description' => 'Contact form'));
					$mail->setLayout('mailLayout');
					$mail->setFrom('mps@example.com', 'Rx Motorpool');
					$mail->setTo('kevinbryansilva22@gmail.com');
					$mail->setSubject('Mail subject');

					if ($mail->send()) {
						// print_r('Email Sent');
					} else {
						// print_r('Email Not Sent');
					}
				}
				else
				{
					$retVal = 'error';
					$retMessage = 'Sorry Reservation was not Save.';
				}

		}
		else
		{
			$retVal = 'error';
			$retMessage = 'Fill up Forms';
			
		}
		$this->renderPartial('/json/json_ret',
			array(
				'retVal' => $retVal,
				'retMessage' => $retMessage,
			));
	}
	
	public function actionDoneReservation()
	{
		$retVal = "";
		$retMessage = "";
		$retView = "";
		$vm = (object) array();
		$done=2;
		
		if (isset($_POST['rate'])&& trim( $_POST['rate']) && isset($_POST['Mileage']) && trim( $_POST['Mileage'])
			&& isset($_POST['reservation_id'])&& trim( $_POST['reservation_id']) )
			{
			$id= $_POST['reservation_id'];
			$rate= $_POST['rate'];
			$mileage= $_POST['Mileage'];
			$vm->reservation = Reservation::model()->findByAttributes(array('reservation_id' => $id));	
			$vm->car = Car::model()->findByAttributes(array('cars_id' => $vm->reservation->car_id));	
			$vm->car->current_mileage += $mileage;
			$vm->reservation->rate= $rate;
			$vm->reservation->mileage= $mileage;
			$vm->reservation->mileage= $mileage;
			$vm->reservation->status= $done;
			if($vm->reservation->save() && $vm->car->save())
				{
				$retVal = 'success';
				$retMessage = 'Data has been Saved';	
				}
					
				else
				{
					$retVal = 'error';
					$retMessage = 'Sorry Reservation was not Save.';
				}
			
			}
		else
		{
			$retVal = 'error';
			$retMessage = 'Fill up Forms';
			
		}
		
		$this->renderPartial('/json/json_ret',
			array(
				'retVal' => $retVal,
				'retMessage' => $retMessage,
			));
	}
	public function actionReservationToday()
	{
		$retVal = "";
		$retMessage = "";
		$retView = "";
		
		$vm = (object) array();
		$vm->reservation = new Reservation('search');
		$date = date("Y-m-d");
		$vm->reservation->reserved = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reserved_date LIKE '%{$date}%'")->queryScalar();
		// $vm->reservation->transit = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 2 and reserved_date <= '{$date}' and reserved_date >= '{$date}'")->queryScalar();
		// $vm->reservation->done = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 4 and reserved_date <= '{$date}' and reserved_date >= '{$date}'")->queryScalar();
		// $vm->reservation->canceled = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 0 and reserved_date <= '{$date}' and reserved_date >= '{$date}'")->queryScalar();
		
		$this->renderPartial('dashboard/ReservationToday', array(
			'vm' => $vm,
		));
		
	}
	
	public function actionReservationOnTransit()
	{
		$retVal = "";
		$retMessage = "";
		$retView = "";
		
		$vm = (object) array();
		$vm->reservation = new Reservation('search');
		$date = date("Y-m-d");
		// $vm->reservation->reserved = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 1 and reserved_date <= '{$date}' and reserved_date >= '{$date}'")->queryScalar();
		$vm->reservation->transit = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 2 and reserved_date LIKE '%{$date}%'")->queryScalar();
		// $vm->reservation->done = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 4 and reserved_date <= '{$date}' and reserved_date >= '{$date}'")->queryScalar();
		// $vm->reservation->canceled = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 0 and reserved_date <= '{$date}' and reserved_date >= '{$date}'")->queryScalar();
		
		$this->renderPartial('dashboard/reservationOnTransit', array(
			'vm' => $vm,
		));
		
	}
		
	public function actionReservationDoneToday()
	{
		$retVal = "";
		$retMessage = "";
		$retView = "";
		
		$vm = (object) array();
		$vm->reservation = new Reservation('search');
		$date = date("Y-m-d");
		// $vm->reservation->reserved = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 1 and reserved_date <= '{$date}' and reserved_date >= '{$date}'")->queryScalar();
		// $vm->reservation->transit = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 2 and reserved_date <= '{$date}' and reserved_date >= '{$date}'")->queryScalar();
		$vm->reservation->done = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 4 and reserved_date LIKE '%{$date}%'")->queryScalar();
		// $vm->reservation->canceled = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 0 and reserved_date <= '{$date}' and reserved_date >= '{$date}'")->queryScalar();
		
		$this->renderPartial('dashboard/reservationDoneToday', array(
			'vm' => $vm,
		));
		
	}
			
	public function actionReservationCanceledToday()
	{
		$retVal = "";
		$retMessage = "";
		$retView = "";
		
		$vm = (object) array();
		$vm->reservation = new Reservation('search');
		$date = date("Y-m-d");
		// $vm->reservation->reserved = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 1 and reserved_date <= '{$date}' and reserved_date >= '{$date}'")->queryScalar();
		// $vm->reservation->transit = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 2 and reserved_date <= '{$date}' and reserved_date >= '{$date}'")->queryScalar();
		// $vm->reservation->done = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 4 and reserved_date <= '{$date}' and reserved_date >= '{$date}'")->queryScalar();
		$vm->reservation->canceled = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 0 and reserved_date LIKE '%{$date}%'")->queryScalar();
		
		$this->renderPartial('dashboard/reservationCanceledToday', array(
			'vm' => $vm,
		));
		
	}
	public function actionReservationEmailArrived()
	{
		$retVal = "";
		$retMessage = "";
		$retView = "";

		
		$vm = (object) array();
		$vm->reservation = new Reservation('search');
		$date = date("Y-m-d");
		// $vm->reservation->reserved = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 1 and reserved_date <= '{$date}' and reserved_date >= '{$date}'")->queryScalar();
		// $vm->reservation->transit = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 2 and reserved_date <= '{$date}' and reserved_date >= '{$date}'")->queryScalar();
		// $vm->reservation->done = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 4 and reserved_date <= '{$date}' and reserved_date >= '{$date}'")->queryScalar();
		$vm->reservation->canceled = Yii::app()->db->createCommand("SELECT count(reservation_no) FROM reservations WHERE reservation_status = 4 and reserved_date LIKE '%{$date}%'")->queryScalar();
		
		$findReservation = Reservation::model()->findAllByAttributes(array('reservation_status'=>3,'reserved_date'=>$date));
		$yehey = count($findReservation);
			$retVal = 'success';
			
			$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $yehey,
		));

		
	}
	
	
	public function actionCheckReservation()
	{
		$retVal = "";
		$retMessage = "";

		$reservationId = $_POST['reservation_id'];
		$findReservation = Reservation::model()->findByPk($reservationId);

		if(isset($findReservation)){
			$retVal = 'success';
			$retMessage = 'Your Reservation was Successfuly Save';
			if ($findReservation->user_cancelled = 1)
			{
				$retVal = 'success';
				$retMessage = 'The user canceled its trip. Press yes to finish the cancelation';
			}
			else
			{
				$retVal = 'success';
				$retMessage = 'Are you sure? The User has not yet canceled his request';				
			}

		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));

	}
	public function actionCheckCancelledReservation()
	{
		$retVal = "";
		$retMessage = "";
		
		$findReservation = Reservation::model()->findAllByAttributes(array('user_cancelled'=>1,'reservation_status'=>1));
		$count=	count($findReservation);
		if(isset($findReservation)){
			$retVal = 'success';
			if($count == 0)
			{
				$retMessage = 'As of now there are no Users that cancelled their request';
			}
			else
			$retMessage = $count . ' User has canceled his reservation Please check User Cancelled tab';
			

		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));

	}

	public function actionMap($id)
	{
		$retVal = "";
		$retMessage = "";
		$vm = (object) array();
		$vm->reservation = new Reservation('search');
		$vm->tracking = new TrackingLog('search');
		$vm->reservation->reservation_no = $id;
		
		
		
	
				$this->render('routes/_getroutes', array(
				'vm' => $vm,
				// 'waypoints' => $retMessage,
				));
	}
	
	public function actionFindDriver()
	{
		$retVal = "";
		$retMessage = "";
		$vm = (object) array();
		$vm->reservation = new Reservation('search');
		$vm->reservation->attributes = $_POST['Reservation'];
		// $vm->tracking = new TrackingLog('search');
		$vm->reservation = Reservation::model()->findByAttributes(array('reservation_no' => $vm->reservation->reservation_no));
		// $findReservation = Reservation::model()->findByPk($id);
			// $findUser = User::model()->findByPk($id);

			if(isset($vm->reservation))
			{
				$logs = $vm->reservation->getLogs($vm->reservation->saved_date);
				
			    // echo CJSON::encode($logs);
			    echo json_encode($logs);
			}
	}
	
	
	public function actionSearchReservation()
	{
		$retVal = "";
		$retMessage = "";
		$vm = (object) array();
		$vm->reservation = new Reservation('search');
		
		$this->render('reservation/search/_index', array(
			'vm' => $vm,
		));


	}
	
	public function actionReservationFullList()
	{
		$vm = (object) array();

		$vm->reservation = new Reservation('search');
		// $id = Yii::app()->user->id;	
		// $vm->reservation->saved_by =$id;
		
		if(isset($_POST['Reservation']))
		{
			$vm->reservation->attributes = $_POST['Reservation'];
		}

		$this->render('reservation/reservation_list', array(
			'vm' => $vm,
		));
	}
	
	
	
	
}