<?php
  session_start();//session starts here
  require("../connect.php");
  $sql = "select activity.ac_no, activity.ac_name, stakeholder_list.stklist_id, stakeholder_list.stklist_name, stakeholder.stk_id, stakeholder_list.stklist_type
          from stakeholder_list
          left join stakeholder on (stakeholder.stklist_id = stakeholder_list.stklist_id) 
          left join activity on (stakeholder.ac_id = activity.ac_id) 
          where activity.ac_id = ".$ac_id;
  $run = mysqli_query($dbcon, $sql);
  while ($rs = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $ac_no = $rs['ac_no'];
    $ac_name = $rs['ac_name'];
    $arr_stklist_id[] = $rs['stklist_id'];
    $arr_stklist_name[] = $rs['stklist_name'];
    $arr_stklist_type[] = $rs['stklist_type'];
    $arr_stk_id[] = $rs['stk_id'];
  }
  mysqli_free_result($run);
  mysqli_close($dbcon);
  $col_count = count($arr_stklist_id);
?>