<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
    'id'=>'cars-form',
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'POST',
    'enableAjaxValidation'=>true,
    )); ?>

<form role="form">
    <fieldset>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-5">
                <div class="img-container">
                    <img src=<?php echo ($vm->cars->car_img != '') ? $vm->cars->car_img : "./images/car.jpg" ?> alt="" height="93" width="186" class="" id="car_img">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-7">
                <div class="form-group">
                    <br/><br/><br/>
                    <?php echo $form->hiddenField($vm->cars,'car_img',array('class'=>'input-style', 'id'=>'img_uri')); ?>
                    <?php echo $form->hiddenField($vm->cars,'cars_id',array('class'=>'input-style',)); ?>

                    <label class="btn btn-primary">
		                Browse&hellip; <input type="file" id="file" style="display: none;">
		            </label>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
        			<label class="label label-primary">PLATE NO</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
                    <?php echo $form->textField($vm->cars,'plate_no',array('class'=>'input-style',"placeholder" => '*Plate No', 'autocomplete'=>"off", "autofocus"=>"autofocus")); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="form-group">
                	<label class="label label-primary">BRAND</label>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="form-group">
                    <label class="label label-primary">MODEL</label>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="form-group">
                    <label class="label label-primary">YEAR</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="form-group">
                <?php echo $form->textField($vm->cars,'brand',array('class'=>'input-style',"placeholder" => '*Brand', 'autocomplete'=>"off",)); ?>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="form-group">
                    <?php echo $form->textField($vm->cars,'model',array('class'=>'input-style',"placeholder" => '*Model', 'autocomplete'=>"off",)); ?>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="form-group">
                    <?php echo $form->textField($vm->cars,'year',array('class'=>'input-style',"placeholder" => 'Year', 'autocomplete'=>"off",)); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="form-group">
                    <label class="label label-primary">PASSENGER CAPACITY</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="form-group">
                <?php echo $form->numberField($vm->cars,'passenger_cap',array('class'=>'input-style',"placeholder" => 'Capacity', 'autocomplete'=>"off",)); ?>
                </div>
            </div>
        </div>
    </fieldset>
</form>

<?php $this->endWidget(); ?>