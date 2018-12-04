<!doctype html>
<html lang="en">
<head>
    <title>Sign  Up - Motorpool</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> </title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/chinabank-theme.css" />
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Chinabank Motorpool</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <div class="alert alert-success header">
                                        <h3>Nice, You're Registeration Has Been Sent</h3>
                                        <p>Please wait till your account approved by our admin. You're account needed to be activated.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-4">
                                        <div class="img-container">
                                            <img src=<?php echo (isset($vm->user)) ? $vm->user->profile_pic : "./images/user.png"; ?> alt="" height="150" width="150" class="img-circle" id="profile_pic">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-8">
                                        <div class="form-group">
                                            <label>Account Details</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-12">
                                                <label for="name"><b>Name</b></label>
                                                <span id="name" class="input-style"><?php echo (isset($vm->user)) ? $vm->user->first_name . " " . $vm->user->surname : "Not Found"; ?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-12">
                                                <label for="email"><b>Email</b></label>
                                                <span id="email" class="input-style"><?php echo (isset($vm->user)) ? $vm->user->email : "Not Found"; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="text-center">
                                        <?php echo CHtml::link('Login Now',array(URL_LOGIN)); ?>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</body>

</html>