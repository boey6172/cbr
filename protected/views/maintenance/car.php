<!-- CONTENTS -->

<div class="container">
	<div class="page-header">
		<h2><span class="fa fa-car"></span> <b>Car Maintenance</b></h2>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php
				$this->renderPartial('_car_thumbnails_list', array(
					'vm' => $vm,
				))
			?>
		</div>
	</div>
</div>

<!-- MODALS -->

<?php
    echo $this->alenaModal( 'modalCarEditForm', array(
        'title' => "<span class='fa fa-car fa-lg'></span>&nbsp;<span class='modalTitle'></span>",
        'body' => $this->renderPartial('_car_view', array(
        	'vm' => $vm,
        ), true),
        'footer' =>
        	CHtml::button('Save', array("id" => "btn_edit_car", "class" => "btn btn-primary")) .
        	' ' .
        	CHtml::button('Cancel', array("class" => "btn", "data-dismiss"=>"modal"))
        ,
        'style' => '
        	width	: 90%;
        ',
    ));
?>

<?php
    echo $this->alenaModal( 'modalCarPartRequestForm', array(
        'title' => "<span class='fa fa-cogs fa-lg'></span>&nbsp;Parts Request Form",
        'body' => $this->renderPartial('_car_part_request_form', array(
        	'vm' => $vm,
        ), true),
        'footer' =>
        	CHtml::button('Save', array("id" => "btn_save_car_part_request", "class" => "btn btn-primary")) .
        	' ' .
        	CHtml::button('Cancel', array("class" => "btn", "data-dismiss"=>"modal"))
        ,
        'style' => '
        	width	: 400px;
        ',
    ));
?>
<?php
	$this->renderPartial('_car_billing_form', array(
		'vm' => $vm,
	));
?>

<!-- SCRIPTS -->

<?php
   $carinfo = Yii::app()->createUrl( "maintenance/carinfo" );
   $carsave = Yii::app()->createUrl( "maintenance/carsave" );
	 $carsavepartsrequest = Yii::app()->createUrl( "maintenance/carpartrequestsave" );
	 $self = Yii::app()->createUrl( "maintenance/car" );

   $success = 'success';
   $error = 'error';

   Yii::app()->clientScript->registerScript('employee_attendance_script', "

   	//-------------- FUNCTIONS --------------

	function viewModal(id)
	{
		var car_id = id;

		$.ajax({
            type: 'POST',
            url: '{$carinfo}',
            data: {'car':car_id},
            dataType:'json',
            success: function(data){
                var json = data;

                var car_data = json.retMessage;

                for(var field_name in car_data)
								{
									var field_val = car_data[field_name];
									var form_field = document.getElementsByName('Car[' + field_name + ']');

									for (var i=0;i<form_field.length;i++) {
										form_field[i].value = field_val;

										if(field_name == 'plate_no')
										{
											$('.modalTitle').html('CAR ' + field_val);
										}
										else if(field_name == 'car_img')
										{
											renderImage();
										}
										else if(field_name == 'cars_id')
										{
											$('#CarPartRequest_car').val(field_val);
											$('#Reservation_car_id').val(field_val);
											reloadBillingGrid();
											reloadCarPartGrid();
										}
									}
								}
				    }
        })

		$('#modalCarEditForm').modal();
	}

	function renderImage()
	{
		var preview = document.querySelector('#car_img');
		var uri = $('#img_uri').val();

		if(uri == '')
		{
			uri = './images/car.jpg';
		}


		preview.src = uri;
	}

	function readImage()
	{
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
	}

	function editCar()
	{
		$.ajax({
	        type        : 'POST',
	        url         : '{$carsave}',
	        data        : $('#formEditCar').serialize(),
	        cache       : false,
	        success     : function( data ) {
	            var json = $.parseJSON( data );

	            if(json.retVal == '{$success}')
	            {
	            	$.fn.yiiListView.update('car-results',{});
	            	$.notify(json.retMessage, json.retVal);
	            	$('#modalCarEditForm').modal('hide');
	            }
	            else if(json.retVal == '{$error}')
	            {
	                $.notify(json.retMessage, json.retVal);
	            }
	        }
	    })
	}

	function resetFormCarPartRequest()
	{
		$('#CarPartRequest_driver').val('');
		$('#CarPartRequest_item_request').val('');
		$('#CarPartRequest_item_qty').val('');
		$('#CarPartRequest_item_amount').val('');
	}

	function saveCarPartRequest()
	{
		$.ajax({
					type			: 'POST',
					url				: '{$carsavepartsrequest}',
					data			: $('#formCarPartRequest').serialize(),
					cache 		: false,
					success		: function( data ) {
							var json = $.parseJSON( data );

							if(json.retVal == '{$success}')
							{
									$.notify(json.retMessage, json.retVal);
									resetFormCarPartRequest();
									reloadCarPartGrid();
									$('#modalCarPartRequestForm').modal('hide');
							}
							else if(json.retVal == '{$error}')
							{
									$.notify(json.retMessage, json.retVal);
							}
					}
		})
	}

	function  reloadCarPartGrid()
	{
		$('#formCarPartRequest').submit();
	}

	function  reloadBillingGrid()
	{
		$('#formCarBilling').submit();
	}

	//-------------- RELOADSGRIDS - :D --------------

	$('#formCarPartRequest').submit(function()
	{
		$('#car_part_request_grid').yiiGridView('update', {
			type:'POST',
			data: $(this).serialize()
		});
		return false;
	});

	$('#formCarBilling').submit(function()
	{
		$('#car_reservation_grid').yiiGridView('update', {
			type:'POST',
			data: $(this).serialize()
		});
		return false;
	});

	//-------------- ACTION BUTTONS --------------

	$(document).on('click', '.viewCarBtn', function(){
		var id = $(this).attr('ref');

    	viewModal(id);
    });

    $(document).on('change','#file',function() {
			readImage();
    });

    $(document).on('click', '#btn_edit_car', function(){
		editCar();
    });

    $(document).on('click', '#new_part_request_btn', function(){
    	$('#modalCarPartRequestForm').modal();
    });

	$(document).on('click', '#btn_save_car_part_request', function(){
		saveCarPartRequest();
	});

   ");
?>
