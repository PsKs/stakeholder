<?php
/*+--------------------------------------------------------------------------------------------------+
  | { id: "1", label: "Forever.", isChecked: true }
  |
  +--------------------------------------------------------------------------------------------------+*/
  require("../../connect.php");
  $gId = $_GET['gId'];
  $return_arr = array ();
  // $arr = array ();
  // $sql = "SELECT * FROM
  //           (SELECT activity.ac_id, activity.ac_name, composite_grp_act.status FROM activity
  //             LEFT OUTER JOIN composite_grp_act
  //             ON activity.ac_id = composite_grp_act.ac_id 
  //             WHERE activity.ac_id
  //             NOT IN (SELECT composite_grp_act.ac_id FROM composite_grp_act WHERE composite_grp_act.group_id = $gId)
  //             UNION
  //             SELECT activity.ac_id, activity.ac_name, composite_grp_act.status FROM activity 
  //             LEFT OUTER JOIN composite_grp_act 
  //             ON activity.ac_id = composite_grp_act.ac_id 
  //             WHERE composite_grp_act.group_id = $gId 
  //             AND composite_grp_act.status LIKE 'unactivated')
  //         AS Alias ORDER BY ac_id";
  // $run = mysqli_query($dbcon, $sql);
  // while ($row = mysqli_fetch_array($run, MYSQL_ASSOC)) {
  //   $row_array['id'] = $row['ac_id'];
  //   $row_array['label'] = $row['ac_name'];
  //   $row_array['isChecked'] = false;
  //   if ($row['status'] === 'unactivated') {
  //     $row_array['isChecked'] = true;
  //   }
  //   array_push($return_arr, $row_array);
  // }
  $sql = "SELECT activity.ac_id, activity.ac_name FROM activity ORDER BY ac_id";
  $run = mysqli_query($dbcon, $sql);
  while ($row = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $row_array['id'] = $row['ac_id'];
    $row_array['label'] = $row['ac_name'];
    array_push($return_arr, $row_array);
  }
  echo json_encode($return_arr, JSON_UNESCAPED_UNICODE);
  // Free result set
  mysqli_free_result($run);
  mysqli_close($dbcon); 
?>