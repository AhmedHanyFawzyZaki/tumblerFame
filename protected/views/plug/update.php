<?php
$this->breadcrumbs=array(
	'Plugs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Plug','url'=>array('index')),
	//array('label'=>'Create Plug','url'=>array('create')),
	array('label'=>'View Plug','url'=>array('view','id'=>$model->id)),
	//array('label'=>'Manage Plug','url'=>array('admin')),
);
?>

<h1>Update Plug <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>