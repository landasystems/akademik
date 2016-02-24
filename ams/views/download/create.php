<?php
$modelCat = DownloadCategory::model()->findByPk($model->download_category_id);
$this->setPageTitle('Upload Dokumen - ' . $modelCat->name);


?>

<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
//if(landa()->checkAccess('Download.Upload')){
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
             array('label'=>'Daftar', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('downloadCategory/index'), 'linkOptions'=>array()),
	),
));
//}
$this->endWidget();
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>