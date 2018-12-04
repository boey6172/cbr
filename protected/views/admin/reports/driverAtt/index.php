
	<div class="page-header">
		<div class="row well col-md-10 col-md-offset-1">
			<legend><span class="fa fa-user-circle"></span> <b>Choose Reports</b></legend>
				<?php
					$this->renderPartial('/admin/reports/driverAtt/_form', array(
						'vm' => $vm,
					));
				?>
		</div>		
		<div class="row well col-md-10 col-md-offset-1">
			
				<?php
					$this->renderPartial('/admin/reports/driverAtt/_grid', array(
						'vm' => $vm,
					));
				?>
		</div>
	</div>

<?php
$success = 'success';
$warning = 'warning';
$error = 'error';
$searchAttandance = Yii::app()->createUrl( "report/DriverAttendance" );
Yii::app()->clientScript->registerScript('Attdriver', "
			
		
		$(document).on('click', '.attendance_search_btn', function(){
			
			grid();
		});
		
		function grid()
		{
		$('#formAttendanceReport').submit();
		}
		
		$('#formAttendanceReport').submit(function()
		{

			$('#attendance-grid').yiiGridView('update', {
			type:'POST',
			data: $(this).serialize()
		});
		return false;
		});
");
?>