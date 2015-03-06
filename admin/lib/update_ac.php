<?php
  session_start();
  require("../../connect.php");
  if (!empty($_POST['noActivity']) && !empty($_POST['nameActivity'])) {
    $ac_id = $_POST['ac_id'];
    $noActivity = $_POST['noActivity'];
    $nameActivity = $_POST['nameActivity'];
    $arrStklist_id_old = explode(",", $_POST['arrStklist_id_old']);
    $arrStklist_id_new = explode(",", $_POST['arrStklist_id_new']);
    foreach ($arrStklist_id_old as $old => $value) {
      if (!in_array($value, $arrStklist_id_new)) {
        /*
          ถ้าในรายการเดิมมีแต่รายการใหม่ไม่มี (หาในรายการใหม่ไม่เจอ)
          แสดงว่ารายการนั้นถูกลบไปแล้ว จะทำการลบออกจากตาราง stakeholder
        */
        $sql = "DELETE FROM stakeholder WHERE stk_id IN (
                  SELECT * FROM ( 
                    SELECT stk_id FROM stakeholder WHERE ac_id = '$ac_id' AND stklist_id = '$value'
                  ) AS a 
                )";
        mysqli_query($dbcon, $sql);
      }
    }
    foreach ($arrStklist_id_new as $key => $value) {
      if (!in_array($value, $arrStklist_id_old)) {
        /*
          ถ้าในรายการใหม่มีแต่รายการเดิมไม่มี (หาในรายการเดิมไม่เจอ)
          แสดงวันรายการนั้นถูกเพิ่มเข้ามา จะทำการเพิ่มลงในตาราง
        */
        $sql = "INSERT INTO stakeholder (ac_id, stklist_id) VALUES ('$ac_id', '$value')";
        mysqli_query($dbcon, $sql);
      }
    }
  }
  mysqli_close($dbcon); 
?>