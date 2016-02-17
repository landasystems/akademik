<?php
$this->setPageTitle('Jadwal Ujian');


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('test-grid', {
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
        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array(), 'visible' => landa()->checkAccess('Test', 'c')),
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

if (landa()->checkAccess('Test', 'r'))
    $buton .= '{statistic}{view}';

if (landa()->checkAccess('Test', 'u'))
    $buton .= '{update} ';

if (landa()->checkAccess('Test', 'd'))
    $buton .= '{delete}';

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'test-grid',
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'template' => '{summary}{pager}{items}{pager}',
    'columns' => array(
        array(
            'header' => 'Kelas',
            'type' => 'raw',
            'name' => 'classroom_id',
            'value' => '$data->Classroom["name"]',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),
        array(
            'header' => 'Created By',
            'type' => 'raw',
            'name' => 'created_user_id',
            'value' => '$data->User["name"]',
        ),
        array(
            'header' => 'Soal',
            'type' => 'raw',
            'name' => 'exam_id',
            'value' => '$data->Exam["name"]',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),
        'name',
        array(
            'name' => 'date_test',
            'type' => 'raw',
            'value' => '"$data->keterangan"',
            'htmlOptions' => array('style' => 'text-align: center;'),
            'headerHtmlOptions' => array('text-align' => 'center'),
//            'value' => '"<img src=\"$data->imgUrl[\\"medium\\"]\" class="image"/>"', 
//            'value' => 'aa', 
        ),
//        'description',
        array(
            'name' => 'created',
            'header' => 'Date',
            'type' => 'raw',
            //'value'=>'date("d M Y",strtotime($data["work_date"]))'
            'value' => 'Yii::app()->dateFormatter->format("d MMM y",strtotime($data->date_test))'
        ),
        'time_start',
        'time_end',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => $buton,
            'buttons' => array(
                'statistic' => array(
                    'options' => array(
                        'class' => 'btn btn-small  brocco-icon-stats'
                    )
                ),
                'view' => array(
                    'label' => 'Lihat',
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

