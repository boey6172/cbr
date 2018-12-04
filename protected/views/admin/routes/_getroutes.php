<h2><span class="fa fa-map text-success"></span> <b>Map - Finder</b></h2>
<hr>

    <script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyABSSsbDOUfnTG2E_M8-6AnOMnAI1wDtU8&libraries=places'></script>

<hr>
<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'map_search_form',
		'type' => 'vertical',
	)
);
?>
<!-- MAP HERE -->
<div class="row">
		<td width="80px">
		<?php
			echo $form->hiddenField($vm->reservation, 'reservation_no', array(
				// 'widgetOptions' => array(
					// 'htmlOptions' => array(
						// 'autocomplete' => 'off',
					// )
				// )
			));
		?>
		
			<button type="button" class="btn btn-primary btn-md search_map_btn"></li> Track Driver</button>
		</td>
	<div class="col-md-8" id="right-panel">
	    <div class="clearfix"></div>
	    <div id="us3" style="width: 100%; height: 700px;"></div>
	    <div class="clearfix">&nbsp;</div>
	</div>
	<!--<div class="col-md-4">
		<table class="table table-bordered table-condensed table-inverse">
		  <thead class="thead-inverse">
		    <tr>
		      <th>#</th>
		      <th width="40%">IN</th>
		      <th width="40%">OUT</th>
		      <th>OPTIONS</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <th scope="row">1</th>
		      <td class="bg-success">6:00 AM</td>
		      <td class="bg-danger">9:00 AM</td>
		      <td>
		      	<button class="btn btn-primary btn-sm"><i class="fa fa-map"></i> View</button>
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">2</th>
		      <td class="bg-success">10:00 AM</td>
		      <td class="bg-danger">01:00 PM</td>
		      <td></td>
		    </tr>
		    <tr>
		      <th scope="row">3</th>
		      <td class="bg-success">3:00 PM</td>
		      <td class="bg-danger">6:00 PM</td>
		      <td></td>
		    </tr>
		  </tbody>
		</table>
	</div>-->
</div>
<?php $this->endWidget(); ?>
<script>

// $('#us3').locationpicker({
//     location: {
//         latitude: 46.15242437752303,
//         longitude: 2.7470703125
//     },
//     radius: 300,
//     inputBinding: {
//         latitudeInput: $('#us3-lat'),
//         longitudeInput: $('#us3-lon'),
//         radiusInput: $('#us3-radius'),
//         locationNameInput: $('#us3-address')
//     },
//     enableAutocomplete: true,
//     onchanged: function (currentLocation, radius, isMarkerDropped) {
//         // Uncomment line below to show alert on each Location Changed event
//         //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
//     }
// });

// initMap();

// function initMap() {
//         var directionsService = new google.maps.DirectionsService;
//         var directionsDisplay = new google.maps.DirectionsRenderer;
//         var map = new google.maps.Map(document.getElementById('us3'), {
//           zoom: 9,
//           center: {lat: 14.599512, lng: 120.984222} // Vicente Madrigal
//     });

//     directionsDisplay.setMap(map);

//     // calculateAndDisplayRoute(directionsService, directionsDisplay);
// }


// function calculateAndDisplayRoute(directionsService, directionsDisplay) {
// 	var waypts = [];
// 	var checkboxArray = document.getElementById('waypoints');
// 	var text = document.getElementById('text_waypoint');
// 	var matchesCount = text.value.toString().split("/").length - 1;
// 	var yehey = text.value.toString().split("/", matchesCount);
// 	var array = JSON.parse("[" + yehey + "]");
// 	// alert( yehey);alert( matchesCount);alert( array.length);
// 	for (var i = 0; i <= array.length -1; i++) {
// 	   	  // var slice[i] = text.value.toString().slice(0, text.value.toString().indexOf("/"));
		  
// 		var text = array[i] + ","+ array[i+1]
// 		i++;
// 		  // alert(text);
		  
// 		waypts.push({
// 	      location:text,
// 	      stopover: true
// 	    });  
// 	}

// 	directionsService.route({
// 	  origin: document.getElementById('Reservation_pick_up_location').value,
// 	  destination: document.getElementById('Reservation_drop_off_location').value,
// 	  waypoints: waypts,
// 	  optimizeWaypoints: true,
// 	  travelMode: 'DRIVING'
// 	}, function(response, status) {
// 	  if (status === 'OK') {
// 	    directionsDisplay.setDirections(response);
// 	    var route = response.routes[0];
// 	    var summaryPanel = document.getElementById('directions-panel');
// 	    summaryPanel.innerHTML = '';
// 	    // For each route, display summary information.
// 	    for (var i = 0; i < route.legs.length; i++) {
// 	      var routeSegment = i + 1;
// 	      summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
// 	          '</b><br>';
// 	      summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
// 	      summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
// 	      summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
// 	    }
// 	  } else {
// 	    window.alert('Directions request failed due to ' + status);
// 	  }
// 	});
// }
</script>
<?php
	$getLogs = Yii::app()->createUrl( "admin/finddriver" );

   Yii::app()->clientScript->registerScript('mapScripts', "

	

	$(document).on('click', '.search_map_btn', function(){
    	getLogs();
    });

    $(document).ready(function(){
		// initMap();
		//	getLogs();
    });

    function custom_sort(a, b) {
	    return new Date(a.log_time).getTime() - new Date(b.log_time).getTime();
	}

   	function getLogs()
   	{
   		$.ajax({
	        type        : 'POST',
	        url         : '{$getLogs}',
	        data        : $('#map_search_form').serialize(),
	        cache       : false,
	        success     : function( data ) {
				
	            var json =  $.parseJSON(data);

				var logs = [];
				json.sort(custom_sort);

				for(var x in json){
				  logs.push(json[x]);
				}

				// console.log(logs);

				initMap(logs); //logs passed
	        }
	    })

		// initMap(logs);
   	}

// ========================== MAPS FUNCTIONS ==========================

	var map = new google.maps.Map(document.getElementById('us3'), {
          zoom: 20,
          center: {lat: 14.557939, lng: 121.019608} // Vicente Madrigal
    	});
    	
    	var marker = [];

   	function initMap(logs) {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
		directionsDisplay.setMap(map);

		calculateAndDisplayRoute(directionsService, directionsDisplay, logs);

	}

	function calculateAndDisplayRoute(directionsService, directionsDisplay, logs) {

		var waypts = [];

		var start = logs[0];
		var finish = logs.slice(-1).pop();

		/*Attendance log not needed*/
		// logs.splice(0, 1);
		// logs.pop();
		
		//clear markers first
		clearMarkers();
		
		var i;

		for (i = 0; i < logs.length; i++) {  
		   marker = new google.maps.Marker({
		     position: new google.maps.LatLng(logs[i].latitude, logs[i].longitude),
		     map: map
		   });
		   console.log(logs[i].latitude + ' - ' + logs[i].longitude);
		}
		
		
		
		//for(var x in logs){
		//  waypts.push({
		//  	location:new google.maps.LatLng(logs[x].latitude, logs[x].longitude),
		//  	stopover: true,
		//  });
		//}

		directionsService.route({
			origin: new google.maps.LatLng(start.latitude,start.longitude),
			destination: new google.maps.LatLng(finish.latitude,finish.longitude),
			waypoints: waypts,
			travelMode: 'WALKING' // DRIVING OR WALKING
		}, function(response, status){
			if(status == 'OK')
			{
				//directionsDisplay.setDirections(response);
				var route = response.routes[0];
			}
			else 
			{
	        	window.alert('Directions request failed due to ' + status);
	        }
		});
		
		
	}
	
	function clearMarkers() {
		for (var i = 0; i < marker.length; i++) {
          		marker[i].setMap(null);
        	}
        	
        	marker = [];
	}

   ");
?>