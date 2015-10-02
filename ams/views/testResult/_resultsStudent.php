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
                    <td>' . $name . '</td>';

            $col = 4;
            foreach ($test as $oTest) {
                if (isset($arrTestResult[$oTest->id][$o->user_id])) {
                    $linkActivated = ($arrTestResult[$oTest->id][$o->user_id]['is_fix']) ?
                            '<span class="label label-success" style="margin-left:10px"><i class="icon-ok icon-white"></i></span>' :
                            CHtml::ajaxLink(
                                    $text = '<span class="label label' . $arrTestResult[$oTest->id][$o->user_id]['id'] . '" style="margin-left:10px"><i class="icon-ok icon-white"></i></span>', $url = url('testResult/updateFix', array('id' => $arrTestResult[$oTest->id][$o->user_id]['id'])), $ajaxOptions = array(
                                'type' => 'POST',
//                                    'dataType' => 'json',
                                'success' => 'function(data){ 
                                            $("#user' . $o->user_id . ' .label").removeClass("label-success"); 
                                            $(".label' . $arrTestResult[$oTest->id][$o->user_id]['id'] . '").addClass("label-success"); 
                                        }'), $htmlOptions = array()
                    );
                    $linkDelete = CHtml::ajaxLink(
                                    $text = '<span class="label label-warning" style="margin-left:2px"><i class="icon-trash icon-white"></i></span>', $url = url('testResult/delete', array('id' => $arrTestResult[$oTest->id][$o->user_id]['id'])), $ajaxOptions = array(
                                'type' => 'POST',
                                'success' => 'function(data){ 
                                            $("#user' . $o->user_id . ' td:nth-child(' . $col . ')").html("-"); 
                                        }'), $htmlOptions = array()
                    );

                    $linkView = '<a href="' . url('testResult/view', array('id' => $arrTestResult[$oTest->id][$o->user_id]['id'])) . '"><span class="label label-info" style="margin-left:2px"><i class="icon-eye-open icon-white"></i></span></a>';
                    echo '<td><b>' . $arrTestResult[$oTest->id][$o->user_id]['result'] . '</b>' . $linkActivated . $linkDelete . $linkView .'</td>';
                } else {
                    echo '<td><b>-</b></td>';
                }
                $col++;
            }

            echo '</tr>';
        }
        ?>
    </tbody>
</table>