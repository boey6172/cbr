<?php

class MaintenanceController extends Controller
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
					'car',
					'carinfo',
					'carsave',
					'driver',
					'department',
					'account',
					'carpartrequestsave',
                ),
				'roles'=>array('rxAdmin'),
			),

			array('deny',  // deny all other users
				'users'=>array('*'),
			),
		);
	}

	public function actionCar()
	{
		$vm = (object) array();
		$vm->car = new Car('search');
		$vm->car_part_request = new CarPartRequest('search');
		$vm->reservation = new Reservation('search');

		if(isset($_POST['CarPartRequest']))
		{
			$vm->car_part_request->attributes = $_POST['CarPartRequest'];
		}

		if(isset($_POST['Reservation']))
		{
			$vm ->reservation->attributes = $_POST['Reservation'];
		}

		$this->render('car', array(
			'vm' => $vm,
		));
	}

	public function actionCarInfo()
	{
		$retVal = 'error';
		$retMessage = 'Error';

		if($_POST['car'] != '')
		{
			$id = $_POST['car'];

			$findCar = Car::model()->findByPk($id);

			if(isset($findCar))
			{
				$retMessage = $findCar->attributes;
			}
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));
	}

	public function actionCarSave()
	{
		$retVal = 'error';
		$retMessage = 'Error';

		if(isset($_POST['Car']))
		{
			$car = new Car('search');
			$car->attributes = $_POST['Car'];

			if(!isset($car->cars_id))
			{
				$retMessage = "New";
			}
			else
			{
				$findCar = Car::model()->findByPk($car->cars_id);

				if(isset($findCar))
				{
					$findCar->attributes = $car->attributes;

					if($findCar->save())
					{
						$retVal = 'success';
						$retMessage = 'Data Saved';
					}
					else
					{
						if($findCar->hasErrors())
						{
							foreach ($findCar->errors as $error) {
								$retMessage = $error;
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

	public function actionCarPartRequestSave()
	{
		$retVal = 'error';
		$retMessage = 'Error';

		if(isset($_POST['CarPartRequest']))
		{
			$car_part_request = new CarPartRequest("search");
			$car_part_request->attributes = $_POST['CarPartRequest'];

			if($car_part_request->save())
			{
				$retVal = "success";
				$retMessage = "Request Saved";
			}
			else
			{
				if($car_part_request->hasErrors())
				{
					foreach($car_part_request->errors as $error)
					{
						$retMessage = $error;
					}
				}
			}
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));
	}

	public function actionDriver()
	{
		$vm = (object) array();

		$this->render('driver', array(
			'vm' => $vm,
		));
	}

	public function actionDepartment()
	{
		$vm = (object) array();

		$this->render('department', array(
			'vm',
		));
	}

	public function actionAccount()
	{
		$vm = (object) array();

		$this->render('account', array(
			'vm' => $vm,
		));
	}

}
