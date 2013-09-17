<?php
/* @var $this UserProcessController */
/* @var $model UserProcess */

$this->breadcrumbs=array(
	'User Processes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserProcess', 'url'=>array('index')),
	array('label'=>'Create UserProcess', 'url'=>array('create')),
	array('label'=>'View UserProcess', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserProcess', 'url'=>array('admin')),
);
?>

<h1>Update UserProcess <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>