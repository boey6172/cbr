
 <?php
    $this->widget('booster.widgets.TbExtendedGridView', [
        'id' => 'reservation_grid',
        'type' => 'bordered condensed hover',
        'template'=>'{items}',
        'htmlOptions' => ['style'=>'width: 100%'],
        'dataProvider' => $vm->reservation->today(),
        'columns' => [
             [
                'name' => 'reservation_no',
                'value' => '$data->reservation_no',
                'header' => 'Reservation No.',
                'sortable' => true,
                'htmlOptions' => ['style'=>'width: 100px'],
            ],
            [
              'name' => 'Pick up Location',
              'value' => '$data->pick_up_location',
              'header' => 'Pick up Location.',
              'sortable' => true,

            ],
            [
              'name' => 'Dropoff Location',
              'value' => '$data->drop_off_location',
              'sortable' => true,
            ],
            [            
              'name' => 'Passengers',
              'value' => '$data->passengers',
              'sortable' => true,
            ],
            [
              'name' => 'Reservation DateTime',
              'value' => '$data->reserved_date',
              'sortable' => true,
            ],
            [
              'name' => 'Reservation Status',
              'value' => '$data->ReservationStatus->description',
              'sortable' => true,
            ],

            [
                'name' => 'View',
                'header' => 'Action',
                'htmlOptions' => ['style'=>'width: 103px'],
                'value' => function($data) {
                    $this->widget(
                        'booster.widgets.TbButton', [
                            'label' => 'Print',
                            'context' => 'primary',
                            'icon' => 'fa fa-print',
                            'buttonType' =>'link',
                            'size' => 'extra_small',
                            'url'=> array('reservation/printticket', 'id'=>$data->reservation_id),
                            'htmlOptions' => [
                                'class' => ($data->reservation_status == 0 ?  'btn-primary' : 'btn-primary'),
                                'ref' => $data->reservation_id,
                                'target' => '_blank',
                                'title' => 'Print',
                            ],
                        ]
                    );
                    $this->widget(
                        'booster.widgets.TbButton', [
                            'label' => 'Cancel',
                            'context' => 'danger',
                            'icon' => 'fa fa-close',
                            'buttonType' =>'link',
                            'size' => 'extra_small',
                            'url'=> array('reservation/printticket', 'id'=>$data->reservation_id),
                            'htmlOptions' => [
                                'class' => ($data->reservation_status == 0 ?  'btn-danger disabled' : 'btn-primary' && $data->reservation_status == 4 ?  'btn-danger disabled' : 'btn-primary'),
                                'ref' => $data->reservation_id,
                                'target' => '_blank',
                                'title' => 'Cancel',
                            ],
                        ]
                    );


                },
            ],
        ],
    ]);
?>
