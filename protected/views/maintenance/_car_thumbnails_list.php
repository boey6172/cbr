<?php 

echo CHtml::openTag('div', array('class' => 'row-fluid'));
$this->widget(
    'booster.widgets.TbThumbnails',
    array(
    	'id' => 'car-results',
        'dataProvider' => $vm->car->search(),
        'template' => "{items}\n{pager}",
        'itemView' => '_car_thumnbnails_view',
    )
);
echo CHtml::closeTag('div');

?>