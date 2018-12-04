<?php

class ReportController extends Controller
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
					'index',	
					'DriverAttendance',	
					'SearchAttendance',	
					'DriverReservation',	
					'DriverBilling',	
                ),
				// 'roles'=>array('rxClient'),
				'roles'=>array('rxAdmin'),
			),
			
			array('deny',  // deny all other users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$vm = (object) array();
		
		$this->render('/admin/reports/index', array(
			'vm' => $vm,
		));
	}
	
	public function actionDriverAttendance()
	{		

		
		$vm = (object) array();
		$vm->attendance = new AttendanceLogs('search');
		
		if(isset($_POST['AttendanceLogs']) || isset($_POST['Month']) || isset($_POST['Year']))
		{
			$month = $_POST['Month'];
			$year = $_POST['Year'];
			$vm->attendance->attributes = $_POST['AttendanceLogs'];
			$vm->attendance->month = $month;
			$vm->attendance->year = $year;
	
		}

		
		$this->render('/admin/reports/driverAtt/index', array(
			'vm' => $vm,
		));

	}
	
	
	public function actionDriverReservation()
	{		

		
		$vm = (object) array();
		$vm->reservation = new Reservation('search');
		
		if(isset($_POST['Reservation']) || isset($_POST['Month']) || isset($_POST['Year']))
		{
			$month = $_POST['Month'];
			$year = $_POST['Year'];
			$vm->reservation->attributes = $_POST['Reservation'];
			$vm->reservation->month = $month;
			$vm->reservation->year = $year;
			
		}

		
		$this->render('/admin/reports/driverRes/index', array(
			'vm' => $vm,
		));

	}
	public function actionDriverBilling()
	{		

		
		$vm = (object) array();
		$vm->reservation = new Reservation('search');
		
		if(isset($_POST['Reservation']) || isset($_POST['Month']) || isset($_POST['Year']))
		{
			$month = $_POST['Month'];
			$year = $_POST['Year'];
			$vm->reservation->attributes = $_POST['Reservation'];
			$vm->reservation->month = $month;
			$vm->reservation->year = $year;
			
		}

		
		$this->render('/admin/reports/driverBilling/index', array(
			'vm' => $vm,
		));

	}


		
}