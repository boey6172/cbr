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

<div class="row">
	<div class="col-sm-12">
		<label class="control-label required" for="Reservation_reserved_date">Reservation Date <span class="required">*</span></label>
		<?php echo $this::datePicker('reservation_date_start', 'MM/DD/YYYY h:mm A', '<input type="text" name="reservation_date_start" id="startdate" autocomplete="off" value="" class="form-control" readonly/>'); ?>
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
<?php echo $form->hiddenField($vm->reservation, 'driver', array()); ?>
<?php echo $form->hiddenField($vm->reservation, 'distance', array()); ?>
<?php echo $form->hiddenField($vm->reservation, 'estimated_time', array()); ?>
<?php echo $form->hiddenField($vm->reservation, 'reservation_type', array()); ?>
<?php echo $form->hiddenField($vm->reservation, 'reservation_no', array()); ?>

<?php
	$this->endWidget();
?>
