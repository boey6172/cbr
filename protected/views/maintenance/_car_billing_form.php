<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'formCarBilling',
	)
);
?>

<?php
	echo $form->hiddenField($vm->reservation, 'car_id', array());
?>

<?php $this->endWidget(); ?>
