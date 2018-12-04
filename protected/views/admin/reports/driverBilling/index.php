	<div class="page-header">
		<div class="row well col-md-10 col-md-offset-1">
			<legend><span class="fa fa-user-circle"></span> <b>Reservation Billing</b></legend>
				<?php
					$this->renderPartial('/admin/reports/driverBilling/_form', array(
						'vm' => $vm,
					));
				?>
		</div>		
		<div class="row well col-md-10 col-md-offset-1">
			
				<?php
					$this->renderPartial('/admin/reports/driverBilling/_grid', array(
						'vm' => $vm,
					));
				?>
		</div>
	</div>

<?php
$success = 'success';
$warning = 'warning';
$error = 'error';
$searchAttandance = Yii::app()->createUrl( "report/DriverBilling" );
Yii::app()->clientScript->registerScript('Attdriver', "
			
		
		$(document).on('click', '.reservation_search_btn', function(){
			
			grid();
		});
		
		function grid()
		{
		$('#formReservationReport').submit();
		}
		
		$('#formReservationReport').submit(function()
		{

			$('#reservation-grid').yiiGridView('update', {
			type:'POST',
			data: $(this).serialize()
		});
		return false;
		});
");
?>