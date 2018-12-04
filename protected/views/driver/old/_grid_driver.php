<?php $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'=>'driver-grid',
    'headerOffset' => 40,
    'type' => 'striped condensed bordered',
    'responsiveTable' => true,
    'dataProvider'=>$vm->driver->search(),
    'columns'=>array(
        array(
            'name' => '#',
            'header' => '#',
            'value' => '$row + 1',
            'htmlOptions'=>array('style'=>'width: 30px'),
        ),
        array(
            'name' => 'driver_no',
            'value' => '$data->driver_no',
            'sortable' => false,
            'htmlOptions' => array(
                'style' => '
                    width: 90px;
                ',
            ),
        ),
        array(
            'name' => 'first_name',
            'value' => '$data->first_name',
            'sortable' => false,
        ),
        array(
            'name' => 'last_name',
            'value' => '$data->last_name',
            'sortable' => false,
        ),
        array(
            'name' => 'contact_no',
            'value' => '$data->contact_no',
            'sortable' => false,
        ),
        array(
                'name' => 'Action',
                'header' => 'Action',
                'htmlOptions'=>array('style'=>'width: 80px'),
                'value' =>  function($data){
                    $this->widget(
                        'booster.widgets.TbButton',
                        array(
                            'label' => 'Update',
                            'context' => 'warning',
                            'size' => 'extra_small',
                            'icon' => 'fa fa-eye',
                            'htmlOptions' => array(
                                'class'=>'view_driver_btn',
                                'ref'=>$data->driver_id,
                            ),
                        )
                    );
                },
        ),
    ),
)); 
 ?>