<?php
$this->breadcrumbs=array(
	'Faqs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Faq','url'=>array('index')),
	array('label'=>'Create Faq','url'=>array('create')),
	array('label'=>'Update Faq','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Faq','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Faq #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'question',
		'answer',
	),
)); ?>
