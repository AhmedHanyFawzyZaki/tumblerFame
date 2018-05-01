<?
	$user=User::model()->findByPk(Yii::app()->user->id);
	if($user->image=='')
	{
		$user->image=Yii::app()->request->baseUrl.'/images/admin.jpg';
	}
?>
<div class="span3 profile" id="sticker">
    <div class="avatar">
        <img src="<?=$user->image?>" width="96" height="96" />
    </div>
    <div class="prof-info">
        <strong> WELCOME BACK!</strong><br>
        <span id="stick_points">Points: <?=$user->total_points?></span><br>
        <span>Referrals: <?=$user->referrals?></span><br>
        <span id="stick_follows">Follows: <?=$user->total_follows?></span><br>
        <span id="stick_plugs">Plugs: <?=$user->plugs?></span><br>
    </div>
    <div class="prof-ref">
        <br />
        <strong>Your Referral Code:</strong>
        <input type="text" value="<?=Yii::app()->request->getBaseUrl('webroot')?>?ref=<?=$user->username?>" />
        <span>+<?=Yii::app()->params['referral_points']?> points for every referral!</span>
    </div>
    <div class="prof-share">
        <script type="text/javascript">var switchTo5x=true;</script>
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">stLight.options({publisher: "6269aa7f-a4c0-4854-9b77-73e1f74d5a30", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
        <br>
        <span class='st_facebook_large' displayText='Facebook'></span>
        <span class='st_twitter_large' displayText='Tweet'></span>
        <span class='st_linkedin_large' displayText='LinkedIn'></span>
        <span class='st_pinterest_large' displayText='Pinterest'></span>
        <span class='st_tumblr_large' displayText='Tumblr'></span>
        <span class='st_sharethis_large' displayText='ShareThis'></span>
    </div>
    <div class="prof-follow text-center">
        <span><strong id="today_overall_follows"><?=Helper::TodayFollowers();?></strong> Follows Today</span><br>
        <span><strong id="total_overall_follows"><?=Helper::TotalFollowers()?> </strong> Follows Since Launch</span>
    </div>
</div>