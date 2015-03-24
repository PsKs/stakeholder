<?php
  require("../../connect.php");
  session_start();
  $user_id = $_SESSION['user_id'];
  $return_arr = array ();
  // $arr = array ();
  $view_activity = "SELECT activity.ac_id, activity.ac_no, activity.ac_name, activity.description 
                    FROM activity
                    LEFT OUTER JOIN composite_grp_act
                    ON activity.ac_id = composite_grp_act.ac_id
                    LEFT OUTER JOIN groups
                    ON composite_grp_act.group_id = groups.group_id
                    LEFT OUTER JOIN users
                    ON groups.group_id = users.group_id
                    WHERE users.user_id = $user_id
                    ORDER BY activity.ac_id ASC";
  $run = mysqli_query($dbcon, $view_activity);
  if (mysqli_num_rows($run)) {
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
  }
?>