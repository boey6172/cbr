<div class="row">
	<div class="col-md-4">
		<?php
			$this->renderPartial('_car_update_form', array(
				'vm' => $vm,
			));
		?>
	</div>
	<div class="col-md-8">
		<?php
			$this->widget(
			    'booster.widgets.TbTabs',
			    array(
			        'type' => 'tabs', // 'tabs' or 'pills'
			        'tabs' => array(
			            array(
			                'label' => 'Parts Request',
			                'content' => 
			                	$this->renderPartial('_car_part_request_grid', array(
									'vm' => $vm,
								), true, false)
			                ,
			                'active' => true
			            ),
			            array(
			                'label' => 'Gas Request',
			                'content' => 
			                	$this->renderPartial('_car_gas_request_grid', array(
									'vm' => $vm,
								), true, false)
			                ,
			                'active' => false
			            ),
			            array(
			                'label' => 'Billing',
			                'content' =>
			                	$this->renderPartial('_car_billing_grid', array(
									'vm' => $vm,
								), true, false)
			                ,
			                'active' => false
			            ),
			        ),
			    )
			);
		?>
	</div>
</div>