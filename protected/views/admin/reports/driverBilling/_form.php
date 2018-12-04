<?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'formReservationReport',
		'type' => 'horizontal',
	)
);
?>

		
			<div class="row">
				<div class="col-md-3">
					
						<select id='gMonth1' class='form-control' name='Month'>
							<option selected value=''>--Select Month--</option>
							<option value='1'>Janaury</option>
							<option value='2'>February</option>
							<option value='3'>March</option>
							<option value='4'>April</option>
							<option value='5'>May</option>
							<option value='6'>June</option>
							<option value='7'>July</option>
							<option value='8'>August</option>
							<option value='9'>September</option>
							<option value='10'>October</option>
							<option value='11'>November</option>
							<option value='12'>December</option>
						</select> 
					
				</div>
				<div class="col-md-3">
 						<select id='gMonth1' class='form-control' name='Year'>
							<option selected value=''>--Select Year--</option>
							<option value='2017'>2017</option>
							<option value='2018'>2018</option>
							<option value='2019'>2019</option>
							<option value='2020'>2020</option>
							<option value='2021'>2021</option>
						</select> 
				</div>
				<div class="col-md-3">
					<?php
					$driver = CHtml::listData( Driver::model()->findAll(array()), 'id', 'full_name'); ?>

					<?php echo $form->select2Group(
						$vm->reservation,
						'driver',
						array(
							'wrapperHtmlOptions' => array(
								'class' => 'col-sm-12 ',
								'name' => 'id',
							),
							'widgetOptions' => array(
								'data' => $driver,
								'options' => array(
									'placeholder' => '--Select Driver--',
								),
							),
						)
					);?>
				</div>
				<div class="col-md-3">
				<?php
					$this->widget(
						'booster.widgets.TbButton',
						array(
							// 'buttonType' => 'submit',
							'label' => 'Update',
							'context' => 'primary',
							'htmlOptions' => array(
								'class' => 'reservation_search_btn col-md-12 ',
								'style' => '
									display: none, 
								',
							),
						)
					);
				?>
				</div>
			</div>
	</div>
<?php $this->endWidget(); ?>
