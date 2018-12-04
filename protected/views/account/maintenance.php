<!-- CONTENTS -->

<div class="page-header">
	<h3><span class="fa fa-lock"></span>&nbsp;<b>Account Maintenance</b></h3>
</div>
<div class="row">
	<div class=" col-md-3 well">
	<legend><span class="fa fa-unlock"></span>&nbsp;Active Accounts</legend>
	No.of account: <?php echo $vm->user->active;?>
	</div>
	<div class=" col-md-3 well">
	<legend><span class="fa fa-lock"></span>&nbsp;Inactive Accounts</legend>
	No.of account: <?php echo $vm->user->inactive;?>
	</div>
	<div class=" col-md-3 well">
	<legend><span class="fa fa-list-alt"></span>&nbsp;Admin Accounts</legend>
	No.of account: <?php echo $vm->auth->admin;?>
	</div>
	<div class=" col-md-3 well">
	<legend><span class="fa fa-list-alt"></span>&nbsp;Client Accounts</legend>
	No.of account: <?php echo $vm->auth->client;?>
	</div>
</div>
<div class="row">
	<div class="account_grid_div">
		<div class="col-md-offset-3 col-md-6">
			<legend><span class="fa fa-list-alt"></span>&nbsp;Account Records</legend>
			<div class="row">
			<?php
				$this->widget(
				    'booster.widgets.TbButton',
				    array(
				    	'id' => 'add_account_btn',
				        'label' => 'Add Account',
				        'icon' => 'fa fa-plus',
				        'context' => 'primary',
				    )
				);
			?>
			</div>
			<div class="row">
			<?php
				$this->renderPartial('_grid_account', array(
					'vm' => $vm,
				));
			?>
			</div>
		</div>
	</div>
		<div class="col-md-offset-3 col-md-6">
	<div class="account_form_div" style="display: none;">
			<legend><span class="fa fa-plus"></span>&nbsp;<span class="form_title">Add Account</span></legend>
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
				$this->renderPartial('_form_account', array(
					'vm' => $vm,
				));
			?>
		</div>
	</div>
</div>

<!-- SCRIPTS -->

<?php
	$account_save = Yii::app()->createUrl( "account/save" );
	$get_account_info = Yii::app()->createUrl( "account/getaccountinfo" );
	$activate_account = Yii::app()->createUrl( "account/activate" );
	$success = 'success';
	$error = 'error';

   Yii::app()->clientScript->registerScript('account_script', "

	$('.save_account_btn').toggle(false);
   	$('.update_account_btn').toggle(false);
   
   // fucntions
   
   	function resetAccountForm()
   	{
   		$('#User_user_id').val('');
   		document.getElementById('formAccount').reset();
   	}

   	function showAddAccountForm()
   	{
   		resetAccountForm();
   		$('.form_title').html('Add Account');
   		$('.save_account_btn').toggle(true);
   		$('.update_account_btn').toggle(false);
   		$('.account_grid_div').toggle(false);
   		$('.account_form_div').toggle(true);
   	}

   	function showAccountGrid()
   	{
   		resetAccountForm();
   		$('.account_grid_div').toggle(true);
   		$('.account_form_div').toggle(false);
   		$('.save_account_btn').toggle(false);
   		$('.update_account_btn').toggle(false);
   	}

   	function showViewAccount()
   	{
   		$('.form_title').html('Update Account');
   		$('.save_account_btn').toggle(false);
   		$('.update_account_btn').toggle(true);
		$('.auth').toggle(false);
   		$('.account_grid_div').toggle(false);
   		$('.account_form_div').toggle(true);
   	}

   	function getAccountInfo(id)
   	{
   		resetAccountForm();
   		$.ajax({
            type: 'POST',
            url: '{$get_account_info}',
            data: {'user':id},
            dataType:'json',
            success: function(data){
                var json = data;

                var user_data = json.retMessage;
					
					
                
				for(var field_name in user_data)
					{
						var field_val = user_data[field_name];
						var form_field = document.getElementsByName('User[' + field_name + ']');
					
						for (var i=0;i<form_field.length;i++) {
							form_field[i].value = field_val;
						}
						renderImage();
					}
				}
        })
   	}

	function activate(id)
   	{
		$.ajax({
            type: 'POST',
            url: '{$activate_account}',
            data: {'user':id},
            dataType:'json',
            success: function(data){
                var json = data;
				
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
					showAccountGrid();
					resetAccountForm();
	            }
	            else if(json.retVal == '{$error}')
	            {
	                $.notify(json.retMessage, json.retVal);
	            }
				
			}
        })
		
	}

	function saveAccount()
	{
		$.ajax({
	        type        : 'POST',
	        url         : '{$account_save}',
	        data        : $('#formAccount').serialize(),
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
					showAccountGrid();
					resetAccountForm();
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
		$('#account-grid').yiiGridView('update', {
			type:'POST',
			data: $(this).serialize()
		});
		return false;
	}
	
	function readImage()
	{
		var preview = document.querySelector('#acc_img');
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
	
	function renderImage()
	{
		var preview = document.querySelector('#acc_img');
		var uri = $('#img_uri').val();

		if(uri == '')
		{
			uri = './images/user.png';
		}


		preview.src = uri;
	}
	
	
	// end fucntion 
   	
	$().ready(function() {
		$('#formAccount').validate({
			debug: true,
			success: 'valid',
			submitHandler: function() {
				saveAccount();
			}
		});

		$('#User_username').rules('add', {
			required:true,
			minlength:3,
			messages : {
				required : 'Username Required',
			}
		});
		$('#User_password').rules('add', {
			equalTo: '#User_confirm_password',
			messages : {
				equalTo : 'Password Dont Match',
			}
		});
		$('#User_confirm_password').rules('add', {
			equalTo: '#User_password',
			messages : {
				equalTo : 'Password Dont Match',
			}
		});
		$('#User_email').rules('add', {
			email: true,
		});
		$('#User_first_name').rules('add', {
			minlength:3,
		});
		$('#User_surname').rules('add', {
			minlength:3,
		});
		$('#User_department').rules('add',{
			required: true,
			messages : {
				required : 'Choose Department',
			}
		 });
	});

    $(document).on('click', '#add_account_btn', function(){
    	showAddAccountForm();
    });

    $(document).on('click', '#back_btn', function(){
    	showAccountGrid();
    });

    $(document).on('click', '.view_account_btn', function(){
    	var id = $(this).attr('ref');

    	getAccountInfo(id);
    	showViewAccount();
    });
	$(document).on('click', '.activate_account_btn', function(){
    	var id = $(this).attr('ref');
		activate(id);

    });

    $(document).on('change','#file',function() {
		readImage();
    });
	
	
   ");   
   
?>