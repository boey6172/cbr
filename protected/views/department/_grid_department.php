<?php $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'=>'department-grid',
    'headerOffset' => 40,
    'type' => 'striped condensed bordered',
    'responsiveTable' => true,
    'dataProvider'=>$vm->department->search(),
    'columns'=>array(
        array(
            'name' => '#',
            'header' => '#',
            'value' => '$row + 1',
            'htmlOptions'=>array('style'=>'width: 30px'),
        ),
        array(
            'name' => 'department_code',
            'value' => '$data->department_code',
            'sortable' => false,
            'htmlOptions' => array(
                'style' => '
                    width: 90px;
                ',
            ),
        ),
        array(
            'name' => 'department_name',
            'value' => '$data->department_name',
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
                                'class'=>'view_department_btn',
                                'ref'=>$data->department_id,
                            ),
                        )
                    );
                },
        ),
    ),
)); 
 ?>