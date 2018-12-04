<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username,
);

?>

<h1>View "<?php echo $model->username; ?>"</h1>
<?php 
/*
    $dept = $model->Department;
    $city = $dept->City;
    $area = $city->Area;
*/
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
        'email',        
	),
)); ?>
