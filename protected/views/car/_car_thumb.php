<div class="item  col-sm-3 col-md-4">
  <div class="card">
    <span style="color: #E53935;"></span>
    <div class="card-image">
      <a href="#"><img class="card-background" height="130" width="200" src=<?php echo ($data->picture != '') ? $data->picture : "./images/car.jpg"; ?> ></a>
    </div>
    <div class="card-content">
      <label class="title-detail"><?php echo $data->plate_no ?></span></label>

      <span>
        <ul class="card-details">
          <li><i class="fa fa-angle-right"></i> Car Model: <br>&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $data->car_model ?></span></li>
          <li><i class="fa fa-angle-right"></i> Capacity    : <span><?php echo $data->passenger_capacity ?></span></li>
          <li><i class="fa fa-angle-right"></i> Max Distance : <span><?php echo $data->distance_capacity ?> km</span></li>

        </ul>
      </br>
      <div style="float:right !important; position:relative; bottom:32px;">
         <button type="button" class="btn cus_btn btn-primary btn_car_edit" ref=<?php echo $data->car_id; ?> style="" name="button"><span class="fa fa-edit"></span></button>
      </div>
    </div>
  </div>
</div>