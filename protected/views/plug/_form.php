<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'plug-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'user_id',CHtml::listData(User::model()->findAll(),'id','username'),array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'content',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'plug_time',array('class'=>'span5','maxlength'=>255,'readonly'=>true)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
