<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Order','url'=>array('index')),
	//array('label'=>'Create Order','url'=>array('create')),
	array('label'=>'Update Order','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Order','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Order','url'=>array('admin')),
);
?>

<h1>View Order #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'package_id'=>array(
			'name'=>'package_id',
			'value'=>$model->pack->title,
		),
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		'status_id'=>array(
			'name'=>'status_id',
			'value'=>$model->status->title,
		),
		'price',
		'order_time',
	),
)); ?>
