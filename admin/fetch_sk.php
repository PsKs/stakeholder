<?php
  require("../connect.php");
  $return_arr = array ();
  $sql = "select stklist_id, stklist_name from stakeholder_list";
  $run = mysqli_query($dbcon, $sql);
  while ($row = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $row_array['stklist_id'][] = $row['stklist_id'];
    $row_array['stklist_name'][] = $row['stklist_name'];
  }
  array_push($return_arr, $row_array); 
  echo json_encode($return_arr, JSON_UNESCAPED_UNICODE);
  // Free result set
  mysqli_free_result($run);
  mysqli_close($dbcon); 
?>