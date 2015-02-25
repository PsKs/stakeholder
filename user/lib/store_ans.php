<?php
  session_start();//session starts here
  require("../../connect.php");
  // print_r($_POST['data']);
  // Array
  //    (
  //        [0] => 1   <------------- ac_id
  //        [1] => Array
  //            (
  //                [0] => test_1
  //                [1] => 4
  //                [2] => 3
  //                [3] => 12
  //            )
  //        [2] => Array
  //            (
  //                [0] => ทดสอบ2
  //                [1] => 5
  //                [2] => 4
  //                [3] => 20
  //            )
  //        [3] => Array
  //            (
  //                [0] => test_3
  //                [1] => 4
  //                [2] => 3
  //                [3] => 12
  //            )
  //    )
  if (isset($_POST['data'])) {
    $array_Data = $_POST['data'];
    $array_Ans = [];
    $ac_id = "";
    foreach ($array_Data as $key => $value) {
      if ($key == 0) {
        $ac_id = $value;
      } else {
        $array_Ans[] = $value;
      }
    }
    $ans_detail = json_encode($array_Ans, JSON_UNESCAPED_UNICODE);
    $sql = "INSERT INTO stakeholder.answer (ans_detail, user_id, ac_id) VALUES ('$ans_detail', '2', '$ac_id')";
    $run = mysqli_query($dbcon, $sql);
    $sql = "UPDATE stakeholder.activity SET status = 'activated' WHERE activity.ac_id = $ac_id;";
    $run = mysqli_query($dbcon, $sql);
    mysqli_close($dbcon);
  }
?>