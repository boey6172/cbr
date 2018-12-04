<?php $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'=>'reservation-grid',
    'headerOffset' => 40,
    'type' => 'striped condensed bordered',
    'responsiveTable' => true,
    'dataProvider'=>$vm->reservation->DriverReport(),
    'columns'=>array(
		array(
			'name' => '#',
			'header' => '#',
			'value' => '$row + 1',
			'htmlOptions'=>array('style'=>'width: 10px'),
		),
		array(
          'name' => 'Driver',
          'value' => '$data->Driver->full_name',
          'sortable' => false,
        ),	
		array(
          'name' => 'Reservation_no',
          'value' => '$data->reservation_no',
          'sortable' => false,
        ),
		array(
          'name' => 'Reservation_Date',
          'value' => '$data->reserved_date',
          'sortable' => false,
        ),	
		array(
          'name' => 'Time in Latitude',
          'value' => '$data->ReservationStatus->description'  ,
          'sortable' => false,
        ),
        
    ),
));
 ?>


