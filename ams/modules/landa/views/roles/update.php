<?php
$this->setPageTitle('Edit Roles | ID : '. $model->id);
$this->breadcrumbs=array(
	'Roles'=>array($type),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

?>

<?php 
$stype = ($type == 'user') ? 'index' : $type;
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create',array('type'=>$type)), 'linkOptions'=>array()),
                array('label'=>'Daftar', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl($stype), 'linkOptions'=>array()),
//                array('label'=>'Edit', 'icon'=>'icon-edit', 'url'=>Yii::app()->controller->createUrl('update',array('id'=>$model->id,'type'=>$type)),'active'=>true, 'linkOptions'=>array()),
	),
));
$this->endWidget();
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>