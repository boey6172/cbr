<div class="item  col-sm-6 col-md-4">
  <div class="card">
    <div class="card-image">
      <img class="card-background" src="<?php echo (isset($data->car_img) && $data->car_img != '') ? $data->car_img : "./images/car.jpg"; ?>">
    </div>
    <div class="card-content">
      <label class="title-detail"><?php echo $data->brand; ?></span></label>
      <span>
        <ul class="card-details">
          <li><i class="fa fa-angle-right"></i> Plate No : <span><?php echo $data->plate_no; ?></span></li>
          <li><i class="fa fa-angle-right"></i> Car Model: <span><?php echo $data->model; ?></li>
          <li><i class="fa fa-angle-right"></i> Capacity    : <span><?php echo $data->passenger_cap; ?></span></li>
        </ul>
        <button type="button" ref="<?php echo $data->cars_id; ?>" class="viewCarBtn btn btn-primary next-step" style="float:right !important; position:relative; bottom:32px;" name="button">Options</button>
      </span>
    </div>
  </div>
</div>
