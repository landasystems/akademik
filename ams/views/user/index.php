<?php
$this->setPageTitle('Users');
$this->breadcrumbs = array(
    'Users',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('User-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<?php
$svisible = "";
if ($type == "teacher") {
    $svisible = landa()->checkAccess('Teacher', 'c');
} elseif ($type == "student") {
    $svisible = landa()->checkAccess('Student', 'c');
} else {
    $svisible = landa()->checkAccess('User', 'c');
}
$this->beginWidget('zii.widgets.CPortlet', array(
    'htmlOptions' => array(
        'class' => ''
    )
));
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills',
    'items' => array(
        array('visible' => $svisible, 'label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create', array('type' => $type)), 'linkOptions' => array(), 'visible' => landa()->checkAccess('User', 'c')),
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
$buton = "";
if ($type == "teacher") {
    if (landa()->checkAccess('Teacher', 'r')) {
        $buton .= '{view}';
    }

    if (landa()->checkAccess('Teacher', 'u')) {
        $buton .= '{update}';
    }
    if (landa()->checkAccess('Teacher', 'd')) {
        $buton .= '{delete}';
    }
} elseif ($type == "student") {
    if (landa()->checkAccess('Student', 'r')) {
        $buton .= '{view}';
    }
    if (landa()->checkAccess('Student', 'u')) {
        $buton .= '{update}';
    }
    if (landa()->checkAccess('Student', 'd')) {
        $buton .= '{delete}';
    }
} else {
    if (landa()->checkAccess('User', 'r')) {
        $buton .= '{view}';
    }

    if (landa()->checkAccess('User', 'u')) {
        $buton .= '{update}';
    }
    if (landa()->checkAccess('User', 'd')) {
        $buton .= '{delete}';
    }
}
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'User-grid',
    'dataProvider' => $model->search($type, $roles),
    'type' => 'striped bordered condensed',
    'template' => '{summary}{pager}{items}{pager}',
    'columns' => array(
        array(
            'name' => 'Foto',
            'type' => 'raw',
            'value' => '"$data->tagImg"',
            'htmlOptions' => array('style' => 'text-align: center; width:180px;text-align:center;')
//            'value' => '"<img src=\"$data->imgUrl[\\"medium\\"]\" class="image"/>"', 
//            'value' => 'aa', 
        ),
        array(
            'name' => 'Biodata',
            'type' => 'raw',
            'value' => '"$data->tagBiodata"',
            'htmlOptions' => array('style' => 'text-align: center;')
//            'value' => '"<img src=\"$data->imgUrl[\\"medium\\"]\" class="image"/>"', 
//            'value' => 'aa', 
        ),
        array(
            'name' => 'Access',
            'type' => 'raw',
            'value' => '"$data->tagAccess"',
            'htmlOptions' => array('style' => 'text-align: center;'),
            'headerHtmlOptions' => array('text-align' => 'center'),
//            'value' => '"<img src=\"$data->imgUrl[\\"medium\\"]\" class="image"/>"', 
//            'value' => 'aa', 
        ),
        // 'id',
        // 'name',
        // 'username',
        // 'email',
        //'roles_id',
        //'enabled',
        // 'created',
//        'UserPosition.name',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => $buton,
            'buttons' => array(
                'view' => array(
                    'label' => 'Lihat',
                    'url' => 'Yii::app()->createUrl("user/view", array("id"=>$data->id,"type"=>"' . $type . '"))',
                    'options' => array(
                        'class' => 'btn btn-small view'
                    )
                ),
                'update' => array(
                    'label' => 'Edit',
                    'url' => 'Yii::app()->createUrl("user/update", array("id"=>$data->id,"type"=>"' . $type . '"))',
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

