<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'update_car_form',
		'type' => 'vertical',
	)
);
?>
	<div style="float:right !important; position:relative; bottom:32px;">
         <button type="button" class="btn cus_btn btn-success btnSchedules" ref=<?php echo $vm->car->car_id; ?> style="" name="button">Schedules <span class="fa fa-calendar"></span></button>
    </div>
<div class="row">
	<div class="col-md-12">
		<div id="update_alert_errors"></div>
	</div>
</div>
<div class="row">
	<div class="col-md-5">
		<center class="well">
			<img src=<?php echo ($vm->car->picture != '') ? $vm->car->picture : "./images/car.jpg" ?> width="414" height="255" title="Picture" alt="" id="profile_pic_update"><br><br>
			<label class="btn btn-primary">
	            <span class="fa fa-camera fa-lg"></span> Browse&hellip; <input type="file" id="file_update" style="display: none;">
	        </label>
		</center>
		<?php
			echo $form->hiddenField($vm->car, 'picture', array('id'=>'img_uri_update'));
		?>
	</div>
	<div class="col-md-7">
		<?php
			echo $form->textFieldGroup($vm->car, 'plate_no', array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						'autocomplete' => 'off',
					)
				)
			));
		?>
		<?php
			echo $form->textFieldGroup($vm->car, 'car_brand', array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						'autocomplete' => 'off',
					)
				)
			));
		?>
		<?php
			echo $form->textFieldGroup($vm->car, 'car_model', array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						'autocomplete' => 'off',
					)
				)
			));
		?>
		<?php $status = CHtml::listData( CarStatus::model()->findAll(), 'status_id', 'description'); ?>
		<?php
			echo $form->dropDownListGroup(
				$vm->car,
				'car_status',
				array(
					'widgetOptions' => array(
						'data' => $status,
						'htmlOptions' => array('prompt'=>'Select Status'),
					)
				)
			); 
		?>
		<?php
			echo $form->numberFieldGroup($vm->car, 'passenger_capacity', array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						'autocomplete' => 'off',
					)
				)
			));
		?>
		<?php
			echo $form->numberFieldGroup($vm->car, 'distance_capacity', array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						'autocomplete' => 'off',
					)
				)
			));
		?>
	
		<?php
		$driver = CHtml::listData( Driver::model()->findAllByAttributes(array('driver_status'=>1)), 'id', 'full_name'); ?>

		<?php echo $form->select2Group(
			$vm->car,
			'default_driver',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-12 ',
					'name' => 'default_driver',
				),
				'widgetOptions' => array(
					'data' => $driver,
					'options' => array(
						'placeholder' => 'Select Driver.',
					),
				),
			)
		);?>
	
	</div>


<?php
	echo $form->hiddenField($vm->car, 'car_id', array());
?>

<?php $this->endWidget(); ?>