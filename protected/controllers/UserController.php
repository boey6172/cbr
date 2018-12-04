<?php

class UserController extends Controller
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
                    'index',
                    'changepassword', 
                    'changepasswordngeown',
                ),
				'roles'=>array('rxAdmin'),
			),

			array('allow', 
				'actions'=>array(
					'signup',
                    'validate',
                ),
				'users'=>array('Guest'),
			),
            
            array('allow', 
				'actions'=>array(
                    'profile',
                ),
				'roles'=>array('rxClient'),
			),

			array('allow', 
				'actions'=>array(
                ),
				'users'=>array('*'),
			),
			
			array('deny',  // deny all other users
				'users'=>array('*'),
			),
			
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->user_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

    public function actionChangeown(){
        $this->actionChangepassword(Yii::app()->user->id);
    }
    
    public function actionChangepassword($id) {
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        
		if(isset($_POST['User']))
		{
			$model->password = $_POST['User']['password'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->user_id));
		}
        else {
            $dUser = array();
        }

        unset($model->password);
		$this->render('changepass',array(
			'model'=>$model,
		));        
    }
    
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
            unset($model->password);
			if($model->save())
				$this->redirect(array('view','id'=>$model->user_id));
		}

        unset($model->password);
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionSignUp()
	{
		$model = new User('search');

		$this->renderPartial('signup',array(
			'model' => $model
		),false,true);
	}

	public function actionValidate()
	{
		$retVal = "alert-error";
		$retMessage = "";

		if(isset($_POST['User']))
		{
			$model = new User('User');

			$model->attributes = $_POST['User'];
			$model->profile_pic = $_POST['User']['profile_pic'];

			if(empty($model->username) || empty($model->password) || empty($model->first_name) || empty($model->surname))
			{
				$retVal = "Warning";
				$retMessage = "Must fill up, required fields. Fields having (*) are required";
			}
			else
			{
				$findUser = User::model()->findByAttributes(array('username'=>$model->username));

				if(count($findUser) > 0)
				{
					$retVal = "Warning";
					$retMessage = 'Someone already used username <b> " '  . $model->username . ' "</b>';
				}
				else
				{
					if($model->save())
					{
						$role = new Authassignment();
						$role->itemname = "rxClient";
						$role->userid = $model->user_id;

						if($role->save())
						{
							$retVal = "Success";
							$retMessage = $model->username;
						}
						else
						{
							$retVal = "Warning";
							$retMessage = $role->userid;
						}
					}
					// else
					// {
					// 	$retVal = "warning";
					// 	$retMessage = $model->username->getErrors();
					// }
				}
			}
		}

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}

	public function actionProfile($id)
	{
		$vm = (object) array();
		
		$user = User::model()->findByAttributes(array('username'=>$id));

		if(isset($user))
		{
			$vm->user = User::model()->findByAttributes(array('username'=>$id));
		}

		$this->renderPartial('profile',array(
			'vm'=>$vm
		));
	}
}
