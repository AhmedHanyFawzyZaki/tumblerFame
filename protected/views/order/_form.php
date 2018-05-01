<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'order-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical'
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'status_id',CHtml::listData(OrderStatus::model()->findAll(),'id','title'),array('class'=>'span2')); ?>
    
    <?php echo $form->dropDownListRow($model,'user_id',CHtml::listData(User::model()->findAll(),'id','username'),array('class'=>'span3')); ?>
    
    <?php echo $form->dropDownListRow($model,'package_id',CHtml::listData(Package::model()->findAll(),'id','title'),array('class'=>'span3')); ?>

	<?php //echo $form->textFieldRow($model,'token',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span2','append'=>'$')); ?>
    
    <div class="control-group ">
        <?php echo $form->labelEx($model, 'order_time', array('class' => 'control-label')) ?>
        <div class="controls">
            <?php
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model, //Model object
                'attribute' => 'order_time', //attribute name
                'language' => '',
                'mode' => 'datetime', //use "time","date" or "datetime" (default)
                'options' => array(
                    "dateFormat" => "yy-mm-dd",
                    'changeMonth' => 'true',
                    'changeYear' => 'true',
                    'showOtherMonths' => true, // Show Other month in jquery
                ), // jquery plugin options
                'htmlOptions' => array(
                    'class' => 'span4',
                ),
            ));
            ?>
        </div>
    </div>
    
    <?php //echo $form->textFieldRow($model,'order_time',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
