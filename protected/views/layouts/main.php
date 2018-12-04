<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="language" content="en" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/cbc-theme.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/sb-admin-2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/wizard.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css" />
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- <script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyABSSsbDOUfnTG2E_M8-6AnOMnAI1wDtU8&libraries=places'></script> -->
    <!-- <script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyABSSsbDOUfnTG2E_M8-6AnOMnAI1wDtU8&libraries=places'></script> -->
     <!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/dist/locationpicker.jquery.min.js"></script> -->
    

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-head navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-title" href="<?php echo Yii::app()->request->baseUrl; ?>"><?php echo $this->pageTitle=Yii::app()->name; ?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav right-top-links navbar-right">

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <img src=
                        <?php
                            echo (Yii::app()->user->getState('__profile_pic')) ?
                                Yii::app()->user->getState('__profile_pic') :
                                "./images/user.png";
                        ?>
                        width="30" height="30" alt="" class="img-circle"> Hi! <?= Yii::app()->user->name; ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                       <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>-->
                        <li class="divider"></li>
                        <li>
                         <?php echo CHtml::link('<i class="fa fa-sign-out fa-fw"></i> Logout',array('site/logout')); ?>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search" >
                            <div>
                                <div class="profile-section">
                                </div>
                                <div>
                                <img class="profile-image" src=
                                <?php
                                    echo (Yii::app()->user->getState('__profile_pic')) ?
                                        Yii::app()->user->getState('__profile_pic') :
                                        "./images/user.png";
                                ?>
                                alt="">
                                <h4 class="text-center">Hi! <?= Yii::app()->user->name; ?></h4>
                                <br/>
                                </div>
                            </div>
                        </li>
                        <li <?php echo (Yii::app()->user->checkAccess('rxClient')) ? '' : 'class="hidden"' ; ?>>
                            <a href="<?php echo Yii::app()->createUrl('client/index'); ?>"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
                        <li <?php echo (Yii::app()->user->checkAccess('rxAdmin')) ? '' : 'class="hidden"' ; ?>>
                            <a href="<?php echo Yii::app()->createUrl('admin/index'); ?>"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
						<!--
                        <li <?php echo (Yii::app()->user->checkAccess('rxAdmin')) ? '' : 'class="hidden"' ; ?>>
                            <a href="<?php echo Yii::app()->createUrl('driver/admin'); ?>"><i class="fa fa-user-circle-o fa-fw"></i> Drivers</a>
                        </li>
						-->

                        <!-- Commented -->
                        <!-- 
                        <li>
                            <a href="<?php //echo Yii::app()->createUrl('admin/index'); ?>"><i class="fa fa-home fa-fw"></i> Admin</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-address-card-o fa-fw"></i> Reservation<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <?php echo CHtml::link('Create Reservation',array('reservation/createreservation')); ?>
                                </li>
                                <li>
                                    <?php echo CHtml::link('View Reservation',array('reservation/viewreservation')); ?>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-gears fa-fw"></i> Maintenance<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <?php echo CHtml::link('Cars',array('maintenance/car')); ?>
                                </li>
                                <li>
                                    <?php echo CHtml::link('Drivers',array('driver/maintenance')); ?>
                                </li>
                                <li>
                                    <?php echo CHtml::link('Departments',array('department/maintenance')); ?>
                                </li>
                                <li>
                                    <?php echo CHtml::link('Accounts',array('account/maintenance')); ?>
                                </li>
                            </ul>
                        </li>
                        -->
                        <li style="display:none;" class="open-if-mobile">
                          <a href="#"><i class="fa fa-user fa-fw"></i> User Profile<span class="fa arrow"></span></a>
                          <ul class="nav nav-second-level">
                              <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                              </li>
                              <li class="divider"></li>
                              <li>
                               <?php echo CHtml::link('<i class="fa fa-sign-out fa-fw"></i> Logout',array('site/logout')); ?>
                              </li>
                          </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <?php echo $content; ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/Moment.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/metisMenu.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/sb-admin-2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/additional-methods.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/parsley.min.js"></script>

</body>
</html>

<?php
$this->widget('ext.widgets.loading.LoadingWidget');
Yii::app()->clientScript->registerScript('loading', "
        $('a, button').click(function() {
            // event.stopPropagation();
            Loading.show();
            // return true;
			Loading.hide();
        });

    ");

?>
