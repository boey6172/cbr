<h2><span class="fa fa-search"></span> <b>Search Results</b> <button class="btn_modal_search btn btn-primary pull-right"><span class="fa fa-search"></span></button></h2>
<hr>

<?php
	echo CHtml::openTag('div', array('class' => 'row-fluid'));
	$this->widget(
	    'bootstrap.widgets.TbThumbnails',
	    array(
	    	'id' => 'reservation_thumbnails',
	        'dataProvider' => $vm->reservation->search(),
	        'template' => "{items}\n{pager}",
	        'itemView' => '_reservation_thumb',
	    )
	);
	echo CHtml::closeTag('div');
?>

<!-- MODELS -->

<?php
    echo $this->alenaModal( 'modalSearch', array(
        'title' => "<span class='fa fa-search fa-lg'></span>&nbsp;<span class='modalTitle'>Search Reservation</span>",
        'body' => $this->renderPartial('_search_form', array(
        	'vm' => $vm,
        ), true),
        'footer' =>
        	CHtml::button('Search', array("id" => "search_btn", "class" => "btn btn-primary")) .
        	' ' .
        	CHtml::button('Close', array("class" => "btn", "data-dismiss"=>"modal"))
        ,
        'style' => '
        	width	: 95%;
        ',
    ));
?>

<!-- SCRIPTS -->

<?php
$client_reservation = Yii::app()->createUrl( "client/index" );
$success = 'success';
$error = 'error';

Yii::app()->clientScript->registerScript('search_reservation', "

	$(document).on('click', '.btn_modal_search', function(){
		$('#modalSearch').modal('show');
	});

	$(document).on('click', '#search_btn', function(){
		$('#search_form').submit();
	});

");

?>