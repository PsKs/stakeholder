<?php
  require("../connect.php");
  /* Select queries return a resultset */
  $result = mysqli_query($dbcon, "SELECT answer.ac_id FROM answer WHERE user_id = ".$user_id);
  if (mysqli_num_rows($result) === 0) {
    // printf("Select returned %d rows.\n", mysqli_num_rows($result));
    header('Location: index.php');
    exit;
    /* free result set */
    mysqli_free_result($result);
  }
  mysqli_close($dbcon);
?>