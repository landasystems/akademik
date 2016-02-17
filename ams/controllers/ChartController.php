<?php

class ChartController extends Controller {

    public $breadcrumbs;
    public $layout = 'main';

//    public function filters() {
//        return array(
//            'rights',
//        );
//    }
    
  

    public function actionExamComparison() {
        $this->render('examComparison');
    }

}

?>
