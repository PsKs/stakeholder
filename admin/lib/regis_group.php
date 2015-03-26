<?php
  require_once("PasswordHash.php");
  require_once("mcrypt-cbc.php");
  /*+--------------------------------------------------------------------------------------------------+
    | เช็คว่ามีค่าส่งมาครบไหม ถ้าตัวใดตัวหนึ่งไม่มีค่าจะทำให้ condition เป็น true และจะไม่ทำงานต่อ
    | แต่ค่าที่ส่งมาจะมาจาก tab ที่เลือกได้ระหว่าง auto กับ manual ซึ่งจะ
    | เกดกรณีที่ตัวใดตัวหนึ่ง คือ password หรือ amount จะเป็น true เสมอๆ (เกิดค่าว่าง)
    | ดังนั้นต้องแยกเช็คสองตัวนี้ออกไปก่อนไม่เช่นนั้นจะทำให้ condition นี้เป็น true เสมอ
    | และไม่สามารถทำงานได้
    +--------------------------------------------------------------------------------------------------+*/
  if ((empty($_POST['username']) || empty($_POST['name'])) || (empty($_POST['password']) && empty($_POST['amount'])))
    exit;
  /*+--------------------------------------------------------------------------------------------------+
    | ใช้คำสั่ง urldecode เพื่อแปลงค่ากลับเนื่องจากการใช้คำสั่ง serializeArray
    | ทำให้อักขระที่เป็นภาษาไทยและอื่นๆ ถูกแปลงค่าไป
    | จะต้องทำการ decode ค่าก่อนนำไปใช้งาน
    +--------------------------------------------------------------------------------------------------+*/
  foreach($_POST as $key => $value) {
    $_POST[$key] = urldecode($value);
  }
  // print_r($_POST);
  $username = $_POST['username'];
  $name = $_POST['name'];
  $group_id = $_POST['group_id'];
  $user_type = "user";
  if (!empty($_POST['password'])) {  /* Manual Register */
    $password = $_POST['password'];
    @$encrypted = encrypt($username, $password);
    if (check_n_regis($username, $encrypted, $user_type, $group_id, $name)) {
      echo "# Found Duplicate Username #\n# System Will Terminate #";
    } else {
      echo "User Registered.";
    }
  } elseif (!empty($_POST['amount'])) {  /* Automatic Register */
    $amount = $_POST['amount'];
    for ($i=1; $i <= $amount; $i++) { 
      $u = $username.mt_rand_str(6);
      $n = $name.' '.$i;
      @$encrypted = encrypt($u, mt_rand_str(9, 'abcdefghijklmnopqrstuvwxyz1234567890'));
      if (check_n_regis($u, $encrypted, $user_type, $group_id, $n)) {
        echo "# Found Duplicate Username #\n# System Will Generate Username Again #";
        $i--;
      } else {
        echo "User Registered.";
      }
    }
  }

  function mt_rand_str ($l, $c = '1234567890') {
    for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
    return $s;
  }
  /*+--------------------------------------------------------------------------------------------------+
    | สร้างกระบวนการเข้ารหัสแบบ two way data encryption & decryption
    | ซึ่งสามารถถอดรหัสออกมาในภายหลังได้เพราะว่า admin เป็นคนที่เพิ่ม user เอง
    | ต่างจาก one way ที่ไม่สามารถถอดรหัสออกมาได้ซึ่งใช้ในกรณีที่ user ลงทะเบียน
    +--------------------------------------------------------------------------------------------------+*/
  function encrypt($uKey, $encrypt) {
    $salt = '@wiseconsulting';
    $count = 1000;
    $key_length = 32;
    $key = pbkdf2('SHA256', $uKey, $salt, $count, $key_length, false);
    define('ENCRYPTION_KEY', $key);
    $data = $encrypt;
    $encrypted_data = mc_encrypt($data, ENCRYPTION_KEY);
    // echo 'Data to be Encrypted: ' . $data . "\n";
    // echo 'Encrypted Data: ' . $encrypted_data . "\n";
    // echo 'Decrypted Data: ' . mc_decrypt($encrypted_data, ENCRYPTION_KEY) . "\n";
    return $encrypted_data;
  }
  function decrypt($uKey, $encrypted_data) {
    $salt = '@wiseconsulting';
    $count = 1000;
    $key_length = 32;
    $key = pbkdf2('SHA256', $uKey, $salt, $count, $key_length, false);
    define('ENCRYPTION_KEY', $key);
    $decrypted_data = mc_decrypt($encrypted_data, ENCRYPTION_KEY);
    return $decrypted_data;
  }
  function check_n_regis($username, $password, $user_type, $group_id, $name) {
    require("../../connect.php");
    // echo "#".$username."\n#".$password."\n#".$user_type."\n#".$group_id."\n#".$name."\n";
    $sql = "SELECT * FROM stakeholder.users WHERE users.username LIKE '$username'";
    $run = mysqli_query($dbcon, $sql);
    if (mysqli_num_rows($run)) {
      mysqli_free_result($run);
      return true;
    } else {
      $sql = "INSERT INTO stakeholder.users (user_id, username, password, user_type, group_id, name, created) 
              VALUES (NULL, '$username', '$password', '$user_type', '$group_id', '$name', CURRENT_TIMESTAMP)";
      $run = mysqli_query($dbcon, $sql);
      if ($run) {
        echo "Success: ";
      } else {
        echo "Failure: ".mysqli_error($dbcon);
      }
      return false;
    }
    mysqli_close($dbcon);
  }
?>