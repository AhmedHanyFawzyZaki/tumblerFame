<?php
$this->breadcrumbs=array(
	'Faqs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Faq','url'=>array('index')),
);
?>

<h1>Create Faq</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>