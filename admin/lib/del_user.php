<?php
  if (!isset($_POST['userId']) || !isset($_POST['funcId'])) { exit; }
  $userId = $_POST['userId'];
  $funcId = $_POST['funcId'];
  if ($funcId === '0') {
    check_user($userId);
  } elseif ($funcId === '1') {
    delete_confirm($userId);
  }
  function check_user($userId) {
    require("../../connect.php");
    $sql = "SELECT DISTINCT answer.user_id FROM answer 
            WHERE answer.user_id = $userId";
    $run = mysqli_query($dbcon, $sql);
    if (mysqli_num_rows($run)) {
      echo json_encode("cancel");     /* If found user in answer table = Not delete. */             
    } else {                          /* If not found user in answer table = Delete. */
      echo json_encode("delete");
    }
    if (mysqli_error($dbcon)) {       /* If mysql error then show error. */
      printf("Errormessage: %s\n", mysqli_error($dbcon));
    } 
    mysqli_free_result($run);
    mysqli_close($dbcon);
  }
  function delete_confirm($userId) {
    require("../../connect.php");
    $sql = "DELETE FROM stakeholder.users WHERE users.user_id = $userId";
    if (mysqli_query($dbcon, $sql) === TRUE) {
      echo json_encode("Complete delete user");
    } else {
      printf("Errormessage: %s\n", mysqli_error($dbcon));
    }
    mysqli_close($dbcon);
  }
?>