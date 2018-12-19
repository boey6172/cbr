<?php if (count($vm->cars) <= 0): ?>

<div class="alert alert-warning">
  <span class="fa fa-exclamation-triangle"></span> No available cars found.
</div>

<?php endif; ?>

<?php if (count($vm->cars) > 0): ?>
<?php foreach($vm->cars as $data): ?>

<div class="item  col-sm-6 col-md-5">
  <div class="card">
    <span style="color: #E53935;"></span>
    <div class="card-image">
      <!-- <button ref=<?php echo $data->car_id; ?> class="btn cus_btn btn-primary car_sched_btn" style="position:absolute; right:0; z-index:10;"><i class="fa fa-calendar"></i></button> -->
      <a href="#"><img class="card-background" height="130" width="200" src=<?php echo ($data->picture != '') ? $data->picture : "./images/car.jpg"; ?> ></a>
    </div>
    <div class="card-content">
      <label class="title-detail"><?php echo $data->plate_no ?></span></label>

      <span>
        <ul class="card-details">
          <li><i class="fa fa-angle-right"></i> Car Model: <span><?php echo $data->car_model ?></span></li>
          <li><i class="fa fa-angle-right"></i> Capacity    : <span><?php echo $data->passenger_capacity ?></span></li>
          <!--<li><i class="fa fa-angle-right"></i> Max Distance : <span><?php echo $data->distance_capacity ?> km</span></li>-->
        </ul>
      </br>
      <div style="float:right !important; position:relative; bottom:32px;">
         <button type="button" class="btn cus_btn btn-primary car_btn" ref=<?php echo $data->car_id; ?> style="" name="button">Choose</button>
      </div>
    </div>
  </div>
</div>


<?php endforeach; ?>

<?php endif; ?>