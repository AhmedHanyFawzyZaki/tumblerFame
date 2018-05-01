<?php
$str='';
	if(Yii::app()->controller->id=='home' && Yii::app()->controller->action->id=='faq')
	{
		$str='faq';
	}
	elseif(Yii::app()->controller->id=='home' && Yii::app()->controller->action->id=='contact')
	{
		$str='contact';
	}
	elseif(Yii::app()->controller->id=='home' && Yii::app()->controller->action->id=='page' )
	{
		$str=$_REQUEST['slug'];
	}
?>
    <div class="row  footer  topMargin15">	
        <div class="wrapper">		
			<div class="row ">
                <div class="span12 leftMargin50 white">
                    <a href="<?=Yii::app()->request->baseUrl?>/home/page/about_us" class="<?=$str=='about_us'?'active':''?>">About Us</a>&nbsp;&nbsp;
                  -&nbsp;&nbsp;<a href="<?=Yii::app()->request->baseUrl?>/home/contact"  class="<?=$str=='contact'?'active':''?>">Contact Us</a>&nbsp;&nbsp;
                  -&nbsp;&nbsp;<a href="<?=Yii::app()->request->baseUrl?>/home/page/how_it_works" class="<?=$str=='how_it_works'?'active':''?>">How It Works</a>&nbsp;&nbsp;			     
                  -&nbsp;&nbsp;<a href="<?=Yii::app()->request->baseUrl?>/home/faq"  class="<?=$str=='faq'?'active':''?>">Faq</a>&nbsp;&nbsp;
                  -&nbsp;&nbsp;<a href="<?=Yii::app()->request->baseUrl?>/home/page/privacy_policy" class="<?=$str=='privacy_policy'?'active':''?>">Privacy Policy</a>
                </div>
            </div>	
        </div>
        <br>
    </div>  
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////end row -->    
  </body>
</html>
