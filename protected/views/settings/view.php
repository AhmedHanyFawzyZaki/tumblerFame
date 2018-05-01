<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Update Settings','url'=>array('index','id'=>$model->id)),
);
?>

<h1>View Settings #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(

		'email',
		'plug_points',
		'follow_points',
		'featured_follow_points',
		'referral_points',
		'replug_period',
                array(
		'name'=>'image',
		'type'=>'raw',
		'value'=>CHtml::image(Yii::app()->request->baseUrl.'/media/'.$model->image,"No Set",array('width'=>200)),
		),
		//'video',
		/*'website',
		'google',
		'twitter',
		'pinterest',
		'support_email',
		
		'facebook',
		'paypal_email',*/
	),
)); ?>
