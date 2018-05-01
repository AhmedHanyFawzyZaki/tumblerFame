<?php
$this->breadcrumbs=array(
	'Plugs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Plug','url'=>array('index')),
	//array('label'=>'Manage Plug','url'=>array('admin')),
);
?>

<h1>Create Plug</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>