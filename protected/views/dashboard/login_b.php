<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
     
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/login/style.default.css" type="text/css" />

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/login/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/login/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/login/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/login/modernizr.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/login/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/login/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/login/custom.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#verticalForm').submit(function(){
            var u = jQuery('#username').val();
            var p = jQuery('#password').val();
            if(u == '' && p == '') {
                jQuery('.login-alert').fadeIn();
                return false;
            }
        });
    });
</script>


<div class="form">



<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
'id'=>'verticalForm',
'enableClientValidation'=>true,
'clientOptions'=>array(
	'validateOnSubmit'=>true,
),
'htmlOptions'=>array('class'=>'well'),
)); ?>




	


	<?php echo $form->textFieldRow($model, 'username', array('class'=>'inputwrapper animate1 bounceIn')); ?>



	<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'inputwrapper animate2 bounceIn')); ?>




	<?php echo $form->checkboxRow($model, 'rememberMe'); ?>


	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Login')); ?>




<?php $this->endWidget(); ?>
</div><!-- form -->

