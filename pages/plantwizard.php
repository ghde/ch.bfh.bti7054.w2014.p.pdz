<?php

if (!array_key_exists('qpart', $_POST)) {

    $quiz = array('QUESTION_1', 'ANSWER_1_1', 'ANSWER_1_2', 'ANSWER_1_3', '1', [5, 3, 2]);

    $smarty->assign('inner_template', 'plant_wizard');
    $smarty->assign('quiz', $quiz);
}
else if (array_key_exists('answer', $_POST))
{
    //store answer in session
    $sessionKey = 'PW_ANSWER';
    $_SESSION[$sessionKey . $_POST['qpart']] = $_POST['answer'];

    if ($_POST['qpart'] === '1' || $_POST['qpart'] === '2') {

        $quiz = $_POST['qpart'] === '1' ?
            array('QUESTION_2', 'ANSWER_2_1', 'ANSWER_2_2', 'ANSWER_2_3', '2', [2, 3, 5])
            : array('QUESTION_3', 'ANSWER_3_1', 'ANSWER_3_2', 'ANSWER_3_3', '3', [2, 3, 5]);

        $smarty->assign('inner_template', 'plant_wizard');
        $smarty->assign('quiz', $quiz);
    }
    else if ($_POST['qpart'] === '3') {
        //wizard completed
        //redirect to search page with get parameters so url can be copied
        $page = "index.php?page=search";

        //get params
        $params = [ 1 => 'sunlight', 2 => 'pouringfreq', 3 => 'difficulty' ];
        for ($i = 1; $i <= 3; $i++) {
            $answer = $_SESSION[$sessionKey . $i];
            //add get parameter (&param=value)
            $page .= '&' . $params[$i] . '=' . $answer;
            //remove from session
            unset($_SESSION[$sessionKey . $i]);
        }
        //redirect to search page
        header("Location: $page");
    }
}
// Close session
session_write_close();