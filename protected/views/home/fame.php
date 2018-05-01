<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<div class="row wrapper content topMargin20">
	<div class="row topMargin10 wrapper">
    	<?php 
			$this->renderPartial('sticker');
        ?>
    	<div class="span8 width653">
        	<div class="alert alert-info alert-dismissable">
        		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            	<b>Want more followers but don't have the time to constantly replug?</b>
                <p class="topMargin10"><a href="<?=Yii::app()->request->baseUrl?>/home/getFeatured"><b><i>Get Featured</i></b></a> and let us do all the work for you, By Staying in the featured list for as many days as you purchase, no constant replugging!</p>
        </div>
            <div class="featured-blogs">
                <h5 class="hall">Top Users (Gain More Points To Be Listed In Our Hall Of Fame "<span class="red">For Free</span>")</h5>
                <div>
            	<?
				if($top_ten_users){
					foreach($top_ten_users as $t_t_u)
					{
				?>
						<div class="blogs">   	
                        	<?
								if(Helper::isFollower(Yii::app()->user->id,$t_t_u->id))
								{
									$style='';
								}
								else
								{
									$style='style="display:none;"';
								}
                            ?>
                        	<img src="<?=Yii::app()->request->baseUrl?>/images/done.png" class="followed" id="done_img_<?=$t_t_u->id?>" <?=$style?> />
                            <a href="javascript:void(0);" onclick="Follow(<?=$t_t_u->id?>,'<?=$t_t_u->username?>')">
                                <img src="<?=$t_t_u['image']?>" width="64" height="64" />
                            </a>
                            <i title="Total Earned Points (<?=$t_t_u['total_points']?>)">T.E.P (<?=$t_t_u['total_points']?>)</i>
                        </div>
                <?	
					}
				}
                ?>
            </div>
            </div>
		</div>
	</div>
</div>