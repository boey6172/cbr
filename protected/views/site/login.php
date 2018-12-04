<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/sb-admin-2.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/cbc-theme.css" />


</head>
<body>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<canvas id="granim-canvas"></canvas>

<div class="container">

	<div class="row">
    <div class="col-md-4 col-md-offset-4" ">
		<div class="login-card card">
			<div class="panel-heading">
				<div class="profile-section" style="background-image: url(./images/pexels-drive.jpg);">
					<div class="heading-title">
						<h3 class="pulla-center">CHINABANK RIDE</h3>
						<h4></h4>
					</div>
				</div>

			</div>
			<div class="panel-body">
      <form role="form">
        <label>Username</label>
        <?php echo $form->textField($vm->model,'username', array('tabindex'=>'1', 'class'=>'form-control', 'value'=>'', 'autocomplete'=>'off')); ?>
        <?php echo $form->error($vm->model,'username'); ?>
			<br>
        <label>Password</label>
        <?php echo $form->passwordField($vm->model,'password', array('tabindex'=>'2', 'class'=>'form-control', 'value'=>'')); ?>
        <?php echo $form->error($vm->model,'password'); ?>

			<br>
        <!--<?php echo $form->checkBox($vm->model,'rememberMe', array('tabindex'=>'3')); ?> Remember me
        <?php if ($vm->model->scenario == 'withCaptcha' && CCaptcha::checkRequirements()): ?>-->
      <!-- Captcha section-->
      <div>
        <?php $this->widget('CCaptcha'); ?>
        <?php //echo $form->labelEx($vm->model, 'verifyCode'); ?>
        <?php echo $form->textField($vm->model, 'verifyCode',array('class'=>'input-style',"placeholder" => 'Verification Code', "autocomplete"=>'off')); ?>
      </div>

      <?php echo $form->error($vm->model, 'verifyCode'); ?> <?php endif; ?>
			<br/>
				<!--<?php echo CHtml::submitButton('Login', array('tabindex'=>'4', 'class'=>'pull-right cus_btn btn-primary', 'value'=>'Log In')); ?>-->
				                                <?php echo CHtml::Button('Proceed', array('class' => 'pull-right cus_btn btn-primary', 'id'=> 'login_btn')); ?>

                                <?php echo $form->hiddenField($vm->model,'ucrypt',array()); ?>
                                <?php echo $form->hiddenField($vm->model,'pcrypt',array()); ?>
				<?php $this->endWidget(); ?>
      <br />
			</form>
			</div>
			<!--<div class="panel-footer text-right">Don't have an account? <?php echo CHtml::link('Sign up',array(URL_SIGNUP)); ?></div>-->
		</div>
	</div>
</div>
</div>


	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/granim.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/CryptoJS v3.1.2/rollups/aes.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/CryptoJS v3.1.2/rollups/pbkdf2.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-3.2.1.min.js"></script>
	
<script type="text/javascript">
var granimInstance = new Granim({
    name: 'main-gradient',
    element: '#granim-canvas',
     direction: 'radial',
    isPausedWhenNotInView: true,
    opacity: [1, 1],
    stateTransitionSpeed: 1000,
    states : {
        "default-state": {
            gradients: [
                ['#d50000', '#d32f2f'],
                ['#b71c1c', '#d32f2f'],
                ['#f44336', '#ef5350']
            ],
        },
    }
});
</script>
    <script type="text/javascript">

        var u = $('#LoginForm_username');
        var p = $('#LoginForm_password');

        var uc = $('#LoginForm_ucrypt');
        var pc = $('#LoginForm_pcrypt');

        u.val('');
        p.val('');

        function encryptLogin()
        {

            var key = CryptoJS.enc.Hex.parse('<?php echo $vm->key_string; ?>');
            var iv = CryptoJS.enc.Hex.parse('<?php echo $vm->iv_string; ?>');

            var ue = CryptoJS.AES.encrypt(u.val(), key, {iv : iv});
            ue = ue.ciphertext.toString(CryptoJS.enc.Base64);
            var pe = CryptoJS.AES.encrypt(p.val(), key, {iv : iv});
            pe = pe.ciphertext.toString(CryptoJS.enc.Base64);

            uc.val(ue);
            pc.val(pe);

            u.val('');
            p.val('');

            $('#login-form').submit();
        }

        $(document).on('click','#login_btn',function() {
            encryptLogin();
        });

        u.keydown(function (event) {
            var keypressed = event.keyCode || event.which;
            if (keypressed == 13) {
                encryptLogin();
            }
        });

        p.keydown(function (event) {
            var keypressed = event.keyCode || event.which;
            if (keypressed == 13) {
                encryptLogin();
            }
        });

    </script>
</body>
</html>
