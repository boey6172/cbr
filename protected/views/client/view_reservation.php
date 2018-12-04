<?php if (isset($vm->reservation)): ?>

<h2><span class="fa fa-car"></span> <b>View Reservation</b></h2>
<hr>

<div>
	<center>
	<?php
		$optionsArray = array(
			'itemId'=> "barcode-div",
			'barcode'=> $vm->reservation->reservation_no,
			/*
				supported types
				ean8, ean13, upc, std25, int25,
				code11, code39, code93, code128,
				codabar, msi, datamatrix
			*/
		);
		echo Common::getItemBarcode( $optionsArray );
	?>
	</center>
</div>
<table class="table table-bordered table-condensed">
	<tr>
		<th class="text-center" colspan="2">
			RESERVATION SUMMARY
		</th>
	</tr>
	<tr>
		<th class="text-center">
			NATURE OF THE TRIP : 
			<?php
				echo $vm->reservation->ReservationType->description;
			?>
		</th>
		<th class="text-center">
			STATUS : 
			<?php
				echo ( $vm->reservation->reservation_status == 0) ? ($vm->reservation->user_cancelled == 0) ? "ADMIN " : "USER " : "" ;
				echo $vm->reservation->ReservationStatus->description;
			?>
		</th>
	</tr>
	<tr>
		<td colspan="2">
			<b>DATE RESERVED :</b> <?php echo date('M d, Y h:i A', strtotime($vm->reservation->reserved_date)); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<b>DATE ARRIVED :</b> <?php echo (!is_null($vm->reservation->arrival_date)) ? date('M d, Y h:i A', strtotime($vm->reservation->arrival_date)) : " NOT YET ARRIVED "; ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
				<b>LOCATION : </b> <br> </b><b>FROM:</b> <br> <?php echo $vm->reservation->pick_up_location; ?> - <br> <b>TO:</b> <br> <?php echo $vm->reservation->drop_off_location; ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<b>DISTANCE : </b> <?php echo ($vm->reservation->distance / 1000); ?> km
		</td>
	</tr>
	<tr  class="<?php echo (!isset($vm->car)) ? 'hidden' : '' ?>">
		<td colspan="2">
			<b>NO OF PASSENGERS : </b> <?php echo ($vm->reservation->no_of_passengers != 0) ? $vm->reservation->no_of_passengers : '' ; ?>
		</td>
	</tr>
	<tr  class="<?php echo (!isset($vm->car)) ? 'hidden' : '' ?>">
		<td colspan="2">
			<b>FARE: </b> <?php echo ($vm->reservation->estimated_fare != 0) ? $vm->reservation->estimated_fare : '' ; ?>
		</td>
	</tr>
	<tr  class="<?php echo (!isset($vm->car)) ? 'hidden' : '' ?>">
		<td colspan="2">
			<b>PASSENGERS : </b> <br>
			<?php echo ($vm->reservation->passengers != '') ? $vm->reservation->passengers : ''; ?>
		</td>
	</tr>
	<tr class="<?php echo (!isset($vm->car)) ? 'hidden' : '' ?>">
		<th  colspan="2" class="text-center">
			CAR DETAILS
		</th>
	</tr>
	<tr class="<?php echo (!isset($vm->car)) ? 'hidden' : '' ?>">
		<td colspan="2">
			<b>PLATE NO : </b> <?php echo (isset($vm->car)) ? $vm->car->plate_no : ''; ?>
		</td>
	</tr>
	<tr  class="<?php echo (!isset($vm->car)) ? 'hidden' : '' ?>">
		<td colspan="2">
			<b>CAR MODEL : </b> <?php echo (isset($vm->car)) ? $vm->car->car_model : ''; ?>
		</td>
	</tr>
	<tr>
		<th colspan="2" class="text-center">
			DRIVER DETAILS
		</th>
	</tr>
	<tr>
		<td colspan="2">
			<b>NAME : </b> <?php echo $vm->driver->full_name; ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<b>CONTACT NO : </b> <?php echo $vm->driver->contact_no; ?>
		</td>
	</tr>
	<tr>
		<th colspan="2" class="text-center">
			<b>REMARKS</b>
		</th>
	</tr>
	<tr>
		<td colspan="2">
			 <?php echo $vm->reservation->cancellation_remarks; ?>
		</td>
	</tr>
</table>

<button id="finish_btn" type="button" class="btn cus_btn btn-success btn-mp"><i class="fa fa-check-circle"></i> Finish Trip</button>

<button id="cancel_btn" type="button" class="btn cus_btn btn-danger btn-mp"><i class="fa fa-times-circle"></i> Cancel Reservation</button>

<button id="back_btn" type="button" class="btn cus_btn btn-primary btn-mp"><i class="fa fa-arrow-circle-o-left"></i> Go Back To Dashboard</button>

<?php endif; ?>

<!-- MODALS -->

<?php
    echo $this->alenaModal( 'modalCancel', array(
        'title' => "<span class='fa fa-question-circle-o fa-lg'></span>&nbsp;<span class='modalTitle'>Cancel Reservation</span>",
        // 'body' => $this->renderPartial('_modal_loading', array(
        // 	'vm' => $vm,
        // ), true),
        'body' => '
	        <center>
	        	<div class="confirmation_cancel_massage">
	        		<h2>Loading <span class="fa fa-spinner fa-spin"></span></h2>
	        	</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
					<form method="post" id="remarks" name="remarks">
						<h2>Reason:</h2>
							<input type="text" name="remarks_text" id="remarks_text" class="remarks_text form-control"><br>
						</div>
					</form>
				</div>
	        	<div class="confirmation_buttons">
					<button class="btn cus_btn btn-success btn-mp btn_modal_cancel_confirm" ref=' . $vm->reservation->reservation_no . '>Yes</button>
					<button class="btn cus_btn btn-danger btn-mp btn_modal_cancel_close">No</button>
				<div>
			</center>
        ',
        'style' => '
        	width	: 95%;
        ',
    ));
?>

<?php
    echo $this->alenaModal( 'modalFinish', array(
        'title' => "<span class='fa fa-check-circle-o fa-lg'></span>&nbsp;<span class='modalTitle'>Finish Trip</span>",
        // 'body' => $this->renderPartial('_modal_loading', array(
        // 	'vm' => $vm,
        // ), true),
        'body' => '
	        <center>
	        	<div class="confirmation_finish_massage">
	        		<h2>Loading <span class="fa fa-spinner fa-spin"></span></h2>
	        	</div>
	        	<div class="confirmation_buttons">
					 
					<button class="btn cus_btn btn-success btn-mp btn_modal_finish_confirm" ref=' . $vm->reservation->reservation_no . '>Yes</button>
					<button class="btn cus_btn btn-danger btn-mp btn_modal_finish_close">No</button>
				<div>
			</center>
        ',
        'style' => '
        	width	: 95%;
        ',
    ));
?>

<?php
    echo $this->alenaModal( 'modalDriverRating', array(
        'title' => "<span class='fa fa-question-circle-o fa-lg'></span>&nbsp;<span class='modalTitle'>Would you like to rate driver ?</span>",
        'body' => '
	        
        ',
        'style' => '
        	width	: 95%;
        ',
    ));
?>

<?php
    echo $this->alenaModal( 'modalThanking', array(
        'title' => "<span class='fa fa-check-circle-o fa-lg'></span>&nbsp;<span class='modalTitle'>Info</span>",
        'body' => '
	        <div class="alert alert-success">
	        	<h2>Thanks, have a nice day. <span class="fa fa-smile-o"></span></h2> 
	        </div>
        ',
        'style' => '
        	width	: 95%;
        ',
    ));
?>

<!-- SCRIPT -->

<script type="text/javascript">

	var reservation_status = <?php echo $vm->reservation->reservation_status; ?>;
	var user_cancelled = <?php echo $vm->reservation->user_cancelled; ?>;

	$( document ).ready(function() {
	   
	   if(reservation_status == 1 && user_cancelled == 1)
	    {
	    	$('#finish_btn').hide();
	    	$('#cancel_btn').hide();
	    }
	    else if(reservation_status == 1  && user_cancelled == 0)
	    {
	    	$('#finish_btn').hide();
	    	$('#cancel_btn').show();
	    }
	    else if(reservation_status == 2 && user_cancelled == 0)
	    {
			$('#finish_btn').show();
	    	$('#cancel_btn').hide();
	    }
	    else if((reservation_status == 3) ||(reservation_status == 0 && user_cancelled == 0))
	    {
	    	$('#finish_btn').hide();
	    	$('#cancel_btn').hide();
	    }
		else if(reservation_status == 0 && user_cancelled == 1)
	    {
	    	$('#finish_btn').hide();
	    	$('#cancel_btn').hide();
	    }
	});
</script>

<?php
$client_reservation = Yii::app()->createUrl( "client/reservationlist" );
$cancel_reservation = Yii::app()->createUrl( "client/cancelreservation" );
$finish_reservation = Yii::app()->createUrl( "client/finishreservation" );
$back_link = Yii::app()->createUrl( "client/index" );
$get_reservation_driver = Yii::app()->createUrl( "client/getreservationdriver" );
$save_rating =  Yii::app()->createUrl( "client/savedriverrating" );
$success = 'success';
$error = 'error';

Yii::app()->clientScript->registerScript('view_reservation', "

	$(document).ready(function(){
         $('#remarks').parsley();
			$('#remarks .remarks_text').attr('data-parsley-required',true)
         .attr('data-parsley-minlength','5');
	});  
	
	$(document).on('click', '#cancel_btn', function(){
		$('.confirmation_cancel_massage').hide();
		$('#modalCancel').modal('show');
	});

	$(document).on('click', '.btn_modal_cancel_close', function(){
		$('#modalCancel').modal('hide');
	});

	$(document).on('click', '.btn_modal_cancel_confirm', function(){
		if ( $('#remarks').parsley().validate() )
		{
			
			$('.confirmation_cancel_massage').show();

			var id = $(this).attr('ref');
			var remarks = $('#remarks_text').val();
			alert(remarks);
			cancelReservation(id,remarks);
		}
	});

	function cancelReservation(id,remarks)
	{
		$.ajax({
			type: 'POST',
			url: '{$cancel_reservation}',
			data: {
				'Reservation[reservation_no]':id,
				'Reservation[cancellation_remarks]':remarks,
			},
			dataType:'json',
			success: function(data){
			    var json = data;
				var message = '<div class=alert_message>' + json.retMessage + '<div>';

				$('.confirmation_buttons').hide();
				$('.confirmation_cancel_massage').html(message);

			    if(json.retVal == '{$success}')
				{
					$('.alert_message').addClass('alert alert-success');
					window.location = '{$client_reservation}';
				}
				else if(json.retVal == '{$error}')
				{
					$('.alert_message').addClass('alert alert-danger');
				}
			}
		})
	}

	$(document).on('click', '#finish_btn', function(){
		$('.confirmation_finish_massage').hide();
		$('#modalFinish').modal('show');
	});

	$(document).on('click', '#back_btn', function(){
		back();
	});

	$(document).on('click', '.btn_modal_finish_close', function(){
		$('#modalFinish').modal('hide');
	});

	$(document).on('click', '.btn_modal_finish_confirm', function(){
		$('.confirmation_finish_massage').show();

		var id = $(this).attr('ref');

		finishReservation(id);
	});

	function finishReservation(id)
	{
		$.ajax({
			type: 'POST',
			url: '{$finish_reservation}',
			data: {
				'Reservation[reservation_no]':id,
			},
			dataType:'json',
			success: function(data){
			    var json = data;
				var message = '<div class=alert_message>' + json.retMessage + '<div>';

				$('.confirmation_buttons').hide();
				$('.confirmation_finish_massage').html(message);

			    if(json.retVal == '{$success}')
				{
					$('.alert_message').addClass('alert alert-success');
					$('#modalFinish').modal('hide');
					getReservationDriver(id);
				}
				else if(json.retVal == '{$error}')
				{
					$('.alert_message').addClass('alert alert-danger');
				}
			}
		})
	}

	function getReservationDriver(id)
	{
		$.ajax({
			type: 'POST',
			url: '{$get_reservation_driver}',
			data: {
				'Reservation[reservation_no]':id,
			},
			dataType:'json',
			success: function(data){
			    var json = data;

			    if(json.retVal == '{$success}')
				{
					$('#modalDriverRating .modal-body').html(json.retMessage);
					$('#modalDriverRating').modal('show');
				}
			}
		})
	}

	$(document).on('click', '.btn_modal_no_rating', function(){
		$('#modalDriverRating').modal('hide');
	});

	$(document).on('click', '.btn_modal_submit_rating', function(){
		submitRating();
	});

	function submitRating()
	{
		$.ajax({
	        type        : 'POST',
	        url         : '{$save_rating}',
	        data        : $('#driver_rating_form').serialize(),
	        cache       : false,
	        success     : function( data ) {
	            var json = $.parseJSON( data );

                if(json.retVal == '{$success}')
                {
                	$('#alert_rating_errors').html(json.retMessage);

					setTimeout(function() { 
					$('#alert_rating_errors').alert('close');
					$('#modalDriverRating').modal('hide');
					}, 1000);
                }
                else if(json.retVal == '{$error}')
                {
                    $('#alert_rating_errors').html(json.retMessage);

                }
	        }
	    })
	}

	$('#modalDriverRating').on('hide.bs.modal', function (e) {
	    showThankingModal();
	});

	function showThankingModal()
	{ 
		$('#modalThanking').modal('show');
	}
	function back()
	{ 
		// $('#modalThanking').modal('show');
		   window.location = '{$back_link}';
	}

	$('#modalThanking').on('hide.bs.modal', function (e) {
	    window.location = '{$client_reservation}';
	});

");

?>