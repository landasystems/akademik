
<a class="btn" href="<?php echo Yii::app()->controller->createUrl('report/GenerateExcelTestResult?exam_id='.$_POST['Exam']['id'].'&classroom_id='.$_POST['Classroom']['id']) ?>">
    <i class="entypo-icon-list"></i>Export to Excel</a>
<button onclick="js:printDiv();
            return false;" class="btn btn-primary">Print Hasil Ujian</button>
<hr>
<!-- ================== -->
<div class='printableArea'>
<table>
    <tr>
        <th>Tahun ajaran</th>
        <td>:</td>
        <td><?php echo $schoolyear ?></td>
        <td>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</td>
        <th>Ujian Kategori</th>
        <td>:</td>
        <td><?php echo $examCategory ?></td>
    </tr>
    <tr>
        <th>Kelas</th>
        <td>:</td>
        <td><?php echo $classroom ?></td>
        <td>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</td>
        <th>Ujian</th>
        <td>:</td>
        <td><?php echo $exam ?></td>
    </tr>
</table><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>User / Student</th>
            <?php
            foreach ($test as $o) {
                echo '<th width="100px">' . $o->name . '</th>';
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        foreach ($userClassroom as $o) {
            $no++;
            $code = isset($o->User->code) ? $o->User->code : '';
            $name = isset($o->User->name) ? $o->User->name : '';
            echo '<tr id="user' . $o->user_id . '">
                    <td>' . $no . '</td>
                    <td>' . $code . '</td>
                    <td>' . $name .  '</td>';

            foreach ($test as $oTest) {
                if (isset($arrTestResult[$oTest->id][$o->user_id])) {
                echo '<td><b>' . $arrTestResult[$oTest->id][$o->user_id]['result'] . '</b></td>';
            } else {
                echo '<td><b>-</b></td>';
            }
            }

            echo '</tr>';
        }
        ?>
    </tbody>
</table>
</div>
<style type="text/css" media="print">
    body {visibility:hidden;}
    .printableArea{visibility:visible; margin-top:  -590px; margin-left:  -220px;} 
</style>
<script type="text/javascript">
            function printDiv()
            {

                window.print();

            }
</script>
