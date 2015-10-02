<?php
$this->setPageTitle('Lihat SMS | ID : ' . $model->id);
$this->breadcrumbs = array(
    'User Messages' => array('index'),
    $model->id,
);
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
        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => url('sms/create'), 'linkOptions' => array(), 'visible' => landa()->checkAccess('Sms', 'c')),
        array('label' => 'Daftar', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'linkOptions' => array()),
        array('label' => 'Outbox', 'icon' => 'icomoon-icon-comments-4', 'url' => Yii::app()->controller->createUrl('outbox'), 'linkOptions' => array()),
        array('label' => 'Detail', 'icon' => 'icon-edit', 'url' => Yii::app()->controller->createUrl('view', array('id' => $model->id)), 'active' => true, 'linkOptions' => array()),
)));
$this->endWidget();
?>
<div class="alert alert-warning">
    <table>
        <tr>
            <td><b>Sent To </b> : </td>
            <td>
                <?php
                $name = '';
                $listUserPhone = User::model()->listUserPhone();
                $listRoles = Roles::model()->listRoles();
                if ($model->type == "group") {
                    $opponents = json_decode($model->type_roles_ids);
                    foreach ($opponents as $value) {
                        $sRoles = (isset($listRoles[$value])) ? $listRoles[$value]->name : '';
                        echo '<span class="label label-info"> ' . $sRoles . ' </span> ';
                    }
                    echo "<hr style='margin:5px'>";
                }


                if (!empty($model->type_phones)) {
                    $opponents = json_decode($model->type_phones);
                    foreach ($opponents as $key => $value) {
                        $name = (isset($listUserPhone[$value])) ? ucwords(strtolower($listUserPhone[$value]['name'])) . ' ('.landa()->hp($value).')' : '-';
                        echo '<span class="label label-warning"> ' . $name . ' </span> ';
                    }
                } else {
                    if ($model->type == "phone") {
                        if (strlen($model->phone) < 6)
                            $prefix = "";
                        else
                            $prefix = "+62";
                        $name = $prefix . $model->phone;
                        echo '<span class="label label-warning"> ' . $name . ' </span> ';
                    } else {
                        $name = (isset($listUserPhone[$model->phone]['name'])) ? ucwords(strtolower($listUserPhone[$model->phone]['name'])) : '';
                        echo '<span class="label label-warning"> ' . $name . ' </span> ';
                    }
                }
                ?>

            </td>
        </tr>   
    </table>
</div>
<div id="history">
    <div id="historyContent">
        <div class="box">
            <div class="title">
                <h4>
                    <span class="icon-envelope"></span>
                    <span>Detail Pesan</span>
                    <span class="box-form right">
                        <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="icon16 iconic-icon-cog"></span>
                            <span class="caret"></span>
                        </a>
                        <!--                        <div class="btn-group">
                                                    <a class="btn btn-mini" id="btnBack" href="#"><i class="icon-circle-arrow-left"></i></a>
                                                    <a class="btn btn-mini" id="btnTrash" href="#"><i class="icon-trash"></i></a>
                                                </div>-->
                    </span>
                </h4>
            </div>
            <div class="content noPad">
                <ul class="messages">
                    <li class="sendMsg">
                        <?php
                        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id' => 'user-message-form',
                            'enableAjaxValidation' => false,
                            'method' => 'post',
                            'type' => 'horizontal',
                            'htmlOptions' => array(
                                'enctype' => 'multipart/form-data'
                            )
                        ));
                        ?>   

                        <?php
                        echo Chtml::textArea('Sms[last_message]', '', array("placeholder" => "Your text ...", 'style' => 'width:99%', 'rows' => '5',));
                        ?>

                        <?php
                        if (!empty($model->type_phones)) {
                            $opp = $model->type_phones;
                        } else {
                            $opp = $model->phone;
                        }
                        ?>
                        <?php echo CHtml::hiddenField('user_id_opp', $opp); ?>
                        <?php echo CHtml::hiddenField('type', $model->type); ?>
                        <?php echo CHtml::hiddenField('type_roles_ids', $model->type_roles_ids); ?>
                        <div class="row-fluid marginT10">
                            <?php
                            echo CHtml::ajaxButton(
                                    'Send Message', url('sms/createDetail'), array(
                                'type' => 'POST',
                                'success' => 'function( data )
                                        {
                                          $(".nextMessage").replaceWith(data);
                                          $("#Sms_last_message").val("");  
                                          $("#infoMess").html(calcMessage($("#Sms_last_message").val()));
                                        }',
                                    ), array('class' => 'btn btn-primary')
                            ); 
                           ?>
                            <span class="help-inline" id="infoMess"></span>
                        </div>
                        <?php $this->endWidget() ?>
                    </li>
                    <?php
                    $criteria = new CDbCriteria;
                    $criteria->addCondition('sms_id=' . $model->id);
                    $criteria->order = 'id DESC';
                    $total = SmsDetail::model()->count();

                    $pages = new CPagination($total);
                    $pages->pageSize = 10;
                    $pages->applyLimit($criteria);

                    $userMessageDetails = SmsDetail::model()->findAll($criteria);

                    echo $this->renderPartial('_view', array('model' => $model, 'userMessageDetails' => $userMessageDetails, 'pages' => $pages, 'opp' => $model->phone, 'phone' => $model->phone, 'listUserPhone' => $listUserPhone));
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

