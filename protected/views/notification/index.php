<h1>Notifications</h1>

<div class="well">
	<?php

		$this->renderPartial('_notification_grid', array(
			'vm'=>$vm,
		));

	?>
</div>

<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'viewNotificationModal')
); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Notification</h4>
</div>

<div class="modal-body">
    Loading . . . .
</div>

<div class="modal-footer">
    <?php $this->widget(
        'booster.widgets.TbButton',
        array(
            'label' => 'Close',
            'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        )
    ); ?>
</div>
<?php $this->endWidget(); ?>

<?php
    $viewnotify  = Yii::app()->createUrl( "notification/viewnotify" );
    $success = 'success';
    $error = 'error';
    $defaultSecond = 0;

    Yii::app()->clientScript->registerScript('classstudent', "

        var totalSeconds = '{$defaultSecond}';

        setInterval(setTime, 1000);

        function setTime()
        {
            if(totalSeconds == 10)
            {
                totalSeconds = 0;
                $('#notification-grid').yiiGridView('update', {
                    data: $(this).serialize()
                });
            }
            else
            {
                ++totalSeconds;
            }
        }

        $(document).on('click', '.view_btn', function(){

        	var values = {
              'notification' : $(this).attr('ref'),
            }

            $.ajax({
                type        : 'POST', 
                url         : '{$viewnotify}',
                data        : values,
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#viewNotificationModal .modal-body').html(json.retMessage);
                        $('#viewNotificationModal').modal();
                    }
                    else if(json.retVal == '{$error}')
                    {
                        $.notify(json.retMessage, json.retVal);
                    }
                }
            })

        });

    ");
?>