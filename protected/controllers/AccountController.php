<?php

class AccountController extends Controller
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
					'getaccountinfo',
					'Activate',
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
		$vm->user = new User('search');
		$vm->auth = new Authassignment('search');
		$vm->user->inactive = Yii::app()->db->createCommand("SELECT count(is_activated) FROM users WHERE is_activated = 0")->queryScalar();
		$vm->user->active = Yii::app()->db->createCommand("SELECT count(is_activated) FROM users WHERE is_activated = 1")->queryScalar();
		$vm->auth->admin = Yii::app()->db->createCommand("SELECT count(itemname) FROM AuthAssignment WHERE itemname = 'rxAdmin'")->queryScalar();
		$vm->auth->client = Yii::app()->db->createCommand("SELECT count(itemname) FROM AuthAssignment WHERE itemname = 'rxClient'")->queryScalar();
			
		$this->render('maintenance', array(
			'vm' => $vm,
		));
	}

	public function actionSave()
	{
		$retVal = 'error';
		$retMessage = 'Error';
		$yehey = 'Error';
		if(!isset($_POST['auth']))
		{
			// $auth = 'rxClient';
			$auth = 'rxAdmin';
			
		}
		else
		{
			$auth = 'rxClient';
		}
		$addassignment = new Authassignment('search');
		$findUser = new User('search');
		if(isset($_POST['User']))
		{
			$findUser = User::model()->findByPk($_POST['User']['user_id']);


			if(isset($findUser->user_id))
			{
				$findUser->attributes = $_POST['User'];
				// $findUser->department = $_POST['User']['department'];
				
					// if (isset($findUser->username)){
						
					// $retVal = 'success';
					// $retMessage = 'wala' ;
						
					// }

				if($findUser->save())
				{
				$addassignment->itemname = $auth;
				$addassignment->userid = $findUser->user_id;
				
					if ($addassignment->save())	{
							
						$retVal = 'success';
						$yehey = 'nag save?' ;
							
					}
					$retVal = 'success';
				//	$retMessage = 'Successfully Updated' ;
					
				}
				else
				{
					if($findUser->hasErrors())
					{
						foreach($findUser->errors() as $error)
						{
							$retMessage = $error;
						}
					}
				}
			}
			else
			{
				$user = new User('search');
				$user->attributes = $_POST['User'];

				if($user->save())
				{
					$retVal = 'success';
					$yehey = 'Successfully Saved';
					$addassignment->itemname = $auth;
				 	$addassignment->userid = $user->user_id;
				
					if ($addassignment->save())	{
							
						$retVal = 'success';
						$yehey = 'nag save?' ;
							
					}
				}
				else
				{
					if($user->hasErrors())
					{
						foreach($user->errors() as $error)
						{
							$retMessage = $error;
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

	public function actionGetAccountInfo()
	{
		$retVal = 'error';
		$retMessage = 'Error';

		if(isset($_POST['user']))
		{
			$id = $_POST['user'];

			$findUser = User::model()->findByPk($id);
			$findUser->password = '';

			if(isset($findUser))
			{
				$retMessage = $findUser->attributes;
			}
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' =>$retMessage,
		));
	}
	
	public function actionActivate()
	{
		$retVal = 'error';
		$retMessage = 'Error';

		if(isset($_POST['user']))
		{
			$id = $_POST['user'];

			$findUser = User::model()->findByPk($id);
			
			if($findUser->is_activated == 0)
			{
				$findUser->is_activated = 1;
				unset($findUser->password);
				unset($findUser->user_id);
				if($findUser->save())
				{
					$retVal = 'success';
					$retMessage = 'Successfully Saved';
				}
			}
			else
			{
				unset($findUser->password);
				unset($findUser->user_id);
				$findUser->is_activated = 0;
				if($findUser->save())
				{
					$retVal = 'success';
					$retMessage = 'Successfully Saved';
				}
			}

			if(isset($findUser))
			{
				$retMessage = $findUser->attributes;
			}
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' =>$retMessage,
		));
	}
}

