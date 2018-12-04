<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
  'booster.widgets.TbActiveForm',
  array(
    'id' => 'search_car_form',
    'type' => 'inline',
  )
);
?>

	<?php
		echo $form->textFieldGroup($vm->car, 'plate_no', array(
			'widgetOptions' => array(
				'htmlOptions' => array(
					'autocomplete' => 'off',
					'placeholder' => 'Search',
					'class' => 'alena-input-md',
				)
			)
		));
	?>
	

<?php $this->endWidget(); ?>