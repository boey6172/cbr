<br/>

<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'ReservationForm',
			'type' => 'horizontal',
		)
	);
?>

<div class="row">
	<div class="col-sm-6">
		<b>START DATE</b>
		<?php echo $this::datePicker('reservation_date_start', 'MM/DD/YYYY h:mm A', '<input type="text" name="reservation_date_start" id="startdate" autocomplete="off" value="" class="form-control" readonly/>'); ?>
	</div>
	<div class="col-sm-6">
		<b>END DATE</b>
		<?php echo $this::datePicker('reservation_date_end', 'MM/DD/YYYY h:mm A', '<input type="text" name="reservation_date_end" autocomplete="off" value="" class="form-control" readonly/>'); ?>
	</div>
</div>
<br />
<div class="row">
	<div class="col-sm-12">
		<span><label for="">Pickup Location</label></span>
		<input type="text" name="pickup_location" autocomplete="off" value="" class="form-control" onFocus="geolocate()" id="pickup">
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<span><label for="">Dropoff Location</label></span>
		<input type="text" name="dropoff_location" autocomplete="off" value="" class="form-control" onFocus="geolocate()" id="dropoff">
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<span><label for="">Type. of Trip</label></span>
		<select class="form-control valid" placeholder="Type" name="type" id="Reservation_type" aria-invalid="false">
			<option value="">Select Type Reservation</option>
			<option value="1">Pick-Up    ( Anywhere to Head Office )</option>
			<option value="2">Drop-Off   ( Head Office to Anywhere )</option>
			<option value="3">Pick Up &amp; Drop Off</option>
		</select>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<span><label for="">No. of Passengers</label></span>
		<input type="number" name="no_passengers" autocomplete="off" value="" class="form-control" min="1" max="20" >
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<span><label for="">Name of Passengers</label></span>
		<textarea style="resize: none; width:100%; " name="remarks_passenger" rows="8" cols="94"></textarea>
	</div>
</div>

<input type="hidden" id="Reservation_car_id" name="car_id" value="">
<input type="hidden" id="Reservation_driver_id" accept=""name="driver_id" value="">



<button id="reserve_btn" class="cus_btn btn-primary btn-mp submit button-next pull-right">Next <i class="fa fa-chevron-circle-right"></i></button>


<?php
	$this->endWidget();
?>
