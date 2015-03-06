<?php
  session_start();//session starts here
  require("../../connect.php");
  $group_id = $_GET['group_id'];
  $ac_id = $_GET['ac_id'];
  $json_data = array ();
  // print_r($_GET);
  $i = 0;
  $stklist_name = array(array());
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
  ORDER BY answer.user_id ASC";
  $run = mysqli_query($dbcon, $sql);
  while ($rs = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $ans_detail[] = $rs['ans_detail'];
    $user_id[] = $rs['user_id'];
    $user_name[] = $rs['name'];
  }
  // print_r($user_id);
  // print_r($ans_detail);
  
  /*
  *  $tmp = [];
  *  foreach ($ans_detail as $index => $value) {
  *    // print_r($value);
  *    // echo "</br>";
  *    $tmp[$index] = explode('"],["', $value);
  *    // print_r($tmp);
  *    // echo "</br>";
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
  *      // echo "</br>";
  *      // print_r($ans_detail);
  *      // echo "</br>";
  *      foreach ($ans_detail as $key => $value) {
  *        $json_data['data'][] = $value;
  *      }
  *    }
  *  }
  */
 
  $tmp = [];
  foreach ($ans_detail as $index => $value) {
    // print_r($value);
    // echo "</br>";
    $tmp[$index] = explode('"],["', $value);
    // print_r($tmp);
    // echo "</br>";
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
      // echo "</br>";
      // print_r($ans_detail);
      // echo "</br>";
      foreach ($ans_detail as $key => $value) {
        $json_data['data'][] = $value;
      }
    }
  }
  
  // print_r($json_data);
  echo json_encode($json_data, JSON_UNESCAPED_UNICODE);
  mysqli_free_result($run);
  mysqli_close($dbcon);
?>