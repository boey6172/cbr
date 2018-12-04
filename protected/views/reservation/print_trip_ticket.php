<div class="trip_ticket">
	<div class="row">
		<div class="col-md-3 pull-right">
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
		</div>
		<br/>
	</div>
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<table class="table table-bordered">
			  <tbody>
			  	<tr class="success">
			    	<th colspan="4" class="text-center">Trip Ticket Details</th>
			    </tr>
			    <th>Client</th>
			  		<td>
			  			<?php echo $vm->reservation->User->first_name . " " . $vm->reservation->User->surname; ?>
			  		</td>
			    <tr>
			    <th>Date Reserved</th>
			  		<td>
			  			<?php echo date("M d, y H:i A", strtotime($vm->reservation->saved_date)); ?>
			  		</td>
			    <tr>
			  	<tr class="success">
			    	<th colspan="4" class="text-center">Reservation Summary</th>
			    </tr>
			      <th>Pick-Up Date</th>
			      <td>
			      	<?php echo date("M d, y H:i A", strtotime($vm->reservation->reserved_date)); ?>
			      </td>
			    </tr>
			 <!-- <tr>
			   //   <th>Pick-Up Date</th>
			   //   <td>
			  //    	<?php echo date("M d, y H:i A", strtotime($vm->reservation->hq_arrival_date)); ?>
			  //    </td>
			   // </tr>
			    <tr>-->
			      <th>Pick-Up Location</th>
			      <td>
			      	<?php echo $vm->reservation->pick_up_location; ?>
			      </td>
			    </tr>
			    <tr>
			      <th>Drop-Off Location</th>
			      <td>
			      	<?php echo $vm->reservation->drop_off_location; ?>
			      </td>
			    </tr>
			    <tr>
			      <th>No Of Passengers</th>
			      <td>
			      	<?php echo $vm->reservation->no_of_passengers; ?> passenger(s)
			      </td>
			    </tr>
			    <tr>
			      <th>Type Of Reservation</th>
			      <td>
			      	<?php echo $vm->reservation->ReservationType->description; ?> passenger(s)
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
			    		<?php echo $vm->reservation->Car->car_brand . " - " . $vm->reservation->Car->car_model; ?>
			    	</td>
			    </tr>
			    <tr>
			    	<th>Capacity</th>
			    	<td>
			    		Maximum of <?php echo $vm->reservation->Car->passenger_capacity; ?> passenger(s)
			    	</td>
			    </tr>
			    <tr class="success">
			    	<th colspan="4" class="text-center">Driver Details</th>
			    </tr>
			    <tr>
			    	<th>Name</th>
			    	<td>
			    		<?php echo $vm->reservation->Driver->full_name; ?>
			    	</td>
			    </tr>
			    <tr>
			    	<th>Contact No</th>
			    	<td>
			    		<?php echo $vm->reservation->Driver->contact_no; ?>
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
</div>


<script type="text/javascript">
  window.onload = function(){
    window.print();
  }
</script>
