<br/>

<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'reservation_form',
			'type' => 'horizontal',
		)
	);
?>
<div class="errorTxt"> <span class="change">Please Fill up the forms</span>
<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> </div>
<div class="row">
	<div class="col-sm-12">
		<label class="control-label required" for="Reservation_reserved_date">Reservation Date <span class="required">*</span></label>
		<?php echo $this::datePicker('reservation_date_start', 'MM/DD/YYYY HH:mm', '<input type="text" name="reservation_date_start" id="startdate" autocomplete="off" value="" class="form-control" readonly/>'); ?>
		
	</div>
	
</div>
<br>
<div id="pick_up_div">
	<div class="row">
		<div class="col-sm-12">
			<label for="" class="control-label required">Pickup Location <span class="required">*</span></label>
			<input type="text" name="Reservation_pick_up_location" autocomplete="off" value="" class="form-control" id="Reservation_pick_up_location">
		</div>
	<br>
	</div>
</div>
<br>
<div id="drop_off_div">
	<div class="row">
		<div class="col-sm-12">
			<label for="" class="control-label required">Drop Off Location <span class="required">*</span></label>
			<input type="text" name="Reservation_drop_off_location" autocomplete="off" value="" class="form-control" id="Reservation_drop_off_location">
		</div>
	<br>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<label class="control-label required" for="">Main Contact No. <span class="required">*</span></label>
		<input type="number" name="Contact_no_main" autocomplete="off" value="" class="form-control" maxlength="11" minlength="10" placeholder="09171234567" id="Contact_no_main">
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<!--<label class="control-label required" for="">No. of Passengers <span class="required">*</span></label>
		<input type="number" name="Reservation_no_passengers" autocomplete="off" value="" class="form-control" min="1" max="20" placeholder="0" id="Reservation_no_passengers">-->
	</div>
</div>

<br>
<div class="row">
	<div class="col-sm-12">
		<div><label for="">Passengers</label><br>
			<input type="text" name="passenger_name" autocomplete="off" value="" id="passenger_name" placeholder="Name" class="form-control"> 
		</div>
		<div>
		<!--	<input type="text" name="passenger_contact_no" autocomplete="off" value="" id="passenger_contact_no" placeholder="Contact No" class="form-control"> -->
		</div>
		<br>
		<div class='pull-right'>
			<button class="btn btn-primary btn-s" type="button" id="add_passenger_btn">Add</button>
		</div>
		<br>
		<br>
		<br>
		<div class="list-group">
		  <span class="list-group-item" id="Reservation_passengers"></span>
		</div>
		
	</div>
</div>
<?php echo $form->hiddenField($vm->reservation, 'car', array()); ?>
<?php echo $form->hiddenField($vm->reservation, 'driver', array()); ?>
<?php echo $form->hiddenField($vm->reservation, 'distance', array()); ?>
<?php echo $form->hiddenField($vm->reservation, 'estimated_time', array()); ?>
<?php echo $form->hiddenField($vm->reservation, 'reservation_type', array()); ?>
<?php echo $form->hiddenField($vm->reservation, 'reservation_no', array()); ?>
<?php echo $form->hiddenField($vm->reservation, 'reservation_no', array()); ?>
<?php echo $form->hiddenField($vm->reservation, 'estimated_fare', array()); ?>
<?php echo $form->hiddenField($vm->reservation, 'contact_no', array()); ?>

<?php
	$this->endWidget();
?>
