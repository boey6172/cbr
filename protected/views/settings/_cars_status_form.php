<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
    'id'=>'cars-status-form',
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'POST',
    'enableAjaxValidation'=>true,
    )); ?>
<div class="container">
	<form role="form">
	    <fieldset>
	        <div class="row">
	            <div class="col-xs-6 col-sm-6 col-md-3">
	            	<div class="row">
	            		<div class="form-group">
			                <div class="img-container">
			                    <img src=<?php echo ($vm->cars->car_img != '') ? $vm->cars->car_img : "./images/car.jpg" ?> alt="" height="93" width="186" class="img-circle" id="car_img">
			                    <?php echo $form->hiddenField($vm->cars,'cars_id',array('class'=>'input-style', 'autocomplete'=>"off",)); ?>
			                </div>
		                </div>
	                </div>
	            </div>
	            <div class="col-xs-6 col-sm-6 col-md-3">
	            	<div class="row">
		                <div class="form-group">
		        			<label class="label label-primary">PLATE NO</label> 
		        			<?php echo $vm->cars->plate_no ?>
		                </div>
		                <div class="form-group">
		        			<label class="label label-primary">BRAND & MODEL</label> 
		        			<?php echo $vm->cars->brand . " - " . $vm->cars->model; ?>
		                </div>
		                <div class="form-group">
		        			<label class="label label-primary">YEAR</label> 
		        			<?php echo $vm->cars->year; ?>
		                </div>
		                <div class="form-group">
		        			<label class="label label-primary">STATUS</label>
		        			<br/>
		        			<?php echo $form->dropDownList($vm->cars, 'status',
							      array('1' => 'AVAILABLE', '3' => 'REMOVED',),array('prompt'=>'Select Status','class'=>'input-style')); 
							?>
		                </div>
	                </div>
	            </div>
	        </div>
	    </fieldset>
	</form>
</div>

<?php $this->endWidget(); ?>