<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'formCarPartRequest',
	)
);
?>

<?php
	echo $form->hiddenField($vm->car_part_request, 'car', array());
?>

<div class="row">
	<div class="col-md-12">
		<?php $part_drivers = CHtml::listData( Driver::model()->findAll(), 'driver_id', 'last_name'); ?>

		<?php echo $form->select2Group(
			$vm->car_part_request,
			'driver',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
				'widgetOptions' => array(
					'data' => $part_drivers,
					'options' => array(
						'placeholder' => 'Select Requestor.',
					),
				),
			)
		);?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php
			echo $form->textFieldGroup($vm->car_part_request, 'item_request', array(
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
			echo $form->numberFieldGroup($vm->car_part_request, 'item_qty', array());
		?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php
			echo $form->numberFieldGroup($vm->car_part_request, 'item_amount', array());
		?>
	</div>
</div>

<?php $this->endWidget(); ?>
