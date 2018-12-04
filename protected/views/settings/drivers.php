<div>
  <h2>Driver Management</h2>
</div>
<div class="well">

<?php
	echo TbHtml::buttonGroup(array(
		array(
			"label" => "", 
			"url" => "#",
			"id"=>"btn_add_driver",
			"class" => "action_btn_edit fa fa-user-plus btn",
			"color" => TbHtml::BUTTON_COLOR_PRIMARY,
		)
	));
?>

</div>
<div class="well">
<?php

  $this->renderPartial('_drivers_grid',array(
    'vm'=>$vm
  ));

?>
</div>

<?php
    echo $this->modalDiv( 'load_driver_form', array(
        'title' => "<div class='title'>Driver</div>", 
        'body' => "<div class='body'></div>",
        'footer' => TbHtml::button(
                        TbHtml::icon('Save', array('class' => 'fa fa-save')) . ' Save', 
                      array('class' => 'btn btn-primary ', 'id' => 'save_btn',)) .
                    TbHtml::button('Cancel', 
                      array('class' => 'btn', 'data-dismiss'=>'modal'))
        ,
    ));    
?>

<?php
    echo $this->modalDiv( 'driver_status_form', array(
        'title' => "<div class='title'>Change Status</div>", 
        'body' => "<div class='body'></div>",
        'footer' => TbHtml::button(
                        TbHtml::icon('Save', array('class' => 'fa fa-save')) . ' Save', 
                      array('class' => 'btn btn-primary ', 'id' => 'save_status_btn',)) .
                    TbHtml::button('Cancel', 
                      array('class' => 'btn', 'data-dismiss'=>'modal')),
        'style' => "width:50%;",
    ));    
?>

<?php
    $loaddriverform = Yii::app()->createUrl( "settings/loaddriverform" );
    $validate = Yii::app()->createUrl( "settings/validatedriver" );
    $statusform = Yii::app()->createUrl( "settings/driverstatus" );
    $savedriverstatus = Yii::app()->createUrl( "settings/savedriverstatus" );
    $use = "Add Driver";
    $edit = "Edit Driver";
    $success = 'success';
    $warning = 'warning';

    Yii::app()->clientScript->registerScript('driver_settings', "
        $(document).on('click','#btn_add_driver',function() {
          $('#load_driver_form .title').html('{$use}');
          $('#load_driver_form .body').load('{$loaddriverform}', 
            {'time': $.now(), 'id': ''}, function(){});
          $('#load_driver_form').modal();
        });

        $(document).on('change','#file',function() {
          var preview = document.querySelector('#driver_img');
          var file    = document.querySelector('#file').files[0];
          var reader  = new FileReader();

          reader.addEventListener('load', function () {
            preview.src = reader.result;
            $('#img_uri').val(preview.src);
          }, false);

          if (file) {
            reader.readAsDataURL(file);
          }
        });

        $(document).on('click','#save_btn',function() {
            submit();
        });

        $('#drivers-form').keypress(function (e) {
            if (e.which == 13) {
                submit();
            }
        });

        function submit()
        {
            $.ajax({
                type        : 'POST', 
                url         : '{$validate}',
                data        : $('#drivers-form').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#drivers-grid').yiiGridView('update', { 
                          data: $(this).serialize() 
                        });
                        $('#load_driver_form').modal('hide');
                        $.notify(json.retMessage, json.retVal);
                    }
                    else if(json.retVal == '{$warning}')
                    {
                        $.notify(json.retMessage, json.retVal);
                    }
                }
            })
        }

        $(document).on('click','.action_btn_edit',function() {
          $('#load_driver_form .title').html('{$edit}');
          $('#load_driver_form .body').load('{$loaddriverform}', 
            {'time': $.now(), 'id': $(this).attr('id')}, function(){});
          $('#load_driver_form').modal();
        });

        $(document).on('click','.action_btn_status',function() {
          $('#driver_status_form .body').load('{$statusform}', 
            {'time': $.now(), 'id': $(this).attr('id')}, function(){});
          $('#driver_status_form').modal();
        });

        $(document).on('click','#save_status_btn',function() {
            savestatus();
        });

        $('#drivers-status-form').keypress(function (e) {
            if (e.which == 13) {
                savestatus();
            }
        });

        function savestatus()
        {
            $.ajax({
                type        : 'POST', 
                url         : '{$savedriverstatus}',
                data        : $('#drivers-status-form').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#drivers-grid').yiiGridView('update', { 
                          data: $(this).serialize() 
                        });
                        $('#driver_status_form').modal('hide');
                        $.notify(json.retMessage, json.retVal);
                    }
                    else if(json.retVal == '{$warning}')
                    {
                        $.notify(json.retMessage, json.retVal);
                    }
                }
            })
        }
    ");    
?>