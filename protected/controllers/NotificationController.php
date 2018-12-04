<?php

class NotificationController extends Controller
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
					'viewnotify',
                ),
				'roles'=>array('rxAdmin'),
			),

			array('allow', 
				'actions'=>array(
					'index',
					'viewnotify',
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

	public function actionIndex()
	{
		$vm = (object) array();
		$vm->notification = new Notification('search');

		$this->render('index', array(
			'vm' => $vm,
		));
	}

	public function actionViewNotify()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->notification = new Notification('search');

		if(isset($_POST['notification']))
		{
			$id = $_POST['notification'];

			$findNotification = Notification::model()->findByPk($id);

			if(isset($findNotification))
			{
				$vm->notification = $findNotification;

				$retVal = "success";
				$retMessage = $this->renderPartial('_notify_view', array(
					'vm'=>$vm,
				), true, true);
			}
		}

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}

}