<?php
/* @var $this UserProcessController */
/* @var $model UserProcess */

$this->breadcrumbs=array(
	'User Processes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserProcess', 'url'=>array('index')),
	array('label'=>'Manage UserProcess', 'url'=>array('admin')),
);
?>

<h1>Create UserProcess</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>