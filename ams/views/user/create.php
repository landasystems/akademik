<?php
$this->setPageTitle('Tambah Users');
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);
if ($type == "student") {
    $url = Yii::app()->controller->createUrl('user/student');
} else {
    $url = Yii::app()->controller->createUrl('user');
}
?>

<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create',array('type'=>$type)),'active'=>true, 'linkOptions'=>array()),
                array('label'=>'Daftar', 'icon'=>'icon-th-list', 'url'=>$url, 'linkOptions'=>array()),
		array('label'=>'Pencarian', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
	),
));
$this->endWidget();
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>