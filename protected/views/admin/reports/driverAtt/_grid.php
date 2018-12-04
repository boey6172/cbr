<?php $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'=>'attendance-grid',
    'headerOffset' => 40,
    'type' => 'striped condensed bordered',
    'responsiveTable' => true,
    'dataProvider'=>$vm->attendance->search(),
    'columns'=>array(
		array(
			'name' => '#',
			'header' => '#',
			'value' => '$row + 1',
			'htmlOptions'=>array('style'=>'width: 10px'),
		),
		array(
          'name' => 'Time_In',
          'value' => '$data->Driver->full_name',
          'sortable' => false,
        ),	
		array(
          'name' => 'Time_In',
          'value' => '$data->time_in',
          'sortable' => false,
        ),
		array(
          'name' => 'Time_Out',
          'value' => '$data->time_out',
          'sortable' => false,
        ),	
		array(
          'name' => 'Time in Latitude',
          'value' => '$data->time_in_latitude . "," . $data->time_in_longitude' ,
          'sortable' => false,
        ),
        
    ),
));
 ?>


