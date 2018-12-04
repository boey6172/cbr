<?php
/* @var $this UserController */
/* @var $model User */

?>

<h1>Change Password<br/> for <?php echo $model->username; ?></h1>
<?php echo $this->renderPartial('_changepass', array('model'=>$model)); ?>