<br/>
<div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-primary" id="new_gas_request_btn"><span class="fa fa-plus"></span> New Request</button>
    </div>
</div>

<?php

$this->widget(
    'booster.widgets.TbExtendedGridView',
    array(
        'id' => 'car_gas_request_grid',
        'type' => 'striped bordered condensed',
        'dataProvider' => $vm->car_gas_request->search(),
        'columns' => array(
        	array(
                'name' => '#',
                'header' => '#',
                'value' => '$row + 1',
                'htmlOptions'=>array('style'=>'width: 10px'),
            ),
            array(
                'name' => 'gas_volume',
                'value' => '$data->gas_volume',
                'header' => 'Volume',
                'sortable' => false,
            ),
            array(
                'name' => 'gas_amount',
                'value' => '$data->gas_amount',
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
