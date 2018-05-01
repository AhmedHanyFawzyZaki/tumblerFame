<?php
$this->breadcrumbs=array(
	'Plugs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Plug','url'=>array('index')),
	//array('label'=>'Create Plug','url'=>array('create')),
	array('label'=>'Update Plug','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Plug','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Plug','url'=>array('admin')),
);
?>

<h1>View Plug #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		'content',
		'plug_time',
	),
)); ?>
