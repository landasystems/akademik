<?php

class ChartController extends Controller {

    public $breadcrumbs;
    public $layout = 'main';

//    public function filters() {
//        return array(
//            'rights',
//        );
//    }
    
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // r exam report
                'actions' => array('examComparison'),
                'expression' => 'app()->controller->isValidAccess("Chart_ExamComparison","r")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("Exam","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("Exam","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("Exam","d")'
            )
        );
    }

    public function actionExamComparison() {
        $this->render('examComparison');
    }

}

?>
