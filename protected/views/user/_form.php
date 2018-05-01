<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'type'=>'horizontal',
	'htmlOptions' => array(	'enctype' => 'multipart/form-data'),

)); ?>

	<script>
		$(document).ready(function() {
            var dd=$('#User_groups_id').val();
			passwordChange(dd);
        });
		function passwordChange(val)
		{
			if(val=='6')
			{
				$('#pass_id').css('display','block');
				$('#credit_id').css('display','none');
			}
			else
			{
				$('#pass_id').css('display','none');
				$('#credit_id').css('display','block');
			}
		}
	</script>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<?php
		echo " <div class=\"control-group \">
		<label for=\"UserDetails_city\" class=\"control-label\">User Group</label>
				 <div class=\"controls\">";
		echo   $form->dropDownList($model,'groups_id',Groups::model()->getGroups(),array('onchange'=>'passwordChange(this.value)'));
		echo "</div> </div>";
    
    ?>


	<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>50)); ?>
    
    <div id="pass_id">
    	<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>90)); ?>
    </div>
    
    <div id="credit_id">
		<?php
        //if($model->isNewRecord != '1' and ( $model->groups_id==0 or $model->groups_id==1  ) )
        //{
            echo $form->textFieldRow($model,'user_credit',array('class'=>'span5','maxlength'=>255,'readonly'=>'readonly','append'=>' $') ) ;
    
        //}
        ?>
    
    <?php echo $form->textFieldRow($model,'total_points',array('class'=>'span5')); ?>
    
    <?php echo $form->textFieldRow($model,'today_points',array('class'=>'span5')); ?>
    
    <?php echo $form->textFieldRow($model,'plugs',array('class'=>'span5')); ?>
    
    <?php echo $form->textFieldRow($model,'referrals',array('class'=>'span5')); ?>
    
    <?php echo $form->textFieldRow($model,'today_follows',array('class'=>'span5')); ?>
    
    <?php echo $form->textFieldRow($model,'total_follows',array('class'=>'span5')); ?>
    
    <div class="control-group">
        <div class="control-label">
            <?php echo $form->labelEx($model, 'featured_time')?>
        </div>
        <div class="controls">
			<?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute' => 'featured_time',
                    'options' => array(
                        'showAnim' => 'fold',
                        'dateFormat' => 'dd-mm-yy',
                    ),
                    'htmlOptions' => array(
                        'size' => '16',
                        'style' => 'cursor:pointer;'
                    ),
                ));
            //echo $form->textFieldRow($model,'featured_time',array('class'=>'span5')); ?>
        </div>
    </div>

    <?
		if($model->image)
		{
	?>
            <div class="control-group ">
                <label for="User_Image" class="control-label">Image</label>
                <div class="controls">
                    <img src="<?=$model->image?>">
                </div>
            </div>
    <?
		}
    ?>
    </div>


	<?php //echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'fname',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'lname',array('class'=>'span5','maxlength'=>255)); ?>

	<?php /*echo $form->fileFieldRow($model,'image');


	if($model->isNewRecord != '1')
	{
		echo " <div class=\"control-group \"> <div class=\"controls\">";


		echo 	CHtml::image(Yii::app()->request->baseUrl.'/media/members/'.$model->image,'image',array('width'=>200));

		echo "</div></div>";
	}*/



	 ?>




	<?php //echo $form->textAreaRow($model,'details',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php
/*
echo $form->dropDownListRow($model, 'groups_id',array('6' => 'Admin', '4' => 'EHR linked admin',
															 '3' => 'Company',
															 '3' => 'Company\'s Employee ',
															 '0' => 'Trainer',
															 '1'=>'Vendor'

															 ));
*/

	  //echo  "<div class=\"controls\">". $form->dropDownList($model,'groups_id',Groups::model()->getGroups())."</div>";


	?>






	<?php //echo $form->checkboxRow($model,'active'); ?>



	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
