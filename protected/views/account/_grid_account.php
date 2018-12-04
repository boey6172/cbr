<?php $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'=>'account-grid',
    'headerOffset' => 40,
    'type' => 'striped condensed bordered',
    'responsiveTable' => true,
    'dataProvider'=>$vm->user->search(),
    'columns'=>array(
        array(
            'name' => '#',
            'header' => '#',
            'value' => '$row + 1',
            'htmlOptions'=>array('style'=>'width: 30px'),
        ),
        array(
            'name' => 'username',
            'value' => '$data->username',
            'sortable' => false,
            'htmlOptions' => array(
                'style' => '
                    width: 90px;
                ',
            ),
        ),
        array(
            'name' => 'name',
            'value' => '$data->first_name . " " . $data->surname',
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
                                'class'=>'view_account_btn',
                                'ref'=>$data->user_id,
                            ),
                        )
                    );
                },
        ),
		
        array(
                'name' => 'Activation',
                'header' => 'Activation',
                'htmlOptions'=>array('style'=>'width: 80px'),
                'value' =>  function($data){
                    $this->widget(
                        'booster.widgets.TbButton',
                        array(
                            'label' => ($data->is_activated == 1 ?  'Deactivate' : 'Activate'),
                            // 'context' => 'warning',
                            'size' => 'extra_small',
                            'icon' => 'fa fa-user-circle-o',
                            'htmlOptions' => array(
                                'class'=>($data->is_activated == 1 ?  'btn-danger activate_account_btn' : 'btn-primary activate_account_btn'),
                                'ref'=>$data->user_id,
                            ),
                        )
                    );
                },
        ),
    ),
)); 
 ?>