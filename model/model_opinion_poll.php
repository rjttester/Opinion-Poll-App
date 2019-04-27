<?php
/**
 * Module   : Opinion Poll
 * Model    : Model_Opinion_Poll
 * Author   : CHARLES ANTON U
 * Date     : APR-26-2019
 */

class Model_Opinion_Poll{

    private $sql;

    public function __construct($db_host,$db_uname,$db_pwd,$db_name){

        $this->db_uname  = $db_uname;
        $this->db_pwd    = $db_pwd;
        $this->db_host   = $db_host;
        $this->db_name   = $db_name;

        $this->con  =   new mysqli($this->db_host,$this->db_uname,$this->db_pwd,$this->db_name);
        if($this->con->connect_error)
            die("Failed to connect Database!");
    }

    public function check($tbl,$qid,$choice){
        $this->sql = "SELECT total_count FROM ".$tbl." WHERE question_id='".$qid."' AND user_selection='".$choice."'";
        $result = $this->con->query($this->sql);
        // echo $this->sql;
        // print_r($result->fetch_row());exit;
        return $result->fetch_row();
    }

    public function save($tbl,$data){
        $cols = implode(array_keys($data),',');
        $vals = "'".implode("','",$data)."'";
        $this->sql = "INSERT INTO ".$tbl." (".$cols.")  VALUES($vals) ";
        $insert = $this->con->query($this->sql);
        if(!$insert) die($this->con->error);
        return $insert;
    }

    public function update($tbl,$qid,$choice,$check_combination){

        $ctn = $check_combination+1;

        $this->sql = "UPDATE ".$tbl." SET total_count='".$ctn."' WHERE question_id='".$qid."' AND user_selection='".$choice."'";
        
        $update = $this->con->query($this->sql);
        
        if(!$update) die($this->con->error);
        
        return $update;

    }

    public function get($sql){
        $this->sql = $sql;
        $result = $this->con->query($this->sql);
        while($row = $result->fetch_assoc()):
            $rows[] = $row;
        endwhile;
        return $rows;
    }

    public function getCount($qid,$aid)
    {
        $count=0;
        $this->sql = "SELECT total_count as count 
                      FROM polls 
                      WHERE question_id='".$qid."' 
                      AND user_selection='".$aid."'";

        $result = $this->con->query($this->sql);
        while ($row = $result->fetch_row()) {
            $count = $row[0];
        }
        return $count;
    }

    public function get_qa(){

        $sql = "SELECT question,q.id as questionid,choice,choice_id 
                FROM poll_choices AS a 
                INNER JOIN poll_questions AS q 
                ON q.id=a.question_id";

        $qa = $this->get($sql);
        return $qa;
    }

    public function putLog($msg)
    { 
        $filename = "log_msg.txt";

        $fd = fopen($filename, 'a');
        
        $str = 'POLL PLACED ON:' . date('Y/m/d h:i:s', mktime())."\n";
        $str .= $msg;
        $str .= 'CLIENT INFO: IP:'.$_SERVER['REMOTE_ADDR'].' | BROWSER:'.$_SERVER['HTTP_USER_AGENT'].'] '."\n";          
        $str .= '-----------------------------'."\n";
        fwrite($fd, $str . "\n");
        
        fclose($fd);
    }
}

$db_obj = new Model_Opinion_Poll(DB_HOST,DB_UNAME,DB_PWD,DB_NAME);


?>