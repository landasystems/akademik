<?php
$this->setPageTitle('Lihat Roles | ID : '. $model->id);
$this->breadcrumbs=array(
	'Roles'=>array($type),
	$model->name,
);
?>

<?php
$stype = ($type == 'user') ? 'index' : $type;
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
//		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create', array('type' => $type)), 'linkOptions'=>array()),
                array('label'=>'Daftar', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl($stype), 'linkOptions'=>array()),
                array('label'=>'Edit', 'icon'=>'icon-edit', 'url'=>Yii::app()->controller->createUrl('update',array('id'=>$model->id,'type' => $type)), 'linkOptions'=>array()),
		//array('label'=>'Pencarian', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
		array('label'=>'Print', 'icon'=>'icon-print', 'url'=>'javascript:void(0);return false', 'linkOptions'=>array('onclick'=>'printDiv();return false;')),

)));
$this->endWidget();
?>
<div class='printableArea'>


 <div class="box">
                    <div class="title">

                        <h4>
                            <span ></span>
                            <span></span>
                        </h4>
                        <a href="#" class="minimize" style="display: none;">Minimize</a>
                        
                    </div>
                    
                    <div class="content">
                        <div class="you">
                                    <ul class="list-unstyled" style="list-style:none;">
                                        <li><h3>Name &nbsp;:&nbsp;<?php echo $model->name; ?></h3></li>
                                        <?php 
                                        $status = ($model->is_allow_login == 0) ? "<span class=\"label label-important\">No</span>" :
                                            "<span class=\"label label-info\">Yes</span>";
                                        echo'<li><h3>Is Allow Login &nbsp;:&nbsp;'.$status.'</h3></li>';
                                        ?>
                                        
                                    </ul>
                            
                                </div>
                        <hr>
                        <?php
                        if($model->is_allow_login == 1){
                        ?>
                <table class="table">
                <thead>
                    <tr>
                        <th>Module/ Fitur</th>
                        <th>Read</th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $arrMenu = Auth::model()->modules();
                    $mAuth = Auth::model()->findAll(array('index' => 'id', 'select' => 'id,crud'));

                    foreach ($arrMenu as $arr) {
                        if (isset($arr['visible']) && $arr['visible'] == false) {
                            //do nothing
                        } else {
                            if (isset($arr['auth_id'])) {
                                //check the module have access or not
                                $r = '';
                                $c = '';
                                $u = '';
                                $d = '';
                                if (isset($mAuth[$arr['auth_id']]->crud)) {
                                    $arrAuth = json_decode($mAuth[$arr['auth_id']]->crud, true);
                                    $r = (isset($arrAuth['r']) && $arrAuth['r'] == 1) ? CHtml::CheckBox('r', '') : '';
                                    $c = (isset($arrAuth['c']) && $arrAuth['c'] == 1) ? CHtml::CheckBox('c', '') : '';
                                    $u = (isset($arrAuth['u']) && $arrAuth['u'] == 1) ? CHtml::CheckBox('u', '') : '';
                                    $d = (isset($arrAuth['d']) && $arrAuth['d'] == 1) ? CHtml::CheckBox('d', '') : '';
                                }

                                echo '<tr>
                                    <td>' . $arr['label'] . '</td>
                                    <td>' . $r . '</td>
                                    <td>' . $c . '</td>
                                    <td>' . $u . '</td>
                                    <td>' . $d . '</td>
                                </tr>';
                            } else {
                                echo '<tr>
                                    <td colspan="5">' . $arr['label'] . '</td>
                                </tr>';
                            }


                            if (isset($arr['items'])) {
                                foreach ($arr['items'] as $arrItems) {
                                    if (isset($arrItems['visible']) && $arrItems['visible'] == false) {
                                        //do nothing
                                    } else {
                                        //check the module have access or not
                                        if (isset($arrItems['auth_id'])) {
                                            $r = '';
                                            $c = '';
                                            $u = '';
                                            $d = '';
                                            if (isset($mAuth[$arrItems['auth_id']]->crud)) {
                                                $arrAuth = json_decode($mAuth[$arrItems['auth_id']]->crud, true);
                                                $r = (isset($arrAuth['r']) && $arrAuth['r'] == 1) ? CHtml::CheckBox('r', '') : '';
                                                $c = (isset($arrAuth['c']) && $arrAuth['c'] == 1) ? CHtml::CheckBox('c', '') : '';
                                                $u = (isset($arrAuth['u']) && $arrAuth['u'] == 1) ? CHtml::CheckBox('u', '') : '';
                                                $d = (isset($arrAuth['d']) && $arrAuth['d'] == 1) ? CHtml::CheckBox('d', '') : '';
                                            }

                                            echo '<tr>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $arrItems['label'] . '</td>
                                                    <td>' . $r . '</td>
                                                    <td>' . $c . '</td>
                                                    <td>' . $u . '</td>
                                                    <td>' . $d . '</td>
                                                </tr>';
                                        } else {
                                            echo '<tr>
                                                    <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $arrItems['label'] . '</td>
                                                </tr>';
                                        }
                                    }
                                }
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
                        <?php }else{'';} ?>
                    </div>
                </div>


<script type="text/javascript">
function printDiv()
{

window.print();

}
</script>
