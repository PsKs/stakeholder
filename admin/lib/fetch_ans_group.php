<?php
  session_start();//session starts here
  require("../../connect.php");
  $group_id = $_GET['group_id'];
  $ac_id = $_GET['ac_id'];
  $u_id = $_GET['user_id'];
  $type = $_GET['type'];
  $json_data = array ();
  $ans_detail = array ();
  $user_id = array ();
  $user_name = array ();
  // print_r($_GET['type']);
  $i = 0;
  $stklist_name = array(array());
  if ($type === "activity") {
    /*$sql = "SELECT users.name, answer.user_id, answer.ans_detail, activity.position 
            FROM composite_grp_act 
            LEFT OUTER JOIN answer 
            ON composite_grp_act.ac_id = answer.ac_id 
            LEFT OUTER JOIN activity  
            ON answer.ac_id = activity.ac_id
            LEFT OUTER JOIN users
            ON answer.user_id = users.user_id 
            WHERE composite_grp_act.group_id = $group_id
            AND composite_grp_act.ac_id = answer.ac_id
            AND answer.ac_id = $ac_id
            ORDER BY answer.user_id ASC";*/
    $sql = "SELECT users.name, answer.user_id, answer.ans_detail, activity.position 
            FROM composite_grp_act 
            LEFT OUTER JOIN answer 
            ON composite_grp_act.ac_id = answer.ac_id 
            LEFT OUTER JOIN activity  
            ON answer.ac_id = activity.ac_id
            LEFT OUTER JOIN users
            ON answer.user_id = users.user_id 
            LEFT OUTER JOIN groups
            ON users.group_id = groups.group_id
            WHERE composite_grp_act.group_id = $group_id
            AND composite_grp_act.ac_id = answer.ac_id
            AND answer.ac_id = $ac_id
            AND groups.group_id = $group_id
            ORDER BY answer.user_id ASC";
  } elseif ($type === "user") {
    $sql = "SELECT users.name, answer.user_id, answer.ans_detail, activity.position 
            FROM composite_grp_act 
            LEFT OUTER JOIN answer 
            ON composite_grp_act.ac_id = answer.ac_id 
            LEFT OUTER JOIN activity  
            ON answer.ac_id = activity.ac_id
            LEFT OUTER JOIN users
            ON answer.user_id = users.user_id 
            WHERE composite_grp_act.group_id = $group_id
            AND answer.ac_id = $ac_id
            AND answer.user_id = $u_id
            ORDER BY answer.user_id ASC";
  }
  $run = mysqli_query($dbcon, $sql);
  if (mysqli_num_rows($run)) {
    while ($rs = mysqli_fetch_array($run, MYSQL_ASSOC)) {
      $ans_detail[] = $rs['ans_detail'];
      $user_id[] = $rs['user_id'];
      $user_name[] = $rs['name'];
      $position[] = $rs['position'];
    }
    // print_r($user_id);
    // print_r($ans_detail);
    
    /*
    *  $tmp = [];
    *  foreach ($ans_detail as $index => $value) {
    *    // print_r($value);
    *    // echo "<br/>";
    *    $tmp[$index] = explode('"],["', $value);
    *    // print_r($tmp);
    *    // echo "<br/>";
    *    unset($ans_detail);
    *    foreach ($tmp[$index] as $key => $val) {
    *      unset($ans_detail);
    *      if ($key + 1 == count($tmp[$index])) {
    *        $val = str_replace(']]', ',"'.$user_id[$index].'"]]', $val);
    *      } else {
    *        $val .= '","'.$user_id[$index].'';
    *      } 
    *      $ans_detail[] = explode('","', trim($val, '[]"'));
    *      // print_r($val);
    *      // echo "<br/>";
    *      // print_r($ans_detail);
    *      // echo "<br/>";
    *      foreach ($ans_detail as $key => $value) {
    *        $json_data['data'][] = $value;
    *      }
    *    }
    *  }
    */
   
    $tmp = [];
    foreach ($ans_detail as $index => $value) {
      // print_r($value);
      // echo "<br/>";
      $tmp[$index] = explode('"],["', $value);
      // print_r($tmp);
      // echo "<br/>";
      unset($ans_detail);
      foreach ($tmp[$index] as $key => $val) {
        unset($ans_detail);
        if ($key == 0) {
          $val = str_replace('[["', '[["'.$user_name[$index].'","', $val);
        } else {
          $val = $user_name[$index].'","'.$val;
        } 
        $ans_detail[] = explode('","', trim($val, '[]"'));
        // print_r($val);
        // echo "<br/>";
        // print_r($ans_detail);
        // echo "<br/>";
        foreach ($ans_detail as $key => $value) {
          $json_data['data'][] = $value;
        }
      }
    }
    // print_r($json_data);
    echo json_encode($json_data, JSON_UNESCAPED_UNICODE);
    mysqli_free_result($run);
    mysqli_close($dbcon);
  } else {
    $str = array ();
    $sql = "SELECT COUNT(stakeholder.stklist_id) as count_id
            FROM stakeholder_list 
            LEFT JOIN stakeholder 
            ON (stakeholder.stklist_id = stakeholder_list.stklist_id) 
            LEFT JOIN activity 
            ON (stakeholder.ac_id = activity.ac_id) 
            WHERE activity.ac_id = ".$ac_id;
    $run = mysqli_query($dbcon, $sql);
    $row = mysqli_fetch_assoc($run);
    $count_id = $row['count_id'];
    // echo $count_id;
    for ($i=0; $i <= $count_id ; $i++) { //เพิ่มส่วนหัวคือ +1 จาก count_id
      $str[] .= "-";
    }
    // print_r ($str);
    $json_data['data'][] = $str;
    echo json_encode($json_data, JSON_UNESCAPED_UNICODE);
    mysqli_free_result($run);
    mysqli_close($dbcon);
  }
?>