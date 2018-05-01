<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Order','url'=>array('index')),
	//array('label'=>'Create Order','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('order-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Orders</h1>

<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'package_id'=>array(
			'name'=>'package_id',
			'value'=>'$data->pack->title',
			'filter'=>CHtml::listData(Package::model()->findAll(),'id','title'),
		),
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>'$data->user->username',
			'filter'=>CHtml::listData(User::model()->findAll(),'id','username'),
		),
		'status_id'=>array(
			'name'=>'status_id',
			'value'=>'$data->status->title',
			'filter'=>CHtml::listData(OrderStatus::model()->findAll(),'id','title'),
		),
		'price',
		'order_time',
		/*
		'price',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
