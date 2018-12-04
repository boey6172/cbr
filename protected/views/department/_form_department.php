<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'formDepartment',
		'type' => 'horizontal',
	)
);
?>

<?php
	echo $form->hiddenField($vm->department, 'department_id',array());
?>
<br/>
<div class="row">
	<div class="col-md-12">
		<?php
			echo $form->textFieldGroup($vm->department, 'department_name', array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						'autocomplete' => 'off',
					)
				)
			));
		?>
	</div>
</div>
<br/>
<div class="row">
	<div class="col-md-12">
		<?php
			echo $form->textFieldGroup($vm->department, 'department_code', array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						'autocomplete' => 'off',
					)
				)
			));
		?>
	</div>
</div>
<br/>
<div class="row">
	<div class="col-md-12">
		<?php
			$this->widget(
			    'booster.widgets.TbButton',
			    array(
			    	'buttonType' => 'submit',
			        'label' => 'Save',
			        'context' => 'success',
			        'htmlOptions' => array(
			        	'class' => 'save_department_btn pull-right',
			        ),
			    )
			);
		?>
		<?php
			$this->widget(
			    'booster.widgets.TbButton',
			    array(
			    	'buttonType' => 'submit',
			        'label' => 'Update',
			        'context' => 'warning',
			        'htmlOptions' => array(
			        	'class' => 'update_department_btn pull-right',
			        	'style' => '
			        		display: none, 
			        	',
			        ),
			    )
			);
		?>
	</div>
</div>

<?php $this->endWidget(); ?>