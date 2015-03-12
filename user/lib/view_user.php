<?php
  require("../connect.php");
  $i = 0;
  $stklist_name = array(array());
  $stklist_id = array(array());
  $sql = "SELECT answer.ac_id, answer.ans_detail, activity.ac_no, activity.ac_name, activity.position 
          FROM answer 
          LEFT JOIN activity 
          ON answer.ac_id = activity.ac_id 
          WHERE user_id = $user_id 
          ORDER BY answer.ac_id ASC";
  $run = mysqli_query($dbcon, $sql);
  while ($rs = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $ac_id[] = $rs['ac_id'];
    $ac_no[] = $rs['ac_no'];
    $ac_name[] = $rs['ac_name'];
    $ac_pos[] = $rs['position'];
    $ans_detail[] = $rs['ans_detail'];
    $sql_2 = "SELECT stakeholder.stklist_id, stakeholder_list.stklist_name 
              FROM stakeholder_list 
              LEFT JOIN stakeholder 
              ON (stakeholder.stklist_id = stakeholder_list.stklist_id) 
              LEFT JOIN activity 
              ON (stakeholder.ac_id = activity.ac_id) 
              WHERE activity.ac_id = ".$rs['ac_id'];
    $run_2 = mysqli_query($dbcon, $sql_2);
    while ($rs_2 = mysqli_fetch_array($run_2, MYSQL_ASSOC)) {
      $stklist_id[$i][] = $rs_2['stklist_id'];
      if (preg_match('/[^A-Za-z0-9]*[()"]/', $rs_2['stklist_name'])) // '/[^a-z\d]/i' should also work.
      {
        // string contains only english letters & digits & ()""
        $stklist_name[$i][] = short_name($rs_2['stklist_name'], 15);    
      } else {
         $stklist_name[$i][] = $rs_2['stklist_name'];
      }
    }
    $i++;
  }
  mysqli_free_result($run);
  mysqli_free_result($run_2);
  mysqli_close($dbcon);

  function short_name($str, $limit) {
    // Make sure a small or negative limit doesn't cause a negative length for substr().
    if ($limit < 3) {
      $limit = 3;
    }
    // Now truncate the string if it is over the limit.
    if (strlen($str) > $limit) {
      return substr($str, 0, $limit - 3) . '...';
    } else {
      return $str;
    }
  }
  function array_mapping($array_keys, $array_values) {
    /* 
      Creates an array by using the values from the keys array as keys 
      and the values from the values array as the corresponding values.
    */
    foreach ($array_values as $key => $value) {
      $array_mapping[$key] = array_combine($array_keys[$key], $value);
    }
    return $array_mapping;
  }
  function split_String_in_Array($array) {
    $i = 0;
    $tmp = [];
    while ($i < count($array)) {
      /*
        Find array pattern in var string using regex and split it.
        Q&A from http://stackoverflow.com/questions/28708259/
        and return array
      */
      if (preg_match_all('~"([^"\\\]*(?s:\\\.[^"\\\]*)*)"~', $array[$i], $match))
      $tmp[$i] = $match[1];
      $i++;
    }
    return $tmp;
  }
  function split_String_in_Array_ANS($array) {
    /*
      function นี้ต่างออกไปคือรูปแบบของ Array string เป็น [["a","b","c","d"],["e","f","g","h"]]
      แต่งต่างจาก function split_String_in_Array ตรงที่มี "],[" คั่นกลาง
      ทำให้ไม่สามารถใช้ function เดิมได้ แต่มีข้อดีคือใช้ "],[" เป็นตัวแบ่ง row ได้
      ซึ่งเป็นที่การออกแบบ Dynamic table ในไฟล์ user/take.php
      คืนค่าเป็น Array 3dimension ความหมายที่คืนค่าคือ Array[ac_id][row][col]
      ของ user ที่ทำกิจกรรมทั้งหมด
    */
    $tmp = [];
    $r = [];
    foreach ($array as $key => $value) {
      $tmp[$key] = explode('"],["', $value);
      // print_r($tmp[$i]);
      foreach ($tmp[$key] as $ky => $val) {
        $r[$key][$ky] = explode('","', trim($val, '[]"'));
        // print_r($r[$ky]);
      }
    }
    return $r; 
  }
  function move_position($array_position, $array_move) {
    foreach ($array_position as $key => $value) {
      foreach ($value as $ky => $val) {
        $tmp[$key][] = $array_move[$key][$val];
      }
    }
    // print_r($tmp);
    return $tmp;
  }

  $arr_stklist = array(array());
  $arr_stklist = array_mapping($stklist_id, $stklist_name);
  // print_r($arr_stklist);
  // print_r($ac_pos[0]);
  /* 
    ข้อมูลอยู่ในรูปแบบ Array string e.g. ["foo","bar","bra bra"]
    นำค่าไปใช้งานยังไม่ได้ต้องแปลงเป็น Array ก่อนจึงสามารถ
    เรียกใช้งานรายตัวได้ 
    คืนค่าเป็น Array
  */
  $ac_pos = split_String_in_Array($ac_pos);
  // print_r($ac_pos);
  $arr_stklist = move_position($ac_pos, $arr_stklist);
  // print_r($arr_stklist);
  $ans_detail = split_String_in_Array_ANS($ans_detail);
  // print_r($ans_detail);
?>