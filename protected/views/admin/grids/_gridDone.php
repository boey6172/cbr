<?php $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'=>'doneReservation-grid',
    'headerOffset' => 40,
    'type' => 'striped condensed bordered',
    'responsiveTable' => true,
    'dataProvider'=>$vm->reservation->TodaysDone(),
    'columns'=>array(
        array(
          'name' => 'Reservation Number',
          'value' => '$data->reservation_no',
          'sortable' => false,
        ),
        array(
          'name' => 'Pick up Location',
          'value' => '$data->pick_up_location',
          'sortable' => false,
        ),
        array(
          'name' => 'Dropoff Location',
          'value' => '$data->drop_off_location',
          'sortable' => false,
        ),
        array(
          'name' => 'Passengers',
          'value' => '$data->passengers',
          'sortable' => false,
        ),
        array(
          'name' => 'Created Date',
          'value' => '$data->saved_date',
          'sortable' => false,
        ),

        array(
          'name' => 'view',
          'header' => 'Action',
          'htmlOptions'=>array('style'=>'width: 133px'),
          'value' => function($data){
                $this->widget(
                    'booster.widgets.TbButton',
                    array(
                        // 'label' => ($data->reservation_status == 0 ?  'Done' : 'View and Print'),
                        'context' => 'primary',
                        'icon' => 'fa fa-print',
                        'buttonType' =>'link',
                        'url'=> array('reservation/printticket', 'id'=>$data->reservation_id),
                        'htmlOptions' => array(
                            'class'=>($data->reservation_status == 0 ?  'btn-primary' : 'btn-primary'),
                            'ref'=>$data->reservation_no,
                            //'target'=>'_blank',
                            'title'=>'update',
                        ),
                    )
                );
				
				$this->widget(
                    'booster.widgets.TbButton',
                    array(
                         // 'label' => ($data->reservation_status == 0 ?  'Cancelled Reservation' : 'Cancel Reservation'),
                        'context' => 'success',
                        'icon' => 'fa fa-map-marker',
						 'url'=> array('admin/map', 'id'=>$data->reservation_no),
                        'buttonType' =>'link',
                        // 'url'=> array('reservation/printticket', 'id'=>$data->reservation_id),
                        'htmlOptions' => array(
							'id'=>'reservation_route_btn',
                            'class'=>($data->reservation_status == 0 ?  ' disabled' : 'btn-primary'),
                            'data'=>$data->reservation_id,
                            //'target'=>'_blank',
                            // 'title'=>'update',
                        ),
                    )
                );
				
				

				
				
            },
        ), 

    ),
));
 ?>
