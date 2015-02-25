<?php
  session_start();//session starts here
  require("../../connect.php");
  $user = 2;
  $i = 0;
  $stklist_name = array(array());
  $sql = "SELECT answer.ac_id, answer.ans_detail, activity.ac_no, activity.ac_name FROM answer LEFT JOIN activity ON answer.ac_id = activity.ac_id WHERE user_id = 2 ORDER BY answer.ac_id ASC";
  $run = mysqli_query($dbcon, $sql);
  while ($rs = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $ac_id[] = $rs['ac_id'];
    $ac_no[] = $rs['ac_no'];
    $ac_name[] = $rs['ac_name'];
    $ans_detail[] = $rs['ans_detail'];
    $sql_2 = "SELECT stakeholder_list.stklist_name FROM stakeholder_list LEFT JOIN stakeholder ON (stakeholder.stklist_id = stakeholder_list.stklist_id) LEFT JOIN activity ON (stakeholder.ac_id = activity.ac_id) WHERE activity.ac_id = ".$rs['ac_id'];
    $run_2 = mysqli_query($dbcon, $sql_2);
    while ($rs_2 = mysqli_fetch_array($run_2, MYSQL_ASSOC)) {
      $stklist_name[$i][] = $rs_2['stklist_name'];
    }
    $i++;
  }
  mysqli_free_result($run);
  mysqli_free_result($run_2);
  mysqli_close($dbcon);
  print_r($ans_detail);
  print_r($stklist_name);
?>