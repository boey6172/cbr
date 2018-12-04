<h2><span class="fa fa-car"></span> <b>Car Reservation</b></h2>
<hr>

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
									<i class="fa fa-exchange fa-lg"></i>
								</span>
							</a>
						</li>

						<li role="presentation" class="disabled">
							<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
								<span class="round-tab">
									<i class="fa fa-calendar-plus-o fa-lg"></i>
								</span>
							</a>
						</li>

						<li role="presentation" class="disabled">
							<a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
								<span class="round-tab">
									<i class="fa fa-car fa-lg"></i>
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
						<?php 
							echo $this->renderPartial('_step_one_form', array(
								'vm' => $vm
							), true)
						?>
					</div>

					<div class="tab-pane" role="tabpanel" id="step2">
						<?php 
							echo $this->renderPartial('_step_two_form', array(
								'vm' => $vm
							), true)
						?>
						<ul class="list-inline pull-left">
								<li><button type="button" class="btn cus_btn btn-primary btn-mp prev-step"><i class="fa fa-chevron-circle-left"></i> <!-- Previous --></button></li>
						</ul>
						<ul class="list-inline pull-right">
								<li><button id="submit_form_btn" type="button" class="btn cus_btn btn-primary btn-mp"><i class="fa fa-chevron-circle-right"></i> <!-- Next --></button></li>
						</ul>
					</div>

					<div class="tab-pane" role="tabpanel" id="step3">
						<br>
						<div class="alert alert-info">
							<b><span class="fa fa-calendar-o"></span>  Available Cars</b>
						</div>
						<div class="row-fluid">
							<div class="list-view">
								<div class="row">
									<div id="step3-content"></div>
								</div>
							</div>
						</div>
						<div style="clear: both;"></div>

						<button type="button" class="btn cus_btn btn-primary btn-mp prev-step pull-left"><i class="fa fa-chevron-circle-left"></i> Back</button>

					</div>

					<div class="tab-pane" role="tabpanel" id="complete">

					<div id="reservation_summary"></div><?php //echo $this->renderPartial('/reservation/summary', array('vm' => $vm,false,true), true) ?>


					<button type="button" class="btn cus_btn btn-primary btn-mp prev-step pull-left"><i class="fa fa-chevron-circle-left"></i> Back</button>

					<button type="button" class="btn cus_btn btn-success btn-mp pull-right" id="save_reservation_btn"><i class="fa fa-check-circle-o"></i> Save</button>
					<!-- <a href="<?php echo Yii::app()->createUrl('reservation/viewreservation'); ?>" type="button" id="save_reservation" class="btn cus_btn btn-success btn-mp pull-right"><i class="fa fa-check-circle-o"></i> Save</a> -->


					</div>

					<div class="clearfix"></div>
			  </div> <!-- end of Tab Content -->
			</div>
		</section>
	</div>
</div>

<!-- MODALS -->

<?php
    echo $this->alenaModal( 'modalLoading', array(
        'title' => "<span class='fa fa-spinner fa-spin fa-lg'></span>&nbsp;<span class='modalTitle'>Searching Cars</span>",
        'body' => $this->renderPartial('_modal_loading', array(
        	'vm' => $vm,
        ), true),
        'footer' =>
        	CHtml::button('Close', array("class" => "btn btn-sm", "data-dismiss"=>"modal"))
        ,
        'style' => '
        	width	: 95%;
        ',
    ));
?>

<?php
    echo $this->alenaModal( 'modalSaving', array(
        'title' => "<span class='fa fa-spinner fa-spin fa-lg'></span>&nbsp;<span class='modalTitle'>Loading</span>",
        'body' => '<h2>Reservation sending, please wait for a while.</h2>',
        'footer' =>
        	CHtml::button('Close', array("class" => "btn btn-sm", "data-dismiss"=>"modal"))
        ,
        'style' => '
        	width	: 95%;
        ',
    ));
?>

<!-- SCRIPTS -->

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

</script>

<!-- ======================== Google Api ========================================= -->


<!-- OLD V2 GOOGLE API -->
<!-- <script type="text/javascript">
	// This example displays an address form, using the autocomplete feature
	// of the Google Places API to help users fill in the information.

	// This example requires the Places library. Include the libraries=places
	// parameter when you first load the API. For example:
	// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

			$('#Reservation_pick_up_location').locationpicker({
                location: {
					
                },
                radius: 300,
                inputBinding: {

                    locationNameInput: $('#Reservation_pick_up_location')
                },
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                    // Uncomment line below to show alert on each Location Changed event
                    //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                }
            });
			
			
			$('#Reservation_drop_off_location').locationpicker({
                location: {

                },
                radius: 300,
                inputBinding: {

                    locationNameInput: $('#Reservation_drop_off_location')
                },
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                    // Uncomment line below to show alert on each Location Changed event
                    //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                }
            });

</script> -->
<!-- NEW GOOGLE API V3 -->
<!--	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABSSsbDOUfnTG2E_M8-6AnOMnAI1wDtU8&libraries=places&callback=initAutocomplete"
        async defer></script> -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhQw7KBR-pws6XVoqooStp7KYRWVf2mwg&libraries=places&callback=initAutocomplete"
        async defer></script>
<script>
	var pick_up_location, drop_off_location;

	function initAutocomplete() {
        pick_up_location = new google.maps.places.Autocomplete(
        	(document.getElementById('Reservation_pick_up_location')));

        drop_off_location = new google.maps.places.Autocomplete(
        	(document.getElementById('Reservation_drop_off_location')));
    }
</script>

<script type="text/javascript">

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
<style>
.errorTxt{
	padding: 20px;
    background-color: #f44336; /* Red */
    color: white;
    margin-bottom: 15px;
	opacity: 1;
    transition: opacity 0.6s;
}
.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}
.closebtn:hover {
    color: black;
}
.borderClass{
  border-color: #C1E0FF;
  border-width:1px;
  border-style: solid;
  /** OR USE INLINE
  border: 1px solid #C1E0FF;
  **/
}
</style>
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCSreAgeZq831QT7_Ael1y0JqLZfLoj0I&callback=initMap"></script> -->

<?php
$validate_reservation = Yii::app()->createUrl( "client/validatereservation" );
$get_car_driver = Yii::app()->createUrl( "client/getcardriver" );
$show_summary = Yii::app()->createUrl( "client/showsummary" );
$save_reservation = Yii::app()->createUrl( "client/savereservation" );
$view_reservation = Yii::app()->createUrl( "client/viewreservation" );
$log_in_page = Yii::app()->createUrl("");
$success = 'success';

Yii::app()->clientScript->registerScript('reservation', "

	function nextStep() {
		var active = $('.wizard .nav-tabs li.active');
		var success = $('.connecting-line .connecting-success');
		var containerWidth = ($('.connecting-line .connecting-success').width() / $('.connecting-line').width())* 100;
		$('.connecting-line .connecting-success').width(containerWidth + (32 / 100) * 100  + '%');
		active.next().removeClass('disabled');
		nextTab(active);
	}

	$(document).on('click', '.rt_btn', function(){
		var rt = $(this).attr('ref');

		if(rt == 1) // PICK-UP
		{
			$('#pick_up_div').show();
			$('#drop_off_div').hide();
			$('#Reservation_drop_off_location').val('');
		}
		else if(rt == 2) // DROP-OFF
		{
			$('#pick_up_div').hide();
			$('#drop_off_div').show();
			$('#Reservation_pick_up_location').val('');
		}
		else if(rt == 3) // PICK-UP AND DROP-OFF
		{
			$('#pick_up_div').show();
			$('#drop_off_div').show();
		}

		$('#Reservation_reservation_type').val(rt);
		nextStep();
	});

	$(document).on('click', '#submit_form_btn', function(){
				$('#reservation_form').submit();
			
	});


	// Form Validation
	$().ready(function() {
	// validate signup form on keyup and submit

	$('#reservation_form').validate({
			success: 'valid',
			debug: true,	
			rules: {
				reservation_date_start: {
						required: true,
						date: true,
						// startDatevalidation: true,
				},
				Reservation_pick_up_location: {
						required: true,
				},
				Reservation_drop_off_location: {
						required: true,
				},
				// Reservation_no_passengers: {
				// 		required: true,
				// },
				Contact_no_main: {
					required: true,
				},	
				// Reservation_passengers2: {
						// required: true,
				// },

		},
		messages: {
			reservation_date_start: {
					required: 'Select Resevation Date',
					date: 'Please enter a valid date.',
			},
			Reservation_pick_up_location: {
					required: 'Please input pickup location',
			},
			Reservation_drop_off_location: {
					required: 'Please input dropoff location',
			},
			// Reservation_no_passengers: {
			// 		required: 'Please input no of passengers',
			// },
			Contact_no_main: {
					required: 'Please input Contact No',
			},
			// Reservation_passengers: {
					// required: 'Please input no of passengers2',
			// },
		},
		submitHandler: function() {
			submitReservation();
		},
		errorElement : 'div',
		errorLabelContainer: '.errorTxt'
		});
	});
var passcount =0;
var pass_array= [];
	$(document).on('click', '#add_passenger_btn', function(){
		var pl = '';
		var pn = $('#passenger_name').val().trim();
		// var pc = $('#passenger_contact_no').val().trim();
		$('#Reservation_passengers').removeClass('borderClass');

		// var passcount = 0;
		
		if(pn != '')
		{
			var pd = '<span class=' + pn  +'><input type=text name=pass_item class=passenger_item value=' + pn +'><button type=button ref=' + pn + ' class=remove_passenger_btn>x</button></span>';
			pass_array.push( ' + pn +');

			$('#Reservation_passengers').append(pd);
			$('.passenger_item').addClass('alena-input-label label-success');
			$('.remove_passenger_btn').addClass('btn btn-xs');
			passcount= passcount + 1;
			
			$('#passenger_name').val('');
			//$('#passenger_contact_no').val('');
			// alert(passcount);
		}
	});

	$(document).on('click', '.remove_passenger_btn', function(){
		var pass_ref =  $(this).attr('ref');
		var pass_class = '.' + pass_ref;
		passcount= passcount - 1;
		// alert(passcount);
		$(pass_class).remove();
	});

	function submitReservation()
	{
		var reservation_date = $('#startdate').val();
		var reservation_pick_up_location = $('#Reservation_pick_up_location').val();
		var reservation_drop_off_location = $('#Reservation_drop_off_location').val();
		var reservation_no_passengers =passcount;
		var passengers = [];
		var reservation_distance = $('#Reservation_distance').val();
		var reservation_type = $('#Reservation_reservation_type').val();
		var passenger_item = $('.passenger_item');
		var estimated_time = $('#Reservation_estimated_time').val();
		var contact_no = $('#Contact_no_main').val();

		var default_location = 'Chinabank, Paseo de Roxas, Makati, NCR, Philippines';

		if(reservation_type == 1)
		{
			reservation_drop_off_location = default_location;
		}
		else if(reservation_type == 2)
		{
			reservation_pick_up_location = default_location;
		}
		
		if(pass_array.length > 0)
		{

			$.each( pass_array, function( key, value ) {
				passengers.push(value);
			});
		}

		d=new Date($.now());
		var month =('0' + (d.getMonth() + 1)).slice(-2);
		var day =('0' + d.getDate()).slice(-2);
		var date = month + day + d.getFullYear();
		
		var hours = d.getHours();
		hours = ('0' + hours).slice(-2)
		var minutes = d.getMinutes();

		minutes = minutes < 10 ? '0'+minutes : minutes;
		var strTime = hours + minutes;

		
		
		date_now = date + strTime;
		var new_date = reservation_date.replace('/', '');
		new_date = new_date.replace(':', '');
		new_date = new_date.replace(' ', '');
		new_date = new_date.replace('/', '');
		
		if(new_date > date_now)
		{
					
			if ($('.passenger_item').length > 0)
			{

					$('.label_from').html(reservation_pick_up_location);
					$('.label_to').html(reservation_drop_off_location);
					$('.label_no_passengers').html(reservation_no_passengers);
			
				
				var directionsService = new google.maps.DirectionsService;

				var waypts = [];
				
				directionsService.route({
				  // origin: document.getElementById('Reservation_pick_up_location').value,
				  // destination: document.getElementById('Reservation_drop_off_location').value,
				  origin: reservation_pick_up_location,
				  destination: reservation_drop_off_location,
				  waypoints: waypts,
				  optimizeWaypoints: true,
				  travelMode: 'DRIVING',
				}, function(response, status) {

					if (status === 'OK')
					{

						var route = response.routes[0];

						for (var i = 0; i < route.legs.length; i++) {

							$('#Reservation_distance').val(route.legs[i].distance.value);
							$('#Reservation_estimated_time').val(route.legs[i].duration.text);

							if($('#Reservation_distance').val() != '')
							{
								$('.label_distance').html(route.legs[i].distance.text);
								$('.label_estimated_time').html(route.legs[i].duration.text);
									distance = route.legs[i].distance.value;
									TimeMins = route.legs[i].duration.value;
								//$('.label_E_fare').html(parseFloat(Math.round(70+(((TimeMins/60) * 2)+((distance/1000) * 7.75))).toFixed(2)));
								//$('#Reservation_estimated_fare').val(parseFloat(Math.round(70+(((TimeMins/60) * 2)+((distance/1000) * 7.75))).toFixed(2)));
								fare = parseFloat(Math.round(70+(((TimeMins/60) * 2)+((distance/1000) * 7.75))).toFixed(2));
								//alert(fare);
								var today = new Date().getHours();
									if ((today >= 7 && today <= 10) || (today >= 17 && today <= 20)) {
									  fare += fare *.3;
									  //alert(fare);
									} 
									$('#Reservation_estimated_fare').val(fare);
								$('.label_E_fare').html(fare);	
								$('#modalLoading').modal('show');

								$.ajax({
									type: 'POST',
									url: '{$validate_reservation}',
									data: {
										'Reservation[reserved_date]':reservation_date,
										'Reservation[pick_up_location]':reservation_pick_up_location,
										'Reservation[drop_off_location]':reservation_drop_off_location,
										'Reservation[no_of_passengers]':passcount,
										'Reservation[passengers]':passengers,
										'Reservation[distance]':route.legs[i].distance.value,
										'Reservation[estimated_time]':route.legs[i].duration.text,
										'Reservation[reservation_type]':reservation_type,
										'Reservation[estimated_fare]':fare,
										'Reservation[contact_no]':contact_no,
									},
									dataType:'json',
									statusCode:{ 
										   403: function() { 
										   		$('#modalLoading').modal('hide');
										   		window.location =  '{$log_in_page}';
										   },
										   200: function(data) {
												var json = data;

												if(json.retVal == '{$success}')
												{
													// $('#modalLoading').modal('hide');
													setTimeout(function() { 
													$('#modalLoading').modal('hide');

													}, 3300);
													
													
													
													$('#step3-content').html(json.retMessage);
													nextStep();
												}
												else
												{
													alert();
												}
								   			}

									}
								})
							}
						}
					}
					else
					{
						$('.errorTxt .change').text('Type your destination, then Select your preferred destination');
						$('.errorTxt').show();
						$('#Reservation_passengers').addClass('borderClass');
					}

				});
			}	
			else
			{
				$('.errorTxt .change').text('Please input Passengers Names');
				$('.errorTxt').show();
				$('#Reservation_passengers').addClass('borderClass');
				$(window).scrollTop(0);
			}
		}
		else
		{
				$('.errorTxt .change').text('Invalid Reservation date.');
				$('.errorTxt').show();
				$('#Reservation_passengers').addClass('borderClass');
				$(window).scrollTop(0);
		}
	}

	$(document).on('click', '.car_btn', function(){
		var car_ref =  $(this).attr('ref');
		var reservation_date_for_driver = $('#startdate').val();
		var distance = $('#Reservation_distance').val();
		$('#Reservation_car').val(car_ref);
		var element = $(this);

		$.ajax({
			type: 'POST',
			url: '{$get_car_driver}',
			data: {
				'car':car_ref,
				'date':reservation_date_for_driver,
				'distance':distance,
				
			},
			dataType:'json',
			statusCode: {
				403: function(){
					window.location =  '{$log_in_page}';
				},
				200: function(data){
					var json = data;

				    if(json.retVal == '{$success}')
					{
						$('#Reservation_driver').val(json.retMessage);
						showSummary();
					}
					else
					{
						element.notify(json.retMessage,{className: 'error', position: 'top right',});
					}
				}

			}
		})
	});

	function showSummary()
	{
		var reservation_date = $('#startdate').val();
		var reservation_pick_up_location = $('#Reservation_pick_up_location').val();
		var reservation_drop_off_location = $('#Reservation_drop_off_location').val();
		var reservation_no_passengers = passcount;
		var passengers = [];
		var reservation_distance = $('#Reservation_distance').val();
		var reservation_estimated_time = $('#Reservation_estimated_time').val();
		var reservation_type = $('#Reservation_reservation_type').val();
		var passenger_item = $('.passenger_item');
		var reservation_car = $('#Reservation_car').val();
		var reservation_driver = $('#Reservation_driver').val();
		var reservation_estimated_fare = $('#Reservation_estimated_fare').val();
		var contact_no = $('#Contact_no_main').val();

		var default_location = 'Chinabank, Paseo de Roxas, Makati, NCR, Philippines';

		if(reservation_type == 1)
		{
			reservation_drop_off_location = default_location;
		}
		else if(reservation_type == 2)
		{
			reservation_pick_up_location = default_location;
		}

		if(passenger_item.length > 0)
		{
			$('.passenger_item').each(function() {
			    passengers.push($(this).val());
			});
		}

		$.ajax({
			type: 'POST',
			url: '{$show_summary}',
			data: {
				'Reservation[reserved_date]':reservation_date,
				'Reservation[pick_up_location]':reservation_pick_up_location,
				'Reservation[drop_off_location]':reservation_drop_off_location,
				'Reservation[no_of_passengers]':passcount,
				'Reservation[passengers]':passengers,
				'Reservation[distance]':reservation_distance,
				'Reservation[estimated_time]':reservation_estimated_time,
				'Reservation[reservation_type]':reservation_type,
				'Reservation[car]':reservation_car,
				'Reservation[driver]':reservation_driver,
				'Reservation[estimated_fare]':reservation_estimated_fare,
				'Reservation[contact_no]':contact_no,
			},
			dataType:'json',
			statusCode: {
				   403: function() { 
						window.location =  '{$log_in_page}';
				   },
				   200: function(data) {
						var json = data;

					    if(json.retVal == '{$success}')
						{
							$('#reservation_summary').html(json.retMessage);
							nextStep();
						}
						else
						{
						// $.notify(json.retMessage, json.retMessage);
						$.notify(json.retMessage, json.retMessage,'warn',{ position:'middle'});
						
						}
				   }
			    
			}
		})
	}

	$(document).on('click', '#save_reservation_btn', function(){
		saveReservation();
	});

	function saveReservation()
	{
		var reservation_date = $('#startdate').val();
		var reservation_pick_up_location = $('#Reservation_pick_up_location').val();
		var reservation_drop_off_location = $('#Reservation_drop_off_location').val();
		var reservation_no_passengers = passcount;
		var passengers = [];
		var reservation_distance = $('#Reservation_distance').val();
		var reservation_type = $('#Reservation_reservation_type').val();
		var passenger_item = $('.passenger_item');
		var reservation_car = $('#Reservation_car').val();
		var reservation_driver = $('#Reservation_driver').val();
		var reservation_estimated_fare = $('#Reservation_estimated_fare').val();
		var contact_no = $('#Contact_no_main').val();

		var default_location = 'Chinabank, Paseo de Roxas, Makati, NCR, Philippines';

		if(reservation_type == 1)
		{
			reservation_drop_off_location = default_location;
		}
		else if(reservation_type == 2)
		{
			reservation_pick_up_location = default_location;
		}

		if(passenger_item.length > 0)
		{
			$('.passenger_item').each(function() {
			    passengers.push($(this).val());
			});
		}

		//Modal Loading
		// $('#modalSaving').modal('show');

		$.ajax({
			type: 'POST',
			url: '{$save_reservation}',
			data: {
				'Reservation[reserved_date]':reservation_date,
				'Reservation[pick_up_location]':reservation_pick_up_location,
				'Reservation[drop_off_location]':reservation_drop_off_location,
				'Reservation[no_of_passengers]':passcount,
				'Reservation[passengers]':passengers,
				'Reservation[distance]':reservation_distance,
				'Reservation[reservation_type]':reservation_type,
				'Reservation[car]':reservation_car,
				'Reservation[driver]':reservation_driver,
				'Reservation[estimated_fare]':reservation_estimated_fare,
				'Reservation[contact_no]':contact_no,
			},
			dataType:'json',
			statusCode: {
			       403: function() { 
			       		window.location =  '{$log_in_page}';
				   },
				   200: function(data) {
						var json = data;

					    if(json.retVal == '{$success}')
						{
							$('#Reservation_reservation_no').val(json.retMessage);
							
							window.location =  '{$view_reservation}&id=' + $('#Reservation_reservation_no').val();
						}
						else
						{
							// $('#modalSaving').modal('hide');
							// $.notify(json.retMessage, json.retMessage);
							$.notify(json.retMessage, json.retMessage,'warn',{ position:'middle'});
						}
				   }
			}
		})
	}

");

?>