<?php if (!empty($vm)): ?>
<?php foreach($vm as $data): ?>

  <div class="item  col-sm-6 col-md-4">
    <div class="card">
      <div class="card-image">
        <span id="reserve-error-driver-<?php echo $data->driver_id; ?>" style="position:absolute; left:0; color: red; z-index:10; display:none;">Sorry cant reserve <i class="fa fa-exclamation-circle"></i></span>
        <button ref=<?php echo $data->driver_id; ?> class="btn cus_btn btn-primary driver_sched_btn" style="position:absolute; right:0; z-index:10;"><i class="fa fa-calendar"></i></button>
        <span>
          <img class="card-background" src="images/card-bg.png">
          <img class="driver-profile" src="<?php echo $data->driver_img; ?>">
        </span>
      </div>
      <div class="card-content">
        <label class="title-detail">Hello I'm <?php echo $data->first_name ?></span></label>
        <span>
          <ul class="card-details">
           <!-- <li><i class="fa fa-angle-right"></i> Rate : ★★★★ (6.0)</li> -->
          <li><i class="fa fa-angle-right"></i> Rate 

		  </li> 
		   
            <li><i class="fa fa-angle-right"></i> Name: <?php echo $data->first_name . " " . $data->last_name; ?> </li>
            <li><i class="fa fa-angle-right"></i> Driver Id : <?php echo $data->driver_no; ?> </li>
            <li><i class="fa fa-angle-right"></i> Contact   :<?php echo $data->contact_no; ?> </li>
          </ul>
          <br>
          <br>
          <button type="button" class="btn btn-primary cus_btn" id="driver_btn" ref=<?php echo $data->driver_id; ?> style="float:right !important; position:relative; bottom:32px;" name="button">Choose</button>
        </span>
      </div>
    </div>
  </div>

<?php endforeach; ?>



<script type="text/javascript">

  var driver_details = {
      name:'<?php  echo $data->first_name . " " . $data->last_name; ?>',
      driver_id:'<?php  echo $data->driver_no; ?>' ,
      contact:'<?php echo $data->contact_no; ?>',
  }

</script>

<?php endif; ?>

