<?php
/**
 * Module       : Opinion Poll
 * Controller   : Front Controller
 * Author       : CHARLES ANTONY U
 * Date         : APR-26-2019 
 */

// ini_set("display_errors",1);
// error_reporting(-1);

define("DB_HOST","localhost");
define("DB_UNAME","root");
define("DB_PWD","Admin123");
define("DB_NAME","opinion_poll_db");

require_once("model/model_opinion_poll.php");

$qa = $db_obj->get_qa();

foreach($qa as $record):
        $records[$record['question']][]=$record;
endforeach;

if(isset($_POST['cast_vote']))
{
        
        if(!isset($_POST['choice']))
        {
                header('location:index.php?e_message=1');
                die("Please select your choice!");
        }

        $qid    = $_POST['qid'];
        $choice = $_POST['choice'];
        $data   = array(
                'question_id'    => $qid, 
                'user_selection' => $choice,
                'total_count'    => 1
                );

        $check_combination = $db_obj->check('polls',$qid,$choice);
        $check_combination = $check_combination[0];

        if($check_combination):
             $task = $db_obj->update('polls',$qid='',$choice,$check_combination);
        else:
             $task = $db_obj->save('polls',$data);
        endif;
        
        $msg = ($task) ? "success" : "failure";

        if($msg=='failure')
        {
            $msg = 'Failed: User Option: '.print_r($_POST,TRUE);
            $db_obj->putLog($msg);

            header('location:?e_message=1');
        }
        else{

            setcookie('PollDone', 1, time() + (86400), "/"); // 86400 = 1 day

            $msg = 'Success: User Option: '.print_r($_POST,TRUE);
            $db_obj->putLog($msg);

            header('location:?s_message=1');  
        }
}

if(isset($_GET['s_message'])){
    require_once("view/results.html.php");
    die();
}

if(!isset($_COOKIE['PollDone']))
    require_once("view/opinion.html.php");
else
    echo '<h3>Your opinion already received. Thank you!</h3>';

?>