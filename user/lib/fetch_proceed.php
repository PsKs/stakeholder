<?php
  session_start();//session starts here
  require("../../connect.php");
  $ac_id = $_GET['ac_id'];
  // $stk = $_GET['stk'];
  $json_data = array ();
  // print_r($_GET);
  $user = 2;
  $i = 0;
  $stklist_name = array(array());
  $sql = "SELECT answer.ans_detail FROM answer WHERE user_id = 2 AND ac_id = $ac_id";
  $run = mysqli_query($dbcon, $sql);
  while ($rs = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $ans_detail[] = $rs['ans_detail'];
  }
  // $stk = explode(',', $stk);
  // $stk = array_flip($stk);
  // extract($stk);
  $tmp = [];
  foreach ($ans_detail as $key => $value) {
    $tmp[$key] = explode('"],["', $value);
    unset($ans_detail);
    foreach ($tmp[$key] as $ky => $val) {
      $ans_detail[] = explode('","', trim($val, '[]"'));
    }
  }
  foreach ($ans_detail as $key => $value) {
    $json_data['data'][] =  $value;
  }
  // print_r($json_data);
  echo json_encode($json_data, JSON_UNESCAPED_UNICODE);
  mysqli_free_result($run);
  mysqli_close($dbcon);
?>