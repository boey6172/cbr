<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
    'id'=>'car-repair-log-form',
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'POST',
    'enableAjaxValidation'=>true,
    )); ?>

<form role="form">
    <fieldset>
        <div class="row">
        	<div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
        			<label class="label label-primary">CAR - PLATE NO</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
                    <?php echo $form->textField($vm->cars,'plate_no',array('class'=>'input-style',"placeholder" => '*Plate No', 'autocomplete'=>"off", 'disabled'=>'disabled')); ?>
                    <?php echo $form->hiddenField($vm->repairLog,'car_id',array('class'=>'input-style', 'autocomplete'=>"off",)); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
                    <label class="label label-primary">DESCRIPTION</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
                    <?php echo $form->textArea($vm->repairLog,'repair_details',array('class'=>'input-style',"placeholder" => '*Description', 'autocomplete'=>"off", "autofocus"=>"autofocus", 'style'=>'height: 200px;')); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-8">
                <div class="form-group">

                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="form-group">
                    <label class="label label-primary">COST</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-8">
                <div class="form-group">

                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="form-group">
                <?php echo $form->numberField($vm->repairLog,'repair_costing',array('class'=>'input-style',"placeholder" => '*Cost', 'autocomplete'=>"off",)); ?>
                </div>
            </div>
        </div>
    </fieldset>
</form>

<?php $this->endWidget(); ?>