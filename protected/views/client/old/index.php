<h2>Dashboard</h2>
<div class="well">
<?php
	$this->widget(
	    'booster.widgets.TbTabs',
	    array(
	        'type' => 'tabs',
	        'justified' => true,
	        'tabs' => array(
                array(
                    'id' => 'reservation',
                    'active' => true,
                    'label' => 'Create Reservation',
                    'content' => '<div class="well"><div class="row"><div class="col-md-12">' . 
                                $this->renderPartial('/reservation/createreservation', array(
                                    'vm'=>$vm,
                                ), true) . 
                                '</div></div></div>'
                ),
	        	array(
					'id' => 'notification',
					'label' => 'Notifications',
	                'content' => $this->renderPartial('_notification_grid', array(
	                				'vm'=>$vm,
	                			 ), true),
				),
				array(
					'id' => 'history',
					'label' => 'History',
	                'content' => $this->renderPartial('_history_grid', array(
                                    'vm'=>$vm,
                                ), true),
				),
	        )
	    )
	);
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

<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'viewHistoryModal')
); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>History</h4>
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
    $viewhistory = Yii::app()->createUrl( "client/viewhistory" );
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

        $(document).on('click', '.view_history_btn', function(){

            var values = {
              'history' : $(this).attr('ref'),
            }

            $('#viewHistoryModal').modal();

            $.ajax({
                type        : 'POST', 
                url         : '{$viewhistory}',
                data        : values,
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#viewHistoryModal .modal-body').html(json.retMessage);
                        $('#viewHistoryModal').modal();
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