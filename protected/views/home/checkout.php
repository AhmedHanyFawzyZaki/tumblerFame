<div class="row">	
        <div class="wrapper content">
<!-- start wraper-->
            <div class="span9 topMargin20">
            	<div class="txt">
                <h3 class="topMargin30">Please  <span class="cr">fill the data</span></h3>
                </div>
                <br/>
                <div class="form_out">

                    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
						'id'=>'orders-form',
						'enableAjaxValidation'=>false,
						'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'form-horizontal'),
					)); ?>


                 <div class="control-group">
                   <label class="control-label" for="first_name">First Name</label>
                    <div class="controls">
            
            <?php echo $form->textField($model,'first_name',array('id'=>'first_name','placeholder'=>'please write your first name ...','required'=>true)); ?>
                    </div>
                    </div>
                    
                    <div class="control-group">
                    <label class="control-label" for="last_name">Last Name</label>
                    <div class="controls">
                   <!-- <input type="text" id="last_name" name="last_name" placeholder="please write your last name ...">-->
            <?php echo $form->textField($model,'last_name',array('id'=>'last_name','placeholder'=>'please write your last name ...','required'=>true)); ?>
                    </div>
                    </div>
                                                            
                    <div class="control-group">
                    <label class="control-label" for="email">E-Mail</label>
                    <div class="controls">
                 <!--   <input type="text" id="email" name="email" placeholder="please write your email ...">-->
                     <?php echo $form->textField($model,'email',array('id'=>'email','placeholder'=>'please write your email...','required'=>true)); ?>
                    </div>
                    </div>
                    
                    <div class="control-group">
                    <label class="control-label" for="address">Address</label>
                    <div class="controls">
               <!--     <input type="text" id="address" name="address" placeholder="please write your address ...">-->
                   <?php echo $form->textField($model,'address',array('id'=>'address','placeholder'=>'please write your address...','required'=>true)); ?>
                    </div>
                    </div>
                    
                    <div class="control-group">
                    <div class="controls">
                  <!--  <button type="submit" class="btn btn-primary">Submit</button>-->
                    	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Pay Now' : 'Pay Now',
			
		)); ?>
                    </div>
                    </div>
<?php $this->endWidget(); ?>
                   </div>
                <br/>
            </div>
            <div class="clear"></div>		
<!--end wraper -->	
        </div>
    </div>