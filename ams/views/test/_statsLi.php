<?php

if (user()->roles_id == -1 || user()->roles_id == 1)
    $modelTestResult = TestResult::model()->findAll(array('condition' => 'test_id=' . $test_id,'order'=>'correct_total DESC'));
else
    $modelTestResult = TestResult::model()->findAll(array('condition' => 'test_id=' . $test_id . ' AND time_end IS NOT NULL','order'=>'correct_total DESC'));

$no = 1;
foreach ($modelTestResult as $arr) {

    $modelTestResultDetail = TestResultDetail::model()->findAll(array('condition' => 'test_result_id=' . $arr->id));
    //if didnt finish, update the result to test result
    if (empty($arr->time_end)) {
        //checking correct or not
        $correct = 0;
        foreach ($modelTestResultDetail as $arrTRD) {
            if ($arrTRD->correct)
                $correct++;
        }

        //save 
        $arr->result = round(($correct / $arr->Test->exam_total) * $arr->Test->result_max);
        $arr->correct_total = $correct;
        $arr->save();
    }

    $resultColor = ($arr->result >= 80) ? 'progress-success' : (($arr->result >= 60) ? 'progress-warning' : 'progress-danger');
    $linkView = '<a href="' . url('testResult/view', array('id' => $arr->id)) . '"><span class="label label-info" style="margin-left:2px"><i class="icon-eye-open icon-white"></i></span></a>';

    echo '<li>
                            <b>'.$no.'.</b> '. $linkView . ' <b>' . $arr->User->name . '</b> (Terjawab ' . count($modelTestResultDetail) . ', Benar ' . $arr->correct_total . ')
                            <span class="pull-right strong">' . $arr->result . '</span>
                            <div class="progress ' . $resultColor . ' progress-striped">
                                <div class="bar" style="width: ' . $arr->result . '%;"></div>
                            </div> 
                        </li>';
    $no++;
}
?>