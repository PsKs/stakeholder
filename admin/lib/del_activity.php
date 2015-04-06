<?php
  if (!isset($_POST['comId']) || !isset($_POST['funcId'])) { exit; }
  $comId = $_POST['comId'];
  $funcId = $_POST['funcId'];
  if ($funcId === '0') {
    check_activity($comId);
  } elseif ($funcId === '1') {
    delete_confirm($comId);
  }
  function check_activity($comId) {
    require("../../connect.php");
    $sql = "SELECT composite_grp_act.status FROM composite_grp_act 
            WHERE composite_grp_act.com_id = $comId";
    $run = mysqli_query($dbcon, $sql);
    if (mysqli_num_rows($run)) {
      $row = mysqli_fetch_assoc($run);
      $status = $row['status'];
      if ($status === 'activated') {     /* If activity is activated = Not delete. */
        echo json_encode($status);
      } else {                           /* If activity is unactivated = Delete. */
        echo json_encode($status);
      }
    } elseif (mysqli_error($dbcon)) {    /* If mysql error then show error. */
      printf("Errormessage: %s\n", mysqli_error($dbcon));
    } 
    mysqli_free_result($run);
    mysqli_close($dbcon);
  }
  function delete_confirm($comId) {
    require("../../connect.php");
    $sql = "DELETE FROM stakeholder.composite_grp_act WHERE composite_grp_act.com_id = $comId";
    if (mysqli_query($dbcon, $sql) === TRUE) {
      echo json_encode("Complete delete activity");
    } else {
      printf("Errormessage: %s\n", mysqli_error($dbcon));
    }
    mysqli_close($dbcon);
  }
?>