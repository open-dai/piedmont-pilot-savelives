<?php
/* @var $this UserProcessController */
/* @var $model UserProcess */

$this->breadcrumbs=array(
	'User Processes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserProcess', 'url'=>array('index')),
	array('label'=>'Create UserProcess', 'url'=>array('create')),
	array('label'=>'Update UserProcess', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserProcess', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserProcess', 'url'=>array('admin')),
);
?>

<h1>View UserProcess #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_code',
		'process',
	),
)); ?>
