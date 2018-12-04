<?php

class ClientController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow delection via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', 
				'actions'=>array(
					// 'index',
                ),
				'roles'=>array('*'),
			),

			array('allow', 
				'actions'=>array(
					'index',
					'carreservation',
					'validatereservation',
					'getcardriver',
					'showsummary',
					'savereservation',
					'viewreservation',
					'cancelreservation',
					'finishreservation',
					'reservationlist',
					'getreservationdriver',
					'savedriverrating',
					'driverreservation',
					'validatedriverreservation',
					'showdriverreservationsummary',
					'savedriverreservation',
					'Testing',
                ),
				'roles'=>array('rxClient', 'rxAdmin'),
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

		$this->render('index', array(
			'vm' => $vm,
		));
	}
	public function SendNotification($timeStamp,$resId)
	{
		require __DIR__.'/../extensions/vendor/autoload.php';
		//require_once(extensions.vendor.autoload);
		$timeStamp = $timeStamp;
		$reservationId = $resId;
		
		$client = new GuzzleHttp\Client();
		$res = $client->post('http://redcat.com.ph/cbr_app_v3/api/on_create_reservation_notification', [
			'form_params' => [
				'timeStamp' => $timeStamp,
				'reservationId' => $reservationId,
			]
		]);
	}
	public function SendNotificationCancel($resId)
	{
		require __DIR__.'/../extensions/vendor/autoload.php';
		//require_once(extensions.vendor.autoload);
		$reservationId = $resId;
		
		$client = new GuzzleHttp\Client();
		$res = $client->post('http://redcat.com.ph/cbr_app_v3/api/on_client_cancel_reservation_refresh', [
			'form_params' => [
				'reservationId' => $reservationId,
			]
		]);
	}

	public function actionCarReservation()
	{
		$vm = (object) array();
		$vm->reservation_type = ReservationType::model()->findAll();
		$vm->reservation = new Reservation('search');

		$dayToday = date('D');

		if($dayToday == 'Mon')
		{
			$todayCoding = 1;
		}
		elseif ($dayToday == 'Tue') {
			$todayCoding = 2;
		}
		elseif($dayToday == 'Wed')
		{
			$todayCoding = 3;
		}
		elseif($dayToday == 'Thu')
		{
			$todayCoding = 4;
		}
		elseif($dayToday == 'Fri')
		{
			$todayCoding = 5;
		}
		elseif($dayToday == 'Sat')
		{
			$todayCoding = 6;
		}
		elseif($dayToday == 'Sun')
		{
			$todayCoding = 7;
		}
		else
		{
			$todayCoding = 0;
		}

		$findCoding = LibCodingType::model()->findByPk($todayCoding);

		$vm->todaysCoding = $findCoding->description;

		$this->render('car_reservation', array(
			'vm' => $vm,
		));
	}

	public function actionValidateReservation()
	{
		$vm = (object) array();
		$retVal = 'error';
		$retMessage = 'Error';
		$dateToday =  date("Y-m-d");
		
		if(isset($_POST['Reservation']))
		{		
			$reservation = new Reservation('search');
			$reservation->attributes = $_POST['Reservation'];
			
			$reseveredDate=date('Y-m-d', strtotime($reservation->reserved_date));
			
			if($reservation->reservation_type == 1 || $reservation->reservation_type == 2 || $reservation->reservation_type == 3)
			{
			

				if($reservation->distance >= '1' && $reservation->distance <= '10000' )
				{
					$reservation->distance = '10.00';
				}
				elseif($reservation->distance >= '10001' && $reservation->distance <= '100000' )
				{
					$reservation->distance = '100.00';
				}
				elseif($reservation->distance >= '100001')
				{
					$reservation->distance = '0.00';
				}

				$filtered_status = '1';
				$filtered_date = date('Y-m-d h:i:sa', strtotime($reservation->reserved_date));
				// $date_now = date("Y-m-d"); 
				$filtered_cars = '';
				
				// $todaysReservations = Reservation::model()->findAll(array(
					// 'select' => 'car',
					// 'distinct'=>true,
					// 'condition'=>'reservation_status IN (' . $filtered_status . ') AND car IS NOT NULL  ',
				// ));

				// foreach($todaysReservations as $tr)
				// {
					// $filtered_cars .= $tr->car . ',';
				// }

				// $dayToday = date('D');
				$filtered = date('D', strtotime($reservation->reserved_date));

				if($filtered == 'Mon')
				{
					$todayCoding = 1;
					//$findCoding = LibCodingType::model()->findByPk($todayCoding);
					//$vm->todaysCoding = $findCoding->description;
				}
				elseif ($filtered == 'Tue') {
					$todayCoding = 2;
				}
				elseif($filtered == 'Wed')
				{
					$todayCoding = 3;
				}
				elseif($filtered == 'Thu')
				{
					$todayCoding = 4;
				}
				elseif($filtered == 'Fri')
				{
					$todayCoding = 5;
				}
				elseif($filtered == 'Sat')
				{
					$todayCoding = 6;
				}
				elseif($filtered == 'Sun')
				{
					$todayCoding = 7;
				}
				else
				{
					$todayCoding = 0;
				}
					$findCoding = LibCodingType::model()->findByPk($todayCoding);
					$vm->todaysCoding = $findCoding->description;

				$todaysCars = CarCodingCluster::model()->findAll(array(
					'select' => 'car',
					'distinct'=>true,
					'condition'=>'coding = ' . $todayCoding,
				));

				foreach($todaysCars as $tc)
				{
					$filtered_cars .= $tc->car . ',';
				}

				$findCars = Car::model()->findAll(array(
					'condition'=>'passenger_capacity >= :passenger_capacity  AND car_id IN (' . $filtered_cars . '0) AND car_status = 1',
					'params'=>array(':passenger_capacity'=>$reservation->no_of_passengers)
					// AND distance_capacity = :distance_capacity
					//,':distance_capacity'=>$reservation->distance removed temporarrily
				));

				$retVal = 'success';

				if(count($findCars) > 0)
				{
					$vm->cars = $findCars;
				}
				else
				{
					$vm->cars = Car::model()->findByPk(0);
				}
			}
			else
			{
				if($reservation->distance >= '1' && $reservation->distance <= '10000' )
				{
					$reservation->distance = '10.00';
				}
				elseif($reservation->distance >= '10001' && $reservation->distance <= '100000' )
				{
					$reservation->distance = '100.00';
				}
				elseif($reservation->distance >= '100001')
				{
					$reservation->distance = '0.00';
				}

				$filtered_status = '1';
				$filtered_date = date('Y-m-d h:i:sa', strtotime($reservation->reserved_date));
				// $date_now = date("Y-m-d"); 
				$filtered_cars = '';
				$filtered_cars_in_reservation = '';
				
				$todaysReservations = Reservation::model()->findAll(array(
					'select' => 'car',
					'distinct'=>true,
					'condition'=>'reservation_status IN (' . $filtered_status . ') AND car IS NOT NULL  ',
				));

				foreach($todaysReservations as $tr)
				{
					$filtered_cars_in_reservation .= $tr->car . ',';
				}

				// $dayToday = date('D');
				$filtered = date('D', strtotime($reservation->reserved_date));

				if($filtered == 'Mon')
				{
					$todayCoding = 1;
				}
				elseif ($filtered == 'Tue') {
					$todayCoding = 2;
				}
				elseif($filtered == 'Wed')
				{
					$todayCoding = 3;
				}
				elseif($filtered == 'Thu')
				{
					$todayCoding = 4;
				}
				elseif($filtered == 'Fri')
				{
					$todayCoding = 5;
				}
				elseif($filtered == 'Sat')
				{
					$todayCoding = 6;
				}
				elseif($filtered == 'Sun')
				{
					$todayCoding = 7;
				}
				else
				{
					$todayCoding = 0;
				}

				$todaysCars = CarCodingCluster::model()->findAll(array(
					'select' => 'car',
					'distinct'=>true,
					'condition'=>'coding = ' . $todayCoding,
				));

				foreach($todaysCars as $tc)
				{
					$filtered_cars .= $tc->car . ',';
				}

				$findCars = Car::model()->findAll(array(
					'condition'=>'passenger_capacity >= :passenger_capacity  AND car_id IN (' . $filtered_cars . '0) AND car_id NOT IN (' . $filtered_cars_in_reservation . '0)AND car_status = 1',
					'params'=>array(':passenger_capacity'=>$reservation->no_of_passengers)
					//AND distance_capacity = :distance_capacity
					//,':distance_capacity'=>$reservation->distance removed temporarrily
				));

				$retVal = 'success';

				if(count($findCars) > 0)
				{
					$vm->cars = $findCars;
				}
				else
				{
					$vm->cars = Car::model()->findByPk(0);
				}
			}
			
			
		$retMessage = $this->renderPartial('_step_three_form', array(
			'vm' => $vm,
			
		), true);

				 // print_r($filtered_cars);
			
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));
	}

	public function actionGetCarDriver()
	{
		$vm = (object) array();
		$retVal = 'error';
		$retMessage = 'Error';
		$filtered_cars = '';
		$filtered_cars_intransit = '';
		$filtered_early_cars = '';
		$filtered_earlier_cars = '';
		$filtered_earliest_cars = '';
		$filtered_earliest_cars_five = '';
		$filtered_earliest_cars_six = '';
		$filtered_earliest_cars_seven = '';
		$yehey = '';
		


		if(isset($_POST['car'])&& isset($_POST['date']) && isset($_POST['distance']))
		{
			$filtered_date = date('Y-m-d H:i:sa', strtotime('+2 hour',strtotime($_POST['date'])));
			$filtered_date_distance = date('Y-m-d H:i:sa', strtotime('+3 hour',strtotime($_POST['date'])));
			$filtered_date_distance_far = date('Y-m-d H:i:sa', strtotime('+4 hour',strtotime($_POST['date'])));
			$filtered_date_distance_five = date('Y-m-d H:i:sa', strtotime('+5 hour',strtotime($_POST['date'])));
			$filtered_date_distance_six = date('Y-m-d H:i:sa', strtotime('+6 hour',strtotime($_POST['date'])));
			$filtered_date_distance_seven = date('Y-m-d H:i:sa', strtotime('+7 hour',strtotime($_POST['date'])));
			$dateToday = date('Y-m-d', strtotime($_POST['date']));
			$dateTodayIntransit = date('Y-m-d', strtotime($_POST['date']));
			$car = $_POST['car'];
			$distance = $_POST['distance'];
			$filtered_status = '1';
			
				$todaysReservations = Reservation::model()->findAll(array(
					'select' => 'car',
					'distinct'=>true,
					'condition'=>'car = (' . $car . ')  AND DATE(reserved_date) LIKE ('. "'" .$dateToday . "'" .') AND reservation_status = 1',
				));
				$todaysReservationsIntransit = Reservation::model()->findAll(array(
					'select' => 'car',
					'distinct'=>true,
					'condition'=>'car = (' . $car . ')  AND DATE(reserved_date) LIKE ('. "'" .$dateTodayIntransit . "'" .') AND reservation_status = 2',
				));
			foreach($todaysReservationsIntransit as $trans)
			{
				$filtered_cars_intransit .= $trans->car;
			}

			foreach($todaysReservations as $tr)
			{
				$filtered_cars .= $tr->car;
			}

			if($filtered_cars_intransit)
			{
				$retVal = 'error';
				$retMessage = 'This Car is Still in transit ' . $filtered_cars_intransit;
			}
			elseif($filtered_cars)
			{
				if($filtered_cars)
				{
					$earlyReservations = Reservation::model()->findAll(array(
						'select' => 'car',
						'distinct'=>true,
						'condition'=>'car = (' . $car . ') AND reserved_date < ('. "'" .$filtered_date . "'" .') AND DATE(reserved_date) LIKE ('. "'" .$dateToday . "'".') AND reservation_status = 1',
					));
					
					$earlierReservations = Reservation::model()->findAll(array(
						'select' => 'car',
						'distinct'=>true,
						'condition'=>'car = (' . $car . ') AND reserved_date < ('. "'" .$filtered_date_distance . "'" .') AND DATE(reserved_date) LIKE ('. "'" .$dateToday . "'".') AND reservation_status = 1',
					));		
					$earliestReservations = Reservation::model()->findAll(array(
						'select' => 'car',
						'distinct'=>true,
						'condition'=>'car = (' . $car . ') AND reserved_date < ('. "'" .$filtered_date_distance_far . "'" .') AND DATE(reserved_date) LIKE ('. "'" .$dateToday . "'".') AND reservation_status = 1',
					));
					$earlyfiveReservations = Reservation::model()->findAll(array(
						'select' => 'car',
						'distinct'=>true,
						'condition'=>'car = (' . $car . ') AND reserved_date < ('. "'" .$filtered_date_distance_five . "'" .') AND DATE(reserved_date) LIKE ('. "'" .$dateToday . "'".') AND reservation_status = 1',
					));
					$earlysixReservations = Reservation::model()->findAll(array(
						'select' => 'car',
						'distinct'=>true,
						'condition'=>'car = (' . $car . ') AND reserved_date < ('. "'" .$filtered_date_distance_six . "'" .') AND DATE(reserved_date) LIKE ('. "'" .$dateToday . "'".') AND reservation_status = 1',
					));
					$earlysevenReservations = Reservation::model()->findAll(array(
						'select' => 'car',
						'distinct'=>true,
						'condition'=>'car = (' . $car . ') AND reserved_date < ('. "'" .$filtered_date_distance_seven . "'" .') AND DATE(reserved_date) LIKE ('. "'" .$dateToday . "'".') AND reservation_status = 1',
					));
					
					
					foreach($earlyReservations as $ts)
					{
						$filtered_early_cars .= $ts->car;
					}	
					foreach($earlierReservations as $td)
					{
						$filtered_earlier_cars .= $td->car;
					}		
					foreach($earliestReservations as $tf)
					{
						$filtered_earliest_cars .= $tf->car;
					}
					foreach($earlyfiveReservations as $tg)
					{
						$filtered_earliest_cars_five .= $tg->car;
					}
					foreach($earlysixReservations as $th)
					{
						$filtered_earliest_cars_six .= $th->car;
					}
					foreach($earlysevenReservations as $tj)
					{
						$filtered_earliest_cars_seven .= $tj->car;
					}
					
					
					
					if($filtered_early_cars)
					{
						$retVal = 'error';
						$retMessage = 'This Car Is already reserved in this Time Slot';
						
					}
					elseif($filtered_earlier_cars && ($distance > 7000))
					{
						$retVal = 'error';
						$retMessage = 'The distance will be conflicting to the next trip';
					}
					elseif($filtered_earliest_cars && ($distance > 14000))
					{
						$retVal = 'error';
						$retMessage = 'The distance will be conflicting to the next trip';
					}
					elseif($filtered_earliest_cars_five && ($distance > 21000))
					{
						$retVal = 'error';
						$retMessage = 'The distance will be conflicting to the next trip';
					}
					elseif($filtered_earliest_cars_six && ($distance > 28000))
					{
						$retVal = 'error';
						$retMessage = 'The distance will be conflicting to the next trip';
					}
					elseif($filtered_earliest_cars_seven && ($distance > 35000))
					{
						$retVal = 'error';
						$retMessage = 'The distance will be conflicting to the next trip';
					}
					elseif($filtered_cars && ($distance > 35000))
					{
						$retVal = 'error';
						$retMessage = 'The distance will be conflicting to the next trip';
					}
					else
					{
						$findCar = Car::model()->findByPk($car);

						$retVal = 'success';
						$retMessage = $findCar->default_driver;
						
						
					
					}
				}
			}
			else
			{
				$findCar = Car::model()->findByPk($car);

				$retVal = 'success';
				$retMessage = $findCar->default_driver;
			


			}
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		
		));
	}

	public function actionShowSummary()
	{
		$vm = (object) array();
		$retVal = 'error';
		$retMessage = 'Error';

		if(isset($_POST['Reservation']))
		{
			$vm->reservation = new Reservation('search');
			$vm->reservation->attributes = $_POST['Reservation'];

			$vm->reservation->estimated_time = $_POST['Reservation']['estimated_time'];
			$vm->reservation->estimated_fare = $_POST['Reservation']['estimated_fare'];

			$vm->car = Car::model()->findByPk($vm->reservation->car);
			$vm->driver = Driver::model()->findByPk($vm->car->default_driver);

			$retVal = 'success';
			$retMessage = $this->renderPartial('_step_four_form', array(
				'vm' => $vm,
			), true);
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));
	}

	public function actionSaveReservation()
	{
		$vm = (object) array();
		$retVal = 'error';
		$retMessage = 'Error';
		$id = Yii::app()->user->id;
		if(isset($_POST['Reservation']))
		{
			$reservation = new Reservation();
			$reservation->attributes = $_POST['Reservation'];
			$formated_resevation_date = date('Y-m-d', strtotime($_POST['Reservation']['reserved_date']));
			// $reservation->reserved_date = date('Y-m-d H:i:s', strtotime($_POST['Reservation']['reserved_date']));
			$reservation->reserved_date = date('Y-m-d H:i:sa', strtotime('+2 hour',strtotime($_POST['Reservation']['reserved_date'])));
			// date('Y-m-d H:i:sa', strtotime('+2 hour',strtotime($_POST['date'])));
			$findReservationDate = Reservation::model()->findAll(array(
						'select' => 'car',
						'distinct'=>true,
						'condition'=>'car = (' . $reservation->car . ') AND reserved_date < ('. "'" .$reservation->reserved_date . "'" .') AND DATE(reserved_date) LIKE ('. "'" . $formated_resevation_date . "'".') AND reservation_status = 1',
					));

			$passenger_list = '';

			if(count($reservation->passengers) > 0)
			{
				foreach ($reservation->passengers as $passenger) {
					$passenger_list .= $passenger . ', ';
				}
			}

			if($passenger_list != '')
			{
				$reservation->passengers = $passenger_list;
			}

			$reservation->reserved_date = date('Y-m-d H:i:s', strtotime($_POST['Reservation']['reserved_date']));

			$reservation->scenario = 'carreservation';
			if(!$findReservationDate)
			{

				if($reservation->save())
				{
					$retVal = 'success';
					$retMessage = $reservation->reservation_no;
					$dateNow = date("Y-m-d h:i:sa");
					$timeStamp = ((strtotime($reservation->reserved_date) - strtotime($dateNow) ));
				 	ClientController::SendNotification( $timeStamp,$reservation->reservation_id );
					$user = new User();
					$user = User::model()->findByPk($id);
						
						require_once('class.phpmailer.php');
						require_once('class.smtp.php');
					
			
						$mail = new PHPMailer();
						$mail->SMTPDebug = 1; 
						//$mail->IsSMTP(); 
						$mail->Host = "redcat.com.ph";
						$mail->Port = 25; // or 587
						$mail->IsHTML(true);
						//$mail->SMTPAuth = true;
						//$mail->SMTPSecure = "ssl";
						//$mail->Username = "it@redcat.com.ph";
						//$mail->Password = "Amiel123";
						$mail->SetFrom('fms@redcat.com.ph', 'Redcat Technologies');
						$mail->Subject = "Your Reservation Information " . $reservation->reservation_no;
						$mail->AddAddress($user->email);
						$mail->AddCC('boey6172@gmail.com');
						$mail->SMTPKeepAlive = true;
						$mail->CharSet = 'utf-8';

							$mail->Body ='	<html>';
							$mail->Body .='	<head>';
							$mail->Body .='			<meta content="text/html; charset=UTF-8" http-equiv="content-type">';
							$mail->Body .='		</head>';
							$mail->Body .='		<body>';
							$mail->Body .='		<table cellspacing="0" cellpadding="10" style="color:#666;font:13px Arial;line-height:1.4em;width:100%;">';
							$mail->Body .='			<tbody>';
							$mail->Body .='				<tr>';
							$mail->Body .='					<td style="color:#7f0000;font-size:22px;border-bottom: 2px solid #4D90FE;">';
							$mail->Body .='						Reservation Confirmed';
							$mail->Body .='					</td>';
							$mail->Body .='				</tr>';
							$mail->Body .='				<tr>';
							$mail->Body .='					<td style="color:#7f0000;font-size:16px;padding-top:5px;">';
							$mail->Body .=						'Reservation Confirmed';
							$mail->Body .=						'<br><br>Message from Automated Response:<br>';
						
							$mail->Body .='					</td>';
							$mail->Body .='				</tr>';
							$mail->Body .='				<tr>';
							$mail->Body .='					<td>';
							$mail->Body .=						'Your Reservation is confirmed. <br> Reservation No.: ' . $reservation->reservation_no . '<br>' ;
							$mail->Body .=						'Pick Up Location: ' . $reservation->pick_up_location . '<br>' . ' Drop off location: ' . $reservation->drop_off_location . '<br>' . 'Reservation Date & Time: ' . 		$reservation->reserved_date;
							$mail->Body .=						'<br><br> Note: Please be at your scheduled pick up Five minutes Before your scheduled pick up.';
							$mail->Body .=						'<br>For cancellation, fees may apply.';	
							$mail->Body .='					</td>';
							$mail->Body .='				</tr>';
							$mail->Body .='				<tr>';
							$mail->Body .='					<td style="padding:15px 20px;text-align:right;padding-top:5px;border-top:solid 1px #dfdfdf">';	
							$mail->Body .='				</td>';
							$mail->Body .='			</tr>';
							$mail->Body .='		</tbody>';
							$mail->Body .='		</table>';
							$mail->Body .='		</body>';
							$mail->Body .='		</html>';
						


					 if ($mail->send()) {
						 $retMessage = $reservation->reservation_no;
					 } 
					 else {
						 if($mail->hasErrors())
						 {
							 foreach ($mail->errors as $error) {
								$retMessage .= '<br/> - ' . $error[0];
							 }
						 }
					}
					
				}
				else
				{
					if($reservation->hasErrors())
					{
						foreach ($reservation->errors as $error) {
							$retMessage .= '<br/> - ' . $error[0];
						}
					}
				}
			}
			else
			{
				$retVal = 'error';
				$retMessage = 'This Car Is already reserved in this Time Slot';
			}
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));

		
	}

	public function actionViewReservation($id)
	{
		$vm = (object) array();

		$findReservation = Reservation::model()->findByAttributes(array('reservation_no' => $id));

		if(count($findReservation) > 0)
		{
			$vm->reservation = $findReservation;

			if($vm->reservation->car != null)
			{
				$vm->car = Car::model()->findByPk($vm->reservation->car);
			}

			$vm->driver = Driver::model()->findByPk($vm->reservation->driver);
		}

		$this->render('view_reservation', array(
			'vm' => $vm,
		));
	}

	public function actionCancelReservation()
	{
		$vm = (object) array();
		$retVal = 'error';
		$retMessage = 'Error';
		$id = Yii::app()->user->id;

		if(isset($_POST['Reservation']))
		{
			$reservation = new Reservation('search');
			$reservation->attributes = $_POST['Reservation'];

			$findReservation = Reservation::model()->findByAttributes(array('reservation_no' => $reservation->reservation_no));

			if(count($findReservation) > 0)
			{
					
					ClientController::SendNotificationCancel( $findReservation->reservation_id );
					$findReservation->user_cancelled = 1; //true
					$findReservation->reservation_status = 0; //true
					$findReservation->cancellation_remarks = $reservation->cancellation_remarks;

					if($findReservation->save())
					{
						$retVal = 'success';
						$retMessage = 'Cancellation request sent, please wait notification for confirmation.';
				
					$user = new User();
					$user = User::model()->findByPk($id);
					
					
						require_once('class.phpmailer.php');
						require_once('class.smtp.php');
					
			
						$mail = new PHPMailer();
						$mail->SMTPDebug = 1; 
						//$mail->IsSMTP(); 
						$mail->Host = "redcat.com.ph";
						$mail->Port = 25; // or 587
						$mail->IsHTML(true);
						//$mail->SMTPAuth = true;
						//$mail->SMTPSecure = "ssl";
						//$mail->Username = "it@redcat.com.ph";
						//$mail->Password = "Amiel123";
						$mail->SetFrom('fms@redcat.com.ph', 'Redcat Technologies');
						$mail->Subject = "Your Reservation Information " . $reservation->reservation_no;
						$mail->AddAddress($user->email);
						$mail->AddCC('boey6172@gmail.com');
						$mail->SMTPKeepAlive = true;
						$mail->CharSet = 'utf-8';

					$mail->Body ='	<html>';
					$mail->Body .='	<head>';
					$mail->Body .='			<meta content="text/html; charset=UTF-8" http-equiv="content-type">';
					$mail->Body .='		</head>';
					$mail->Body .='		<body>';
					$mail->Body .='		<table cellspacing="0" cellpadding="10" style="color:#666;font:13px Arial;line-height:1.4em;width:100%;">';
					$mail->Body .='			<tbody>';
					$mail->Body .='				<tr>';
					$mail->Body .='					<td style="color:#7f0000;font-size:22px;border-bottom: 2px solid #4D90FE;">';
					$mail->Body .='						Reservation Cancelled';
					$mail->Body .='					</td>';
					$mail->Body .='				</tr>';
					$mail->Body .='				<tr>';
					$mail->Body .='					<td style="color:#7f0000;font-size:16px;padding-top:5px;">';
					$mail->Body .=						'Reservation Cancelled';
					$mail->Body .=						'<br><br>Message from Automated Response:<br>';
				
					$mail->Body .='					</td>';
					$mail->Body .='				</tr>';
					$mail->Body .='				<tr>';
					$mail->Body .='					<td>';
					$mail->Body .=						'<br> Reservation No.: ' . $findReservation->reservation_no . '<br>' ;
					$mail->Body .=						'Pick Up Location: ' . $findReservation->pick_up_location . '<br>' . ' Drop off location: ' . $findReservation->drop_off_location . '<br>' . 'Reservation Date & Time: ' . $findReservation->reserved_date;
					$mail->Body .=						'<br><br> Note: Please be advise that your reservation will be cancelled with in the day ';
							
					$mail->Body .='					</td>';
					$mail->Body .='				</tr>';
					$mail->Body .='				<tr>';
					$mail->Body .='					<td style="padding:15px 20px;text-align:right;padding-top:5px;border-top:solid 1px #dfdfdf">';	
					$mail->Body .='				</td>';
					$mail->Body .='			</tr>';
					$mail->Body .='		</tbody>';
					$mail->Body .='		</table>';
					$mail->Body .='		</body>';
					$mail->Body .='		</html>';
					
					
					// if ($mail->send()) {
						$retMessage = $findReservation->reservation_no;
					// } 
					// else {
						// if($mail->hasErrors())
						// {
							// foreach ($mail->errors as $error) {
								// $retMessage .= '<br/> - ' . $error[0];
							// }
						// }
					// }
					}
			}
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));
	}

	public function actionFinishReservation()
	{
		$vm = (object) array();
		$retVal = 'error';
		$retMessage = 'Error';
		$id = Yii::app()->user->id;

		if(isset($_POST['Reservation']))
		{
			$reservation = new Reservation('search');
			$reservation->attributes = $_POST['Reservation'];

			$findReservation = Reservation::model()->findByAttributes(array('reservation_no' => $reservation->reservation_no));

			if(count($findReservation) > 0)
			{
				$findReservation->arrival_date = date('Y-m-d H:i:s');
				$findReservation->reservation_status = 3; //ARRIVED

				if($findReservation->save())
				{
					$retVal = 'success';
					$retMessage = 'Trip changed status to ARRIVED';
					
					$user = new User();
					$user = User::model()->findByPk($id);
					require_once('class.phpmailer.php');
           			require_once('class.smtp.php');
				
		
					$mail = new PHPMailer();
					$mail->SMTPDebug = 1; 
					//$mail->IsSMTP(); 
					$mail->Host = "redcat.com.ph";
					$mail->Port = 25; // or 587
					$mail->IsHTML(true);
					//$mail->SMTPAuth = true;
					//$mail->SMTPSecure = "ssl";
					//$mail->Username = "it@redcat.com.ph";
					//$mail->Password = "Amiel123";
					$mail->SetFrom('fms@redcat.com.ph', 'Redcat Technologies');
					$mail->Subject = "Your Reservation Information " . $reservation->reservation_no;
					$mail->AddAddress($user->email);
					$mail->AddCC('boey6172@gmail.com');
					$mail->SMTPKeepAlive = true;
					$mail->CharSet = 'utf-8';

				$mail->Body ='	<html>';
				$mail->Body .='	<head>';
				$mail->Body .='			<meta content="text/html; charset=UTF-8" http-equiv="content-type">';
				$mail->Body .='		</head>';
				$mail->Body .='		<body>';
				$mail->Body .='		<table cellspacing="0" cellpadding="10" style="color:#666;font:13px Arial;line-height:1.4em;width:100%;">';
				$mail->Body .='			<tbody>';
				$mail->Body .='				<tr>';
				$mail->Body .='					<td style="color:#7f0000;font-size:22px;border-bottom: 2px solid #4D90FE;">';
				$mail->Body .='						Reservation Done';
				$mail->Body .='					</td>';
				$mail->Body .='				</tr>';
				$mail->Body .='				<tr>';
				$mail->Body .='					<td style="color:#7f0000;font-size:16px;padding-top:5px;">';
				$mail->Body .=						'Reservation Done';
				$mail->Body .=						'<br><br>Message from Automated Response:<br>';
			
				$mail->Body .='					</td>';
				$mail->Body .='				</tr>';
				$mail->Body .='				<tr>';
				$mail->Body .='					<td>';
				$mail->Body .=						'Hope you had an enjoyable ride!<br> Booking Details <br>' ;
				$mail->Body .=						'Pick Up Location: ' . $findReservation->pick_up_location . '<br>' . ' Drop off location: ' . $findReservation->drop_off_location . '<br>' . 'Reservation Date & Time: ' . $findReservation->reserved_date ;
				$mail->Body .=						'<br><br> Thank you For Booking Have a Nice Day ';
				$mail->Body .='					</td>';
				$mail->Body .='				</tr>';
				$mail->Body .='				<tr>';
				$mail->Body .='					<td style="padding:15px 20px;text-align:right;padding-top:5px;border-top:solid 1px #dfdfdf">';	
				$mail->Body .='				</td>';
				$mail->Body .='			</tr>';
				$mail->Body .='		</tbody>';
				$mail->Body .='		</table>';
				$mail->Body .='		</body>';
				$mail->Body .='		</html>';

					if ($mail->send()) {
						$retMessage = $reservation->reservation_no;
					} 
					else {
						if($mail->hasErrors())
						{
							foreach ($mail->errors as $error) {
								$retMessage .= '<br/> - ' . $error[0];
							}
						}
					}
				}
			}
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));
	}

	public function actionReservationList()
	{
		$vm = (object) array();

		$vm->reservation = new Reservation('search');
		$id = Yii::app()->user->id;	
		$vm->reservation->saved_by =$id;
		
		if(isset($_POST['Reservation']))
		{
			$vm->reservation->attributes = $_POST['Reservation'];
		}

		$this->render('reservation_list', array(
			'vm' => $vm,
		));
	}

	public function actionGetReservationDriver()
	{
		$vm = (object) array();
		$retVal = 'success';
		$retMessage = 'Error';

		if(isset($_POST['Reservation']))
		{
			$reservation_no = $_POST['Reservation']['reservation_no'];

			if($reservation_no != '')
			{
				$findReservation = Reservation::model()->findByAttributes(array('reservation_no' => $reservation_no));

				if(isset($findReservation))
				{
					$findDriver = Driver::model()->findByPk($findReservation->driver);

					if(isset($findDriver))
					{
						$vm->driver = $findDriver;

						$retMessage = $this->renderPartial('_driver_rating_form', array(
							'vm' => $vm,
						), true, true);
					}
					else
					{
						$retMessage = 'Cannot find Driver';
					}
				}
				else
				{
					$retMessage = 'Cannot find Reservation record ' . $reservation_no;
				}
			}
			else
			{
				$retMessage = 'Blank resevation';
			}

		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));
	}

	public function actionSaveDriverRating()
	{
		$alert = (object) array();
        $alert->context = 'danger';
        $alert->messages = '';

        $retVal = 'error';

        if(isset($_POST['Driver']))
        {
        	$driver = $_POST['Driver']['id'];
        	$rating = $_POST['Driver']['rating'];

        	$findDriver = Driver::model()->findByPk($driver);

        	if(isset($findDriver))
        	{
        		$findDriver->rating += $rating;
        		$findDriver->rating_count += 1;

        		if($findDriver->save())
        		{
        			$retVal = 'success';

        			$alert->context = 'success';
        			$alert->messages = 'Successfully Submitted.';
        		}
        		elseif($findDriver->hasErrors())
        		{
        			foreach ($findDriver->errors as $error) {
						$alert->messages .= '<br/> - ' . $error[0];
					}
        		}
        	}
        }

        $retMessage = $this->renderPartial('/json/_alert_message', array('alert'=>$alert), true, true);

        $this->renderPartial('/json/json_ret', array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}

	public function actionDriverReservation()
	{
		$vm = (object) array();
		$vm->reservation_type = ReservationType::model()->findAll();
		$vm->reservation = new Reservation('search');

		$this->render('driver_reservation', array(
			'vm' => $vm,
		));
	}

	public function actionValidateDriverReservation()
	{
		$vm = (object) array();
		$retVal = 'error';
		$retMessage = 'Error';

		if(isset($_POST['Reservation']))
		{
			$reservation = new Reservation('search');
			$reservation->attributes = $_POST['Reservation'];

			$filtered_status = '1,2,3';
			$filtered_drivers = '';

			$todaysReservations = Reservation::model()->findAll(array(
				'select' => 'driver',
				'distinct'=>true,
				'condition'=>'reservation_status IN (' . $filtered_status . ')',
			));

			$carsWDrivers = Car::model()->findAll(array(
				'select' => 'default_driver',
				'distinct'=>true,
				'condition'=>'default_driver IS NOT NULL',
			));

			foreach($todaysReservations as $tr)
			{
				$filtered_drivers .= $tr->driver . ',';
			}

			foreach($carsWDrivers as $cd)
			{
				$filtered_drivers .= $cd->default_driver . ',';
			}

			$findDrivers = Driver::model()->findAll(array(
				'condition'=>'id NOT IN (' . $filtered_drivers . '0) AND driver_status != 0',
    			'params'=>array()
			));

			$retVal = 'success';

			if(count($findDrivers) > 0)
			{
				$vm->drivers = $findDrivers;
			}
			else
			{
				$vm->drivers = Driver::model()->findByPk(0);
			}

			$retMessage = $this->renderPartial('_step_three_driver_form', array(
				'vm' => $vm,
			), true);
			
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));
	}

	public function actionShowDriverReservationSummary()
	{
		$vm = (object) array();
		$retVal = 'error';
		$retMessage = 'Error';

		if(isset($_POST['Reservation']))
		{
			$vm->reservation = new Reservation('search');
			$vm->reservation->attributes = $_POST['Reservation'];

			$vm->reservation->estimated_time = $_POST['Reservation']['estimated_time'];

			$vm->driver = Driver::model()->findByPk($vm->reservation->driver);

			$retVal = 'success';
			$retMessage = $this->renderPartial('_step_four_driver_form', array(
				'vm' => $vm,
			), true);
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));
	}

	public function actionSaveDriverReservation()
	{
		$vm = (object) array();
		$retVal = 'error';
		$retMessage = 'Error';

		if(isset($_POST['Reservation']))
		{
			$reservation = new Reservation();
			$reservation->attributes = $_POST['Reservation'];

			$reservation->reserved_date = date('Y-m-d H:i:s', strtotime($reservation->reserved_date));
			$reservation->car = null;

			$reservation->scenario = 'driverreservation';
			
			if($reservation->save())
			{
				$retVal = 'success';
				$retMessage = $reservation->reservation_no;
			}
			else
			{
				if($reservation->hasErrors())
				{
					foreach ($reservation->errors as $error) {
						$retMessage .= '<br/> - ' . $error[0];
					}
				}
			}
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));
	}
}
