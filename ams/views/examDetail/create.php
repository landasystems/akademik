<?php
$this->setPageTitle('Tambah Exam Details');
$this->breadcrumbs=array(
	'Exam Details'=>array('index'),
	'Create',
);

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
		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'),'active'=>true, 'linkOptions'=>array()),
                array('label'=>'Daftar', 'icon'=>'icon-th-list', 'url'=>bu('exam/index.html'), 'linkOptions'=>array()),
            array('label'=>'Preview Soal', 'icon'=>'entypo-icon-search-2', 'url'=>url('exam/'.$_GET['id']), 'linkOptions'=>array()),
	),
));
$this->endWidget();
?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'modelExam'=>$modelExam, 'modelExamDetail'=>$modelExamDetail)); ?>