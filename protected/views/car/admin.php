<h2><span class="fa fa-car"></span> <b>Cars</b>
<button class="btn_modal_add btn btn-primary"><span class="fa fa-plus-circle"></span> Add</button>
<div class="col-xs-2 pull-right">
<span class="pull-right">
  <button class="btn btn-primary" id="btn_car_search"><span class="fa fa-search"></span></button>
</span>
<span>
  <?php
    $this->renderPartial('_search_car_form', array(
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
	    	'id' => 'car_thumbnails',
	        'dataProvider' => $vm->car->search(),
	        'template' => "{items}\n{pager}",
	        'itemView' => '_car_thumb',
	    )
	);
	echo CHtml::closeTag('div');
?>

<!-- MODALS  -->
<?php
    echo $this->alenaModal( 'modalUpdateCar', array(
        'title' => "<span class='fa fa-car fa-lg'></span>&nbsp;<span class='modalTitle'>Update Car</span>",
        'body' => '',
        'footer' =>
          CHtml::button('Update', array("id" => "btn_update_car", "class" => "btn btn-primary")) .
          ' ' .
          CHtml::button('Close', array("class" => "btn", "data-dismiss"=>"modal"))
        ,
        'style' => '
          width : 65%;
        ',
    ));
?>

<?php
    echo $this->alenaModal( 'modalCar', array(
        'title' => "<span class='fa fa-car fa-lg'></span>&nbsp;<span class='modalTitle'>Add Car</span>",
        'body' => $this->renderPartial('_car_form', array(
          'vm' => $vm,
        ), true),
        'footer' =>
          CHtml::button('Save', array("id" => "btn_save_car", "class" => "btn btn-primary")) .
          ' ' .
          CHtml::button('Close', array("class" => "btn", "data-dismiss"=>"modal"))
        ,
        'style' => '
          width : 65%;
        ',
    ));
?>

<!-- SCRIPTS -->

<?php
$save_car = Yii::app()->createUrl( "car/savecar" );
$update_car = Yii::app()->createUrl( "car/updatecar" );
$view_car = Yii::app()->createUrl( "car/viewcar" );
$success = 'success';
$error = 'error';

Yii::app()->clientScript->registerScript('driver', "

  $(document).on('click', '.btn_modal_add', function(){
    $('#modalCar').modal('show');
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

  $(document).on('click', '#btn_save_car', function(){
    saveCar();
  });

  function saveCar()
  {
    $.ajax({
          type        : 'POST',
          url         : '{$save_car}',
          data        : $('#car_form').serialize(),
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

  $(document).on('click', '.btn_car_edit', function(){
    var id = $(this).attr('ref');  
  
    viewCar(id);
  });

  function viewCar(id)
  {
    $.ajax({
      type: 'POST',
      url: '{$view_car}',
      data: {
        'Car[car_id]':id,
      },
      dataType:'json',
      success: function(data){
        var json = data;

        $('#modalUpdateCar .modal-body').html(json.retMessage);
        $('#modalUpdateCar').modal('show');
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

  $(document).on('click', '#btn_update_car', function(){
    updateCar();
  });

  function updateCar()
  {
    $.ajax({
          type        : 'POST',
          url         : '{$update_car}',
          data        : $('#update_car_form').serialize(),
          cache       : false,
          success     : function( data ) {
              var json = $.parseJSON( data );

                if(json.retVal == '{$success}')
                {
                  location.reload();
                  $('#update_alert_errors').html(json.retMessage);

                  setTimeout(function() { 
                    $('#alert_box').alert('close');
                    $('#modalUpdateCar').modal('hide');
                  }, 1000);
                }
                else if(json.retVal == '{$error}')
                {
                    $('#update_alert_errors').html(json.retMessage);
                }
          }
      })
  }

  $(document).on('click', '#btn_car_search', function(){
    $('#search_car_form').submit();
  });

  $('#search_text').on('keydown', function(e) {
    if (e.which == 13) {
      $('#search_car_form').submit();
    }
  });

");

?>