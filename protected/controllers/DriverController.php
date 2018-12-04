<?php

class DriverController extends Controller
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
					// 'maintenance',
					// 'save',
					// 'getdriverinfo',
					'admin',
					'savedriver',
					'viewdriver',
					'updatedriver',
                ),
				'roles'=>array('rxAdmin'),
			),

			array('deny',  // deny all other users
				'users'=>array('*'),
			),
		);
	}

	public function actionAdmin()
	{
		$vm = (object) array();
		$vm->driver = new Driver('search');

		if(isset($_POST['Driver']))
		{
			$vm->driver->attributes = $_POST['Driver'];
		}

		$this->render('admin', array(
			'vm' => $vm,
		));
	}

	public function actionSaveDriver()
	{
		$alert = (object) array();
        $alert->context = 'danger';
        $alert->messages = '';

        $retVal = 'error';

        if(isset($_POST['Driver']))
        {
        	$driver = new Driver('search');
        	$driver->attributes = $_POST['Driver'];

        	if($driver->validate())
        	{
        		if($driver->save())
        		{
        			$retVal = 'success';
        			$alert->context = 'success';
        			$alert->messages = 'Driver Saved';
        		}
        	}
        	elseif($driver->hasErrors())
        	{
        		foreach($driver->errors as $error)
        		{
        			$alert->messages .= '<br> - ' . $error[0];
        		}
        	}
        }

        $retMessage = $this->renderPartial('/json/_alert_message', array('alert'=>$alert), true, true);

        $this->renderPartial('/json/json_ret', array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}

	public function actionViewDriver()
	{
		$retVal = 'error';
		$retMessage = 'Error';

		$vm = (object) array();

		if($_POST['Driver']['id'] != '')
		{
			$driver = Driver::model()->findByPk($_POST['Driver']['id']);

			if(isset($driver))
			{
				$vm->driver = $driver;
				$vm->driver->password = '';
				$vm->driver->car = 0;

				$findCar = Car::model()->findByAttributes(array('default_driver' => $vm->driver->id));

				if(isset($findCar))
				{
					$vm->driver->car = $findCar->car_id;
				}
			}
			else
			{
				$vm->driver = new Driver('search');
			}
		}


		$retMessage = $this->renderPartial('_update_driver_form', array(
			'vm' => $vm,
		), true);

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));
	}

	public function actionUpdateDriver()
	{
		$alert = (object) array();
        $alert->context = 'danger';
        $alert->messages = '';

        $retVal = 'error';

        if(isset($_POST['Driver']))
        {
        	$driver = Driver::model()->findByPk($_POST['Driver']['id']);

        	if(isset($driver))
        	{
        		$driver->attributes = $_POST['Driver'];

        		if(trim($driver->password) == '')
        		{
        			unset($driver->password);
        		}

        		if($driver->driver_status == '0' && $_POST['Driver']['car'] != '0')
        		{
        			$findCar = Car::model()->findByPk($_POST['Driver']['car']);
        			$findCar->default_driver = null;
        			$findCar->scenario = 'driverremove';

        			$findCar->save();
        		}

        		if($driver->save())
        		{
        			$retVal = 'success';
        			$alert->context = 'success';
        			$alert->messages = 'Driver Successfully updated';
        		}
        		elseif($driver->hasErrors())
	        	{
	        		foreach($driver->errors as $error)
	        		{
	        			$alert->messages .= '<br> - ' . $error[0];
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
}
