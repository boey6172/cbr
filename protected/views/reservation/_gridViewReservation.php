<?php
     $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'=>'reservation-grid',
    'headerOffset' => 40,
    'type' => 'striped condensed bordered',
    'responsiveTable' => true,
    'dataProvider'=>$vm->reservation->search(),
    'columns'=>array(
        array(
          'name' => 'Reservation Number',
          'value' => '$data->reservation_no',
          'sortable' => false,
        ),
        array(
          'name' => 'Pick up Location',
          'value' => '$data->pickup_location',
          'sortable' => false,
        ),
        array(
          'name' => 'Dropoff Location',
          'value' => '$data->dropoff_location',
          'sortable' => false,
        ),
        array(
          'name' => 'Created Date',
          'value' => '$data->date_saved',
          'sortable' => false,
        ),
        array(
          'name' => 'company',
          'visible' =>'($data->status == 2 ? "false":"false")' ,
          'header' => 'Action',
          'htmlOptions'=>array('style'=>'width: 133px'),
          'value' => function($data){
                $this->widget(
                    'booster.widgets.TbButton',
                    array(
                        'label' => 'View & Print',
                        'context' => 'primary',
                        'icon' => 'fa fa-print',
                        'buttonType' =>'link',
                        'url'=> array('reservation/printticket', 'id'=>$data->reservation_id),
                        'htmlOptions' => array(
                            'class'=>($data->status == 2 ?  'disabled' : 'btn-primary'),
                            'ref'=>$data->reservation_no,
                            //'target'=>'_blank',
                            'title'=>'update',
                        ),
                    )
                );
            },
        ),
        array(
          'name' => 'Cancel',
          'header' => '',
          'htmlOptions'=>array('style'=>'width: 178px'),
          'value' => function($data){
                $this->widget(
                    'booster.widgets.TbButton',
                    array(
                        'label' => ($data->status == 2 ?  'Cancelled Reservation' : 'Cancel Reservation'),
                        'context' => 'primary',
                        'icon' => 'fa fa-close',
                        'buttonType' =>'link',
                        //'url'=> array('reservation/printticket', 'id'=>$data->reservation_id),
                        'htmlOptions' => array(
                            'id'=>'modal_cancel_reservation',
                            'class'=>($data->status == 2 ?  'btn-danger disabled' : 'btn-primary'),
                            'data'=>$data->reservation_id,
                            //'target'=>'_blank',
                            'title'=>'update',
                        ),
                    )
                );
            },
        ),
    ),
));
 ?>
