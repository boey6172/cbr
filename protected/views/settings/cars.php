<div>
  <h2>Car Management</h2>
</div>
<div class="well">

<?php
	echo TbHtml::buttonGroup(array(
		array(
			"label" => "", 
			"url" => "#",
			"id"=>"btn_add_car",
			"class" => "action_btn_edit fa fa-plus btn",
			"color" => TbHtml::BUTTON_COLOR_PRIMARY,
		)
	));
?>

</div>
<div class="well">
<?php

  $this->renderPartial('_cars_grid',array(
    'vm'=>$vm
  ));

?>
</div>

<?php
    echo $this->modalDiv( 'load_car_form', array(
        'title' => "<div class='title'>Car</div>", 
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
    echo $this->modalDiv( 'car_status_form', array(
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
    echo $this->modalDiv( 'car_repair_log_form', array(
        'title' => "<div class='title'>Repair Log Entry</div>", 
        'body' => "<div class='body'></div>",
        'footer' => TbHtml::button(
                        TbHtml::icon('Save', array('class' => 'fa fa-save')) . ' Save', 
                      array('class' => 'btn btn-primary ', 'id' => 'save_log_btn',)) .
                    TbHtml::button('Cancel', 
                      array('class' => 'btn', 'data-dismiss'=>'modal')),
        'style' => "width:50%;",
    ));    
?>

<?php
    $loadcarform = Yii::app()->createUrl( "settings/loadcarform" );
    $validate = Yii::app()->createUrl( "settings/validatecar" );
    $statusform = Yii::app()->createUrl( "settings/carstatus" );
    $savecarstatus = Yii::app()->createUrl( "settings/savecarstatus" );
    $repairlogform = Yii::app()->createUrl( "settings/repairlogform" );
    $saverepairlog = Yii::app()->createUrl( "settings/saverepairlog" );
    $use = "Add Car";
    $edit = "Edit Car";
    $success = 'success';
    $warning = 'warning';

    Yii::app()->clientScript->registerScript('car_settings', "
        $(document).on('click','#btn_add_car',function() {
          $('#load_car_form .title').html('{$use}');
          $('#load_car_form .body').load('{$loadcarform}', 
            {'time': $.now(), 'id': ''}, function(){});
          $('#load_car_form').modal();
        });

        $(document).on('change','#file',function() {
          var preview = document.querySelector('#car_img');
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

        $('#cars-form').keypress(function (e) {
            if (e.which == 13) {
                submit();
            }
        });

        function submit()
        {
            $.ajax({
                type        : 'POST', 
                url         : '{$validate}',
                data        : $('#cars-form').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#cars-grid').yiiGridView('update', { 
                          data: $(this).serialize() 
                        });
                        $('#load_car_form').modal('hide');
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
          $('#load_car_form .title').html('{$edit}');
          $('#load_car_form .body').load('{$loadcarform}', 
            {'time': $.now(), 'id': $(this).attr('id')}, function(){});
          $('#load_car_form').modal();
        });

        $(document).on('click','.action_btn_status',function() {
          $('#car_status_form .body').load('{$statusform}', 
            {'time': $.now(), 'id': $(this).attr('id')}, function(){});
          $('#car_status_form').modal();
        });

        $(document).on('click','#save_status_btn',function() {
            savestatus();
        });

        $('#cars-status-form').keypress(function (e) {
            if (e.which == 13) {
                savestatus();
            }
        });

        function savestatus()
        {
            $.ajax({
                type        : 'POST', 
                url         : '{$savecarstatus}',
                data        : $('#cars-status-form').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#cars-grid').yiiGridView('update', { 
                          data: $(this).serialize() 
                        });
                        $('#car_status_form').modal('hide');
                        $.notify(json.retMessage, json.retVal);
                    }
                    else if(json.retVal == '{$warning}')
                    {
                        $.notify(json.retMessage, json.retVal);
                    }
                }
            })
        }

        $(document).on('click','.action_btn_repair',function() {
          $('#car_repair_log_form .body').load('{$repairlogform}', 
            {'time': $.now(), 'id': $(this).attr('id')}, function(){});
          $('#car_repair_log_form').modal();
        });

        $(document).on('click','#save_log_btn',function() {
            savelog();
        });

        $('#cars-status-form').keypress(function (e) {
            if (e.which == 13) {
                savelog();
            }
        });

        function savelog()
        {
            $.ajax({
                type        : 'POST', 
                url         : '{$saverepairlog}',
                data        : $('#car-repair-log-form').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#cars-grid').yiiGridView('update', { 
                          data: $(this).serialize() 
                        });
                        $('#car_repair_log_form').modal('hide');
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