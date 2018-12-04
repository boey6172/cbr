<?php /** @var TbActiveForm $form */
			$form = $this->beginWidget(
				'booster.widgets.TbActiveForm',
				array(
					'id' => 'formEditCar',
				)
			);
		?>

		<?php
			echo $form->hiddenField($vm->car, 'cars_id', array());
		?>
		<?php
			echo $form->hiddenField($vm->car, 'car_img', array(
				'id'=>'img_uri',
			));
		?>

		<div class="row">
			<div class="col-md-12">
				<center>
				<div class="card-image">
			      <img class="card-background" src=<?php echo (isset($data->car_img) && $data->car_img != '') ? $data->car_img : './images/car.jpg'; ?> id="car_img">
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
			<div class="col-md-6">
				<?php
					echo $form->textFieldGroup($vm->car, 'plate_no', array(
						'widgetOptions' => array(
							'htmlOptions' => array(
								'autocomplete' => 'off',
							)
						)
					)); 
				?>
			</div>
			<div class="col-md-6">
				<?php
					echo $form->numberFieldGroup($vm->car, 'year', array());
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<?php
					echo $form->textFieldGroup($vm->car, 'brand', array(
						'widgetOptions' => array(
							'htmlOptions' => array(
								'autocomplete' => 'off',
							)
						)
					)); 
				?>
			</div>
			<div class="col-md-6">
				<?php
					echo $form->numberFieldGroup($vm->car, 'passenger_cap', array());
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<?php
					echo $form->textFieldGroup($vm->car, 'model', array(
						'widgetOptions' => array(
							'htmlOptions' => array(
								'autocomplete' => 'off',
							)
						)
					)); 
				?>
			</div>
		</div>

		<?php $this->endWidget(); ?>