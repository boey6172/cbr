<?php if (count($vm->drivers) <= 0): ?>

<div class="alert alert-warning">
  <span class="fa fa-exclamation-triangle"></span> No available drivers found.
</div>

<?php endif; ?>

<?php if (count($vm->drivers) > 0): ?>
<?php foreach($vm->drivers as $data): ?>

<div class="item  col-sm-6 col-md-3">
  <div class="card">
    <div class="card-image">
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
        <button type="button" class="btn btn-primary cus_btn driver_btn" ref=<?php echo $data->id; ?> style="float:right !important; position:relative; bottom:32px;" name="button">Choose</button>
      </span>
    </div>
  </div>
</div>


<?php endforeach; ?>

<?php endif; ?>