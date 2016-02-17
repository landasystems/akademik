<?php
$this->setPageTitle('Sms');
$this->breadcrumbs = array(
    'Sms',
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
        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array(),'visible' => landa()->checkAccess('Sms', 'c')),
        array('label' => 'Daftar', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'active' => true, 'linkOptions' => array()),
        array('label' => 'Outbox', 'icon' => 'icomoon-icon-comments-4', 'url' => Yii::app()->controller->createUrl('outbox'), 'linkOptions' => array()),
        array('label' => 'Pencarian', 'icon' => 'icon-search', 'url' => '#', 'linkOptions' => array('class' => 'search-button')),
        
        array('label' => 'Export ke Excel', 'icon' => 'icon-download', 'url' => Yii::app()->controller->createUrl('GenerateExcel'), 'linkOptions' => array('target' => '_blank'), 'visible' => true),
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

<style>
    .notice {
    background:#eeeeee;
}
</style>    
<?php
$buton="";
if(landa()->checkAccess('Sms', 'r')){
   $buton .= '{view}'; 
}
if(landa()->checkAccess('Sms', 'd')){
   $buton .= '{delete}'; 
}
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'sms-grid',
    'dataProvider' => $model->search(),
    'type' => ' bordered condensed',
    'template' => '{summary}{pager}{items}{pager}',
    'columns' => array(
        array(
            'header' => 'Type',
            'name' => 'type',
            'type' => 'raw',
            'value' => '"$data->tagImg"',
            'htmlOptions' => array('style' => 'text-align: center; text-align:center;'),
            'headerHtmlOptions' => array('style' => 'text-align: center;'),
            'cssClassExpression' => '($data["is_read"]==0) ? "notice" : ""',
        ),
        array(
            'name' => 'phone',
            'type' => 'raw',
            'header' => 'Contact',
            'value' => '"$data->name"',
            'cssClassExpression' => '($data["is_read"]==0) ? "notice" : ""',
        ),        
        array(
            'name'=>'last_date',
            'header'=>'Date',
            'type'=>'raw',
            'value'=>'"$data->tgl"',
            'htmlOptions' => array('class' => 'span3'),
            'cssClassExpression' => '($data["is_read"]==0) ? "notice" : ""',
        ),
        array(
            'name'=>'last_message',
            'header'=>'Message',
            'type'=>'raw',
            'value'=>'"$data->Message"',
            'htmlOptions' => array('class' => 'span4'),
            'cssClassExpression' => '($data["is_read"]==0) ? "notice" : ""',
        ),
        array(
            'name'=>'count_message',
            'header'=>'Count Message',
            'type'=>'raw',
            'value'=>'"$data->TotalMessage"',
            'htmlOptions' => array('class' => 'span2'),
            'cssClassExpression' => '($data["is_read"]==0) ? "notice" : ""',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'cssClassExpression' => '($data["is_read"]==0) ? "notice" : ""',
            'template' => $buton,
            'buttons' => array(
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
            'htmlOptions' => array('style' => 'width: 85px'),
        )
    ),
));
?>

