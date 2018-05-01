<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
  <!-- alerts -->





    <!-- alerts -->

<div class="content">

<div class="emak-academy">

<?php // echo Yii::app()->user->getFlash('ErrorMsg'); ?>
<?php


if(Yii::app()->user->hasFlash('ErrorMsg') )
{
	?>

	  <div class="alert alert-error">
     <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Error !</strong> <?php echo Yii::app()->user->getFlash('ErrorMsg'); ?>.
    </div>

	<?

}

?>

<p>Please fill out the following form with your login credentials:</p>
<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'login-form',
'enableClientValidation'=>true,
'clientOptions'=>array(
	'validateOnSubmit'=>true,
),
)); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'username' ,array('class'=>'log-label')); ?>
		<?php echo $form->textField($model,'username' ,array('class'=>'log-txt')  ); ?>
		<?php echo $form->error($model,'username' ,array('class'=>'log-error')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password' ,array('class'=>'log-label')); ?>
		<?php echo $form->passwordField($model,'password' ,array('class'=>'log-txt')); ?>
		<?php echo $form->error($model,'password' ,array('class'=>'log-error')); ?>
	</div>
<div class="left-log">
	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe',array('class'=>'log-label')); ?>
		<?php echo $form->label($model,'rememberMe',array('class'=>'log-label')); ?>
		<?php echo $form->error($model,'rememberMe' ,array('class'=>'log-error')); ?>
	</div>

</div>
	<div class="buttons">
		<?php echo CHtml::submitButton('Login' ,array('class'=>'btn btn-large btn-danger')); ?>
	</div>
<span class="required">&nbsp;</span>


<?php $this->endWidget(); ?>
