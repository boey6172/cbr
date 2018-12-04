<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$this->render('index');

        if( Yii::app()->user->isGuest ) {
            $this->actionLogin();
        }
        else
            $this->render('index',array(
            		
            ));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$vm = (object) array();
		$vm->model=new LoginForm;
		$vm->user=new User();
		
		$vm->key_string = "0123456789abcdef0123456789abcdef";
	    $vm->iv_string = "abcdef9876543210abcdef9876543210";
		
		//for captcha
		if (Yii::app()->user->getState('attempts-login') > 3) { //make the captcha required if the unsuccessful attemps are more of thee
            $vm->model->scenario = 'withCaptcha';
        }
		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($vm->model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			
			$ue64 = $_POST['LoginForm']['ucrypt'];
			$pe64 = $_POST['LoginForm']['pcrypt'];

			$key = pack("H*", $vm->key_string);
			$iv = pack("H*", $vm->iv_string);

			$ue = base64_decode($ue64);
			$pe = base64_decode($pe64);
			$u = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ue, MCRYPT_MODE_CBC, $iv), "\t\0" );
			$p = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $pe, MCRYPT_MODE_CBC, $iv), "\t\0" );

			$username = preg_replace("/[^!@#$&*()a-zA-Z-0-9,._]/", "", $u);
			$password = preg_replace("/[^!@#$&*()a-zA-Z-0-9,._]/", "", $p);

			// echo "Username : " . $username;
			// echo "<br>Password : " . $password;

			// $vm->model->attributes=$_POST['LoginForm'];
			$vm->model->username = $username;
			$vm->model->password = $password;

			// validate user input and redirect to the previous page if valid
			if($vm->model->validate() && $vm->model->login()){
				$user = User::model()->findByAttributes(array('username'=>$vm->model->username));
				Yii::app()->user->setState('attempts-login', 0);
			}
			else {  //if login is not successful, increase the attemps 
                Yii::app()->user->setState('attempts-login', Yii::app()->user->getState('attempts-login', 0) + 1);
 
                if (Yii::app()->user->getState('attempts-login') > 3) { 
                    $vm->model->scenario = 'withCaptcha'; //useful only for view
                }
            }
			
			if(isset($user)){
				if($user->is_activated == 1)
				{
					$checkrole = Authassignment::model()->findByAttributes(array('userid'=>$user->user_id));

					if(isset($checkrole))
					{
						if($checkrole->itemname == 'rxClient')
						{
							$this->redirect(array('client/index'));
						}
						elseif($checkrole->itemname == 'rxAdmin') {
							$this->redirect(array('admin/index'));
						}
					}
				}
				else
				{
							
					Yii::app()->user->logout();
					$this->redirect(array('site/Redirect'));
				}
			}

		}
		// display the login form
		$this->renderPartial('login',array('vm'=>$vm));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	public function actionRedirect()
	{
		$this->render('redirect');
	}
}