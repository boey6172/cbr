<?php $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'=>'notification-grid',
    'headerOffset' => 40,
    'type' => 'striped condensed bordered',
    'responsiveTable' => true,
    'dataProvider'=>$vm->notification->search(),
    'columns'=>array(
        array(
            'name' => '#',
            'header' => '#',
            'value' => '$row + 1',
            'htmlOptions'=>array('style'=>'width: 40px'),
        ),
        array(
          'name' => 'Title',
          'value' => '$data->title',
          'sortable' => false,
        ),
        array(
          'name' => 'Date',
          'value' => 'date("M d, Y h:i A", strtotime($data->saved_date))',
          'sortable' => false,
          'htmlOptions'=>array('style'=>'width: 165px'),
        ),
        array(
                'name' => 'Action',
                'header' => 'Action',
                'htmlOptions'=>array('style'=>'width: 85px'),
                // 'type' => 'raw',
                'value' =>  function($data){
                                $this->widget(
                                    'booster.widgets.TbButton',
                                    array(
                                        'label' => '',
                                        'size' => 'small',
                                        'icon' => 'fa fa-eye',
                                        'htmlOptions' => array(
                                            'class'=>'view_btn',
                                            'ref'=>$data->notification_id,
                                        ),
                                    )
                                ); echo ' ';
                                $this->widget(
                                    'booster.widgets.TbButton',
                                    array(
                                        'label' => '',
                                        'size' => 'small',
                                        'icon' => 'fa fa-trash',
                                        'htmlOptions' => array(
                                            'class'=>'delete_btn',
                                            'ref'=>$data->notification_id,
                                        ),
                                    )
                                );
                            },
            ),
    ),
)); 
 ?>