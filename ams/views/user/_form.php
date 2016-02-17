<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'User-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>
    <fieldset>
        <legend>
            <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
        </legend>

        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>
        <div class="clearfix"></div>

        <?php // if (user()->checkAccess('User.*')) {  ?>
        <div class="box">
            <div class="title">
                <h4>
                    <?php
                    $listakses = ($_GET['type']=='student') ? array(2 => 'Murid') : array(1 => 'Guru', 2 => 'Murid');                   
                    
                    echo 'Hak Akses Sebagai<span class="required">*</span> :    ';
                    if ($model->id == User()->id) { //if same id, cannot change role it self
                        $listRoles = Roles::model()->listRoles();
                        if (User()->roles_id == -1) {
                            echo 'Super User';
                        } elseif (isset($listRoles[User()->roles_id])) {
                            echo $listRoles[User()->roles_id]['name'];
                        }
                    } else {
                        echo CHtml::dropDownList('User[roles_id]', $model->roles_id, $listakses, array(
                            'ajax' => array('url' => url('user/AllowLogin'),
                                'type' => 'POST',
                            ),
                        ));
                    }
                    ?>                     
                </h4>
            </div>
        </div>
        <?php // }  ?>
        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#personal">Info Login</a></li>
            <li><a href="#public">Info Diri</a></li>
            <li><a href="#parent">Info Orang Tua</a></li>
            <?php if (!($model->isNewRecord)) { ?><li><a href="#document">Dokumen</a></li><?php } ?>
            <?php if (!($model->isNewRecord)) { ?><li><a href="#result">Riwayat Ujian</a></li><?php } ?>
            <?php if (!($model->isNewRecord)) { ?><li><a href="#exam">List Soal</a></li><?php } ?>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="personal">
                <table>
                    <tr>
                        <td width="300">
                            <?php
//                            $accessSaldo = in_array('saldo', param('menu'));
//                          $imgs = '';
                            $cc = '';
                            if ($model->isNewRecord) {
                                $img = Yii::app()->landa->urlImg('', '', '');
                            } else {
                                $img = Yii::app()->landa->urlImg('avatar/', $model->avatar_img, $_GET['id']);
                                $del = '<div class="btn-group photo-det-btn">';
                                $imgs = param('urlImg') . '350x350-noimage.jpg';
                                $cc = CHtml::ajaxLink(
                                                '<i class="icon-trash">Remove Photo</i>', url('user/removephoto', array('id' => $model->id)), array(
                                            'type' => 'POST',
                                            'success' => 'function( data )
                                                    {
                                                           $("#my_image").attr("src","' . $imgs . '");
                                                           $("#yt0").fadeOut();
                                                    }'), array('class' => 'btn btn-large btn-block btn-primary', 'style' => 'width: 360px;font-size: 15px;')
                                        )
                                        . '</div>';
                            }
                            echo '<img src="' . $img['medium'] . '" alt="" class="image img-polaroid" id="my_image"  /> ';
                            echo $cc;
                            ?>

                            <br><br><div> <?php echo $form->fileFieldRow($model, 'avatar_img', array('class' => 'span3', 'label' => false)); ?></div>
                        </td>

                        <td style="vertical-align: top;">
                            <?php echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 20)); ?>
                            <?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 100)); ?>
                            <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span3', 'maxlength' => 255, 'hint' => 'Fill the password, to change',)); ?>
                            <?php echo $form->toggleButtonRow($model, 'enabled'); ?> 
                            <?php echo $form->textFieldRow($model, 'code', array('class' => 'span5', 'maxlength' => 25)); ?>
                            <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?> 
                            
                        </td>

                    </tr>
                </table>

            </div> 
            <div class="tab-pane" id="public">
                <div class="control-group ">
                    <?php
                    echo CHtml::activeLabel($model, 'province_id', array('class' => 'control-label'));
                    ?>
                    <div class="controls">
                        <?php
                        echo CHtml::dropDownList('province_id', $model->City->province_id, CHtml::listData(Province::model()->findAll(), 'id', 'name'), array(
                            'empty' => t('choose', 'global'),
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => CController::createUrl('landa/city/dynacities'),
                                'update' => '#User_city_id',
                            ),
                        ));
                        ?>  
                    </div>
                </div>


                <?php echo $form->dropDownListRow($model, 'city_id', CHtml::listData(City::model()->findAll('province_id=:province_id', array(':province_id' => (int) $model->City->province_id)), 'id', 'name'), array('class' => 'span3')); ?>


                <?php echo $form->textAreaRow($model, 'address', array('class' => 'span5', 'maxlength' => 255)); ?>

                <?php
                echo $form->textFieldRow(
                        $model, 'phone', array('prepend' => '+62')
                );
                ?>
            </div>  
            <?php if (user()->roles_id == 2) { ?>
                <div class="tab-pane" id="parent">
                    <?php
                    if ($model->isNewRecord == false) {
                        $other = json_decode($model->others, true);
                        echo'<div class="control-group">
                    <label class="control-label" for="inputEmail">Parents Name</label>
                    <div class="controls">
                        <input style="height:px;" type="text" id="User[parent_name]" name="User[parent_name]" placeholder="Parent Name" value="' . $other['parent_name'] . '">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputEmail">Parents Number</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">+62</span>
                            <input class="span2" id="prependedInput" type="text" placeholder="Parent Number" name="User[parent_number]" value="' . $other['parent_number'] . '">
                        </div>
                    </div>
                </div>';
                    } else {
                        ?>
                        <div class="control-group">
                            <label class="control-label" for="inputEmail">Parents Name</label>
                            <div class="controls">
                                <input style="height:px;" type="text" id="User[parent_name]" name="User[parent_name]" placeholder="Parent Name">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputEmail">Parents Number</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on">+62</span>
                                    <input class="span2" id="prependedInput" type="text" placeholder="Parent Number" name="User[parent_number]">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <?php if (!($model->isNewRecord)) { ?>
                <div class="tab-pane" id="document">

                    <?php
                    $this->widget('bootstrap.widgets.TbGridView', array(
                        'id' => 'download-grid',
                        'dataProvider' => new CActiveDataProvider(Download::model(), array('criteria' => array('condition' => 'created_user_id=' . $_GET['id']))),
                        'type' => 'striped bordered condensed',
                        'template' => '{summary}{pager}{items}{pager}',
                        'columns' => array(
                            'id',
                            'DownloadCategory.name',
                            array(
                                'name' => 'File Name',
                                'value' => '$data->url',
                                'htmlOptions' => array('style' => 'text-align: left;')
                            ),
                            'created',
                            array(
                                'value' => '"<a href=\"$data->urlFull\" class=\"btn btn-small icon-download\"></a>"',
                                'type' => 'raw',
                                'htmlOptions' => array('style' => 'width: 35px;'),
                            ),
                            array(
                                'class' => 'CLinkColumn',
                                //'header' => 'Name',
                                'linkHtmlOptions' => array("class" => "btn btn-small  icon-trash", 'label' => false),
                                'urlExpression' => 'Yii::app()->createUrl("download/delete/$data->id")',
                            ),
                        ),
                    ));
                    ?>                          

                </div>
            <?php } ?>
            <?php if (!($model->isNewRecord)) { ?>
                <div class="tab-pane" id="result">
                    <?php
                    $this->widget('bootstrap.widgets.TbGridView', array(
                        'id' => 'report-grid',
                        'dataProvider' => new CActiveDataProvider(TestResult::model(), array('criteria' => array('condition' => 'user_id=' . $_GET['id']))),
                        'type' => 'striped bordered condensed',
                        'template' => '{summary}{pager}{items}{pager}',
                        'columns' => array(
                            array(
                                'name' => 'test_id',
                                'header' => 'Mata Pelajaran',
                                'value' => '$data->examCat',
                                'type' => 'raw'
                            ),
                            array(
                                'name' => 'exam_id',
                                'header' => 'Nama Ujian',
                                'value' => '$data->examName',
                                'type' => 'raw'
                            ),
                            'result',
//                    'created',
                        ),
                    ));
                    ?>

                </div>
            <?php } ?>
            <?php if (!($model->isNewRecord)) { ?>
                <div class="tab-pane" id="exam">

                    <?php
                    $this->widget('bootstrap.widgets.TbGridView', array(
                        'id' => 'exam-grid',
                        // 'dataProvider' => $model->search(),
                        'dataProvider' => new CActiveDataProvider(Exam::model(), array('criteria' => array('condition' => 'created_user_id=' . $_GET['id']))),
                        'type' => 'striped bordered condensed',
                        'template' => '{summary}{pager}{items}{pager}',
                        'columns' => array(
                            'id',
                            //'ExamCategory.name',
                            array(
                                'name' => 'Category',
                                'value' => '$data->ExamCategory["name"]',
                                'htmlOptions' => array('style' => 'text-align: left;')
                            ),
                            'name',
                            'description',
                            'period',
                            array(
                                'value' => '"<a href=\"examDetail/create/$data->id.html\" class=\"btn btn-small brocco-icon-list\"></a>"',
                                'type' => 'raw'
                            )
                        ),
                    ));
                    ?>               

                </div>
            <?php } ?>


        </div>
</div>


<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'icon' => 'ok white',
        'label' => $model->isNewRecord ? 'Tambah' : 'Simpan',
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'reset',
        'icon' => 'remove',
        'label' => 'Reset',
    ));
    ?>
</div>
</fieldset>

<?php $this->endWidget(); ?>

</div>
