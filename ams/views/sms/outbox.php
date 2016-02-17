<?php
$this->setPageTitle('Outbox SMS');
$this->breadcrumbs = array(
    'Outbox',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('sms-grid', {
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
        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array()),
        array('label' => 'Daftar', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'),  'linkOptions' => array()),
        array('label' => 'Outbox', 'icon' => 'icomoon-icon-comments-4', 'url' => Yii::app()->controller->createUrl('outbox'),'active' => true, 'linkOptions' => array()),
//        array('label' => 'Pencarian', 'icon' => 'icon-search', 'url' => '#', 'linkOptions' => array('class' => 'search-button')),
//        
//        array('label' => 'Export ke Excel', 'icon' => 'icon-download', 'url' => Yii::app()->controller->createUrl('GenerateExcel'), 'linkOptions' => array('target' => '_blank'), 'visible' => true),
    ),
));
$this->endWidget();
?>

<div class="well">
    <ul>
        <li>List ini adalah data pesan yang belum terproses di modem (belum terkirim)</li>
        <li>Jika tidak terproses - proses list yang ada dibawah ini mohon segera menghubungi technical support</li>
    </ul>
</div>


<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'sms-grid',
    'dataProvider' => $model->outbox(),
    'type' => ' bordered condensed',
    'template' => '{items}{summary}{pager}',
    'columns' => array(        
//        'created',
//        'message',
        array(
            'name' => 'created',
            'type' => 'raw',            
            'value' => '"$data->created"',      
            'htmlOptions' => array('class' => 'span2'),
        ),        
        array(
            'header' => 'Contact',
            'name' => 'sms_id',
            'type' => 'raw',            
            'value' => '"$data->name"',            
            'htmlOptions' => array('class' => 'span2'),
        ),            
        array(
            'name' => 'message',
            'type' => 'raw',            
            'value' => '"$data->message"',      
            'htmlOptions' => array('class' => 'span10'),
        ),            
//        array(
//            'header'=>'Status',
//            'name' => 'is_process',
//            'type' => 'raw',            
//            'value' => '"Unprocess"',      
//            'htmlOptions' => array('class' => 'span2'),
//        ),          
//        array(
//            'class' => 'bootstrap.widgets.TbButtonColumn',
//            'template' => '{view} {delete}',
//            'buttons' => array(
//                'view' => array(
//                    'label' => 'Lihat',
//                    'options' => array(
//                        'class' => 'btn btn-small view'
//                    )
//                ),
//                'update' => array(
//                    'label' => 'Edit',
//                    'options' => array(
//                        'class' => 'btn btn-small update'
//                    )
//                ),
//                'delete' => array(
//                    'label' => 'Hapus',
//                    'options' => array(
//                        'class' => 'btn btn-small delete'
//                    )
//                )
//            ),
//            'htmlOptions' => array('style' => 'width: 85px'),
//        )
    ),
));
?>

