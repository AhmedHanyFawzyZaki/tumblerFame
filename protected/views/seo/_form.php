<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'seo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'page_name',array('class'=>'span5','maxlength'=>255,'readonly'=>'readonly')); ?><br><br>

	<?php echo $form->textAreaRow($model,'meta_tags',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
        
        <p style="color:red;">(Please split tags with comma ",")</p><br><br>

	<?php echo $form->textAreaRow($model,'meta_description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php //echo $form->textFieldRow($model,'meta_author',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
