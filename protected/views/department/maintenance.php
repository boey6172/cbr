<!-- CONTENTS -->

<div class="page-header">
	<h3><span class="fa fa-book"></span>&nbsp;<b>Department Maintenance</b></h3>
</div>
<div class="row">
	<div class="department_grid_div">
		<div class="col-md-offset-3 col-md-6">
			<legend><span class="fa fa-list-alt"></span>&nbsp;Department Records</legend>
			<?php
				$this->widget(
				    'booster.widgets.TbButton',
				    array(
				    	'id' => 'add_department_btn',
				        'label' => 'Add Department',
				        'icon' => 'fa fa-plus',
				        'context' => 'primary',
				    )
				);
			?>
			<?php
				$this->renderPartial('_grid_department', array(
					'vm' => $vm,
				));
			?>
		</div>
	</div>
		<div class="col-md-offset-3 col-md-6">
	<div class="department_form_div" style="display: none;">
			<legend><span class="fa fa-plus"></span>&nbsp;<span class="form_title">Add Department</span></legend>
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
				$this->renderPartial('_form_department', array(
					'vm' => $vm,
				));
			?>
		</div>
	</div>
</div>

<!-- SCRIPTS -->

<?php
	$department_save = Yii::app()->createUrl( "department/save" );
	$get_department_info = Yii::app()->createUrl( "department/getdepartmentinfo" );
	$success = 'success';
	$error = 'error';

   Yii::app()->clientScript->registerScript('department_script', "

   	function resetDepartmentForm()
   	{
   		$('#Department_department_id').val('');
   		document.getElementById('formDepartment').reset();
   	}

   	function showAddDepartmentForm()
   	{
   		resetDepartmentForm();
   		$('.form_title').html('Add Department');
   		$('.save_department_btn').toggle(true);
   		$('.update_department_btn').toggle(false);
   		$('.department_grid_div').toggle(false);
   		$('.department_form_div').toggle(true);
   	}

   	function showDepartmentGrid()
   	{
   		resetDepartmentForm();
   		$('.department_grid_div').toggle(true);
   		$('.department_form_div').toggle(false);
   	}

   	function showViewDepartment()
   	{
   		$('.form_title').html('Update Department');
   		$('.save_department_btn').toggle(false);
   		$('.update_department_btn').toggle(true);
   		$('.department_grid_div').toggle(false);
   		$('.department_form_div').toggle(true);
   	}

   	function getDepartmentInfo(id)
   	{
   		resetDepartmentForm();
   		$.ajax({
            type: 'POST',
            url: '{$get_department_info}',
            data: {'department':id},
            dataType:'json',
            success: function(data){
                var json = data;

                var department_data = json.retMessage;

                for(var field_name in department_data)
					{
						var field_val = department_data[field_name];
						var form_field = document.getElementsByName('Department[' + field_name + ']');

						for (var i=0;i<form_field.length;i++) {
							form_field[i].value = field_val;
						}
					}
				}
        })
   	}

	function saveDepartment()
	{
		$.ajax({
	        type        : 'POST',
	        url         : '{$department_save}',
	        data        : $('#formDepartment').serialize(),
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
					showDepartmentGrid();
					resetDepartmentForm();
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
		$('#department-grid').yiiGridView('update', {
			type:'POST',
			data: $(this).serialize()
		});
		return false;
	}
   	
	$().ready(function() {
		$('#formDepartment').validate({
			debug: true,
			success: 'valid',
			submitHandler: function() {
				saveDepartment();
			}
		});

		$('#Department_department_name').rules('add', {
			required:true,
			minlength:3,
			messages : {
				required : 'Department Name Required',
			}
		});
		$('#Department_department_code').rules('add', {
			required:true,
			minlength:3,
			messages : {
				required : 'Department Code Required',
			}
		});
	});

    $(document).on('click', '#add_department_btn', function(){
    	showAddDepartmentForm();
    });

    $(document).on('click', '#back_btn', function(){
    	showDepartmentGrid();
    });

    $(document).on('click', '.view_department_btn', function(){
    	var id = $(this).attr('ref');

    	getDepartmentInfo(id);
    	showViewDepartment();
    });

   ");
?>