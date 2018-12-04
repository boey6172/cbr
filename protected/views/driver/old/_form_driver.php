<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'formDriver',
		'type' => 'horizontal',
	)
);
?>

<?php
	echo $form->hiddenField($vm->driver, 'driver_id',array());
?>
<?php
echo $form->hiddenField($vm->driver, 'driver_img', array(
	'id'=>'img_uri',
));
?>

<div class="row">
	<div class="col-md-12">
		<center>
		<div class="card-image">
		  <img  src=<?php echo (isset($data->profile_pic) && $data->profile_pic != '') ? $data->profile_pic : './images/user.png'; ?> width='100' height='100' alt='' class='img-circle' id="driver_img">
		</div>
		</center>
		<br/>
		<label class="pull-right btn btn-primary btn-xs">
			Browse&hellip; <input type="file" id="file" style="display: none;">
		</label>
	</div>
</div>
<br/>
<div class="row">
	<div class="col-md-12">
		<?php
			echo $form->textFieldGroup($vm->driver, 'first_name', array(
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
			echo $form->textFieldGroup($vm->driver, 'last_name', array(
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
			echo $form->textFieldGroup($vm->driver, 'contact_no', array(
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
			$this->widget(
			    'booster.widgets.TbButton',
			    array(
			    	'buttonType' => 'submit',
			        'label' => 'Save',
			        'context' => 'success',
			        'htmlOptions' => array(
			        	'class' => 'save_driver_btn pull-right',
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
			        	'class' => 'update_driver_btn pull-right',
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