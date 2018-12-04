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
			<b>LOCATION : </b> <?php echo $vm->reservation->pick_up_location; ?> - <?php echo $vm->reservation->drop_off_location; ?>
		</td>
	</tr>
	<tr>
		<td>
			<b>DISTANCE : </b> <?php echo ($vm->reservation->distance / 1000); ?> km
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