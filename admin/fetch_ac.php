<?php
  require("../connect.php");
  $return_arr = array ();
  // $arr = array ();
  $view_activity = "select * from activity order by ac_id asc";
  $run = mysqli_query($dbcon, $view_activity);
  while ($row = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $arr = array ();
    $string = "";
    $row_array['id'] = $row['ac_id'];
  	$row_array['no'] = $row['ac_no'];
    $row_array['name'] = $row['ac_name'];
    $row_array['create'] = $row['created'];
    $sql = "select stakeholder_list.stklist_id, stakeholder_list.stklist_name from stakeholder_list left join stakeholder on (stakeholder.stklist_id = stakeholder_list.stklist_id) left join activity on (stakeholder.ac_id = activity.ac_id) where activity.ac_id = ".$row['ac_id'];
    $run_2 = mysqli_query($dbcon, $sql);
    while ($rs = mysqli_fetch_array($run_2, MYSQL_ASSOC)) {
      // $arr['stakeholder_list'][] = $rs;
      array_push($arr, $rs['stklist_name']);
    }
    // print_r ($arr);
    // echo $string;
    $string = implode(",",$arr);
    $row_array['stakeholder_list'] = $string;
    array_push($return_arr, $row_array);
    // array_push($return_arr, $arr);
  }
  echo json_encode($return_arr, JSON_UNESCAPED_UNICODE);
  // Free result set
  mysqli_free_result($run);
  mysqli_free_result($run_2);
  mysqli_close($dbcon); 
?>