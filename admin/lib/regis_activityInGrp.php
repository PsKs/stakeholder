<?php
/*+--------------------------------------------------------------------------------------------------+
  | 
  |
  +--------------------------------------------------------------------------------------------------+*/
  require("../../connect.php");
  // print_r($_POST['data']);
  $arrData = $_POST['data'];
  $gId = $_POST['group_id'];
  // $arr_acid_old = array ();
  $arrData = explode(',', $arrData);
  // $sql = "SELECT DISTINCT composite_grp_act.ac_id FROM composite_grp_act 
  //         WHERE composite_grp_act.group_id = $gId
  //         AND composite_grp_act.status LIKE 'unactivated'";
  // echo($sql);
  // $run = mysqli_query($dbcon, $sql);
  // if (mysqli_num_rows($run)) {
  //   // แสดงว่ามีการเพิ่มกิจกรรมไว้ก่อนหน้านี้แล้วแต่ยังไม่มีการทำกิจกรรม (status = unactivated)
  //   // จึงต้องเช็คว่าได้มีการลบกิจกรรมนี้ออกจากรายการหรือไม่ หรือไม่ได้ลบออกจากรายการ
  //   while ($rs = mysqli_fetch_array($run, MYSQL_ASSOC)) {
  //     array_push($arr_acid_old, $rs['ac_id']);
  //     foreach ($arr_acid_old as $old_key => $value) {
  //       if (!in_array($value, $arrData)) {
  //         // ถ้าในรายการเดิมมีแต่รายการใหม่ไม่มี (หาในรายการใหม่ไม่เจอ)
  //         // แสดงว่ารายการนั้นถูกลบไปแล้ว
  //         $sql = "DELETE FROM composite_grp_act 
  //                 WHERE composite_grp_act.group_id = $gId
  //                 AND composite_grp_act.ac_id = $value";
  //         mysqli_query($dbcon, $sql);
  //         echo "ลบ".$sql;
  //       }
  //     }
  //     foreach ($arrData as $new_key => $value) {
  //       if (!in_array($value, $arr_acid_old)) {
  //         // ถ้าในรายการใหม่มีแต่รายการเดิมไม่มี (หาในรายการเดิมไม่เจอ)
  //         // แสดงวันรายการนั้นถูกเพิ่มเข้ามา
  //         $sql = "INSERT INTO composite_grp_act (com_id, group_id, ac_id, no, status) 
  //                 VALUES (NULL, '$gId', '$value', '0', 'unactivated')";
  //         mysqli_query($dbcon, $sql);
  //         echo "เพิ่ม".$sql;
  //       }
  //     }
  //   }
  // } else {
  // /*+--------------------------------------------------------------------------------------------------+
  //   | แสดงว่ายังไม่มีการเพิ่มกิจกรรมใดๆ ลงไปในลูกค้านี้หรือกิจกรรมนั้นถูกทำแล้ว (status = activate)
  //   | จะทำการบันทึกข้อมูลลงฐานข้อมูล ส่วนกิจกรรมที่ทำแล้วจะไม่ถูกแสดงตั้งแต่แรก
  //   | จึงยืนยันได้ว่าจะไม่มีกิจกรรมที่ทำจะหลุดมาในหน้านี้
  //   +--------------------------------------------------------------------------------------------------+*/
  //   foreach ($arrData as $key => $value) {
  //     $sql = "INSERT INTO composite_grp_act (com_id, group_id, ac_id, no, status) 
  //             VALUES (NULL, '$gId', '$value', '0', 'unactivated')";
  //     mysqli_query($dbcon, $sql);
  //     echo "ใหม่".$sql;
  //   }
  // }
  foreach ($arrData as $key => $value) {
    $sql = "INSERT INTO composite_grp_act (com_id, group_id, ac_id, no, status) 
            VALUES (NULL, '$gId', '$value', '0', 'unactivated')";
    mysqli_query($dbcon, $sql);
  }
  mysqli_close($dbcon); 
?>