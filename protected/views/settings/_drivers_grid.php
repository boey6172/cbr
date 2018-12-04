<?php $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'=>'drivers-grid',
    'headerOffset' => 40,
    'type' => 'striped condensed bordered',
    'responsiveTable' => true,
    'dataProvider'=>$vm->drivers->search(),
    'columns'=>array(
        array(
          'class'=>'bootstrap.widgets.TbImageColumn',
          'imagePathExpression'=>'($data->driver_img != "") ? $data->driver_img : "./images/user.png"',
          'imageOptions'=>array('width'=>'48px', 'height' => '48px','class'=> 'circle'),
          'usePlaceKitten'=>false,
        ),
        array(
          'name' => 'ID No',
          'value' => '$data->driver_no',
          'sortable' => false,
        ),
        array(
          'name' => 'Last Name',
          'value' => '$data->last_name',
          'sortable' => false,
        ),
        array(
          'name' => 'First Name',
          'value' => ' $data->first_name',
          'sortable' => false,
        ),
        array(
          'name' => 'Contact No',
          'value' => '(!empty($data->contact_no)) ? $data->contact_no : "No Contact No"',
          'sortable' => false,
        ),
        array (
          'name' => 'Status',
          'type' => 'raw',
          'value' => 'TbHtml::buttonGroup(array(
              array(
                  "label" => "{$data->DriverStatus->description}", 
                  "url" => "#",
                  "id"=>"{$data->driver_id}",
                  "ref"=>"{$data->driver_id}",
                  "class" => "action_btn_status",
                  "color" => TbHtml::BUTTON_COLOR_PRIMARY,
                  ),
          ))',
        ),
        array (
          'name' => 'Actions',
          'type' => 'raw',
          'value' => 'TbHtml::buttonGroup(array(
              array(
                  "label" => "", 
                  "url" => "#",
                  "id"=>"{$data->driver_id}",
                  "ref"=>"{$data->driver_id}",
                  "class" => "action_btn_edit fa fa-pencil-square-o btn",
                  "color" => TbHtml::BUTTON_COLOR_PRIMARY,
                  ),
          ))',
        ),
    ),
    'extendedSummary' => array(
        'title' => 'Driver Status',
        'columns' => array(
            'Status' => array(
                'label'=>'Driver Count',
                'types' => array(
                    'ACTIVE'=>array('label'=>'<label class="label label-success">ACTIVE</label>'),
                    'SUSPENDED'=>array('label'=>'<label class="label label-danger">SUSPENDED</label>'),
                    'RESIGNED'=>array('label'=>'<label class="label label-default">RESIGNED</label>'),
                ),
                'class'=>'TbCountOfTypeOperation',
            )
        )
    ),
    'extendedSummaryOptions' => array(
        'class' => 'well',
        'style' => 'width:400px; margin-top:10px;'
    ),
)); 
 ?>