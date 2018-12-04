<?php

class DepartmentController extends Controller
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
					'maintenance',
					'save',
					'getdepartmentinfo',
                ),
				'roles'=>array('rxAdmin'),
			),

			array('deny',  // deny all other users
				'users'=>array('*'),
			),
		);
	}

	public function actionMaintenance()
	{
		$vm = (object) array();
		$vm->department = new Department('search');

		$this->render('maintenance', array(
			'vm' => $vm,
		));
	}

	public function actionSave()
	{
		$retVal = 'error';
		$retMessage = 'Error';

		if(isset($_POST['Department']))
		{
			$findDepartment = Department::model()->findByPk($_POST['Department']['department_id']);


			if(isset($findDepartment))
			{
				$findDepartment->attributes = $_POST['Department'];

				if($findDepartment->save())
				{
					$retVal = 'success';
					$retMessage = 'Successfully Updated';
				}
				else
				{
					if($findDepartment->hasErrors())
					{
						foreach($findDepartment->errors() as $error)
						{
							$retMessage = $error;
						}
					}
				}
			}
			else
			{
				$department = new Department('search');
				$department->attributes = $_POST['Department'];

				if($department->save())
				{
					$retVal = 'success';
					$retMessage = 'Successfully Saved';
				}
				else
				{
					if($department->hasErrors())
					{
						// foreach($department->errors() as $error)
						// {
						// 	$retMessage = $error;
						// }
					}
				}
			}
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));
	}

	public function actionGetDepartmentInfo()
	{
		$retVal = 'error';
		$retMessage = 'Error';

		if(isset($_POST['department']))
		{
			$id = $_POST['department'];

			$findDepartment = Department::model()->findByPk($id);

			if(isset($findDepartment))
			{
				$retMessage = $findDepartment->attributes;
			}
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' =>$retMessage,
		));
	}
}

