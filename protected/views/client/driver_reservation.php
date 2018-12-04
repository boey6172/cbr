<h2><span class="fa fa-user-circle-o"></span> <b>Driver Reservation</b></h2>
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
						<?php 
							echo $this->renderPartial('_step_one_form', array(
								'vm' => $vm
							), true)
						?>
					</div>

					<div class="tab-pane" role="tabpanel" id="step2">
						<?php 
							echo $this->renderPartial('_step_two_driver_form', array(
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
        'title' => "<span class='fa fa-spinner fa-spin fa-lg'></span>&nbsp;<span class='modalTitle'>Searching Drivers</span>",
        'body' => $this->renderPartial('_modal_driver_loading', array(
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

<script type="text/javascript">
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

<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCSreAgeZq831QT7_Ael1y0JqLZfLoj0I&callback=initMap"></script> -->

<?php
$validate_driver_reservation = Yii::app()->createUrl( "client/validatedriverreservation" );
$get_car_driver = Yii::app()->createUrl( "client/getcardriver" );
$show_driver_reservation_summary = Yii::app()->createUrl( "client/showdriverreservationsummary" );
$save_driver_reservation = Yii::app()->createUrl( "client/savedriverreservation" );
$view_reservation = Yii::app()->createUrl( "client/viewreservation" );
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
			debug: true,
			success: 'valid',
			rules: {
				reservation_date_start: {
						required: true,
						// startDatevalidation: true,
				},
				Reservation_pick_up_location: {
						required: true,
				},
				Reservation_drop_off_location: {
						required: true,
				},
		},
		messages: {
			reservation_date_start: {
					required: 'Please select resevation date',
			},
			Reservation_pick_up_location: {
					required: 'Please input pickup location',
			},
			Reservation_drop_off_location: {
					required: 'Please input dropoff location',
			},
		},
		submitHandler: function() {
			submitReservation();
		}
		});
	});

	function submitReservation()
	{
		var reservation_date = $('#startdate').val();
		var reservation_pick_up_location = $('#Reservation_pick_up_location').val();
		var reservation_drop_off_location = $('#Reservation_drop_off_location').val();
		var reservation_distance = $('#Reservation_distance').val();
		var reservation_type = $('#Reservation_reservation_type').val();
		var estimated_time = $('#Reservation_estimated_time').val();

		var default_location = 'Chinabank, Paseo de Roxas, Makati, NCR, Philippines';

		if(reservation_type == 1)
		{
			reservation_drop_off_location = default_location;
		}
		else if(reservation_type == 2)
		{
			reservation_pick_up_location = default_location;
		}

		$('.label_from').html(reservation_pick_up_location);
		$('.label_to').html(reservation_drop_off_location);

		var directionsService = new google.maps.DirectionsService;

		var waypts = [];

		directionsService.route({
          // origin: document.getElementById('Reservation_pick_up_location').value,
          // destination: document.getElementById('Reservation_drop_off_location').value,
		  origin: reservation_pick_up_location,
          destination: reservation_drop_off_location,
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
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
						$('#modalLoading').modal('show');

						$.ajax({
							type: 'POST',
							url: '{$validate_driver_reservation}',
							data: {
								'Reservation[reserved_date]':reservation_date,
								'Reservation[pick_up_location]':reservation_pick_up_location,
								'Reservation[drop_off_location]':reservation_drop_off_location,
								'Reservation[distance]':route.legs[i].distance.value,
								'Reservation[estimated_time]':route.legs[i].duration.text,
								'Reservation[reservation_type]':reservation_type
							},
							dataType:'json',
							success: function(data){
							    var json = data;

							    if(json.retVal == '{$success}')
								{
									$('#step3-content').html(json.retMessage);
									nextStep();
								}
							}
						})
					}
				}
			}
			else
			{
				$('.label_distance').html('Cannot calculate distance, please input nearest location');
				$('#modalLoading').modal('show');
			}

        });
		
	}

	$(document).on('click', '.driver_btn', function(){
		var driver_ref =  $(this).attr('ref');

		$('#Reservation_driver').val(driver_ref);
		showDriverReservationSummary();
	});

	function showDriverReservationSummary()
	{
		var reservation_date = $('#startdate').val();
		var reservation_pick_up_location = $('#Reservation_pick_up_location').val();
		var reservation_drop_off_location = $('#Reservation_drop_off_location').val();
		var reservation_distance = $('#Reservation_distance').val();
		var reservation_estimated_time = $('#Reservation_estimated_time').val();
		var reservation_type = $('#Reservation_reservation_type').val();
		var reservation_driver = $('#Reservation_driver').val();

		var default_location = 'Chinabank, Paseo de Roxas, Makati, NCR, Philippines';

		if(reservation_type == 1)
		{
			reservation_drop_off_location = default_location;
		}
		else if(reservation_type == 2)
		{
			reservation_pick_up_location = default_location;
		}

		$.ajax({
			type: 'POST',
			url: '{$show_driver_reservation_summary}',
			data: {
				'Reservation[reserved_date]':reservation_date,
				'Reservation[pick_up_location]':reservation_pick_up_location,
				'Reservation[drop_off_location]':reservation_drop_off_location,
				'Reservation[distance]':reservation_distance,
				'Reservation[estimated_time]':reservation_estimated_time,
				'Reservation[reservation_type]':reservation_type,
				'Reservation[driver]':reservation_driver,
			},
			dataType:'json',
			success: function(data){
			    var json = data;

			    if(json.retVal == '{$success}')
				{
					$('#reservation_summary').html(json.retMessage);
					nextStep();
				}
			}
		})
	}

	$(document).on('click', '#save_reservation_btn', function(){
		saveDriverReservation();
	});

	function saveDriverReservation()
	{
		var reservation_date = $('#startdate').val();
		var reservation_pick_up_location = $('#Reservation_pick_up_location').val();
		var reservation_drop_off_location = $('#Reservation_drop_off_location').val();
		var reservation_distance = $('#Reservation_distance').val();
		var reservation_type = $('#Reservation_reservation_type').val();
		var passenger_item = $('.passenger_item');
		var reservation_driver = $('#Reservation_driver').val();

		var default_location = 'Chinabank, Paseo de Roxas, Makati, NCR, Philippines';

		if(reservation_type == 1)
		{
			reservation_drop_off_location = default_location;
		}
		else if(reservation_type == 2)
		{
			reservation_pick_up_location = default_location;
		}

		$.ajax({
			type: 'POST',
			url: '{$save_driver_reservation}',
			data: {
				'Reservation[reserved_date]':reservation_date,
				'Reservation[pick_up_location]':reservation_pick_up_location,
				'Reservation[drop_off_location]':reservation_drop_off_location,
				'Reservation[distance]':reservation_distance,
				'Reservation[reservation_type]':reservation_type,
				'Reservation[driver]':reservation_driver,
			},
			dataType:'json',
			success: function(data){
			    var json = data;

			    if(json.retVal == '{$success}')
				{
					$('#Reservation_reservation_no').val(json.retMessage);
					
					window.location =  '{$view_reservation}&id=' + $('#Reservation_reservation_no').val();
				}
			}
		})
	}

");

?>