<?php

class ReservationController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
					'createreservation',
					'printticket',
					'getselectedCar',
					'getselecteddriver',
					'viewreservation',
					'savereservation',
					'view',
					'viewcar',
					'viewcarsched',
					'viewdriversched',
					'validatecarsched',
					'validatedriversched',
					'filterdriver',
					'cancelreservation',
                ),
				'roles'=>array('rxAdmin'),
			),

			array('allow',
				'actions'=>array(
          'createreservation',
					'printticket',
					'getselectedCar',
					'getselecteddriver',
					'viewreservation',
					'savereservation',
					'view',
					'viewcar',
					'viewcarsched',
					'viewdriversched',
					'validatecarsched',
					'validatedriversched',
					'filterdriver',
					'cancelreservation',
                ),
				'roles'=>array('rxClient'),
			),

            array('deny',
				'actions'=>array(
                ),
				'roles'=>array('rxClient'),
			),

			array('deny',  // deny all other users
				'users'=>array('*'),
			),

		);
	}


	public function actionPrintTicket($id)
	{
		$vm = (object) array();

		$vm->reservation = Reservation::model()->findByPk($id);

		$this->render('print_trip_ticket',array(
			'vm'=>$vm,
		));
	}

	public function actionViewReservation()
	{
		$vm = (object) array();
		$vm->reservation = new Reservation('search');

		$vm->reservation->saved_by = Yii::app()->user->id;

		$this->render('reservationview',array(
			'vm'=>$vm,
		));
	}



	public function actionGetSelectedCar()
	{
		$vm = (object) array();


		if(isset($_POST['car_id']))
		{
			$findCar = Car::model()->findByPk($_POST['car_id']);
		}

		$this->renderPartial('/json/json_retVal',
				array(
						'retVal' => $findCar->attributes,
						'retId' => '',
				));
	}


	public function actionGetSelectedDriver()
	{
		$vm = (object) array();

		if(isset($_POST['driver_id']))
		{
			$findDriver = Driver::model()->findByPk($_POST['driver_id']);
		}

		$this->renderPartial('/json/json_retVal',
				array(
						'retVal' => $findDriver->attributes,
						'retId' => '',
				));
	}

	public function actionCreateReservation()
	{
		$vm = (object) array();
		$vm->reservation = new Reservation('search');
		$vm->car = new Car('search');
		$vm->driver = new Driver('search');

		$this->render('createreservation',array(
			'vm'=>$vm,
		));
	}

	public function actionFilterDriver()
	{
		$driverData = array();
		$notavailable = array();
		$driverList = array();
		$retVal = true;
		$retMessage = 'Working...';
		$arrOfDriver = array();
		$arrVar = array();
		$duplicateVar;
		$isNewReservartion = false;

		//$curDate = date("d M Y g:i:s a", strtotime('02/01/2017 01:15 AM'));
		$curDate = date("d M Y g:i:s a", strtotime($_POST['current_date']));

		$findAllDriver = Driver::model()->findAllByAttributes(array('isVip'=>0));
		foreach ($findAllDriver as $driver) {
			$checkRes = Reservation::model()->findAll();
		  $findDriverInReservation = Reservation::model()->findAllByAttributes(array('driver_id'=>$driver->driver_id));

			if (!empty($checkRes)) {
				if(!empty($findDriverInReservation)){
						foreach ($findDriverInReservation as $driverSched) { // hanapin lahat ng  driver sa reservation
								$startd = date("d M Y g:i:s a", strtotime($driverSched->reservation_date_start));
								$endd = date("d M Y g:i:s a", strtotime($driverSched->reservation_date_end));
								$gpendd = date("d M Y g:i:s a", strtotime($driverSched->reservation_date_end) + 60*60);

								if($driverSched->status != 2){
									if($curDate != $startd){
										if (strtotime($curDate) > strtotime($endd)){
											if ($curDate > $gpendd ){
											  $driverData[] = Driver::model()->findAllByAttributes(array('driver_id'=>$driver->driver_id));
											}else{
												$arrOfDriver[] = $driver->driver_id;
											}
											//print_r('Available'.' ----- '.$driver->driver_id.' ----- '.$driverSched->reservation_date_start.' '.'<br/>');
										}else{
											//print_r('Notavailable'.' ----- '.$driver->driver_id.' ----- '.$driverSched->reservation_date_start.' '.'<br/>');
											//print($driver->driver_id);
											//$notavailable[] = Driver::model()->findAllByAttributes(array('driver_id'=>$driver->driver_id));
											$arrOfDriver[] = $driver->driver_id;

										}
									}else{
											//print_r('Notavailable'.' ----- '.$driver->driver_id.' ----- '.$driverSched->reservation_date_start.' '.'<br/>');
											$arrOfDriver[] = $driver->driver_id;
									}
								}else{
									$driverData[] = Driver::model()->findAllByAttributes(array('driver_id'=>$driver->driver_id));
								}
						}
				}else{
						$driverData[] = Driver::model()->findAllByAttributes(array('driver_id'=>$driver->driver_id));
				}
			}else{
				$arrVar[] = Driver::model()->findAll();
				$isNewReservartion = true;
				break;
			}
		}

		$duplicateVar = 0;

		foreach ($driverData as $key => $value) {
				if(!empty($arrOfDriver)){
					foreach ($arrOfDriver as $driverid) {
						if($value[0]->driver_id != $driverid && $value[0]->driver_id != $duplicateVar){
								$duplicateVar = $value[0]->driver_id;
								$arrVar[] = $value[0];
						}
					}
				}else{
					if($value[0]->driver_id != $duplicateVar){
						$duplicateVar = $value[0]->driver_id;
						$arrVar[] = $value[0];
					}
				}
		}


		//Merging array
		if($isNewReservartion == true){
			foreach($arrVar as $subArray){
				foreach($subArray as $val){
						$driverList[] = $val;
				}
			}
		}else{
			$driverList = $arrVar;
		}

		//remove Not available
		foreach ($driverList as $key => $value) {
			foreach ($arrOfDriver as $driverid) {
				if ($value->driver_id == $driverid) {
					unset($driverList[$key]);
				}
			}
		}


		$retView = $this->renderPartial('_step_three',array(
	  	'vm' => $driverList,
	  ), true );


		$this->renderPartial('/json/json_view',
	    array(
	        'retVal' => $retVal,
	        'retMessage' => $retMessage,
	  			'retView' => $retView,
	    ));

	}


	public function actionSaveReservation()
	{
		$retVal = "";
		$retMessage = "";

			$reservation = new Reservation('search');
			$reservation->reservation_date_start =
											date("Y-m-d H:i:s", strtotime($_POST['reservation_date_start']));
			$reservation->reservation_date_end =
											date("Y-m-d H:i:s", strtotime($_POST['reservation_date_end']));
			$reservation->pickup_location = $_POST['pickup_location'];
			$reservation->dropoff_location = $_POST['dropoff_location'];
			$reservation->no_passengers = $_POST['no_passengers'];
			$reservation->remarks = $_POST['remarks_passenger'];
			$reservation->type = $_POST['type'];
			$reservation->car_id = $_POST['car_id'];
			$reservation->driver_id = $_POST['driver_id'];

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
					$retMessage = 'Mail Successfuly Sent';
				} else {
					$retMessage = 'Mail Successfuly Not Sent';
				}
			}
			else
			{
				$retVal = 'error';
				$retMessage = 'Sorry Reservation was not Save.';
			}

		$this->renderPartial('/json/json_ret',
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}

	public function actionView($id)
	{
		$vm = (object) array();

		$vm->reservation = new Reservation('search');

		if(isset($id) && $id != '')
		{
			$findReservation = Reservation::model()->findByAttributes(array('reservation_no' => $id));

			if(isset($findReservation))
			{
				$vm->reservation = $findReservation;
			}
		}

		$this->render('trip_ticket', array(
			'vm' => $vm,
		));
	}

	public function actionValidateCarSched()
	{
		$retval = 1;
		$curDate = date("d M Y g:i:s a", strtotime($_POST['current_date']));
		//$curDate = date("d M Y g:i:s a", strtotime('02/1/2017 02:10 PM')) ;

		$carId = $_POST['car_id'];
		//$carId = '4fe8cad9-523a-11e6-a61f-40f02ff9b3e5';
		$retId = $carId;
		$findAllCar = Reservation::model()->findAllByAttributes(array('car_id'=>$carId));

		if(isset($findAllCar)){
		  foreach ($findAllCar as $carSched) {

		    $startd = date("d M Y g:i:s a", strtotime($carSched->reservation_date_start));
		    $endd = date("d M Y g:i:s a", strtotime($carSched->reservation_date_end));
		    $gpendd = date("d M Y g:i:s a", strtotime($carSched->reservation_date_end) + 60*60);

		    if($carSched->status != 2)  {
		      if($curDate != $startd){
		        if (strtotime($curDate) > strtotime($endd)){
		          if ($curDate > $gpendd ){
		            $retval = 1;
		          }else{
		            $retval = 2;
								$retId = $carId;
								// $tempgpendd = date("H:i:s", strtotime($gpendd));
								// $tempcurDate = date("H:i:s", strtotime($curDate));
								// echo $remainingMinutes = ( strtotime($tempgpendd) - strtotime($tempcurDate) ) / 60;
		          }
		        }
		        else{
		          $retval = 2;
		          $retId = $carId ;
		        }
		      }else{
		        $retval = 2;
		        $retId = $carId ;
		        break;
		      }
		    }else{
		      $retval = 1;
		    }

		  }
		}

		$this->renderPartial('/json/json_retVal',
		array(
				'retVal' => $retval,
				'retId' => $retId,
		));
	}


	public function actionViewCarSched()
	{
		$retVal = "danger";
		$retMessage = "Error";
		$vm = (object) array();
		$findCar = Car::model()->findByPk($_POST['car_id']);
		if(isset($findCar))
		{
			$retVal = 'success';
			$vm->car = $findCar;
			$vm->reservation = new Reservation('search');
			$vm->reservation->car_id = $findCar->cars_id;

			$retView = $this->renderPartial('_schedules',array(
				'vm' => $vm,
			), true);
		}

		$this->renderPartial('/json/json_view',
    array(
        'retVal' => $retVal,
        'retMessage' => $retMessage,
				'retView' => $retView,
    ));
	}


	public function actionViewDriverSched()
	{
		$retVal = "danger";
		$retMessage = "Error";
		$vm = (object) array();
		$findDriver = Driver::model()->findByPk($_POST['driver_id']);
		if(isset($findDriver))
		{
			$retVal = 'success';
			$vm->car = $findDriver;
			$vm->reservation = new Reservation('search');
			$vm->reservation->driver_id = $findDriver->driver_id;

			$retView = $this->renderPartial('_schedules',array(
				'vm' => $vm,
			), true);
		}

		$this->renderPartial('/json/json_view',
		array(
				'retVal' => $retVal,
				'retMessage' => $retMessage,
				'retView' => $retView,
		));
	}


	public function actionCancelReservation()
	{
		$retVal = "";
		$retMessage = "";

		$reservationId = $_POST['reservation_id'];
		$findReservation = Reservation::model()->findByPk($reservationId);

		if(isset($findReservation)){
			$retVal = 'success';
			$retMessage = 'Your Reservation was Successfuly Save';
			$findReservation->reservation_status = 0;

			if ($findReservation->save()){
				$retVal = 'success';
				$retMessage =$findReservation->reservation_no .' has been canceled';
			} 
			if($findReservation->hasErrors())
                {
                    foreach($findReservation->errors as $error)
                    {
                        $retMessage = $error;
                    }
                }
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));

	}

}
