<table class="table table-bordered table-condensed">
	<tr>
		<th class="text-center">
			RESERVATION SUMMARY
		</th>
	</tr>
	<tr>
		<th class="text-center">
			TYPE : 
			<?php
				if($vm->reservation->reservation_type = '1')
				{
					echo 'PICK-UP';
				}
				elseif($vm->reservation->reservation_type = '2')
				{
					echo 'DROP-OFF';
				}
				elseif($vm->reservation->reservation_type = '3')
				{
					echo 'PICK-UP AND DROP-OFF';
				}
			?>
		</th>
	</tr>
	<tr>
		<td>
			<b>RESERVATION DATE :</b> <?php echo $vm->reservation->reserved_date; ?>
		</td>
	</tr>
	<tr>
		<td>
			<b>LOCATION : </b> <br> </b><b>FROM:</b> <br> <?php echo $vm->reservation->pick_up_location; ?> - <br> <b>TO:</b> <br> <?php echo $vm->reservation->drop_off_location; ?>
		</td>
	</tr>
	<tr>
		<td>
			<b>DISTANCE : </b> <?php echo ($vm->reservation->distance / 1000); ?> km
		</td>
	</tr>
	<tr>
		<td>
			<b>ESTIMATED TRAVEL TIME : </b> <?php echo ($vm->reservation->estimated_time); ?>
		</td>
	</tr>
	<tr>
		<td>
			<b>NO OF PASSENGERS : </b> <?php echo $vm->reservation->no_of_passengers; ?>
		</td>
	</tr>
	<tr>
		<td>
			<b>PASSENGERS : </b> 
			<?php
			// try{
				// if (isset($vm->reservation->passengers))
				// {
					// return true;
				// }
				// else
				// {
					// return false;
				// }
				foreach($vm->reservation->passengers as $passenger)
				{
					echo '<br>' . $passenger; 
				}
			// }
			// catch(Exception $e)
			// {
				// echo 'Caught exception: ',  $e->getMessage(), "\n";
				// echo '<br> No Indicated Passengers '; 
			// }
			?>
		</td>
	</tr>
	<tr>
		<td>
			<b>ESTIMATED FARE : </b> <?php echo $vm->reservation->estimated_fare; ?>
		</td>
	</tr>
	<tr>
		<th class="text-center">
			CAR DETAILS
		</th>
	</tr>
	<tr>
		<td>
			<b>PLATE NO : </b> <?php echo $vm->car->plate_no; ?>
		</td>
	</tr>
	<tr>
		<td>
			<b>CAR MODEL : </b> <?php echo $vm->car->car_model; ?>
		</td>
	</tr>
	<tr>
		<th class="text-center">
			DRIVER DETAILS
		</th>
	</tr>
	<tr>
		<td>
			<b>NAME : </b> <?php echo $vm->driver->full_name; ?>
		</td>
	</tr>
	<tr>
		<td>
			<b>CONTACT NO : </b> <?php echo $vm->driver->contact_no; ?>
		</td>
	</tr>
</table>