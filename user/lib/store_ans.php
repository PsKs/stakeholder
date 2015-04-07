<?php
  session_start();//session starts here
  require("../../connect.php");
  // print_r($_POST['data']);
  // Array
  //   (
  //     [0] => 1       <--------- activity id
  //     [1] => risk    <--------- activity type
  //     [2] => Array   <--------- data (row)
  //       (
  //           [0] => ทดสอบ <--------- data (column)
  //           [1] => 5
  //           [2] => 5
  //           [3] => 25
  //       )

  //     [3] => Array
  //       (
  //           [0] => Testing
  //           [1] => 4
  //           [2] => 5
  //           [3] => 20
  //       )

  //     [4] => Array
  //       (
  //           [0] => foo bar
  //           [1] => 4
  //           [2] => 4
  //           [3] => 16
  //       )
  //   )
  // Array
  //   (
  //     [0] => 3
  //     [1] => swot-tows
  //     [2] => Array
  //       (
  //         [0] => O
  //         [1] => T
  //         [2] => S
  //         [3] => SO
  //         [4] => ST
  //         [5] => W
  //         [6] => WO
  //         [7] => WT
  //       )
  //   )
  if (isset($_POST['data']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $array_Data = $_POST['data'];
    $array_Ans = [];
    $ac_id = $array_Data[0];
    if ($array_Data[1] === 'swot-tows') {
      array_push($array_Ans, $array_Data[2][2]);
      array_push($array_Ans, $array_Data[2][5]);
      array_push($array_Ans, $array_Data[2][0]);
      array_push($array_Ans, $array_Data[2][1]);
      array_push($array_Ans, $array_Data[2][3]);
      array_push($array_Ans, $array_Data[2][4]);
      array_push($array_Ans, $array_Data[2][6]);
      array_push($array_Ans, $array_Data[2][7]);
    } else {
      foreach ($array_Data as $key => $value) {
        if ($key > 1) {
          array_push($array_Ans, $value);
        }
      }
    }
    $ans_detail = json_encode($array_Ans, JSON_UNESCAPED_UNICODE);
    $sql = "INSERT INTO stakeholder.answer (ac_id, user_id, ans_detail) VALUES ('$ac_id', '$user_id', '$ans_detail')";
    $run = mysqli_query($dbcon, $sql);
    $sql = "UPDATE stakeholder.activity SET status = 'activated' WHERE activity.ac_id = $ac_id;";
    $run = mysqli_query($dbcon, $sql);
    mysqli_close($dbcon);
  }
?>