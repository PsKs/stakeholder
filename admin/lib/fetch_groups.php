<?php
  require("../../connect.php");
  $return_arr = array ();
  // $arr = array ();
  $sql = "SELECT * FROM groups WHERE group_id > 0";
  $run = mysqli_query($dbcon, $sql);
  while ($row = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $row_array['group_id'] = $row['group_id'];
    $row_array['group_name'] = $row['group_name'];
    $sql = "SELECT COUNT(users.user_id) AS count_user FROM users WHERE group_id = ".$row['group_id'];
    $run2 = mysqli_query($dbcon, $sql);
    while ($row = mysqli_fetch_array($run2, MYSQL_ASSOC)) {
      $row_array['count_user'] = $row['count_user'];
    }
    array_push($return_arr, $row_array);
  }
  echo json_encode($return_arr, JSON_UNESCAPED_UNICODE);
  // Free result set
  mysqli_free_result($run);
  mysqli_free_result($run2);
  mysqli_close($dbcon); 
?>