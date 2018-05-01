<?php
$this->breadcrumbs=array(
	'Seos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pages Seo','url'=>array('index')),
	//array('label'=>'Create Seo','url'=>array('create')),
	array('label'=>'View Page Seo','url'=>array('view','id'=>$model->id)),
	//array('label'=>'Manage Seo','url'=>array('admin')),
);
?>

<h1>Update Seo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>