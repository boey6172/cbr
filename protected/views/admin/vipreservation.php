<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'vipreservation',
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

<div class="row">
	<div class="col-md-12">
		<?php
		$drivers = CHtml::listData( Driver::model()->findAll(array('condition'=>'isVip = 1')), 'driver_id', 'last_name'); ?>

		<?php echo $form->select2Group(
			$vm->reservation,
			'driver_id',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
					'name' => 'driver-id',
				),
				'widgetOptions' => array(
					'data' => $drivers,
					'options' => array(
						'placeholder' => 'Select Driver.',
					),
				),
			)
		);?>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<?php $car = CHtml::listData( Car::model()->findAll(array('condition'=>'isVip = 1 ','order'=>'name')), 'cars_id', 'name'); ?>

		<?php echo $form->select2Group(
			$vm->reservation,
			'car_id',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5 yehey',
					'name' => 'car_id',
				),
				'widgetOptions' => array(
					'data' => $car,
					'options' => array(
						'placeholder' => 'Select car.',
					),
				),
			)
		);?>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<?php
			echo $form->textFieldGroup($vm->reservation, 'pickup_location', array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						// 'autocomplete' => 'off',
						'name'=> 'pickup_location'
					)
				)
			));
		?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php
			echo $form->textFieldGroup($vm->reservation, 'dropoff_location', array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						// 'autocomplete' => 'off',
						'name'=> 'dropoff_location'
					)
				)
			));
		?>
	</div>
</div>


<div class="row">
	<div class="col-sm-12">
		<span><label for="">Type. of Passengers</label></span>
		<select class="form-control valid" placeholder="Type" name="type" id="Reservation_type" aria-invalid="false">
			<option value="">Select Type Reservation</option>
			<option value="1">Pick Up</option>
			<option value="2">Drop Off</option>
			<option value="3">Pick Up &amp; Drop Off</option>
		</select>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<span><label for="">No. of Passengers</label></span>
		<input type="number" name="no_passengers" autocomplete="off" value="" class="form-control">
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<span><label for="">Name of Passengers</label></span>
		<textarea style="resize: none; width:100%; " name="remarks_passenger" rows="8" cols="94"></textarea>
	</div>
</div>
<div class="row">
	<div class="col-md-offset-1 col-md-10">
		<button type="button" class="btn btn-success btn-block" id="save_reservation_btn">SAVE RESERVATION</button>
	</div>
</div>

<?php $this->endWidget(); ?>

<!-- ======================== Google Api ========================================= -->

<script>
	// This example displays an address form, using the autocomplete feature
	// of the Google Places API to help users fill in the information.

	// This example requires the Places library. Include the libraries=places
	// parameter when you first load the API. For example:
	// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

	var placeSearch, autocomplete1, autocomplete;
	var componentForm = {
		street_number: 'short_name',
		route: 'long_name',
		locality: 'long_name',
		administrative_area_level_1: 'short_name',
		country: 'long_name',
		postal_code: 'short_name'
	};

	function initAutocomplete() {
		// Create the autocomplete object, restricting the search to geographical
		// location types.
		autocomplete = new google.maps.places.Autocomplete(
				/** @type {!HTMLInputElement} */(document.getElementById('pickup_location')),
				{types: ['geocode']});
	autocomplete = new google.maps.places.Autocomplete(
				/** @type {!HTMLInputElement} */(document.getElementById('dropoff_location')),
				{types: ['geocode']});

		// When the user selects an address from the dropdown, populate the address
		// fields in the form.
	}

	function fillInAddress() {
		// Get the place details from the autocomplete object.
		var place = autocomplete.getPlace();

		for (var component in componentForm) {
			document.getElementById(component).value = '';
			document.getElementById(component).disabled = false;
		}

		// Get each component of the address from the place details
		// and fill the corresponding field on the form.
		for (var i = 0; i < place.address_components.length; i++) {
			var addressType = place.address_components[i].types[0];
			if (componentForm[addressType]) {
				var val = place.address_components[i][componentForm[addressType]];
				document.getElementById(addressType).value = val;
			}
		}
	}

	// Bias the autocomplete object to the user's geographical location,
	// as supplied by the browser's 'navigator.geolocation' object.
	function geolocate() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var geolocation = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				var circle = new google.maps.Circle({
					center: geolocation,
					radius: position.coords.accuracy
				});
				autocomplete.setBounds(circle.getBounds());
			});
		}
	}

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABSSsbDOUfnTG2E_M8-6AnOMnAI1wDtU8&libraries=places&callback=initAutocomplete" async defer></script>



<?php
$saveReservation = Yii::app()->createUrl( "admin/SaveVIPreservation" );

$success = 'success';
$warning = 'warning';
$error = 'error';

Yii::app()->clientScript->registerScript('reservation', "


		$('#save_reservation_btn').click(function(){
			Loading.show();
			$.ajax({
					type        : 'POST',
					url         : '{$saveReservation}',
					data        : $('#vipreservation').serialize(),
					cache       : false,
					success     : function( data ) {
							var json = $.parseJSON( data );
							
							if(json.retVal == '{$success}')
							{
									$.notify(json.retMessage, 'success');
									$('.select2-chosen').select2('val', '');
									var form = document.getElementById('vipreservation');
									Loading.hide();
									form.reset();
							}
							else if(json.retVal == '{$error}')
							{
									$.notify(json.retMessage, json.retVal);
							}
					}
			});
		});
		
		$().ready(function() {
		// validate signup form on keyup and submit
		$('#vipreservation').validate({
				debug: true,
				success: 'valid',
				rules: {
					reservation_date_start: {
							required: true,
							startDatevalidation: true,
					},
					reservation_date_end: {
							required: true,
							endDatevalidation: '#startdate',
					},
					pickup_location: {
							required: true,
					},
					dropoff_location: {
							required: true,
					},
					no_passengers: {
							required: true,
					},
					type: {
							required: true,
					},
			},
			messages: {
				reservation_date_start: {
						required: 'Please select start date',
				},
				reservation_date_end: {
						required: 'Please select end date',
				},
				pickup_location: {
						required: 'Please input pickup location',
				},
				dropoff_location: {
						required: 'Please input dropoff location',
				},
				no_passengers: {
						required: 'Please input no of passengers',
				},
				type: {
						required: 'Please select type',
				},
			},

			});
		});
		jQuery.validator.addMethod('startDatevalidation', function (value, element) {
				var splitDate = value;
        //splitDate = splitDate.split(' ');
				var currentDate = new Date();
				var targetValue = new Date(splitDate);
				return targetValue > currentDate;
		}, 'Invalid Date!');

		jQuery.validator.addMethod('endDatevalidation', function (value, element, param) {
				var currentValue = value;
				//currentValue = currentValue.split(' ');
				var target = $( param );
				var targetValue = target.val();
				//targetValue = targetValue.split(' ');

				var startDate = new Date(targetValue);
				var endDate = new Date(currentValue);

				return startDate < endDate;

		}, 'Invalid Date!');


");
?>