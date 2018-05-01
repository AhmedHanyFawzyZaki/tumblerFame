<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Pages','url'=>array('index')),
	array('label'=>'Update Pages','url'=>array('update','id'=>$model->id)),
);
?>



<h1>View - <?php echo $model->title; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(

		'title',
		//'intro',
		array(
                      'name'=>'details',
                      'type'=>'raw',
                ),
		array(
		'name'=>'image',
		'type'=>'raw',
		'value'=>CHtml::image(Yii::app()->request->baseUrl.'/media/'.$model->image,$model->title,array('width'=>250)),
		),


		/*array(
			'name'=>'video',
			 'type'=>'raw',
			  'value'=>Helper::PlayVideo($model)

			),




		array(
			'name'=>'publish',
			'type'=>'raw',
			'value'=>$model->getStatus($model->publish),
		),*/

	),
)); ?>


