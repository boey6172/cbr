<h2><span class="fa fa-user-circle-o"></span> <b>Drivers</b>
<button class="btn_modal_add btn btn-primary"><span class="fa fa-plus-circle"></span> Add</button>
<div class="col-xs-2 pull-right">
<span class="pull-right">
  <button class="btn btn-primary" id="btn_driver_search"><span class="fa fa-search"></span></button>
</span>
<span>
  <?php
    $this->renderPartial('_search_driver_form', array(
      'vm' => $vm,
    ));
  ?>
</span>
</div>
</h2>
<hr>

<?php
	echo CHtml::openTag('div', array('class' => 'row-fluid'));
	$this->widget(
	    'bootstrap.widgets.TbThumbnails',
	    array(
	    	'id' => 'driver_thumbnails',
	        'dataProvider' => $vm->driver->search(),
	        'template' => "{items}\n{pager}",
	        'itemView' => '_driver_thumb',
	    )
	);
	echo CHtml::closeTag('div');
?>

<!-- MODALS -->

<!-- <center> -->
<?php
    echo $this->alenaModal( 'modalDriver', array(
        'title' => "<span class='fa fa-user-circle-o fa-lg'></span>&nbsp;<span class='modalTitle'>Add Driver</span>",
        'body' => $this->renderPartial('_driver_form', array(
        	'vm' => $vm,
        ), true),
        'footer' =>
        	CHtml::button('Save', array("id" => "btn_save_driver", "class" => "btn btn-primary")) .
        	' ' .
        	CHtml::button('Close', array("class" => "btn", "data-dismiss"=>"modal"))
        ,
        'style' => '
        	width	: 40%;
        ',
    ));
?>

<?php
    echo $this->alenaModal( 'modalUpdateDriver', array(
        'title' => "<span class='fa fa-user-circle-o fa-lg'></span>&nbsp;<span class='modalTitle'>Update Driver</span>",
        'body' => '',
        'footer' =>
          CHtml::button('Update', array("id" => "btn_update_driver", "class" => "btn btn-primary")) .
          ' ' .
          CHtml::button('Close', array("class" => "btn", "data-dismiss"=>"modal"))
        ,
        'style' => '
          width : 40%;
        ',
    ));
?>

<?php
    echo $this->alenaModal( 'modalConfirmUpdateDriver', array(
        'title' => "<span class='fa fa-question-circle-o fa-lg'></span>&nbsp;<span class='modalTitle'>Info</span>",
        'body' => '
          <div class="alert alert-info">
            This driver has been assigend to car, Do you want to remove this driver on being assigned?
          </div>
        ',
        'footer' =>
          CHtml::button('Yes', array("id" => "btn_yes_update_driver", "class" => "btn btn-primary", "data-dismiss"=>"modal")) .
          ' ' .
          CHtml::button('No', array("id" => "btn_no_update_driver", "class" => "btn", "data-dismiss"=>"modal"))
        ,
        'style' => '
          width : 30%;
        ',
    ));
?>
<!-- </center> -->

<!-- SCRIPTS -->

<?php
$save_driver = Yii::app()->createUrl( "driver/savedriver" );
$update_driver = Yii::app()->createUrl( "driver/updatedriver" );
$view_driver = Yii::app()->createUrl( "driver/viewdriver" );
$success = 'success';
$error = 'error';

Yii::app()->clientScript->registerScript('driver', "

	$(document).on('click', '.btn_modal_add', function(){
		$('#modalDriver').modal('show');
	});

	$(document).on('change','#file',function() {
    var preview = document.querySelector('#profile_pic');
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

  $(document).on('click', '#btn_save_driver', function(){
		saveDriver();
	});
  
	function saveDriver()
	{
		$.ajax({
	        type        : 'POST',
	        url         : '{$save_driver}',
	        data        : $('#driver_form').serialize(),
	        cache       : false,
	        success     : function( data ) {
	            var json = $.parseJSON( data );

                if(json.retVal == '{$success}')
                {
                	location.reload();
                  $('#alert_errors').html(json.retMessage);

                  setTimeout(function() { 
                    $('#alert_box').alert('close');
                    $('#modalDriver').modal('hide');
                  }, 1000);
                }
                else if(json.retVal == '{$error}')
                {
                    $('#alert_errors').html(json.retMessage);
                }
	        }
	    })
	}

  $(document).on('click', '.btn_driver_edit', function(){
    var id = $(this).attr('ref');  
  
    viewDriver(id);
  });

  function viewDriver(id)
  {
    $.ajax({
      type: 'POST',
      url: '{$view_driver}',
      data: {
        'Driver[id]':id,
      },
      dataType:'json',
      success: function(data){
        var json = data;

        $('#modalUpdateDriver .modal-body').html(json.retMessage);
        $('#modalUpdateDriver').modal('show');
      }
    })
  }

  $(document).on('change','#file_update',function() {
    var preview = document.querySelector('#profile_pic_update');
    var file    = document.querySelector('#file_update').files[0];
    var reader  = new FileReader();

    reader.addEventListener('load', function () {
      preview.src = reader.result;
      $('#img_uri_update').val(preview.src);
    }, false);

    if (file) {
      reader.readAsDataURL(file);
    }
  });

  $(document).on('click', '#btn_update_driver', function(){
    checkDriver();
  });

  function checkDriver()
  {
    var update_driver_status = $('#update_driver_form .row .col-md-8 .form-group #Driver_driver_status').val();
    var update_driver_car = $('#update_driver_form #Driver_car').val();

    if((update_driver_car != '0') && (update_driver_status == '0'))
    {
      $('#modalConfirmUpdateDriver').modal('show');
      // alert('Car :' + update_driver_car + ' - Status : ' + update_driver_status);
    }
    else
    {
      updateDriver();
      // alert('Car :' + update_driver_car + ' - Status : ' + update_driver_status + ' (Woohhh) ');
    }
  }

  function updateDriver()
  {
    $.ajax({
          type        : 'POST',
          url         : '{$update_driver}',
          data        : $('#update_driver_form').serialize(),
          cache       : false,
          success     : function( data ) {
              var json = $.parseJSON( data );

                if(json.retVal == '{$success}')
                {
                  location.reload();
                    $('#update_alert_errors').html(json.retMessage);

                    setTimeout(function() { 
                      $('#alert_box').alert('close');
                      $('#modalUpdateDriver').modal('hide');
                      location.reload();
                    }, 1000);
                }
                else if(json.retVal == '{$error}')
                {
                    $('#update_alert_errors').html(json.retMessage);
                }
          }
      })
  }

  $(document).on('click', '#btn_yes_update_driver', function(){
    updateDriver();
  });

  $(document).on('click', '#btn_no_update_driver', function(){
    $('#update_driver_form .row .col-md-8 .form-group #Driver_driver_status').val('1');
    updateDriver();
  });

  $(document).on('click', '#btn_driver_search', function(){
    $('#search_driver_form').submit();
  });

  $('#search_text').on('keydown', function(e) {
    if (e.which == 13) {
      $('#search_driver_form').submit();
  }

  
});

");

?>