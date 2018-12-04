<?php 

echo CHtml::openTag('div', array('class' => 'row-fluid'));
$this->widget(
    'booster.widgets.TbThumbnails',
    array(
    	'id' => 'car-results',
        'dataProvider' => $vm->car->availableCars(),
        'template' => "{items}\n{pager}",
        'itemView' => '_carview',
    )
);
echo CHtml::closeTag('div');

?>