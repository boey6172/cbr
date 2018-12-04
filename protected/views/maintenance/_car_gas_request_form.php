<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'formCarGasRequest',
	)
);
?>

<?php
	echo $form->hiddenField($vm->car_gas_request, 'car', array());
?>

<div class="row">
	<div class="col-md-12">
		<?php $gas_drivers = CHtml::listData( Driver::model()->findAll(), 'driver_id', 'last_name'); ?>

		<?php echo $form->select2Group(
			$vm->car_gas_request,
			'driver',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
				'widgetOptions' => array(
					'data' => $gas_drivers,
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
			echo $form->numberFieldGroup($vm->car_gas_request, 'gas_volume', array());
		?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php
			echo $form->numberFieldGroup($vm->car_gas_request, 'gas_amount', array());
		?>
	</div>
</div>

<?php $this->endWidget(); ?>
