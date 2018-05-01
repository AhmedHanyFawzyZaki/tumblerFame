<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<!--<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-grid',
	'type'=>'striped  condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(

		'username',
		//'email',
		//'fname',
		//'lname',

		'groups_id'=>array(// display 'author.username' using an expression
                        'name'=>'groups_id',
                       'value'=>'$data->usergroup->group_title',
                        'filter'=> Groups::model()->getgroups(),
                    ),
		'featured_time',

		/*
		'image',
		'details',
		'group',
		'active',
		'user_details_id',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
