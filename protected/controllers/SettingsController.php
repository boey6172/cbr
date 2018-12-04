<?php

class SettingsController extends Controller
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
                    'admin',

                    //Users

                    'users',
                    'checkstatus',
                    'activate',

                    //Drivers
                    'drivers',
                    'loaddriverform',
                    'validatedriver',
                    'driverstatus',
                    'savedriverstatus',

                    //Cars
                    'cars',
                    'loadcarform',
                    'validatecar',
                    'carstatus',
                    'savecarstatus',
                    'repairlogform',
                    'saverepairlog',
                ),
				'roles'=>array('rxAdmin'),
			),

			array('deny', 
				'actions'=>array(
                    'admin',
                    'users',
                    'checkstatus',
                    'activate',
                    'drivers',
                    'loaddriverform',
                    'validatedriver',
                    'driverstatus',
                    'savedriverstatus',
                    'cars',
                    'loadcarform',
                    'validatecar',
                    'carstatus',
                    'savecarstatus',
                    'repairlogform',
                    'saverepairlog',
                ),
				'roles'=>array('rxClient'),
			),
            
            array('allow', 
				'actions'=>array(
                ),
				'roles'=>array('rxClient'),
			),
			
			array('deny',  // deny all other users
				'users'=>array('*'),
			),
			
		);
	}

	public function actionAdmin()
	{
		$this->render('admin',array(
		));
	}

	public function actionUsers()
	{
		$vm = (object) array();
		$vm->user = new User('search');

		$this->render('users',array(
			'vm' => $vm,
		));
	}

	public function actionCheckStatus()
	{
		$vm = (object) array();

		$vm->message_type = "";
		$vm->message = "";

		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			$findUser = User::model()->findByPk($id);

			if(isset($findUser))
			{
				$vm->user = $findUser;

				if($vm->user->is_activated)
				{
					$vm->message_type = "alert-info";
					$vm->message = "Are you sure deactivate <b>" . $vm->user->username . "</b> account ? ";
				}
				else
				{
					$vm->message_type = "alert-warning";
					$vm->message = "Activate <b>" . $vm->user->username . "</b> account ? ";
				}
			}
		}

		$this->renderPartial('_user_activation_form',array(
			'vm'=>$vm
		));
	}

	public function actionActivate()
	{
		$vm = (object) array();

		$vm->message_type = "";
		$vm->message = "";

		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			$findUser = User::model()->findByPk($id);

			if(isset($findUser))
			{
				$vm->user = $findUser;

				if($vm->user->is_activated)
				{
					$vm->user->is_activated = 0;
					$vm->message = "<b>" . $vm->user->username . "</b> Deactivated. ";
				}
				else
				{
					$vm->user->is_activated = 1;
					$vm->message = "<b>" . $vm->user->username . "</b> Activated. ";
				}

				unset($vm->user->password);
				if($vm->user->save())
				{
					$vm->message_type = "alert-success";
				}
				else
				{
					$vm->message_type = "alert-danger";
				}
			}
		}

		$this->renderPartial('_user_activation_form',array(
			'vm'=>$vm
		));
	}

	public function actionDrivers()
	{
		$vm = (object) array();
		$vm->drivers = new Driver('search');

		$this->render('drivers',array(
			'vm' => $vm,
		));
	}

	public function actionLoadDriverForm()
	{
		$vm = (object) array();
		$vm->drivers = new Driver('search');

		if(isset($_POST['id']))
		{
			$id = $_POST['id'];

			$findDriver = Driver::model()->findByPk($id);

			if(isset($findDriver))
			{
				$vm->drivers = $findDriver;
			}
		}

		$this->renderPartial('_drivers_form',array(
			'vm' => $vm,true,true
		));
	}

	public function actionValidateDriver()
	{
		$retVal = "danger";
		$retMessage = "";

		if(isset($_POST['Driver']))
		{
			$model = new Driver('search');

			$model->attributes = $_POST['Driver'];
			$model->driver_img = $_POST['Driver']['driver_img'];

			if(empty($model->driver_no) || empty($model->first_name) || empty($model->last_name) || empty($model->gender))
			{
				$retVal = "warning";
				$retMessage = "Must fill up, required fields. Fields having (*) are required";
			}
			else
			{
				if(!empty($model->driver_id))
				{
					$findById = Driver::model()->findByPk(array($model->driver_id));

					$findById->driver_no = $model->driver_no;
					$findById->first_name = $model->first_name;
					$findById->last_name = $model->last_name;
					$findById->gender = $model->gender;
					$findById->contact_no = $model->contact_no;
					$findById->driver_img = $model->driver_img;

					if($findById->save())
					{
						$retVal = "success";
						$retMessage = "Successfully Updated";
					}
				}
				else
				{
					$findDriver = Driver::model()->findByAttributes(array('driver_no'=>$model->driver_no));

					if(count($findDriver) > 0)
					{
						$retVal = "warning";
						$retMessage = 'Someone already used Driver No <b> " '  . $model->driver_no . ' "</b>';
					}
					else
					{
						if($model->save())
						{
							$retVal = "success";
							$retMessage = "Successfull Added";
						}
					}
				}
			}
		}

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}

	public function actionDriverStatus()
	{
		$vm = (object) array();

		$vm->message_type = "";
		$vm->message = "";

		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			$findDriver = Driver::model()->findByPk($id);

			if(isset($findDriver))
			{
				$vm->drivers = $findDriver;
			}
		}

		$this->renderPartial('_drivers_status_form',array(
			'vm'=>$vm
		));
	}

	public function actionSaveDriverStatus()
	{
		$retVal = "danger";
		$retMessage = "";

		if(isset($_POST['Driver']))
		{
			if(isset($_POST['Driver']['driver_id']) && !empty($_POST['Driver']['status']))
			{
				$findDriver = Driver::model()->findByPk($_POST['Driver']['driver_id']);
				
				if(isset($findDriver))
				{
					if($findDriver->status != $_POST['Driver']['status'])
					{
						$findDriver->status = $_POST['Driver']['status'];

						if($findDriver->save())
						{
							$retVal = "success";
							$retMessage = "Status Saved.";
						}
					}
					else
					{
						$retVal = "success";
						$retMessage = "Nothing Changed";
					}
				}
			}
			else
			{
				$retVal = "warning";
				$retMessage = "Please select status.";
			}
		}

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}

	public function actionCars()
	{
		$vm = (object) array();
		$vm->cars = new Car('search');

		$this->render('cars',array(
			'vm' => $vm,
		));
	}

	public function actionLoadCarForm()
	{
		$vm = (object) array();
		$vm->cars = new Car('search');

		if(isset($_POST['id']))
		{
			$id = $_POST['id'];

			$findCar = Car::model()->findByPk($id);

			if(isset($findCar))
			{
				$vm->cars = $findCar;
			}
		}

		$this->renderPartial('_cars_form',array(
			'vm' => $vm,true,true
		));
	}

	public function actionValidateCar()
	{
		$retVal = "danger";
		$retMessage = "";

		if(isset($_POST['Car']))
		{
			$model = new Car('search');

			$model->attributes = $_POST['Car'];
			$model->car_img = $_POST['Car']['car_img'];

			if(empty($model->plate_no) || empty($model->brand) || empty($model->model))
			{
				$retVal = "warning";
				$retMessage = "Must fill up, required fields. Fields having (*) are required";
			}
			else
			{
				if(!empty($model->cars_id))
				{
					$findById = Car::model()->findByPk(array($model->cars_id));

					$findById->plate_no = $model->plate_no;
					$findById->brand = $model->brand;
					$findById->model = $model->model;
					$findById->year = $model->year;
					$findById->passenger_cap = $model->passenger_cap;
					$findById->car_img = $model->car_img;

					if($findById->save())
					{
						$retVal = "success";
						$retMessage = "Successfully Updated";
					}
				}
				else
				{
					$findCar = Car::model()->findByAttributes(array('plate_no'=>$model->plate_no));

					if(count($findCar) > 0)
					{
						$retVal = "warning";
						$retMessage = 'Plate No <b> " '  . $model->plate_no . ' "</b> is already in use.';
					}
					else
					{
						if($model->save())
						{
							$retVal = "success";
							$retMessage = "Successfull Added";
						}
					}
				}
			}
		}

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}

	public function actionCarStatus()
	{
		$vm = (object) array();

		$vm->message_type = "";
		$vm->message = "";

		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			$findCar = Car::model()->findByPk($id);

			if(isset($findCar))
			{
				$vm->cars = $findCar;
			}
		}

		$this->renderPartial('_cars_status_form',array(
			'vm'=>$vm
		));
	}

	public function actionSaveCarStatus()
	{
		$retVal = "danger";
		$retMessage = "";

		if(isset($_POST['Car']))
		{
			if(isset($_POST['Car']['cars_id']) && !empty($_POST['Car']['status']))
			{
				$findCar = Car::model()->findByPk($_POST['Car']['cars_id']);
				
				if(isset($findCar))
				{
					if($findCar->status != $_POST['Car']['status'])
					{
						$findCar->status = $_POST['Car']['status'];

						if($findCar->save())
						{
							$retVal = "success";
							$retMessage = "Status Saved.";
						}
					}
					else
					{
						$retVal = "success";
						$retMessage = "Nothing Changed";
					}
				}
			}
			else
			{
				$retVal = "warning";
				$retMessage = "Please select status.";
			}
		}

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}

	public function actionRepairLogForm()
	{
		$vm = (object) array();
		$vm->repairLog = new RepairLog('search');

		if(isset($_POST['id']))
		{
			$id = $_POST['id'];

			$vm->repairLog->car_id = $id;

			$findCar = Car::model()->findByPk($id);

			if(isset($findCar))
			{
				$vm->cars = $findCar;
			}
		}

		$this->renderPartial('_cars_repair_log_form',array(
			'vm'=>$vm
		));
	}

	public function actionSaveRepairLog()
	{
		$retVal = "danger";
		$retMessage = "";

		if(isset($_POST['RepairLog']))
		{
			$model = new RepairLog('search');
			$model->attributes = $_POST['RepairLog'];

			if($model->save())
			{
				$findCar = Car::model()->findByPk($model->car_id);
				if(isset($findCar))
				{
					$findCar->status = 2;

					if($findCar->save())
					{
						$retVal = "success";
						$retMessage = "Successfully Logged";
					}
				}
			}
			else
			{
				$retVal = "warning";
				$retMessage = "Required Fields Needed";
			}
		}

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}
}