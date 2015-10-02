<?php
$answer = json_decode($model['answer'], true);
?>

<div id="question">
    
    <?php
    echo '<input type="hidden" name="number" value="'.$rn.'"/>';
    echo '<div style=""><b class="pull-left">' . $rn . '. </b> ' . $model['question'] . '</div>';
    ?>
</div>

<ul class="liUjian">
    <?php if (!empty($answer['A'])) { ?>
        <li><?php
            echo CHtml::radioButton('choice', ($choose == 'A') ? true : false, array('id' => 'optionA', 'value' => 'A', 'return' => true, 'ajax' => array(
                    'type' => 'POST',
                    'url' => url('test/resultDetail/' . $model['id']),
                    'success' => 'js:function(data){
                                if (data == "refresh"){
                                    window.location.reload(); 
                                }
                                clearAnswer();
                                $("#a .lbl").html("<span class=\"label label-success\" style=\"margin-left:10px\"><i class=\"icon-ok icon-white\"></i></span>");
                                $("#' . $model['id'] . '").addClass("btn-success");
                            }')));
            ?> <b>A.</b> <span id="a"><?php echo $answer['A'] ?><span class="lbl"></span></span>
        </li>
    <?php } ?>
    <?php if (!empty($answer['B'])) { ?>
        <li><?php
            echo CHtml::radioButton('choice', ($choose == 'B') ? true : false, array('id' => 'optionB', 'value' => 'B', 'return' => true, 'ajax' => array(
                    'type' => 'POST',
                    'url' => url('test/resultDetail/' . $model['id']),
                    'success' => 'js:function(data){    
                                if (data == "refresh"){
                                    window.location.reload(); 
                                }
                                clearAnswer();
                                $("#b .lbl").html("<span class=\"label label-success\" style=\"margin-left:10px\"><i class=\"icon-ok icon-white\"></i></span>");
                                $("#' . $model['id'] . '").addClass("btn-success");
                            }')));
            ?> <b>B.</b> <span id="b"><?php echo $answer['B'] ?><span class="lbl"></span></span>
        </li>
    <?php } ?>
    <?php if (!empty($answer['C'])) { ?>
        <li><?php
            echo CHtml::radioButton('choice', ($choose == 'C') ? true : false, array('id' => 'optionC', 'value' => 'C', 'return' => true, 'ajax' => array(
                    'type' => 'POST',
                    'url' => url('test/resultDetail/' . $model['id']),
                    'success' => 'js:function(data){
                                if (data == "refresh"){
                                    window.location.reload(); 
                                }
                                clearAnswer();
                                $("#c .lbl").html("<span class=\"label label-success\" style=\"margin-left:10px\"><i class=\"icon-ok icon-white\"></i></span>");
                                $("#' . $model['id'] . '").addClass("btn-success");
                            }')));
            ?> <b>C.</b> <span id="c"><?php echo $answer['C'] ?><span class="lbl"></span></span>
        </li>
    <?php } ?>
    <?php if (!empty($answer['D'])) { ?>
        <li><?php
            echo CHtml::radioButton('choice', ($choose == 'D') ? true : false, array('id' => 'optionD', 'value' => 'D', 'return' => true, 'ajax' => array(
                    'type' => 'POST',
                    'url' => url('test/resultDetail/' . $model['id']),
                    'success' => 'js:function(data){
                                if (data == "refresh"){
                                    window.location.reload(); 
                                }
                                clearAnswer();
                                $("#d .lbl").html("<span class=\"label label-success\" style=\"margin-left:10px\"><i class=\"icon-ok icon-white\"></i></span>");
                                $("#' . $model['id'] . '").addClass("btn-success");
                            }')));
            ?> <b>D.</b> <span id="d"><?php echo $answer['D'] ?><span class="lbl"></span></span>
        </li>
    <?php } ?>
    <?php if (!empty($answer['E'])) { ?>
        <li><?php
            echo CHtml::radioButton('choice', ($choose == 'E') ? true : false, array('id' => 'optionE', 'value' => 'E', 'return' => true, 'ajax' => array(
                    'type' => 'POST',
                    'url' => url('test/resultDetail/' . $model['id']),
                    'success' => 'js:function(data){
                                if (data == "refresh"){
                                    window.location.reload(); 
                                }
                                clearAnswer();  
                                $("#e .lbl").html("<span class=\"label label-success\" style=\"margin-left:10px\"><i class=\"icon-ok icon-white\"></i></span>");
                                $("#' . $model['id'] . '").addClass("btn-success");
                            }')));
            ?> <b>E.</b> <span id="e"><?php echo $answer['E'] ?><span class="lbl"></span></span>
        </li>
    <?php } ?>
    <?php if (!empty($answer['F'])) { ?>
        <li><?php
            echo CHtml::radioButton('choice', ($choose == 'F') ? true : false, array('id' => 'optionF', 'value' => 'F', 'return' => true, 'ajax' => array(
                    'type' => 'POST',
                    'url' => url('test/resultDetail/' . $model['id']),
                    'success' => 'js:function(data){
                                if (data == "refresh"){
                                    window.location.reload(); 
                                }
                                clearAnswer();
                                $("#f .lbl").html("<span class=\"label label-success\" style=\"margin-left:10px\"><i class=\"icon-ok icon-white\"></i></span>");
                                $("#' . $model['id'] . '").addClass("btn-success");
                            }')));
            ?> <b>F.</b> <span id="f"><?php echo $answer['F'] ?><span class="lbl"></span></span>
        </li>
    <?php } ?>
</ul>

