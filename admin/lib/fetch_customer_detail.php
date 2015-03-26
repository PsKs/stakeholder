<?php
  require("../../connect.php");
  $return_arr = array ();
  // $arr = array ();
  $gId = $_POST['gId'];
  $sql = "SELECT * FROM users WHERE group_id = ".$gId;
  $run = mysqli_query($dbcon, $sql);
  while ($row = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $row_array['username'] = $row['username'];
    $row_array['min_pass_encrypt'] = substr($row['password'], 0, 9);
    $row_array['full_pass_encrypt'] = $row['password'];
    $row_array['name'] = $row['name'];
    $row_array['created'] = $row['created'];
    array_push($return_arr, $row_array);
  }
  echo json_encode($return_arr, JSON_UNESCAPED_UNICODE);
  // Free result set
  mysqli_free_result($run);
  // mysqli_free_result($run2);
  mysqli_close($dbcon); 
?>