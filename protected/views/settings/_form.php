<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'website',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255)); ?>
    <?php echo $form->textFieldRow($model,'plug_points',array('class'=>'span5','maxlength'=>255)); ?>
    <?php echo $form->textFieldRow($model,'follow_points',array('class'=>'span5','maxlength'=>255)); ?>
    <?php echo $form->textFieldRow($model,'featured_follow_points',array('class'=>'span5','maxlength'=>255)); ?>
    <?php echo $form->textFieldRow($model,'referral_points',array('class'=>'span5','maxlength'=>255)); ?>
    <?php echo $form->textFieldRow($model,'replug_period',array('class'=>'span5','maxlength'=>255,'append'=>'minutes')); ?>
        
        <?php echo $form->fileFieldRow($model,'image',array('class'=>'span5','maxlength'=>255));

	if($model->isNewRecord != '1' and $model->image!='')
	{
		echo "<p>". Chtml::image(Yii::app()->baseUrl.'/media/'.$model->image ,'image',array('width'=>200)) ."</p>";

	}
	 ?>
	<?php //echo $form->textFieldRow($model,'support_email',array('class'=>'span5','maxlength'=>255)); ?>
	<?php //echo $form->textFieldRow($model,'paypal_email',array('class'=>'span5','maxlength'=>255)); ?>
	<?php //echo $form->textFieldRow($model,'facebook',array('class'=>'span5','maxlength'=>255)); ?>



	<?php //echo $form->textFieldRow($model,'google',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'twitter',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'pinterest',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php //echo $form->textFieldRow($model,'video',array('class'=>'span5','maxlength'=>255)); ?>



	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
