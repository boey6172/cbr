<div class="container">
	<div class="row">
    <div class="col-md-12">
			<?php echo $this->renderPartial('_gridViewReservation', array('vm' => $vm,), true); ?>
    </div>
  </div>
</div>


<?php
    echo $this->alenaModal( 'modal_reservation', array(
        'title' => '<span style="color:red;">Warning <i class="fa fa-exclamation-triangle"></i></span>',
        'body' => "<h3>Are you sure to cancel this reservation?</h3>",
        'footer' =>
					CHtml::button('No', array("class" => "btn", "data-dismiss"=>"modal")) .
        	' ' .
        	CHtml::button('Yes', array("id" => "btn_update_reservation", "class" => "btn btn-primary"))
        ,
        // 'style' => '
        // 	width	: 50%;
        // ',
    ));
?>


<?php
$cancelReservation = Yii::app()->createUrl( "reservation/cancelreservation" );
$success = 'success';
$warning = 'warning';
$danger = 'danger';

Yii::app()->clientScript->registerScript('view_reservation', "
		var res_id;

		$(document).on('click', '#modal_cancel_reservation', function(){
			$('#modal_reservation').modal();
			res_id =  $(this).attr('data');

		});

		$(document).on('click', '#btn_update_reservation', function(){

			var values = {
							'reservation_id' : res_id
			}


			$.ajax({
					url: '{$cancelReservation}',
					type: 'POST',
					data: values,
					dataType: 'JSON',
					success     : function( data ) {
							var json = ( data );

							if(json.retVal == '{$success}')
							{
								$('#reservation-grid').yiiGridView('update', {
                                data: $(this).serialize()
                            });
								$('#modal_reservation').modal('hide');
							}
							else if(json.retVal == '{$danger}')
							{
								 alert('error');
							}
					}
			});

		});


");
?>
