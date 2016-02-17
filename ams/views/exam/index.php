<?php
$this->setPageTitle('Soal Ujian');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('exam-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<?php
$this->beginWidget('zii.widgets.CPortlet', array(
    'htmlOptions' => array(
        'class' => ''
    )
));
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills',
    'items' => array(
        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array(), 'visible' => landa()->checkAccess('Exam', 'c')),
        array('label' => 'Daftar', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'active' => true, 'linkOptions' => array()),
        array('label' => 'Pencarian', 'icon' => 'icon-search', 'url' => '#', 'linkOptions' => array('class' => 'search-button')),
    ),
));
$this->endWidget();
?>



<div class="search-form" style="display:none">
<?php
$this->renderPartial('_search', array(
    'model' => $model,
));
?>
</div><!-- search-form -->


<?php
$buton = '';

if (landa()->checkAccess('Exam', 'r'))
    $buton .= '{view}';

if (landa()->checkAccess('Exam', 'u'))
    $buton .= '{update} ';

if (landa()->checkAccess('Exam', 'd'))
    $buton .= '{delete}';

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'exam-grid',
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'template' => '{summary}{pager}{items}{pager}',
    'columns' => array(
        array(
            'header'=>'Created By',
            'name' => 'created_user_id',
            'type'=>'raw',
            'value' => '$data->User->name',
        ),
        //'ExamCategory.name',
        array(
            'header'=>'Kategori Ujian',
            'type'=>'raw',
            'name' => 'exam_category_id',
            'value' => '$data->ExamCategory["name"]',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),
        'name',
        'period',
        array(
            'value' => '$data->urlExamDet',
            'type' => 'raw'
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => $buton,
            'buttons' => array(
                'view' => array(
                    'label' => 'View',
                    'options' => array(
                        'class' => 'btn btn-small view'
                    )
                ),
                'update' => array(
                    'label' => 'Edit',
                    'options' => array(
                        'class' => 'btn btn-small update'
                    )
                ),
                'delete' => array(
                    'label' => 'Hapus',
                    'options' => array(
                        'class' => 'btn btn-small delete'
                    )
                )
            ),
            'htmlOptions' => array('style' => 'width: 125px'),
        )
    ),
));
?>

