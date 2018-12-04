<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
    'id'=>'drivers-form',
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'POST',
    'enableAjaxValidation'=>true,
    )); ?>

<form role="form">
    <fieldset>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-3">
                <div class="img-container">
                    <img src=<?php echo ($vm->drivers->driver_img != '') ? $vm->drivers->driver_img : "./images/user.png" ?> alt="" height="100" width="100" class="img-circle" id="driver_img">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-9">
                <div class="form-group">
                    <br/><br/><br/>
                    <?php echo $form->hiddenField($vm->drivers,'driver_img',array('class'=>'input-style', 'id'=>'img_uri')); ?>
                    <?php echo $form->hiddenField($vm->drivers,'driver_id',array('class'=>'input-style',)); ?>

                    <label class="btn btn-primary">
		                Browse&hellip; <input type="file" id="file" style="display: none;">
		            </label>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
        			<label class="label label-primary">ID NO</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
                    <?php echo $form->textField($vm->drivers,'driver_no',array('class'=>'input-style',"placeholder" => '*ID No', 'autocomplete'=>"off",)); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
                	<label class="label label-primary">FULL NAME</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                <?php echo $form->textField($vm->drivers,'first_name',array('class'=>'input-style',"placeholder" => '*First Name', 'autocomplete'=>"off", "autofocus"=>"autofocus",)); ?>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <?php echo $form->textField($vm->drivers,'last_name',array('class'=>'input-style',"placeholder" => '*Last Name', 'autocomplete'=>"off",)); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
        			<label class="label label-primary">GENDER</label>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
        			<label class="label label-primary">CONTACT NO</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                <?php echo $form->dropDownList($vm->drivers, 'gender',
				      array('1' => 'Male', '2' => 'Female',),array('prompt'=>'Gender','class'=>'input-style')); 
				?>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6>
                <div class="form-group">
                <?php echo $form->textArea($vm->drivers,'contact_no',array('class'=>'input-style', 'autocomplete'=>"off", 'style'=>'height: 85px;')); ?>
                </div>
            </div>
        </div>
    </fieldset>
</form>

<?php $this->endWidget(); ?>