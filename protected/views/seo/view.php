<?php
$this->breadcrumbs=array(
	'Seos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Pages Seo','url'=>array('index')),
	//array('label'=>'Create Seo','url'=>array('create')),
	array('label'=>'Update Page Seo','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Page Seo','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Seo','url'=>array('admin')),
);
?>

<h1>View (<?php echo $model->page_name; ?>) Seo</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'page_name',
		'meta_tags',
		'meta_description',
		//'meta_author',
	),
)); ?>
