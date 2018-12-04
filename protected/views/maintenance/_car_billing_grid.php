<?php

$this->widget(
    'booster.widgets.TbExtendedGridView',
    array(
        'id' => 'car_reservation_grid',
        'type' => 'striped bordered condensed',
        'dataProvider' => $vm->reservation->search(),
        'columns' => array(
        	array(
                'name' => '#',
                'header' => '#',
                'value' => '$row + 1',
                'htmlOptions'=>array('style'=>'width: 10px'),
            ),
            array(
                'name' => 'reservation_no',
                'value' => '$data->reservation_no',
                'header' => 'Reservation No',
                'sortable' => false,
            ),
            array(
                'name' => 'saved_by',
                'value' => '$data->User->first_name . " " . $data->User->surname',
                'header' => 'Reserved by',
                'sortable' => false,
            ),
			array(
                'name' => 'Department',
                'value' => '$data->User->Department->department_name',
                'header' => 'Department',
                'sortable' => false,
            ),
            array(
                'name' => 'driver',
                'value' => '($data->Driver != "") ? $data->Driver->first_name . " " . $data->Driver->last_name : "No Drivers"',
                'header' => 'Driver',
                'sortable' => false,
            ),
            array(
                'name' => 'type',
                'value' => '$data->Type->description',
                'header' => 'Trip Type',
                'sortable' => false,
            ),
            array(
                'name' => 'mileage',
                'value' => '$data->mileage',
                'header' => 'Mileage',
				// 'footer' => '$model->getTotal($data)',
                'sortable' => false,
				'class'=>'booster.widgets.TbTotalSumColumn'
            ),
			array(
                'name' => 'mileage',
                'value' => '$data->mileage * 50',
                'header' => 'Mileage',
                'sortable' => false,
				'class'=>'booster.widgets.TbTotalSumColumn'
            ),
        )
    )
);

?>