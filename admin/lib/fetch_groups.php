<?php
  require("../../connect.php");
  $return_arr = array ();
  // $arr = array ();
  $sql = "SELECT * FROM groups WHERE group_id > 0";
  $run = mysqli_query($dbcon, $sql);
  while ($row = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $row_array['group_id'] = $row['group_id'];
    $row_array['group_name'] = $row['group_name'];
    $row_array['created'] = date('j-M-y g:iA', strtotime($row['created']));
    $g_id = $row['group_id'];
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
    }
    array_push($return_arr, $row_array);
  }
  echo json_encode($return_arr, JSON_UNESCAPED_UNICODE);
  // Free result set
  mysqli_free_result($run);
  mysqli_free_result($run2);
  mysqli_close($dbcon); 
?>