<?php
$this->breadcrumbs=array(
'Faqs'=>array('index'),
'Manage',
);

$this->menu=array(
array('label'=>'List Faq','url'=>array('index')),
array('label'=>'Create Faq','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('faq-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Faqs</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'faq-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
	'question',
	'answer',
	array(
		'class'=>'bootstrap.widgets.TbButtonColumn',
	),
),
)); ?>
