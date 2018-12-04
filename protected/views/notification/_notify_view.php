<?php

	$this->widget(
	    'booster.widgets.TbPanel',
	    array(
	        'title' => $vm->notification->title . ' - ( ' . date("M d, Y h:i A", strtotime($vm->notification->saved_date)) . ' )',
	        'headerIcon' => 'fa fa-sticky-note',
	        'content' => 'Hello Mr/Mrs ' . $vm->notification->User->first_name . ',<br/><br/><p>' . $vm->notification->content . '</p>',
	    )
	);

?>