<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'update_driver_form',
		'type' => 'vertical',
	)
);
?>
<div class="row">
	<div class="col-md-12">
		<div id="update_alert_errors"></div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<center class="well">
			<img src=<?php echo ($vm->driver->picture != '') ? $vm->driver->picture : "./images/user.png" ?> width="125" height="125" title="Profile Picture" alt="" id="profile_pic_update"><br><br>
			<label class="btn btn-primary">
	            <span class="fa fa-camera fa-lg"></span> Browse&hellip; <input type="file" id="file_update" style="display: none;">
	        </label>
		</center>
		<?php
			echo $form->hiddenField($vm->driver, 'picture', array('id'=>'img_uri_update'));
		?>
	</div>
	<div class="col-md-8">
		<?php
			echo $form->emailFieldGroup($vm->driver, 'email', array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						'autocomplete' => 'off',
					)
				)
			));
		?>
		<?php
			echo $form->passwordFieldGroup($vm->driver, 'password', array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						'autocomplete' => 'off',
					)
				)
			));
		?>
		<?php $status = CHtml::listData( DriverStatus::model()->findAll(), 'status_id', 'description'); ?>
		<?php
			echo $form->dropDownListGroup(
				$vm->driver,
				'driver_status',
				array(
					'widgetOptions' => array(
						'data' => $status,
						'htmlOptions' => array('prompt'=>'Select Status'),
					)
				)
			); 
		?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php
			echo $form->textFieldGroup($vm->driver, 'full_name', array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						'autocomplete' => 'off',
					)
				)
			));
		?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php
			echo $form->numberFieldGroup($vm->driver, 'contact_no', array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						'autocomplete' => 'off',
					)
				)
			));
		?>
	</div>
</div>
<?php
	echo $form->hiddenField($vm->driver, 'id', array());
?>
<?php
	echo $form->hiddenField($vm->driver, 'car', array());
?>

<?php $this->endWidget(); ?>