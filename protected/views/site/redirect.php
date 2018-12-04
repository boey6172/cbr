<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */


?>

<h1>Activation Needed</h1>





<p>Wait until your acount has been activated.
</p>


<h1>Redirecting in 3 seconds...</h1>


<?php
$login = Yii::app()->createUrl( "site/login" );

Yii::app()->clientScript->registerScript('login', "
window.onload = function () {
    setTimeout(function() { window.location.href= '{$login}'} , 3000);
};

");
?>
