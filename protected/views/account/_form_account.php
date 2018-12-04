<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'formAccount',
		'type' => 'horizontal',
	)
);
?>

<?php
	echo $form->hiddenField($vm->user, 'user_id',array());
?>
<br/>
<?php
echo $form->hiddenField($vm->user, 'profile_pic', array(
	'id'=>'img_uri',
));
?>

<div class="row">
	<div class="col-md-12">
		<center>
		<div class="card-image">
		  <img  src=<?php echo (isset($data->profile_pic) && $data->profile_pic != '') ? $data->profile_pic : './images/user.png'; ?> width='100' height='100' alt='' class='img-circle' id="acc_img">
		</div>
		</center>
		<br/>
		<label class="pull-right btn btn-primary btn-xs">
			Browse&hellip; <input type="file" id="file" style="display: none;">
		</label>
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<?php
			echo $form->textFieldGroup($vm->user, 'username', array(
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
			echo $form->passwordFieldGroup($vm->user, 'password', array(
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
			echo $form->passwordFieldGroup($vm->user, 'confirm_password', array(
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
		$department = CHtml::listData( Department::model()->findAll(array()), 'department_id', 'department_name'); ?>

		<?php echo $form->select2Group(
			$vm->user,
			'department',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-12 ',
					'name' => 'department-id',
				),
				'widgetOptions' => array(
					'data' => $department,
					'options' => array(
						'placeholder' => 'Select Department.',
					),
				),
			)
		);?>
	</div>
</div>
</br>

<div class="row">
	<div class="col-md-12">
		<?php
			echo $form->textFieldGroup($vm->user, 'email', array(
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
			echo $form->textFieldGroup($vm->user, 'first_name', array(
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
			echo $form->textFieldGroup($vm->user, 'surname', array(
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
</br>
<div class="col-md-9 ">
Role
</div>
					<div class="col-md-3">
 						<select id='auth' class='form-control' name='auth'>
							<option selected value=''>--Select Role--</option>
							<option value='rxclient'>Client</option>
							<option value='rxadmin'>Admin</option>

						</select> 
				</div>
		
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
			        	'class' => 'save_account_btn pull-right',
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
			        	'class' => 'update_account_btn pull-right',
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