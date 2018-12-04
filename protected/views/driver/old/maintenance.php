<!-- CONTENTS -->

<div class="page-header">
	<h3><span class="fa fa-user-circle-o"></span>&nbsp;<b>Driver Maintenance</b></h3>
</div>
<div class="row">
	<div class="driver_grid_div">
		<div class="col-md-offset-3 col-md-6">
			<legend><span class="fa fa-list-alt"></span>&nbsp;Drivers Records</legend>
			<?php
				$this->widget(
				    'booster.widgets.TbButton',
				    array(
				    	'id' => 'add_driver_btn',
				        'label' => 'Add Driver',
				        'icon' => 'fa fa-user-plus',
				        'context' => 'primary',
				    )
				);
			?>
			<?php
				$this->renderPartial('_grid_driver', array(
					'vm' => $vm,
				));
			?>
		</div>
	</div>
	<div class="driver_form_div" style="display: none;">
		<div class="col-md-offset-3 col-md-6">
			<legend><span class="fa fa-user-plus"></span>&nbsp;<span class="form_title">Add Driver</span></legend>
			<?php
				$this->widget(
				    'booster.widgets.TbButton',
				    array(
				    	'id' => 'back_btn',
				        'label' => 'Back To Grid',
				        'icon' => 'fa fa-chevron-left',
				        'context' => 'primary',
				    )
				);
			?>
			<?php
				$this->renderPartial('_form_driver', array(
					'vm' => $vm,
				));
			?>
		</div>
	</div>
</div>

<!-- SCRIPTS -->

<?php
	$driver_save = Yii::app()->createUrl( "driver/save" );
	$get_driver_info = Yii::app()->createUrl( "driver/getdriverinfo" );
	$success = 'success';
	$error = 'error';

   Yii::app()->clientScript->registerScript('employee_attendance_script', "

   	function resetDriverForm()
   	{
   		$('#Driver_driver_id').val('');
   		document.getElementById('formDriver').reset();
   	}

   	function showAddDriverForm()
   	{
   		resetDriverForm();
   		$('.form_title').html('Add Driver');
   		$('.save_driver_btn').toggle(true);
   		$('.update_driver_btn').toggle(false);
   		$('.driver_grid_div').toggle(false);
   		$('.driver_form_div').toggle(true);
   	}

   	function showDriverGrid()
   	{
   		resetDriverForm();
   		$('.driver_grid_div').toggle(true);
   		$('.driver_form_div').toggle(false);
   	}

   	function showViewDriver()
   	{
   		$('.form_title').html('Update Driver');
   		$('.save_driver_btn').toggle(false);
   		$('.update_driver_btn').toggle(true);
   		$('.driver_grid_div').toggle(false);
   		$('.driver_form_div').toggle(true);
   	}

   	function getDriverInfo(id)
   	{
   		resetDriverForm();
   		$.ajax({
            type: 'POST',
            url: '{$get_driver_info}',
            data: {'driver':id},
            dataType:'json',
            success: function(data){
                var json = data;

                var driver_data = json.retMessage;

                for(var field_name in driver_data)
					{
						var field_val = driver_data[field_name];
						var form_field = document.getElementsByName('Driver[' + field_name + ']');

						for (var i=0;i<form_field.length;i++) {
							form_field[i].value = field_val;

							// if(field_name == 'car_img')
							// {
							// renderImage();
							// }
						}
						renderImage();
					}
				}
        })
   	}

	function saveDriver()
	{
		$.ajax({
	        type        : 'POST',
	        url         : '{$driver_save}',
	        data        : $('#formDriver').serialize(),
	        cache       : false,
	        success     : function( data ) {
	            var json = $.parseJSON( data );

	            if(json.retVal == '{$success}')
	            {
	            	$('.table').notify(json.retMessage,
						{
							position:'top left',
							className: json.retVal,
							arrowShow: false
						}
					);
					reloadGrid();
					showDriverGrid();
					resetDriverForm();
	            }
	            else if(json.retVal == '{$error}')
	            {
	                $.notify(json.retMessage, json.retVal);
	            }
	        }
	    })
	}

	function reloadGrid()
	{
		$('#driver-grid').yiiGridView('update', {
			type:'POST',
			data: $(this).serialize()
		});
		return false;
	}
	
	function renderImage()
	{
		var preview = document.querySelector('#driver_img');
		var uri = $('#img_uri').val();

		if(uri == '')
		{
			uri = './images/user.png';
		}


		preview.src = uri;
	}
	
	
	//// end function 
   	
	$().ready(function() {
		$('#formDriver').validate({
			debug: true,
			success: 'valid',
			submitHandler: function() {
				saveDriver();
			}
		});

		$('#Driver_first_name').rules('add', {
			required:true,
			minlength:3,
			messages : {
				required : 'First Name Required',
			}
		});
		$('#Driver_last_name').rules('add', {
			required:true,
			minlength:3,
			messages : {
				required : 'Last Name Required',
			}
		});
		$('#Driver_contact_no').rules('add', {
			required:true,
			minlength:9,
			digits : true,
			messages : {
				required : 'Contact No Required',
			}
		});
	});

    $(document).on('click', '#add_driver_btn', function(){
    	showAddDriverForm();
    });

    $(document).on('click', '#back_btn', function(){
    	showDriverGrid();
    });

    $(document).on('click', '.view_driver_btn', function(){
    	var id = $(this).attr('ref');

    	getDriverInfo(id);
    	showViewDriver();
    });
	
	$(document).on('change','#file',function() {
		readImage();
    });

   ");
?>