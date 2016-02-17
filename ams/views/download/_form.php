<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'download-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>
    <fieldset>


        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>


        <?php
        if (landa()->checkAccess('DownloadCategory', 'd')){
        $ruleButton = ' {delete}';
    }else{
        $ruleButton = '';
    }
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'download-grid',
            'dataProvider' => $model->search(),
            'type' => 'striped bordered condensed',
            'template' => '{summary}{pager}{items}{pager}',
            'columns' => array(
                'DownloadCategory.name',
                array(
                    'name' => 'File Name',
                    'value' => '$data->url',
                    'htmlOptions' => array('style' => 'text-align: left;')
                ),
                array(
                    'header' => 'Tgl. Upload',
                    'name' => 'created',
                    'type' => 'raw',
                    'value' => 'date("d M Y, H:i",strtotime($data->created))',
                ),
                /*
                  'created_user_id',
                  'modified',
                 */
                array(
                    'value' => '"<a href=\"$data->urlFull\" class=\"btn btn-small icon-download\"></a>"',
                    'type' => 'raw',
                    'htmlOptions' => array('style' => 'width: 35px;'),
                ),
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => $ruleButton,
                    'buttons' => array(
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


<?php //echo $form->textFieldRow($model, 'name', array('class' => 'span3', 'maxlength' => 255));  ?>


<?php //echo $form->dropDownListRow($model, 'download_category_id', CHtml::listData(DownloadCategory::model()->findAll(array('order' => 'root, lft')),arr 'id', 'nestedname'), array('class' => 'span3', 'empty' => 'root'));   ?>
        <?php
        if (landa()->checkAccess('Download', 'c')) {
            echo'<div class="control-group">		
            <label class="control-label">Document</label>
            <div class="controls">';

            $this->widget('application.extensions.EAjaxUpload.EAjaxUpload', array(
                'id' => 'url',
                'config' => array(
                    'action' => Yii::app()->createUrl('download/upload/' . $model->download_category_id),
                    'allowedExtensions' => array("zip", "rar", "doc", "docx", "pdf", "ppt", "xls", "mp3", "mp4", "jpeg", "jpg", "png"), //array("jpg","jpeg","gif","exe","mov" and etc...
                    'sizeLimit' => 30 * 1024 * 1024, // maximum file size in bytes
                    'minSizeLimit' => 10 * 10 * 10, // minimum file size in bytes
                    'multiple' => false,
                //'onComplete'=>"js:function(id, fileName, responseJSON){ alert(fileName  ); }",
                //'messages'=>array(
                //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                //                  'emptyError'=>"{file} is empty, please select files again without it.",
                //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                //                 ),
                //'showMessage'=>"js:function(message){ alert(message); }"
                ),
            ));







            echo'<br/>
                <div class="well">
                    <ul>
                        <li>Untuk melakukan multiple upload file, drag foto secara bersamaan ke dalam area tombol Upload</li>
                        <li>Extensi yang diperbolehkan adalah <span class="label label-info">zip, rar, doc, docx, pdf, ppt, xls, mp3, mp4, jpeg, jpg, png</span></li>
                        <li>Thumbnail foto akan dicreate secara otomatis oleh systems</li>
                    </ul>
                </div>';
        }
        ?>
    </fieldset>

<?php $this->endWidget(); ?>

</div>
