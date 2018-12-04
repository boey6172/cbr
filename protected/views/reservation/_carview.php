<div class="item  col-sm-6 col-md-4">
  <div class="card">
    <span style="color: #E53935;"></span>
    <div class="card-image">
      <button ref=<?php echo $data->cars_id; ?> class="btn cus_btn btn-primary car_sched_btn" style="position:absolute; right:0; z-index:10;"><i class="fa fa-calendar"></i></button>
      <a href="#"><img class="card-background" src="<?php echo $data->car_img; ?>"></a>
    </div>
    <div class="card-content">
      <label class="title-detail"><?php echo $data->brand ?></span></label>
      <span id="reserve-error-car-<?php echo $data->cars_id; ?>" style="float:right; font-size: 1.1em; color:white; background:#E53935; padding:5px; display:none;">Already Reserve <i class="fa fa-exclamation-circle"></i></span>
      <span>
        <ul class="card-details">
          <li><i class="fa fa-angle-right"></i> Car Model: <span><?php echo $data->model ?></span></li>
          <li><i class="fa fa-angle-right"></i> Current Milleage : <span><?php echo $data->current_mileage ?></span></li>
          <li><i class="fa fa-angle-right"></i> Color    : <span>Blue</span></li>
        </ul>
      </br>
      <div style="float:right !important; position:relative; bottom:32px;">
         <button type="button" class="btn cus_btn btn-primary" id="car_btn" ref=<?php echo $data->cars_id; ?> style="" name="button">Choose</button>
      </div>
    </div>
  </div>
</div>
