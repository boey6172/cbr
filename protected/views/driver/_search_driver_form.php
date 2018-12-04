<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
  'booster.widgets.TbActiveForm',
  array(
    'id' => 'search_driver_form',
    'type' => 'inline',
  )
);
?>

	<?php
		echo $form->textFieldGroup($vm->driver, 'full_name', array(
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