<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pages','url'=>array('index')),
);
?>

<h1>Create Pages</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>