<?php $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'=>'user-grid',
    'headerOffset' => 40,
    'type' => 'striped condensed bordered',
    'responsiveTable' => true,
    'dataProvider'=>$vm->user->search(),
    'columns'=>array(
        array(
          'class'=>'bootstrap.widgets.TbImageColumn',
          'imagePathExpression'=>'($data->profile_pic != "") ? $data->profile_pic : "./images/user.png"',
          'imageOptions'=>array('width'=>'48px', 'height' => '48px','class'=> 'circle'),
          'usePlaceKitten'=>false,
        ),
        array(
          'name' => 'Surname',
          'value' => '$data->surname',
          'sortable' => false,
        ),
        array(
          'name' => 'First Name',
          'value' => ' $data->first_name',
          'sortable' => false,
        ),
        array(
          'name' => 'username',
          'value' => '$data->username',
          'sortable' => false,
        ),
        array(
          'name' => 'Email',
          'value' => '$data->email',
          'sortable' => false,
        ),
        array (
          'name' => 'Activated',
          'type' => 'raw',
          'value' => 'TbHtml::buttonGroup(array(
              array(
                  "label" => "{$data->is_activated}" ? "ACTIVATED" : "IN ACTIVE", 
                  "url" => "#",
                  "id"=>"{$data->user_id}",
                  "ref"=>"{$data->user_id}",
                  "class" => "action_btn_activate",
                  "color" => "{$data->is_activated}" ? TbHtml::BUTTON_COLOR_SUCCESS : TbHtml::BUTTON_COLOR_DANGER,
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
                  "id"=>"{$data->user_id}",
                  "ref"=>"{$data->user_id}",
                  "class" => "action_btn_edit fa fa-pencil-square-o btn",
                  "color" => TbHtml::BUTTON_COLOR_PRIMARY,
                  ),
          ))',
        ),
    ),
    'extendedSummary' => array(
        'title' => 'User Status',
        'columns' => array(
            'Activated' => array(
                'label'=>'User Count',
                'types' => array(
                    'ACTIVATED'=>array('label'=>'<label class="label label-success">Activated</label>'),
                    'IN ACTIVE'=>array('label'=>'<label class="label label-danger">In Active</label>'),
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