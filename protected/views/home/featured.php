<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<div class="row wrapper content topMargin20">
	<div class="row topMargin10 wrapper">
    	<?php 
			//$this->renderPartial('sticker');
        ?>
        <div class="wrapper width653 mrgauto">
            <h2 class="text-center">Choose From The Available Packages To Be Famous And Get Featured Fast & Easy!</h2>
        </div>
    	
        <div class="padd30">
        	<?
				foreach($packages as $package)
				{
            ?>
            		<div class="featured-pack">
                        <p class="bg-success">
                            <span class="pay-day-num"><span class="white-class"><?=$package->valid_for?></span> Days </span>
                        </p>
                        <div class="pay-pack">
                            <span class="pay-day-num">$<span class="red-class"><?=$package->price?></span></span>
                            <h2 class="payh2">Pay Safe And Fast Using</h2>
                            <img src="<?=Yii::app()->request->baseUrl?>/images/paypal.png"  class="topMargin20">
                            <form method="post" action="<?=Yii::app()->request->baseUrl?>/home/checkout">
                                <input type="hidden" name="id" value="<?=$package->id?>">
                                <label class="topMargin20">
                                    <input type="submit" value="Buy Now" class="pay-btn">
                                </label>
                            </form>
                        </div>
                    </div>
            <?
				}
            ?>
        </div>
	</div>
</div>