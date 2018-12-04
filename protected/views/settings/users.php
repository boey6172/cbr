<div>
  <h2>User Management</h2>
</div>
<!-- div class="well">
<?php
  // $this->renderPartial('_users_form',array(
  //   'vm'=>$vm,
  // ));
?>
</div> -->

<div class="well">
<?php

  $this->renderPartial('_users_grid',array(
    'vm'=>$vm
  ));

?>
</div>

<?php
    echo $this->modalDiv( 'activation_form', array(
        'title' => "<div class='title'>Activate / Deactivate</div>", 
        'body' => "<div class='body'></div>",
        'footer' => TbHtml::button(
                        TbHtml::icon('Yes', array('class' => 'fa fa-check')) . 'Yes', 
                      array('class' => 'btn btn-success ', 'id' => 'yes_btn', 'data-dismiss'=>'modal')) .
                    TbHtml::button(
                        TbHtml::icon('No', array('class' => 'fa fa-times')) . 'No', 
                      array('class' => 'btn btn-danger ', 'data-dismiss'=>'modal'))
        ,
        'style' => "",
    ));    
?>

<?php
    echo $this->modalDiv( 'alert', array(
        'title' => "<div class='title'>Activate / Deactivate</div>", 
        'body' => "<div class='body'></div>",
        'footer' => TbHtml::button('Close', array('class' => 'btn', 'data-dismiss'=>'modal'))
        ,
        'style' => "",
    ));    
?>

<?php
    $checkStatus = Yii::app()->createUrl( "settings/checkstatus" );
    $activator = Yii::app()->createUrl( "settings/activate" );

    Yii::app()->clientScript->registerScript('activate_user', "
        $(document).on('click','.action_btn_activate',function() {
          $('#activation_form .body').load('{$checkStatus}', 
            {'time': $.now(), 'id': $(this).attr('id')}, function(){});
          $('#activation_form').modal();
        });

        $(document).on('click','#yes_btn',function() {
          $('#alert .body').load('{$activator}', 
            {'time': $.now(), 'id': $('#user').attr('value')}, function(){});
            
          $('#user-grid').yiiGridView('update', { 
            data: $(this).serialize() 
          });

          $('#alert').modal(); 
          return false; 
        });
    ");    
?>