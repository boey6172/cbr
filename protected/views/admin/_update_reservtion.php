<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'updateReservation',
	)
);
?>
<div class="row">
<div class="col-sm-12">
<span><label for="">Rate the Trip</label></span>
</div>

<div class="col-sm-12">
<?php
$isvip = 1;
$this->widget('CStarRating',array(
            'name'=>'rate',
            'value'=>$isvip,
            'minRating'=>1,
            'maxRating'=>5,
            'starCount'=>5,
			'callback'=>'
			function(){

			}'
            ));
?>
</div>



<div class="row">
	<div class="col-sm-12">
		<span><label for="">Mileage</label></span>
		<input type="number" name="Mileage" autocomplete="off" value="" class="form-control">
	</div>
</div>
<input type="hidden" id="reservation_id" name="reservation_id" value="">

<?php $this->endWidget(); ?>


