<?php
  session_start();
  if (isset($_SESSION['username']) && isset($_SESSION['name']) && isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
    $username = $_SESSION['username'];
    $name = $_SESSION['name'];
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type'];
    if ($_SESSION['user_type'] !== "user") {
      echo "<script>window.open('../index.php','_self')</script>";
    }
  } else {
    echo "<script>window.open('../index.php','_self')</script>";
  }
?>