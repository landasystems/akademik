<?php
$this->setPageTitle('Lihat Soal');
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
        array('label' => 'Daftar', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'linkOptions' => array()),
        array('label' => 'Edit', 'icon' => 'icon-edit', 'url' => Yii::app()->controller->createUrl('update', array('id' => $model->id)), 'linkOptions' => array(), 'visible' => landa()->checkAccess('Exam', 'u')),
)));
$this->endWidget();
?>
<div class='printableArea'>
    <div class="well">
        <div class="page-header">
            <center> <table >
                    <tr >
                        <td align="center"><center><h2> <?php echo $model->ExamCategory->name ?></h2>
                        <h3>Mata Pelajaran: <?php echo $model->name ?></h3>
                        <h3>Jumlah Soal : <?php echo $model->total ?></h3>
                        <h3>Waktu : <?php echo $model->period ?> menit</h3></center></td>
                    </tr>

                </table>
            </center>
        </div>


        <table>
            <?php
            $soal = ExamDetail::model()->findAll(array('condition' => 'exam_id=' . $model->id, 'order' => 'number asc'));

            foreach ($soal as $key => $o) {
                $A = '';
                $B = '';
                $C = '';
                $D = '';
                $E = '';
                $F = '';
                $pilihan = json_decode($o->answer, true);
                if (!empty($pilihan['A'])) {
                    if ($o->correct=='A') {
                        $A = '<span style="text-decoration: underline;">A.&nbsp;' . $pilihan['A'] . '</span><br/>';
                    } else {
                        $A = 'A.&nbsp;' . $pilihan['A'] . '<br/>';
                    }
                }
                if (!empty($pilihan['B'])) {
                    if ($o->correct=='B') {
                        $B = '<span style="text-decoration: underline;">B.&nbsp;' . $pilihan['B'] . '</span><br/>';
                    } else {
                        $B = 'B.&nbsp;' . $pilihan['B'] . '<br/>';
                    }
                }
                if (!empty($pilihan['C'])) {
                    if ($o->correct=='C') {
                        $C = '<span style="text-decoration: underline;">C.&nbsp;' . $pilihan['C'] . '</span><br/>';
                    } else {
                        $C = 'C.&nbsp;' . $pilihan['C'] . '<br/>';
                    }
                }
                if (!empty($pilihan['D'])) {
                    if ($o->correct=='D') {
                        $D = '<span style="text-decoration: underline;">D.&nbsp;' . $pilihan['D'] . '</span><br/>';
                    } else {
                        $D = 'D.&nbsp;' . $pilihan['D'] . '<br/>';
                    }
                }
                if (!empty($pilihan['E'])) {
                    if ($o->correct=='E') {
                        $E = '<span style="text-decoration: underline;">E.&nbsp;' . $pilihan['E'] . '</span><br/>';
                    } else {
                        $E = 'E.&nbsp;' . $pilihan['E'] . '<br/>';
                    }
                }
                if (!empty($pilihan['F'])) {
                    if ($o->correct=='F') {
                        $F = '<span style="text-decoration: underline;">F.&nbsp;' . $pilihan['F'] . '</span><br/>';
                    } else {
                        $F = 'F.&nbsp;' . $pilihan['F'] . '<br/>';
                    }
                }
//        $B = $pilihan['B'];
//        $C = $pilihan['C'];
//        $D = $pilihan['D'];
//        $E = $pilihan['E'];
//        $F = $pilihan['F'];
                echo
                '
      <tr>
      <td rowspan="" align="left" valign="top"><b>' . $o->number . '.</b></td>
      <td>' . $o->question . '
          ' . $A . '
          ' . $B . '
          ' . $C . '
          ' . $D . '
          ' . $E . '
          ' . $F . '
          </td>
      </tr>';

//      echo'<tr>
//      <td>E.&nbsp;'.$E.'</td>
//      </tr>';
//      echo'<tr>
//      <td>F.&nbsp;'.$F.'</td>
//      </tr>';
            }
            ?>
        </table>
    </div>
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
