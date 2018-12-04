<div class="item  col-sm-6 col-md-2">
  <div class="card">
    <div class="card-image">
      <button ref=<?php echo $data->id; ?> class="btn cus_btn btn_driver_status <?php echo ($data->driver_status == 1) ? 'btn-success' : 'btn-danger' ?>" style="position:absolute; right:0; z-index:10;"><i class="fa fa-circle-o"></i> <?php echo ($data->driver_status == 1) ? 'ACTIVE' : 'IN ACTIVE' ?></button>
      <span>
        <img class="card-background" src="images/card-bg.png">
        <img class="driver-profile" src="<?php echo $data->picture; ?>">
      </span>
    </div>
    <div class="card-content">
      <label class="title-detail"><?php echo $data->full_name ?></span></label>
      <span>
        <ul class="card-details">
          <li><i class="fa fa-angle-right"></i> Rate : ★★★★ (6.0)</li>
          <li><i class="fa fa-angle-right"></i> Contact   :<?php echo $data->contact_no; ?> </li>
        </ul>
        <br>
        <br>
        <button type="button" class="btn btn-primary cus_btn btn_driver_edit" ref=<?php echo $data->id; ?> style="float:right !important; position:relative; bottom:32px;" name="button"><span class="fa fa-edit fa-1x text-center"></span></button>
      </span>
    </div>
  </div>
</div>