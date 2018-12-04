<br/>
<div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-primary" id="new_part_request_btn"><span class="fa fa-plus"></span> New Request</button>
    </div>
</div>
<?php

$this->widget(
    'booster.widgets.TbExtendedGridView',
    array(
        'id' => 'car_part_request_grid',
        'type' => 'striped bordered condensed',
        'dataProvider' => $vm->car_part_request->search(),
        'columns' => array(
        	array(
                'name' => '#',
                'header' => '#',
                'value' => '$row + 1',
                'htmlOptions'=>array('style'=>'width: 10px'),
            ),
            array(
                'name' => 'item_request',
                'value' => '$data->item_request',
                'header' => 'Item',
                'sortable' => false,
            ),
            array(
                'name' => 'item_qty',
                'value' => '$data->item_qty',
                'header' => 'Qty',
                'sortable' => false,
            ),
            array(
                'name' => 'item_amount',
                'value' => '$data->item_amount',
                'header' => 'Amount',
                'sortable' => false,
            ),
            array(
                'name' => 'driver',
                'value' => '$data->Driver->first_name . " " . $data->Driver->last_name',
                'header' => 'Requestor',
                'sortable' => false,
            ),
        )
    )
);

?>
