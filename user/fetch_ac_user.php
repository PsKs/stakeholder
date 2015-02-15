<?php
  require("../connect.php");
  $return_arr = array ();
  // $arr = array ();
  $view_activity = "select * from activity order by ac_id asc";
  $run = mysqli_query($dbcon, $view_activity);
  while ($row = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $row_array['ac_id'] = $row['ac_id'];
    $row_array['ac_no'] = $row['ac_no'];
    $row_array['ac_name'] = $row['ac_name'];
    $row_array['description'] = $row['description'];
    array_push($return_arr, $row_array);
  }
  echo json_encode($return_arr, JSON_UNESCAPED_UNICODE);
  // Free result set
  mysqli_free_result($run);
  mysqli_close($dbcon); 
?>