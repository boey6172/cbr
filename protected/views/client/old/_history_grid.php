<?php $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'=>'history-grid',
    'headerOffset' => 40,
    'type' => 'striped condensed bordered',
    'responsiveTable' => true,
    'dataProvider'=>$vm->reservation->userReservations(),
    'columns'=>array(
        array(
            'name' => '#',
            'header' => '#',
            'value' => '$row + 1',
            'htmlOptions'=>array('style'=>'width: 40px'),
        ),
        array(
          'name' => 'Reservation No',
          'value' => '$data->reservation_no',
          'sortable' => false,
        ),
        array(
          'name' => 'Date Reserved',
          'value' => 'date("M d, Y h:i A", strtotime($data->date_saved))',
          'sortable' => false,
        ),
        array(
          'name' => 'Status',
          'value' => '$data->Status->description',
          'sortable' => false,
        ),
        array(
                'name' => 'Action',
                'header' => 'Action',
                'htmlOptions'=>array('style'=>'width: 90px'),
                // 'type' => 'raw',
                'value' =>  function($data){
                                $this->widget(
                                    'booster.widgets.TbButton',
                                    array(
                                        'label' => '',
                                        'size' => 'small',
                                        'icon' => 'fa fa-eye',
                                        'htmlOptions' => array(
                                            'class'=>'view_history_btn',
                                            'ref'=>$data->reservation_id,
                                        ),
                                    )
                                ); echo ' ';
                                $this->widget(
                                    'booster.widgets.TbButton',
                                    array(
                                        'label' => '',
                                        'size' => 'small',
                                        'icon' => 'fa fa-print',
                                        'buttonType' =>'link',
                                        'url'=> array('reservation/view&id=' . $data->reservation_no),
                                        'htmlOptions' => array(
                                            'class'=>'view_history_btn',
                                            'ref'=>$data->reservation_id,
                                            'target'=>'_blank',
                                        ),
                                    )
                                );
                            },
            ),
    ),
)); 
 ?>