<?php

class CarController extends Controller
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
					'admin',
					'savecar',
                    'viewcar',
					'updatecar',
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
		$vm->car = new Car('search');

		if(isset($_POST['Car']))
		{
			$vm->car->attributes = $_POST['Car'];
		}

		$this->render('admin', array(
			'vm' => $vm,
		));
	}

	public function actionSaveCar()
	{
		$alert = (object) array();
        $alert->context = 'danger';
        $alert->messages = '';

        $retVal = 'error';

        if(isset($_POST['Car']))
        {
        	$car = new Car('search');
        	$car->attributes = $_POST['Car'];

        	if($car->validate())
        	{
        		if($car->save())
        		{

        			$cpn = substr($car->plate_no, -1);


                    $car_schedule = array();

        			if($cpn == 1 || $cpn == 2)
        			{
                        array_push($car_schedule, 2,3,4,5,6,7);
                        
                    }
        			elseif($cpn == 3 || $cpn == 4)
        			{
        				array_push($car_schedule, 1,3,4,5,6,7);
        			}
        			elseif($cpn == 5 || $cpn == 6)
        			{
        				array_push($car_schedule, 2,1,4,5,6,7);
        			}
        			elseif($cpn == 7 || $cpn == 8)
        			{
        				array_push($car_schedule, 2,3,1,5,6,7);
        			}
        			elseif($cpn == 9 || $cpn == 0)
        			{
        				array_push($car_schedule, 2,3,4,1,6,7);
        			}
                foreach($car_schedule as $tc)
                {
            
                    $car_coding = new CarCodingCluster();
                    $car_coding->car = $car->car_id;
                    $car_coding->coding = 0;
                    $car_coding->coding = $tc;

        			if($car_coding->save())
        			{
                        
	        			$retVal = 'success';
	        			$alert->context = 'success';
	        			$alert->messages = 'Car Saved';
        			}
        			else
        			{
        				$alert->messages = 'Error in saving.';
        			}

                }

        		}
        	}
        	elseif($car->hasErrors())
        	{
        		foreach($car->errors as $error)
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

    public function actionViewCar()
    {
        $retVal = 'error';
        $retMessage = 'Error';

        $vm = (object) array();

        if($_POST['Car']['car_id'] != '')
        {
            $car = Car::model()->findByPk($_POST['Car']['car_id']);

            if(isset($car))
            {
                $vm->car = $car;
            }
            else
            {
                $vm->car = new Car('search');
            }
        }


        $retMessage = $this->renderPartial('_update_car_form', array(
            'vm' => $vm,
        ), true);

        $this->renderPartial('/json/json_ret', array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
    }

    public function actionUpdateCar()
    {
        $alert = (object) array();
        $alert->context = 'danger';
        $alert->messages = '';

        $retVal = 'error';

        if(isset($_POST['Car']))
        {
            $car = new Car('search');
            $car->attributes = $_POST['Car'];

            $findCar = Car::model()->findByPk($car->car_id);

            if(isset($findCar))
            {
                $findCar->attributes = $_POST['Car'];

                if($findCar->validate())
                {
                    if($findCar->save())
                    {
                        
				$retVal = 'success';
                            $alert->context = 'success';
                            $alert->messages = 'Car Updated ';
                        
                    }
                }
                elseif($findCar->hasErrors())
                {
                    foreach($findCar->errors as $error)
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
