
	<div class="page-header">
		
			<div class="row">
				<div class="row well col-md-8 col-md-offset-2">
				<legend><span class="fa fa-home"></span> <b>Choose Reports</b></legend>
					<div class="row ">
						<?php// echo CHtml::link( $this::faDivMenu('fa-user-o', 'DRIVER ATTENDANCE REPORT'),array(URL_ADMIN_REPORTS_ATTENDANCE_DRIVER)); ?>
						
						<?php echo CHtml::link( $this::faDivMenu('fa-credit-card-alt', 'BILLING REPORT'),array(URL_ADMIN_REPORTS_RESERVATION_BILLING)); ?>
						<?php echo CHtml::link( $this::faDivMenu('fa-list-ol', 'DRIVER RESERVATION REPORT'),array(URL_ADMIN_REPORTS_RESERVATION_DRIVER)); ?>
					</div>
				</div>

				
			</div>
	</div>

