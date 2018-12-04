<span class="label label-success">STEP 1</span><br/>
<b>Start Date : </b> <?php echo date("M d, y H:i A", strtotime($reservation->reservation_date_start)); ?><br/>
<b>End Date : </b> <?php echo date("M d, y H:i A", strtotime($reservation->reservation_date_end)); ?><br/>
<b>Pick Up Location : </b><?php echo $reservation->pickup_location; ?><br/>
<b>Drop Off Location : </b><?php echo $reservation->dropoff_location; ?><br/>
<b>Passengers : </b><?php echo $reservation->no_passengers; ?><br/>
<b>Type : </b><?php echo $reservation->Type->description; ?><br/>