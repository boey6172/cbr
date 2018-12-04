<?php /** @var TbActiveForm $form */
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'driver_rating_form',
			'type' => 'vertical',
		)
	);
?>
<div class="row">
	<div class="col-sm-12">
		<div id="alert_rating_errors"></div>
	</div>
</div>
<center>
<div class="row">
	<div class="col-sm-12 col-md-12">
		<img src=<?php echo ($vm->driver->picture != '') ? $vm->driver->picture : "./images/user.png" ?> width="175" height="175" title="Profile Picture" alt="" class="img-circle">
	</div>
</div>
<hr>
<div class="row">
	<div class="col-sm-12">
		<b>NAME : </b> <?php echo strtoupper($vm->driver->full_name); ?><br>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<b>RATE HERE</b><br>
			<?php
				$this->widget('CStarRating',array(
				    'name'=>'Driver[rating]',
				    'value'=>1,
				    'minRating'=>1,
				    'maxRating'=>5,
				    'starCount'=>5,
					'callback'=>'
					function(){
						
					}',
					'htmlOptions' => array(
						'class' => 'btn',
					),
			    ));
			?>
	</div>
</div>
<?php
	echo $form->hiddenField($vm->driver, 'id', array());
?>
</center>
<button type="button" class="btn cus_btn btn-primary btn-mp btn_modal_submit_rating">Submit</button>
<button type="button" class="btn cus_btn btn-mp btn_modal_no_rating">No, Thanks</button>

<?php $this->endWidget(); ?>