<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'car_form',
		'type' => 'vertical',
	)
);
?>
<div class="row">
	<div class="col-md-12">
		<div id="alert_errors"></div>
	</div>
</div>
<div class="row">
	<div class="col-md-5">
		<center class="well">
			<img src=<?php echo ($vm->car->picture != '') ? $vm->car->picture : "./images/car.jpg" ?> width="414" height="255" title="Picture" alt="" id="profile_pic"><br><br>
			<label class="btn btn-primary">
	            <span class="fa fa-camera fa-lg"></span> Browse&hellip; <input type="file" id="file" style="display: none;">
	        </label>
		</center>
		<?php
			echo $form->hiddenField($vm->car, 'picture', array('id'=>'img_uri'));
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
						'value' => '4',
					)
				)
			));
		?>
		<?php
			echo $form->numberFieldGroup($vm->car, 'distance_capacity', array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						'autocomplete' => 'off',
						'value' => '0.00',
					)
				)
			));
		?>
		<?php
		$driver = CHtml::listData( Driver::model()->findAll(array()), 'id', 'full_name'); ?>

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

<?php $this->endWidget(); ?>