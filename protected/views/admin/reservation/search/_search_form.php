<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'search_form',
		'type' => 'vertical',
	)
);
?>

<div class="row">
	<div class="col-md-12">
		<?php
			echo $form->textFieldGroup($vm->reservation, 'reservation_no', array(
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
		<?php echo $form->datePickerGroup(
			$vm->reservation,
			'reserved_date',
			array(
				'widgetOptions' => array(
					'options' => array(
						'language' => 'en',
					),
				),
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
				// 'hint' => 'Click inside! This is a super cool date field.',
				'append' => '<i class="glyphicon glyphicon-calendar"></i>'
			)
		); ?>
	</div>
</div>

<?php $this->endWidget(); ?>