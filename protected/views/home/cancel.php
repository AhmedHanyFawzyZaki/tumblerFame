<?
	$this->pageTitle=Yii::app()->name." Order Cancellation";
?>
<div class="row wrapper content topMargin20">
	<div class="row topMargin10 wrapper">
    	<div class="span11 featured-blogs" style="margin:15px 30px; height:435px; text-align:center;">
            <h2 style="font-size:30px;">Payment Cancellation</h2>
            <label style="color:red;">Your Payment has been cancelled</label><br><br><br><br><br><br>
            <label style="font-size:18px;font-style:italic;">The payment has been cancelled by the user, in order to <a hidden="<?=Yii::app()->request->baseUrl?>/home/getFeatured">get featured</a> and promote your blog, you have to choose one package from our available packages and complete the payment process.</label><br><br><br><br><br><br>
            <label>Thank you for using <a href="<?=Yii::app()->request->baseUrl?>"><?=Yii::app()->name?></a></label>
        </div>
    </div>
</div>