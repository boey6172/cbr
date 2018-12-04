<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - User';
$this->breadcrumbs=array(
	'User',
);
?>
<h1>User</h1>
<div id="submenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
                array('label'=>'Logout', 'url'=>array('/site/logout')),
                array('label'=>'Password', 'url'=>array('/user/changeown')),
			
			),
		)); ?>
</div>