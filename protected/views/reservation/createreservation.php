<div class="row">
	<div class="col-md-8">
		<section>
			<div class="wizard">
				<div class="wizard-inner">
					<div class="connecting-line">
					<div class="connecting-success"></div>
					</div>
					<ul class="nav nav-tabs line" role="tablist">

						<li role="presentation" class="active">
							<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
								<span class="round-tab">
									<i class="fa fa-calendar-plus-o fa-lg"></i>
								</span>
							</a>
						</li>

						<li role="presentation" class="disabled">
							<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
								<span class="round-tab">
									<i class="fa fa-car fa-lg"></i>
								</span>
							</a>
						</li>

						<li role="presentation" class="disabled">
							<a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
								<span class="round-tab">
									<i class="fa fa-user fa-lg"></i>
								</span>
							</a>
						</li>

						<li role="presentation" class="disabled">
							<a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
								<span class="round-tab">
									<i class="fa fa-file-text-o fa-lg"></i>
								</span>
							</a>
						</li>

					</ul>
			  </div> <!-- End of Inner-wizard  -->

				<div class="tab-content">
					<div class="tab-pane active" role="tabpanel" id="step1">
						<?php 	echo $this->renderPartial('/reservation/_step_one', array('vm' => $vm,false,true), true) ?>
					</div>

					<div class="tab-pane" role="tabpanel" id="step2">
						<?php echo $this->renderPartial('/reservation/_step_two', array('vm' => $vm,false,true), true) ?>
						<ul class="list-inline pull-left">
								<li><button type="button" class="btn cus_btn btn-primary btn-mp prev-step"><i class="fa fa-chevron-circle-left"></i> Previous</button></li>
						</ul>
					</div>

					<div class="tab-pane" role="tabpanel" id="step3">

						<div class="row-fluid">
							<div class="list-view">
								<div class="row">
									<div id="step3-content"></div>
								</div>
							</div>
						</div>
						<div style="clear: both;"></div>

						<button type="button" class="btn cus_btn btn-primary btn-mp prev-step pull-left"><i class="fa fa-chevron-circle-left"></i> Previous</button>

					</div>

					<div class="tab-pane" role="tabpanel" id="complete">

					<?php echo $this->renderPartial('/reservation/summary', array('vm' => $vm,false,true), true) ?>


					<button type="button" class="btn cus_btn btn-primary btn-mp prev-step pull-left"><i class="fa fa-chevron-circle-left"></i> Previous</button>


					<a href="<?php echo Yii::app()->createUrl('reservation/viewreservation'); ?>" type="button" id="save_reservation" class="btn cus_btn btn-primary btn-mp pull-right"><i class="fa fa-save"></i> Save</a>


					</div>

					<div class="clearfix"></div>
			  </div> <!-- end of Tab Content -->
			</div>
		</section>
	</div>
</div>


<?php
    echo $this->alenaModal( 'view_car_sched', array(
        'title' => "Car Schedule",
        'body' => "<div class='content'></div>",
        'footer' =>
        	// CHtml::button('Save', array("id" => "btn_edit_car", "class" => "btn btn-primary")) .
        	// ' ' .
        	CHtml::button('Back', array("class" => "btn", "data-dismiss"=>"modal"))
        ,
        // 'style' => '
        // 	width	: 50%;
        // ',
    ));
?>


<?php
    echo $this->alenaModal( 'view_driver_sched', array(
        'title' => "Driver Schedule",
        'body' => "<div class='content'></div>",
        'footer' =>
        	// CHtml::button('Save', array("id" => "btn_edit_car", "class" => "btn btn-primary")) .
        	// ' ' .
        	CHtml::button('Back', array("class" => "btn", "data-dismiss"=>"modal"))
        ,
        // 'style' => '
        // 	width	: 50%;
        // ',
    ));
?>



<script type="text/javascript">
$(document).ready(function () {
		//Wizard
$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

		var $target = $(e.target);

		if ($target.parent().hasClass('disabled')) {
				return false;
		}
});

$(".next-step").click(function (e) {

		 var $active = $('.wizard .nav-tabs li.active');
						var $success = $('.connecting-line .connecting-success');
						var containerWidth = ($(".connecting-line .connecting-success").width() / $(".connecting-line").width())* 100;
						$('.connecting-line .connecting-success').width(containerWidth +(32 / 100) * 100 + '%');
						$active.next().removeClass('disabled');
						nextTab($active);

});
		$(".prev-step").click(function (e) {
				var $active = $('.wizard .nav-tabs li.active');
				 var containerWidth = ($(".connecting-line .connecting-success").width() / $(".connecting-line").width())* 100;
				 $('.connecting-line .connecting-success').width(containerWidth -  (32 / 100) * 100 + '%');
				prevTab($active);
		});
});
function nextTab(elem) {
		$(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
		$(elem).prev().find('a[data-toggle="tab"]').click();
}

$(document).on('click', '#reserve_btn', function(){
		var reserve_details = $("#ReservationForm").serializeObject();
		$('#display_respick').text(JSON.stringify(reserve_details.pickup_location).replace(/['"]+/g, ''));
		$('#display_resdrop').text(JSON.stringify(reserve_details.dropoff_location).replace(/['"]+/g, ''));
		$('#display_resstartdate').text(JSON.stringify(reserve_details.reservation_date_start).replace(/['"]+/g, ''));
		$('#display_resenddate').text(JSON.stringify(reserve_details.reservation_date_end).replace(/['"]+/g, ''));
		$('#display_resno_passenger').text(JSON.stringify(reserve_details.no_passengers).replace(/['"]+/g, ''));
		$('#display_remarks_passenger').text(JSON.stringify(reserve_details.remarks_passenger).replace(/['"]+/g, ''));
});

function getCarDetails(object) {
		$('#display_carname').text(object.brand);
		$('#display_carmodel').text(object.model);
		$('#display_carplate').text(object.plate_no);
		$('#display_mileage').text(object.current_mileage);
		$('#display_carcapacity').text(object.passenger_cap);
}

function getDriverDetails(object) {
		$('#display_drivcarname').text(object.first_name +" "+ object.last_name);
		$('#display_drivid').text(object.driver_no);
		$('#display_drivcontact').text(object.contact_no);
}

//jquery-serialize-object
(function($){
    $.fn.serializeObject = function(){

        var self = this,
            json = {},
            push_counters = {},
            patterns = {
                "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
                "key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
                "push":     /^$/,
                "fixed":    /^\d+$/,
                "named":    /^[a-zA-Z0-9_]+$/
            };


        this.build = function(base, key, value){
            base[key] = value;
            return base;
        };

        this.push_counter = function(key){
            if(push_counters[key] === undefined){
                push_counters[key] = 0;
            }
            return push_counters[key]++;
        };

        $.each($(this).serializeArray(), function(){

            // skip invalid keys
            if(!patterns.validate.test(this.name)){
                return;
            }

            var k,
                keys = this.name.match(patterns.key),
                merge = this.value,
                reverse_key = this.name;

            while((k = keys.pop()) !== undefined){

                // adjust reverse_key
                reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');

                // push
                if(k.match(patterns.push)){
                    merge = self.build([], self.push_counter(reverse_key), merge);
                }

                // fixed
                else if(k.match(patterns.fixed)){
                    merge = self.build([], k, merge);
                }

                // named
                else if(k.match(patterns.named)){
                    merge = self.build({}, k, merge);
                }
            }

            json = $.extend(true, json, merge);
        });

        return json;
    };
})(jQuery);

</script>

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
				/** @type {!HTMLInputElement} */(document.getElementById('pickup')),
				{types: ['geocode']});
autocomplete = new google.maps.places.Autocomplete(
				/** @type {!HTMLInputElement} */(document.getElementById('dropoff')),
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
$validatereservation = Yii::app()->createUrl( "reservation/validatereservation" );
$getCars = Yii::app()->createUrl( "reservation/getselectedcar" );
$ValidateCarSched = Yii::app()->createUrl( "reservation/validatecarsched" );
$ValidateDriverSched = Yii::app()->createUrl( "reservation/validateDriversched" );
$getDrivers = Yii::app()->createUrl( "reservation/getselecteddriver" );
$saveReservation = Yii::app()->createUrl( "reservation/savereservation" );
$viewCarSched = Yii::app()->createUrl( "reservation/viewcarsched" );
$viewDriverSched = Yii::app()->createUrl( "reservation/viewdriversched" );
$filterDriver = Yii::app()->createUrl( "reservation/filterdriver" );
$success = 'success';
$warning = 'warning';
$danger = 'danger';

Yii::app()->clientScript->registerScript('reservation', "

		$(document).on('click', '.car_sched_btn', function(){
			var values = {
              'car_id' : $(this).attr('ref')
            }

            $.ajax({
                url: '{$viewCarSched}',
                type: 'POST',
                data: values,
                dataType: 'JSON',
                success     : function( data ) {
                    var json = ( data );

                    if(json.retVal == '{$success}')
                    {
                       $('#view_car_sched .content').html(json.retView);
                       $('#view_car_sched').modal();
                    }
                    else if(json.retVal == '{$danger}')
                    {
                       alert('error');
                    }
                }
            });
			$('#view_car_sched').modal();
		});


		$(document).on('click', '.driver_sched_btn', function(){
			var values = {
							'driver_id' : $(this).attr('ref')
						}

						$.ajax({
								url: '{$viewDriverSched}',
								type: 'POST',
								data: values,
								dataType: 'JSON',
								success     : function( data ) {
										var json = ( data );

										if(json.retVal == '{$success}')
										{
											 $('#view_driver_sched .content').html(json.retView);
											 $('#view_driver_sched').modal();
										}
										else if(json.retVal == '{$danger}')
										{
											 alert('error');
										}
								}
						});
			$('#view_driver_sched').modal();
		});



		function nexStep() {
			var active = $('.wizard .nav-tabs li.active');
			var success = $('.connecting-line .connecting-success');
			var containerWidth = ($('.connecting-line .connecting-success').width() / $('.connecting-line').width())* 100;
			$('.connecting-line .connecting-success').width(containerWidth + (32 / 100) * 100  + '%');
			active.next().removeClass('disabled');
			nextTab(active);
		}

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

		$(document).on('click', '#car_btn', function(){

					var temp_car_id = $(this).attr('ref');
					$('#Reservation_car_id').val(temp_car_id);

					var carValidation = {
						'car_id' : $(this).attr('ref'),
						'current_date' : $('#startdate').val(),
					}

					var valSched = {
							'current_date' : $('#startdate').val(),
					}

					var values = {
						 'car_id' : $(this).attr('ref'),
					}

					//alert(temp_car_id);

					$.ajax({
							type        : 'POST',
							url         : '{$ValidateCarSched}',
							data        : carValidation,
							cache       : false,
							success     : function( data ) {
									var json = $.parseJSON( data );
									// 1: true
									// 2: false
									// 3: not set
									if(json.retVal === 1)
									{
										//Car Details

										$.ajax({
												type        : 'POST',
												url         : '{$getCars}',
												data        : values,
												cache       : false,
												success     : function( data ) {
														var json = $.parseJSON( data );

														if(json.retVal !== null)
														{
															var car_details = json.retVal;
															getCarDetails(car_details);
														}
												}
										});

										//Driver Filter

										$.ajax({
												type        : 'POST',
												url         : '{$filterDriver}',
												data        : valSched,
												cache       : false,
												success     : function( data ) {
														var json = $.parseJSON( data );

														if(json.retVal == true)
														{
															//alert(json.retMessage);
															$('#step3-content').html(json.retView);
														}
												}
										});


										nexStep();
									}else{
										//alert(json.retVal);
										$('#reserve-error-car-'+json.retId).show(1).delay(2000).hide(1);
										//alert('sorry na reserved na :D');
									}
							}
					});

			});



		$(document).on('click', '#driver_btn', function(){

					var temp_driver_id = $(this).attr('ref');
					$('#Reservation_driver_id').val(temp_driver_id);

					var values = {
						 'driver_id' : $(this).attr('ref'),
					 }

					 $.ajax({
							type        : 'POST',
							url         : '{$getDrivers}',
							data        : values,
							cache       : false,
							success     : function( data ) {
									var json = $.parseJSON( data );

									if(json.retVal !== null)
									{
										var driver_details = json.retVal;
										getDriverDetails(driver_details);
									}
							}
					 });
					 nexStep();

			});

		// Form Validation
		$().ready(function() {
		// validate signup form on keyup and submit
		$('#ReservationForm').validate({
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
			submitHandler: function() {
				nexStep();
			}
			});
		});

		$('#save_reservation').click(function(){
			$.ajax({
					type        : 'POST',
					url         : '{$saveReservation}',
					data        : $('#ReservationForm').serialize(),
					cache       : false,
					success     : function( data ) {
							var json = $.parseJSON( data );

							if(json.retVal == '{$success}')
							{
									$.notify(json.retMessage, json.retVal);
							}
							else if(json.retVal == '{$danger}')
							{
									$.notify(json.retMessage, json.retVal);
							}
					}
			});
		});


");
?>
