<?php
  require("../../connect.php");
  $return_arr = array ();
  // $arr = array ();
  $gId = $_POST['gId'];
  $sql = "SELECT * FROM users WHERE group_id = ".$gId;
  $run = mysqli_query($dbcon, $sql);
  while ($row = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $row_array['username'] = $row['username'];
    $row_array['password'] = $row['password'];
    $row_array['name'] = $row['name'];
    $row_array['created'] = $row['created'];
    /*$g_id = $row['group_id'];
    $sql = "SELECT (SELECT COUNT(users.user_id) 
                    FROM users 
                    WHERE users.group_id = $g_id) AS count_user,
                   (SELECT COUNT(composite_grp_act.com_id) 
                    FROM composite_grp_act 
                    WHERE composite_grp_act.group_id = $g_id) AS count_ac";
    $run2 = mysqli_query($dbcon, $sql);
    while ($row = mysqli_fetch_array($run2, MYSQL_ASSOC)) {
      $row_array['count_user'] = $row['count_user'];
      $row_array['count_ac'] = $row['count_ac'];
    }*/
    array_push($return_arr, $row_array);
  }
  echo json_encode($return_arr, JSON_UNESCAPED_UNICODE);
  // Free result set
  mysqli_free_result($run);
  // mysqli_free_result($run2);
  mysqli_close($dbcon); 
?>