<?php  // set the page title


$this->pageTitle=Yii::app()->name . ' -'. $pages->title;
?>

<div class="content">
<div class="emak-academy">

<h2><?= $pages->title ;?></h2>

<?php echo $pages->details;  ?>

</div>

</div>