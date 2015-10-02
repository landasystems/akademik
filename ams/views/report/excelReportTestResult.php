<table border="1">
    <tr>
        <th>Tahun ajaran : </th>
        <td><?php echo $class->SchoolYear->school_year ?></td>
        <th>Ujian Kategori : </th>
        <td><?php echo $exam->ExamCategory->name ?></td>
    </tr>
    <tr>
        <th>Kelas : </th>
        <td><?php echo $class->name ?></td>
        <th>Ujian : </th>
        <td><?php echo $exam->name ?></td>
    </tr>
</table><br>
<table class="table table-bordered" border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>User / Student</th>
            <th>Nilai</th>
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
                    <td style="width:30%">' . $no . '</td>
                    <td>' . $code . '</td>
                    <td>' . $name . $o->user_id . '</td>';

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

