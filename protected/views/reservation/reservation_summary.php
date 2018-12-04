<div class="row">
	<div class="col-xl-12">
		&nbsp;
	</div>
</div>
<div class="row">
	<div class="col-md-offset-1 col-md-10">
		<table class="table table-bordered">
		  <thead>
		    <tr class="success">
		      <th colspan="4" class="text-center">Reservation Summary</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <th>Pick-Up Date</th>
		      <td>
		      	<?php echo date("M d, y H:i A", strtotime($vm->reservation->reservation_date_start)); ?>
		      </td>
		    </tr>
		    <tr>
		      <th>Pick-Up Date</th>
		      <td>
		      	<?php echo date("M d, y H:i A", strtotime($vm->reservation->reservation_date_end)); ?>
		      </td>
		    </tr>
		    <tr>
		      <th>Pick-Up Location</th>
		      <td>
		      	<?php echo $vm->reservation->pickup_location; ?>
		      </td>
		    </tr>
		    <tr>
		      <th>Drop-Off Location</th>
		      <td>
		      	<?php echo $vm->reservation->dropoff_location; ?>
		      </td>
		    </tr>
		    <tr>
		      <th>No Of Passengers</th>
		      <td>
		      	<?php echo $vm->reservation->no_passengers; ?> passenger(s)
		      </td>
		    </tr>
		    <tr>
		      <th>Type Of Reservation</th>
		      <td>
		      	<?php echo $vm->reservation->Type->description; ?> passenger(s)
		      </td>
		    </tr>
		    <tr class="success">
		    	<th colspan="4" class="text-center">Car Details</th>
		    </tr>
		    <tr>
		    	<th>Plate No</th>
		    	<td>
		    		<?php echo $vm->reservation->Car->plate_no; ?>
		    	</td>
		    </tr>
		    <tr>
		    	<th>Brand & Model</th>
		    	<td>
		    		<?php echo $vm->reservation->Car->brand . " - " . $vm->reservation->Car->model; ?>
		    	</td>
		    </tr>
		    <tr>
		    	<th>Capacity</th>
		    	<td>
		    		Maximum of <?php echo $vm->reservation->Car->passenger_cap; ?> passenger(s)
		    	</td>
		    </tr>
		    <tr class="success">
		    	<th colspan="4" class="text-center">Driver Details</th>
		    </tr>
		    <tr>
		    	<th>Name</th>
		    	<td>
		    		<?php echo $vm->reservation->Driver->first_name . " " . $vm->reservation->Driver->last_name; ?>
		    	</td>
		    </tr>
		    <tr>
		    	<th>ID No</th>
		    	<td>
		    		<?php echo $vm->reservation->Driver->driver_no; ?>
		    	</td>
		    </tr>
		  </tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-xl-12">
		&nbsp;
	</div>
</div>
<div class="row">
	<div class="col-md-offset-1 col-md-10">
		<button class="btn btn-success btn-block" id="save_reservation_btn">SAVE RESERVATION</button>
	</div>
</div>
<div class="row">
	<div class="col-xl-12">
		&nbsp;
	</div>
</div>