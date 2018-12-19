
 <?php
    $this->widget('booster.widgets.TbExtendedGridView', [
        'id' => 'carSchedule_grid',
        'type' => 'bordered condensed hover',
        'template'=>'{items}',
        'htmlOptions' => ['style'=>'width: 100%'],
        'dataProvider' => $vm->carschedules->search(),
        'columns' => [

            [
              'name' => 'coding',
              'value' => '$data->CodingType->description',
              'header' => 'Schedule',
              'sortable' => true,

            ],
            [
                'name' => 'View',
                'header' => 'Action',
                'htmlOptions' => ['style'=>'width: 103px'],
                'value' => function($data) {
                    $this->widget(
                        'booster.widgets.TbButton', [
                            'label' => ($data->status == 1 ?  'Deactivate' : 'Activate'),
                            'context' => 'primary',
                            //'icon' => 'fa fa-print',
                            'buttonType' =>'link',
                            'size' => 'extra_small',
                            //'url'=> array('reservation/printticket', 'id'=>$data->cluster_id),
                            'htmlOptions' => [
                                 'class'=>($data->status == 1 ?  'btn-danger activate_schedule_btn' : 'btn-primary activate_schedule_btn'),
                                'ref' => $data->cluster_id,
                                'target' => '_blank',
                                'title' => 'Print',
                            ],
                        ]
                    );
                },
            ],
        ],
    ]);
?>
