<?php
  require("../../connect.php");
  $gId = $_POST['gId'];
  $return_arr = array ();
  // $arr = array ();
  $view_activity = "SELECT activity.ac_id, activity.ac_no, activity.ac_name, composite_grp_act.created, composite_grp_act.com_id
                    FROM activity, composite_grp_act 
                    WHERE composite_grp_act.group_id = $gId AND composite_grp_act.ac_id = activity.ac_id
                    ORDER BY created ASC";
  $run = mysqli_query($dbcon, $view_activity);
  while ($row = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $arr = array ();
    $string = "";
    $row_array['id'] = $row['ac_id'];
    $row_array['no'] = $row['ac_no'];
    $row_array['name'] = $row['ac_name'];
    $row_array['created'] = date('j-M-y', strtotime($row['created']));
    $row_array['com_id'] = $row['com_id'];
    $sql = "SELECT stakeholder_list.stklist_id, stakeholder_list.stklist_name 
            FROM stakeholder_list 
            LEFT JOIN stakeholder 
            ON (stakeholder.stklist_id = stakeholder_list.stklist_id) 
            LEFT JOIN activity 
            ON (stakeholder.ac_id = activity.ac_id) 
            WHERE activity.ac_id = ".$row['ac_id'];
    $run_2 = mysqli_query($dbcon, $sql);
    while ($rs = mysqli_fetch_array($run_2, MYSQL_ASSOC)) {
      // $arr['stakeholder_list'][] = $rs;
      array_push($arr, $rs['stklist_name']);
    }
    // print_r ($arr);
    $string = implode(",",$arr);
    $string = htmlspecialchars($string);
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