<?php
/* @var $this UserProcessController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Processes',
);

$this->menu=array(
	array('label'=>'Create UserProcess', 'url'=>array('create')),
	array('label'=>'Manage UserProcess', 'url'=>array('admin')),
);
?>

<h1>User Processes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
