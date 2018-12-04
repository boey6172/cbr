<?php $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'=>'cars-grid',
    'headerOffset' => 40,
    'type' => 'striped condensed bordered',
    'responsiveTable' => true,
    'dataProvider'=>$vm->reservation->getCarReservations(),
    'columns'=>array(
        array(
          'name' => 'Reservation No',
          'value' => '$data->reservation_no',
          'sortable' => false,
        ),
        array(
          'name' => 'Date',
          'value' => 'date("M d, Y", strtotime($data->reservation_date_start))',
          'sortable' => false,
        ),
        array(
          'name' => 'Time',
          'value' => 'date("h:i A", strtotime($data->reservation_date_start)) . " - " . date("h:i A", strtotime($data->reservation_date_end))',
          'sortable' => false,
        ),
    ),
)); 
 ?>