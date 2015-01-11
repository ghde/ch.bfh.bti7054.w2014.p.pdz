<?php

if (!isset($_POST['qpart'])) {

    $quiz = array("QUESTION_1", "ANSWER_1_1", "ANSWER_1_2", "ANSWER_1_3", '1');

    $smarty->assign('inner_template', 'plant_questions');
    $smarty->assign('quiz', $quiz);
}

else  {

    if ($_POST['qpart'] == '1') {

        $quiz = array("QUESTION_2", "ANSWER_2_1", "ANSWER_2_2", "ANSWER_2_3", '2');

        $smarty->assign('inner_template', 'plant_questions');
        $smarty->assign('quiz', $quiz);

    }

    if ($_POST['qpart'] == '2') {

        $quiz = array("QUESTION_3", "ANSWER_3_1", "ANSWER_3_2", "ANSWER_3_3", '3');

        $smarty->assign('inner_template', 'plant_questions');
        $smarty->assign('quiz', $quiz);

    }

    if ($_GET['qpart'] == '3') {

        //show

    }

}

