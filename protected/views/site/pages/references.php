<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Reference Maintenance';
$this->breadcrumbs=array(
	'Reference Tables',
);
?>
<h1>Reference Tables</h1>
<div id="submenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
            /*
				array('label'=>'Departments', 'url'=>array('/departments/admin')),
				array('label'=>'Metro Branches', 'url'=>array('/metroBranches/admin')),
				array('label'=>'Provincial Branches', 'url'=>array('/provincialBranches/admin')),
				array('label'=>'Institutions', 'url'=>array('/institutions/admin')),
				array('label'=>'Countries', 'url'=>array('/countryBranches/admin')),
				array('label'=>'Mail Types', 'url'=>array('/mailTypes/admin')),
				array('label'=>'Messengers', 'url'=>array('/couriers/admin')),
				array('label'=>'General Mail Status', 'url'=>array('/generalStatus/admin')),
				array('label'=>'Detailed Mail Status', 'url'=>array('/mailStatus/admin')),
                
             */
             
				array('label'=>'Users', 'url'=>array('/user')),
				array('label'=>'Roles', 'url'=>array('/rbam')),
			),
		)); ?>
</div>