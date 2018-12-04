<h2><span class="fa fa-home"></span> <b>Dashboard</b></h2>
<hr>

<?php echo CHtml::link( $this::faDivMenu('fa-car', 'RESERVE CAR'),array(URL_CLIENT_CAR_RESERVATION)); ?>
<!--/// echo CHtml::link( $this::faDivMenu('fa-user-o', 'RESERVE DRIVER'),array(URL_CLIENT_DRIVER_RESERVATION)); ?>-->
<?php echo CHtml::link( $this::faDivMenu('fa-list', 'RESERVATIONS'),array(URL_CLIENT_RESERVATION_LIST)); ?>


