<?php

$this->pageTitle=Yii::app()->name . ' -'. $pages->title;
?>
<div class="row wrapper content topMargin20">
	<div class="row topMargin10 wrapper">
		<div class="wrapper width653 mrgauto">
            <h2 class="text-center"><?= $pages->title ;?></h2>
        </div>
        <div class="txt padd">
        	<img class="pull-right leftMargin20" width="300" src="<?=Yii::app()->request->baseUrl?>/media/<?php echo $pages->image?>" />
        	<?php echo $pages->details;  ?>
        </div>
    </div>
</div>