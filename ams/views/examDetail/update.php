<?php
$this->setPageTitle('Ujian | '. $modelExam->name);
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
//		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array()),
                array('label'=>'Daftar', 'icon'=>'icon-th-list', 'url'=>url('exam'), 'linkOptions'=>array()),
                array('label'=>'Preview Soal', 'icon'=>'entypo-icon-search-2', 'url'=>url('exam/'.$model->exam_id), 'linkOptions'=>array()),
                array('label'=>'Hapus Soal', 'icon'=>'cut-icon-trashcan', 'url'=>Yii::app()->controller->createUrl('delete', array('id'=>$_GET['id'], 'exam_id'=>$modelExam->id)), 'linkOptions'=>array()),
//                array('label'=>'Edit', 'icon'=>'icon-edit', 'url'=>Yii::app()->controller->createUrl('update',array('id'=>$model->id)),'active'=>true, 'linkOptions'=>array()),
	),
));
$this->endWidget();
?>  

<?php echo $this->renderPartial('_form',array('model'=>$model, 'modelExam'=>$modelExam, 'modelExamDetail'=>$modelExamDetail)); ?>