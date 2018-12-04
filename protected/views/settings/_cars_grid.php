<?php $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'=>'cars-grid',
    'headerOffset' => 40,
    'type' => 'striped condensed bordered',
    'responsiveTable' => true,
    'dataProvider'=>$vm->cars->search(),
    'columns'=>array(
        array(
          'class'=>'bootstrap.widgets.TbImageColumn',
          'imagePathExpression'=>'($data->car_img != "") ? $data->car_img : "./images/car.jpg"',
          'imageOptions'=>array('width'=>'96px', 'height' => '48px','class'=> 'circle'),
          'usePlaceKitten'=>false,
        ),
        array(
          'name' => 'Plate No',
          'value' => '$data->plate_no',
          'sortable' => false,
        ),
        array(
          'name' => 'Brand',
          'value' => '$data->brand',
          'sortable' => false,
        ),
        array(
          'name' => 'Model',
          'value' => ' $data->model',
          'sortable' => false,
        ),
        array(
          'name' => 'Year',
          'value' => '(!empty($data->year)) ? $data->year : "NULL"',
          'sortable' => false,
        ),
        array (
          'name' => 'Status',
          'type' => 'raw',
          'value' => 'TbHtml::buttonGroup(array(
              array(
                  "label" => "{$data->CarStatus->description}", 
                  "url" => "#",
                  "id"=>"{$data->cars_id}",
                  "ref"=>"{$data->cars_id}",
                  "class" => "action_btn_status",
                  "color" => TbHtml::BUTTON_COLOR_PRIMARY,
                  ),
          ))',
        ),
        array (
          'name' => 'Actions',
          'type' => 'raw',
          'value' => '
            TbHtml::buttonGroup(array(
              array(
                  "label" => "", 
                  "url" => "#",
                  "id"=>"{$data->cars_id}",
                  "ref"=>"{$data->cars_id}",
                  "class" => "action_btn_edit fa fa-pencil-square-o btn",
                  "color" => TbHtml::BUTTON_COLOR_PRIMARY,
                  ),
            )) . 
            TbHtml::buttonGroup(array(
              array(
                  "label" => "", 
                  "url" => "#",
                  "id"=>"{$data->cars_id}",
                  "ref"=>"{$data->cars_id}",
                  "class" => "action_btn_repair fa fa-wrench btn",
                  "color" => TbHtml::BUTTON_COLOR_PRIMARY,
                  ),
            ))
          ',
        ),
    ),
    'extendedSummary' => array(
        'title' => 'Car Status',
        'columns' => array(
            'Status' => array(
                'label'=>'Car Count',
                'types' => array(
                    'AVAILABLE'=>array('label'=>'<label class="label label-success">AVAILABLE</label>'),
                    'UNDER REPAIR'=>array('label'=>'<label class="label label-danger">UNDER REPAIR</label>'),
                    'REMOVED'=>array('label'=>'<label class="label label-default">REMOVED</label>'),
                ),
                'class'=>'TbCountOfTypeOperation',
            )
        )
    ),
    'extendedSummaryOptions' => array(
        'class' => 'well',
        'style' => 'width:500px; margin-top:10px;'
    ),
)); 
 ?>