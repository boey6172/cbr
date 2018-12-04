<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
    'id'=>'drivers-status-form',
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
			                    <img src=<?php echo ($vm->drivers->driver_img != '') ? $vm->drivers->driver_img : "./images/user.png" ?> alt="" height="150" width="150" class="img-circle" id="driver_img">
			                    <?php echo $form->hiddenField($vm->drivers,'driver_id',array('class'=>'input-style', 'autocomplete'=>"off",)); ?>
			                </div>
		                </div>
	                </div>
	            </div>
	            <div class="col-xs-6 col-sm-6 col-md-3">
	            	<div class="row">
		                <div class="form-group">
		        			<label class="label label-primary">ID NO</label> 
		        			<?php echo $vm->drivers->driver_no ?>
		                </div>
		                <div class="form-group">
		        			<label class="label label-primary">NAME</label> 
		        			<?php echo $vm->drivers->first_name . " " . $vm->drivers->last_name; ?>
		                </div>
		                <div class="form-group">
		        			<label class="label label-primary">CONTACTS</label> 
		        			<?php echo $vm->drivers->contact_no; ?>
		                </div>
		                <div class="form-group">
		        			<label class="label label-primary">STATUS</label>
		        			<br/>
		        			<?php echo $form->dropDownList($vm->drivers, 'status',
							      array('1' => 'ACTIVE', '2' => 'SUSPENDED', '3' => 'RESIGNED',),array('prompt'=>'Select Status','class'=>'input-style')); 
							?>
		                </div>
	                </div>
	            </div>
	        </div>
	    </fieldset>
	</form>
</div>

<?php $this->endWidget(); ?>