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

    <?php $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
    'id'=>'signup-form',
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'POST',
    'enableAjaxValidation'=>true,
    )); ?>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sign Up</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="img-container">
                                            <img src="./images/user.png" alt="" height="150" width="150" class="img-circle" id="profile_pic">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <br/><br/><br/><br/>
                                            <?php echo $form->hiddenField($model,'profile_pic',array('class'=>'input-style', 'id'=>'img_uri')); ?>

                                            <input type="file" class="input-style" id="file" />

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->textField($model,'username',array('class'=>'input-style',"placeholder" => '*Username', 'autocomplete'=>"off", "autofocus"=>"autofocus",)); ?>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                        <?php echo $form->textField($model,'first_name',array('class'=>'input-style',"placeholder" => '*First Name', 'autocomplete'=>"off",)); ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <?php echo $form->textField($model,'surname',array('class'=>'input-style',"placeholder" => '*Last Name', 'autocomplete'=>"off",)); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <?php echo $form->textField($model,'email',array('class'=>'input-style',"placeholder" => 'Email Address', 'autocomplete'=>"off",)); ?>
                                </div>

                                <div class="form-group">
                                    <?php echo $form->passwordField($model,'password',array('class'=>'input-style',"placeholder" => '*Password', 'autocomplete'=>"off")); ?>
                                </div>
                                <?php echo CHtml::Button('Continue', array('class' => 'btn-block btn-style', 'id' => 'submit_btn')); ?>
                                <br />
                                <div>
                                    Already have an account? <?php echo CHtml::link('Log In',array(URL_LOGIN)); ?>
                                </div>
                            </fieldset>
                        </form>
                    </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</body>

<?php
    echo $this->modalDiv( 'jsonAlert', array(
        'title' => "<div class='title'></div>", 
        'body' => "<div class='body alert alert-info'></div>",
        'footer' => CHtml::button('Close', array("class" => "btn close_button", "data-dismiss"=>"modal")),
        'style' => "",
    ));    
?>

</html>

<?php
$validate = Yii::app()->createUrl($this->uniqueId . "/validate");
$profile = Yii::app()->createUrl($this->uniqueId . "/profile");

    Yii::app()->clientScript->registerScript('signup', "
        $(document).on('click','#submit_btn',function() {
            submit();
        });

        $('#signup-form').keypress(function (e) {
            if (e.which == 13) {
                submit();
            }
        });

        $(document).on('change','#file',function() {
          var preview = document.querySelector('#profile_pic');
          var file    = document.querySelector('#file').files[0];
          var reader  = new FileReader();

          reader.addEventListener('load', function () {
            preview.src = reader.result;
            $('#img_uri').val(preview.src);
          }, false);

          if (file) {
            reader.readAsDataURL(file);
          }
        });

        function submit()
        {
            $.ajax({
                type        : 'POST', 
                url         : '{$validate}',
                data        : $('#signup-form').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == 'Success')
                    {
                        window.location.href = '{$profile}&id=' + json.retMessage, '_blank';
                    }
                    else if(json.retVal == 'Warning')
                    {
                        $('#jsonAlert .title').html(json.retVal);
                        $('#jsonAlert .body').html(json.retMessage);
                        $('#jsonAlert').modal();
                    }
                }
            })
        }
    ");
?>