<div class="item  col-sm-6 col-md-4">
  <div class="card">
    <span style="color: #E53935;"></span>
    <div class="card-image">
      <!-- <img class="card-background" src="<?php //echo $data->Car->picture; ?>"> -->
		
		<div class="well text-right">
				<?php
					// $optionsArray = array(
					// 	'itemId'=> "barcode-div",
					// 	'barcode'=> $data->reservation_no,
						
					// 		// supported types
					// 		// ean8, ean13, upc, std25, int25,
					// 		// code11, code39, code93, code128,
					// 		// codabar, msi, datamatrix
						
					// );
					// echo Common::getItemBarcode( $optionsArray );
				?>
				<b>Date : </b><?php echo date('M d, Y h:i A', strtotime($data->saved_date)); ?>
      	</div>
    </div>
    <div class="card-content">
      <!-- <label class="title-detail">
      	TITLE
      </label> -->

      <span>
        <ul class="card-details">
          <li><i class="fa fa-angle-right"></i> <b>RESERVATION NO</b> : <span><?php echo $data->reservation_no ?></span></li>
          <li><i class="fa fa-angle-right"></i> <b>RESERVATION DATE</b> : <span><?php echo date('M d, Y h:i A', strtotime($data->reserved_date)); ?></span></li>
          <li><i class="fa fa-angle-right"></i> <b>STATUS</b> : <span>
		  <?php echo ( $data->reservation_status == 0) ? ($data->user_cancelled == 0) ? "ADMIN " : "USER " : "" ;?>
		  <?php echo $data->ReservationStatus->description ?></span></li>
          <li><i class="fa fa-angle-right"></i> <b>LOCATION</b>: <span><?php echo $data->pick_up_location . ' <b>TO</b> ' . $data->drop_off_location ?></span></li>
        </ul>
      </br>
      <div style="float:right !important; position:relative; bottom:32px;">
         <a href="<?php echo  Yii::app()->createUrl( "client/viewreservation&id=" ) . $data->reservation_no ?>" class="btn cus_btn btn-primary car_btn">View Details <span class="fa fa-arrow-circle-o-right fa-lg"></span></a>
      </div>
    </div>
  </div>
</div>