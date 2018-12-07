
	<div class="page-header">
		
			<div class="row">
				<div class="row well">
				<legend><span class="fa fa-home"></span> <b>Admin Home</b></legend>
					<div class="col-md-3">
						<?php
						$this->widget('ext.metabox.EMetabox', array(
							'id' => 'reservationToday',
							'url' => array('admin/reservationToday'),
						 
						));
						?>
					</div>
					<div class="col-md-3">
						
						<?php
						$this->widget('ext.metabox.EMetabox', array(
							'id' => 'reservationOnTransit',
							'url' => array('admin/reservationOnTransit'),
						 
						));
						?>
					</div>	
					<div class="col-md-3">
						<?php
						$this->widget('ext.metabox.EMetabox', array(
							'id' => 'reservationDoneToday',
							'url' => array('admin/reservationDoneToday'),
						 
						));
						?>		
					</div>
					<div class="col-md-3">
						<?php
						$this->widget('ext.metabox.EMetabox', array(
							'id' => 'reservationCanceledToday',
							'url' => array('admin/reservationCanceledToday'),
						 
						));
						?>		
					
					</div>
				</div>
				<div class="row well">
				<legend><span class="fa fa-home"></span> <b>Reservations</b></legend>

					<?php /** @var TbActiveForm $form */
					$form = $this->beginWidget(
						'booster.widgets.TbActiveForm',
						array(
							'id' => 'formReservation',
							'type' => 'horizontal',
						)
					);
					?>
				    <div class="row">	
					    <div class="col-md-5">
					            
					        <?=$this::datePickerAlldays('date1', 'YYYY-M-DD', $form->textField( $vm->reservation, 'reserved_date', ['class'=>'form-control'])); ?>
					    </div>
						<div class="col-md-3">
							<?php
								$this->widget(
									'booster.widgets.TbButton',
									array(
										// 'buttonType' => 'submit',
										'label' => 'Submit',
										'context' => 'primary',
										'htmlOptions' => array(
											'class' => 'reservation_search_btn col-md-12 ',
											'style' => '
												display: none, 
											',
										),
									)
								);
							?>
						</div>

					</div>
					</br>	

					<?php $this->endWidget(); ?>
					<div class="col-md-12 ">
						<?php
							$this->widget(
								'booster.widgets.TbTabs',
								array(
									'type' => 'tabs', // 'tabs' or 'pills'
									'tabs' => array(
										array(
											'active' => true,
											'label' => 'Reservations',
											'icon' => 'fa fa-calendar fa-lg',
											'content' => $this->renderPartial('reservationview', array(
												'vm' => $vm,
											), true),
										),		
										/*array(
											'active' => false,
											'label' => 'In-Transit',
											'icon' => 'fa fa-car fa-lg',
											'content' => $this->renderPartial('grids/inTransit', array(
												'vm' => $vm,
											), true),
										),		
										array(
											'active' => false,
											'label' => 'Done Reservation',
											'icon' => 'fa fa-check fa-lg',
											'content' => $this->renderPartial('grids/done', array(
												'vm' => $vm,
											), true),
										),	
										array(
											'active' => false,
											'label' => 'User Cancelled Reservations',
											'icon' => 'fa fa-user-times fa-lg',
											'content' => $this->renderPartial('grids/usercancelledReservation', array(
												'vm' => $vm,
											), true),
										),	
										array(
											'active' => false,
											'label' => 'Cancelled Reservations',
											'icon' => 'fa fa-ban fa-lg',
											'content' => $this->renderPartial('grids/cancelledReservation', array(
												'vm' => $vm,
											), true),
										),	*/
										
										
								)
							));
						?>
					</div>
				</div>
				<!--<div class="row well">
				<legend><span class="fa fa-home"></span> <b>All Reservations</b></legend>
					<div class="col-md-12 ">
						<?php
							$this->widget(
								'booster.widgets.TbTabs',
								array(
									'type' => 'tabs', // 'tabs' or 'pills'
									'tabs' => array(
										array(
											'active' => true,
											'label' => 'Reservations',
											'icon' => 'fa fa-calendar fa-lg',
											// 'content' => $this->renderPartial('allreservationview', array(
											// 	'vm' => $vm,
											// ), true),
											'content' => 'ongoing updates',
											
										),		
										/*array(
											'active' => false,
											'label' => 'In-Transit',
											'icon' => 'fa fa-car fa-lg',
											// 'content' => $this->renderPartial('allgrids/inTransit', array(
											// 	'vm' => $vm,
											// ), true),
											'content' => 'ongoing updates',
										),		
										array(
											'active' => false,
											'label' => 'Done Reservation',
											'icon' => 'fa fa-check fa-lg',
											// 'content' => $this->renderPartial('allgrids/done', array(
											// 	'vm' => $vm,
											// ), true),
											'content' => 'ongoing updates',
										),	
										array(
											'active' => false,
											'label' => 'User Cancelled Reservations',
											'icon' => 'fa fa-user-times fa-lg',
											// 'content' => $this->renderPartial('allgrids/usercancelledReservation', array(
											// 	'vm' => $vm,
											// ), true),
											'content' => 'ongoing updates',
										),	
										array(
											'active' => false,
											'label' => 'Cancelled Reservations',
											'icon' => 'fa fa-ban fa-lg',
											// 'content' => $this->renderPartial('allgrids/cancelledReservation', array(
											// 	'vm' => $vm,
											// ), true),
											'content' => 'ongoing updates',
										),	*/
										
										
								)
							));
						?>
					</div>
				</div>-->
				<div class="row well">
					<legend><span class="fa fa-bars"></span> <b>Admin Menu</b></legend>
						<div class="col-md-12 ">
							<?php
								echo CHtml::openTag('div', array('class' => 'row-fluid'));
								$this->widget(
									'bootstrap.widgets.TbThumbnails',
									array(
									'id' => 'admin_thumb',
									'dataProvider' => $vm->menu->search(),
									'template' => "{items}\n{pager}",
									'itemView' => 'dashboard/_menu_thumb',
									)
								);
								echo CHtml::closeTag('div');
							?>
					</div>
				</div>
			</div>
	</div>

<?php
    echo $this->alenaModal( 'modal_reservation_cancel', array(
        'title' => '<span style="color:red;"><i class="fa fa-pencil"></i> Cancel Reservation</span>',
		'body' =>'',
        'footer' =>
					CHtml::button('No', array("class" => "btn", "data-dismiss"=>"modal")) .
        	' ' .
        	CHtml::button('Yes', array("id" => "btn_cancel_reservation", "class" => "btn btn-primary", "data-dismiss"=>"modal"))
        ,
        // 'style' => '
        // 	width	: 50%;
        // ',
    ));
?>


<?php
    echo $this->alenaModal( 'modal_reservation', array(
        'title' => '<span style="color:red;"><i class="fa fa-pencil"></i> Update Reservation</span>',
         'body' =>$this->renderPartial('_update_reservtion', array(
        	'vm' => $vm,
        ), true),
		'footer' =>
					
        	
        	CHtml::button('Yes', array("id" => "btn_update_reservation", "class" => "btn btn-primary")). ' '.
			CHtml::button('No', array("class" => "btn", "data-dismiss"=>"modal")) 
        ,
        // 'style' => '
        // 	width	: 50%;
        // ',
    ));
?>

<?php
$cancelReservation = Yii::app()->createUrl( "reservation/cancelreservation" );
$doneReservation = Yii::app()->createUrl( "Admin/DoneReservation" );
$carAdmin = Yii::app()->createUrl( "Car/Admin" );
$driverAdmin = Yii::app()->createUrl( "Driver/Admin" );
$accountAdmin = Yii::app()->createUrl( "Account/Maintenance" );
$deparmentAdmin = Yii::app()->createUrl( "department/maintenance" );
$reservationListAdmin = Yii::app()->createUrl( "client/reservationlist" );
$resrvationAdmin = Yii::app()->createUrl( "client/carreservation" );
$reservationCheck = Yii::app()->createUrl( "admin/CheckReservation" );
$reservationCheckcancelled = Yii::app()->createUrl( "admin/CheckCancelledReservation" );
$reportsAdmin = Yii::app()->createUrl( "report/index" );
$reservationEmailArrived = Yii::app()->createUrl( "admin/reservationEmailArrived" );
$AllList = Yii::app()->createUrl( "admin/ReservationFullList" );
$index = Yii::app()->createUrl( "admin/index" );

$success = 'success';
$warning = 'warning';
$error = 'error';

Yii::app()->clientScript->registerScript('dashboard', "
		var res_id;
		var reservation_d;
		counter();
		refresh();
		gridRefresh();
	$(document).ready(function() {
	       		$('#reservation_grid table').attr('id', 'ac_grid');	
 		});	

	   	$(function () {
                        $('#ac_grid').DataTable({
							'stateSave': true,
							'ordering': true,
							'responsive': true,
							'iDisplayLength': 10,
							'order': [[ 0, 'asc' ], [ 1, 'asc' ]]

                        })
                    })       
	//var table = $('#ac_grid').DataTable();	
	//setInterval( function () {
    //table.ajax.reload(); // user paging is not reset on reload
    // alert('yehey');
	//}, 5000 );

		$(document).on('click', '.reservation_search_btn', function(){
				grid();
				search();

			});
			
			function grid()
			{
				$('#formReservation').submit();
			}
			
		$('#formReservation').submit(function()
			{
				$('#reservation_grid').yiiGridView('update', {
				type:'POST',
				data: $(this).serialize()
			});
			return false;
		});


		
			function refresh()
			{
				getUsercancelledCount();
				emailArrived();
				$('#reservationToday').metabox('refresh');
				$('#reservationOnTransit').metabox('refresh');
				$('#reservationDoneToday').metabox('refresh');
				$('#reservationCanceledToday').metabox('refresh');
			}
			function gridRefresh()
			{
									
					$('#cancelledreservation-grid').yiiGridView('update', {
						data: $(this).serialize()
					});
					$('#reservation-grid').yiiGridView('update', {
						data: $(this).serialize()
					});			
					$('#usercancelledreservation-grid').yiiGridView('update', {
						data: $(this).serialize()
					});
					$('#inTransitReservation-grid').yiiGridView('update', {
						data: $(this).serialize()
					});		
					$('#doneReservation-grid').yiiGridView('update', {
						data: $(this).serialize()
					});
					$('#allcancelledreservation-grid').yiiGridView('update', {
						data: $(this).serialize()
					});
					$('#allreservation-grid').yiiGridView('update', {
						data: $(this).serialize()
					});			
					$('#allusercancelledreservation-grid').yiiGridView('update', {
						data: $(this).serialize()
					});
					$('#allinTransitReservation-grid').yiiGridView('update', {
						data: $(this).serialize()
					});		
					$('#alldoneReservation-grid').yiiGridView('update', {
						data: $(this).serialize()
					});
				
			}
			
			function getUsercancelledCount()
			{
				$.ajax({
						url: '{$reservationCheckcancelled}',
						type: 'POST',
						// data:  $('#updateReservation').serialize(),
						dataType: 'JSON',
						success     : function( data ) {
								var json = ( data );

								if(json.retVal == '{$success}')
								{
									$.notify(json.retMessage, json.retVal);
								}
								else if(json.retVal == '{$error}')
								{
									 $.notify(json.retMessage, json.retVal);
								}
						}
				});
			}
			
			function emailArrived()
			{
				$.ajax({
						url: '{$reservationEmailArrived}',
						type: 'POST',
						// data:  $('#updateReservation').serialize(),
						dataType: 'JSON',
						success     : function( data ) {
								var json = ( data );

								if(json.retVal == '{$success}')
								{
									$.notify(json.retMessage, json.retVal);
								}
								else if(json.retVal == '{$error}')
								{
									 $.notify(json.retMessage, json.retVal);
								}
						}
				});
			}
			
			function counter()
			{
				var counter = 0;
				var interval = setInterval(function() {
				counter++;
				
		   
				if (counter == 30) {
					
					refresh();
					gridRefresh();
				   counter = 0;
				}
					}, 1000);
			}
	

		$(document).on('click', '#modal_cancel_reservation', function(){
			res_id =  $(this).attr('data');
			alert();
			var values = {
							'reservation_id' : res_id
			}

			
			$.ajax({
					url: '{$reservationCheck}',
					type: 'POST',
					data: values,
					dataType: 'JSON',
					success     : function( data ) {
							var json = ( data );

							if(json.retVal == '{$success}')
							{
								$('#modal_reservation_cancel .modal-body').html(json.retMessage);
								$('#modal_reservation_cancel').modal();
							}
							else if(json.retVal == '{$error}')
							{
								 alert('error');
							}
					}
			});
			$('#modal_reservation_cancel').modal();
			

		});	
		$(document).on('click', '.Admin', function(){
		// alert('Admin');
			window.location= '{$resrvationAdmin}';

		});	

		$(document).on('click', '.User', function(){
			window.location= '{$accountAdmin}';
		});	

		$(document).on('click', '.Car', function(){
			// alert('car');
			window.location= '{$carAdmin}';
		});
		
		$(document).on('click', '.Driver', function(){
			window.location= '{$driverAdmin}';
		});	
		$(document).on('click', '.Department', function(){
			window.location= '{$deparmentAdmin}';
		});	
		$(document).on('click', '.Search', function(){
			window.location= '{$reservationListAdmin}';
		});
		$(document).on('click', '.Reports', function(){
			window.location= '{$reportsAdmin}';
		});
		$(document).on('click', '.All', function(){
			window.location= '{$AllList}';
		});
		
		
		$(document).on('click', '#Update_reservation', function(){
			$('#modal_reservation').modal();

			reservation_d =  $(this).attr('data');
			document.getElementById('reservation_id').value =  reservation_d;


		});
		

		

		$(document).on('click', '#btn_cancel_reservation', function(){

			var values = {
							'reservation_id' : res_id
			}


			$.ajax({
					url: '{$cancelReservation}',
					type: 'POST',
					data: values,
					dataType: 'JSON',
					success     : function( data ) {
							var json = ( data );

							if(json.retVal == '{$success}')
							{
								gridRefresh();
								
								$('#modal_reservation').modal('hide');
								$.notify(json.retMessage, json.retVal);
							}
							else if(json.retVal == '{$error}')
							{
								 alert('error');
							}
					}
			});

		});

		
		$(document).on('click', '#btn_update_reservation', function(){

			var values = {
							'reservation_id' : reservation_d
							
							
			}


			$.ajax({
					url: '{$doneReservation}',
					type: 'POST',
					data:  $('#updateReservation').serialize(),
					dataType: 'JSON',
					success     : function( data ) {
							var json = ( data );

							if(json.retVal == '{$success}')
							{
								$('#reservation-grid').yiiGridView('update', {
                                data: $(this).serialize()
                            });
								$('#modal_reservation').modal('hide');
								$.notify(json.retMessage, json.retVal);
								location.reload();
							}
							else if(json.retVal == '{$error}')
							{
								 $.notify(json.retMessage, json.retVal);
							}
					}
			});

		});
		
		


");
?>
