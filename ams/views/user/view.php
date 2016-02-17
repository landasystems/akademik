<?php
$this->setPageTitle('Lihat Users | ID : ' . $model->id);
$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->name,
);
?>

<?php
if (landa()->checkAccess('User.Index','r')) {
    $this->beginWidget('zii.widgets.CPortlet', array(
        'htmlOptions' => array(
            'class' => ''
        )
    ));
    $this->widget('bootstrap.widgets.TbMenu', array(
        'type' => 'pills',
        'items' => array(
            array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create',array('type'=>$type)), 'linkOptions' => array()),
            array('label' => 'Daftar', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl($type), 'linkOptions' => array()),
            array('label' => 'Edit', 'icon' => 'icon-edit', 'url' => Yii::app()->controller->createUrl('update', array('id' => $model->id,'type'=>$type)), 'linkOptions' => array()),
            array('label' => 'Print', 'icon' => 'icon-print', 'url' => 'javascript:void(0);return false', 'linkOptions' => array('onclick' => 'printDiv();return false;')),
    )));

    $this->endWidget();
}
?>
<div class='printableArea'>

</div>
<style type="text/css" media="print">
    body {visibility:hidden;}
    .printableArea{visibility:visible;} 
</style>
<script type="text/javascript">
    function printDiv()
    {

        window.print();

    }
</script>
<div class="well">


    <table width="100%" border="0" class="table">
        <tr>

            <td width="30%" rowspan="7" align="left" valign="top" > <?php
                $img = Yii::app()->landa->urlImg('avatar/', $model->avatar_img, $model->id);
                echo '<img src="' . $img['medium'] . '" alt="" class="image"  /> ';
                ?></td>
            <td width="10%" align="left" valign="top">Nama </td>
            <td width="1%" align="left" valign="top">:</td>
            <td width="36%" align="left" valign="top"><?php echo $model->name; ?></td>
            <td width="36%" align="right" valign="top"><em class="box"></td>
        </tr>
        <tr>
            <td align="left" valign="top">Username</td>
            <td align="left" valign="top">:</td>
            <td colspan="2" align="left" valign="top"><?php echo $model->username; ?></td>
        </tr>
        <tr>
            <td align="left" valign="top">Alamat</td>
            <td align="left" valign="top">:</td>
            <td colspan="2" align="left" valign="top"><?php echo $model->address; ?></td>
        </tr>
        <tr>
            <td align="left" valign="top">Kab/Kota</td>
            <td align="left" valign="top">:</td>
            <td colspan="2" align="left" valign="top"><?php echo $model->City->name; ?></td>
        </tr>


        <tr>
            <td align="left" valign="top">Phone</td>
            <td align="left" valign="top">:</td>
            <td colspan="2" align="left" valign="top"><?php echo $model->phone; ?></td>
        </tr>
        <tr>
            <td align="left" valign="top">Email</td>
            <td align="left" valign="top">:</td>
            <td colspan="2" align="left" valign="top"><?php echo $model->email; ?></td>
        </tr>
        <tr>

            <td colspan="4" align="left" valign="top">
                <?php
                echo '<i>"' . $model->description . '"</i>';
                ?>
            </td>
        </tr>

    </table>
    <h2>Your Document</h2><br>





    <ul class="nav nav-tabs" id="myTab">

        <li class="active"><a  href="#document">Your Document</a></li>
        <li><a href="#result">Your Result</a></li>
        <li><a href="#exam">Your Exam</a></li>
    </ul>
    <div class="tab-content">

        <div class="tab-pane active" id="document">

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
                        'htmlOptions' => array('style' => 'width: 35px;')
                    ),
                ),
            ));
            ?>                          

        </div>

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
                        'header'=>'Exam Category',
                        'value' => '$data->examCat',
                        'type' => 'raw'
                    ),
                    array(
                        'name' => 'exam_id',
                        'header'=>'Nama Ujian',
                        'value' => '$data->examName',
                        'type' => 'raw'
                    ),
                    'result',
//                    'created',
                ),
            ));
            ?>  


        </div>

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
                        'value' => '$data->urlExamDet',
                        'type' => 'raw'
                    ),
                    array(
                        'class' => 'bootstrap.widgets.TbButtonColumn',
                        'template' => '{update} {delete}',
                        'buttons' => array(
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

        </div>


    </div>
</div>
