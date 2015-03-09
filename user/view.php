<?php
  session_start();//session starts here
  require("../connect.php");
  $user = 2;
  $i = 0;
  $stklist_name = array(array());
  $stklist_id = array(array());
  $sql = "SELECT answer.ac_id, answer.ans_detail, activity.ac_no, activity.ac_name, activity.position FROM answer LEFT JOIN activity ON answer.ac_id = activity.ac_id WHERE user_id = 2 ORDER BY answer.ac_id ASC";
  $run = mysqli_query($dbcon, $sql);
  while ($rs = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $ac_id[] = $rs['ac_id'];
    $ac_no[] = $rs['ac_no'];
    $ac_name[] = $rs['ac_name'];
    $ac_pos[] = $rs['position'];
    $ans_detail[] = $rs['ans_detail'];
    $sql_2 = "SELECT stakeholder.stklist_id, stakeholder_list.stklist_name FROM stakeholder_list LEFT JOIN stakeholder ON (stakeholder.stklist_id = stakeholder_list.stklist_id) LEFT JOIN activity ON (stakeholder.ac_id = activity.ac_id) WHERE activity.ac_id = ".$rs['ac_id'];
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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/dataTables.colvis.jqueryui.css" rel="stylesheet">
    <link href="../css/dataTables.colvis.min.css" rel="stylesheet">
    <!-- <link href="../css/bootstrap-table.css" rel="stylesheet"> -->
    <!-- DataTables CSS -->
    <link href="../css/dataTables.bootstrap.css" rel="stylesheet">
    <!-- <link href="../css/jquery.dataTables.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        @media (min-width: 768px) {
          .sidebar-nav .navbar .navbar-collapse {
            padding: 0;
            max-height: none;
          }
          .sidebar-nav .navbar ul {
            float: none;
          }
          .sidebar-nav .navbar ul:not {
            display: block;
          }
          .sidebar-nav .navbar li {
            float: none;
            display: block;
          }
          .sidebar-nav .navbar li a {
            padding-top: 12px;
            padding-bottom: 12px;
          }
          .ml10 {
            margin-left: 10px;
          }
        }
        .panel {  
          margin-top: 50px;
        }
        .panel-heading a:after {
          font-family:'Glyphicons Halflings';
          content:"\e114";
          float: right;
          color: #808080;
        }
        .panel-heading a.collapsed:after {
          content:"\e080";
        }
        .table {
          font-size: 110%;
        }
        .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
          background-color: #dcdcdc;
        }
    </style>
  </head>
  <body>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="../js/jquery-1.11.2.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/bootstrap-table.js"></script>
  <script src="../js/bootbox.min.js"></script>
  <!-- DataTables -->
  <script src="../js/jquery.dataTables.js"></script>
  <script src="../js/dataTables.colVis.min.js"></script>
  <script>
    function table(ac) {  
      $(document).ready(function() {
        var table = $('#show_answer'+ac).DataTable( {
          "ajax": "lib/fetch_proceed.php?ac_id="+ac,
          "dom": 'C<"clear">lfrtip',
          "paging": false,
          "searching": false
        });
      });
    }
    $(function () {
      var active = true;
      $('#collapse-init').click(function () {
        if (active) {
          active = false;
          $('.panel-collapse').collapse('show');
          $('.panel-title').attr('data-toggle', '');
          $(this).text('Collapse All');
        } else {
          active = true;
          $('.panel-collapse').collapse('hide');
          $('.panel-title').attr('data-toggle', 'collapse');
          $(this).text('Expand All');
        }
      });
      // collapse แบบสลับกันออกมาโชว์ไม่มีการค้างไว้
      // $('#accordion').on('show.bs.collapse', function () {
      //     if (active) $('#accordion .in').collapse('hide');
      // });
    });
  </script>
  <h1>Prototype User</h1>
  <div class="row">
  <div class="col-md-2">
    <div class="sidebar-nav">
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="visible-xs navbar-brand">Sidebar menu</span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Overview</a></li>
            <li><a href="view.php">View Activity</a></li>
            <li><a href="#">#</a></li>
            <li><a href="#">#</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  <!-- End Menu -->
  <div class="col-md-10">
  <button id="collapse-init" class="btn btn-primary pull-right">
    Expand All
  </button>
  <div class="panel-group " id="accordion">
  <?php
    foreach ($ac_id as $key => $ac) {
  ?>
    <div class="panel panel-info" id="panel<?=$ac?>">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-target="#<?=$ac?>" 
               href="#<?=$ac?>" class="collapsed">
              กิจกรรมที่ <?=($ac_no[$key]." ".$ac_name[$key]); ?>
            </a>
          </h4>
        </div>
        <div id="<?=$ac?>" class="panel-collapse collapse">
          <div class="panel-body">
            <script type="text/javascript">
              table(<?php echo $ac; ?>);
            </script>
            <table id="show_answer<?=$ac?>" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <?php
                    foreach ($arr_stklist[$key] as $stklist_key => $stklist_value) {
                      echo "<th>".$stklist_value."</th>";
                    }
                  ?>
                </tr>
              </thead> 
            </table>
          </div>
        </div>
    </div>
  <?php
    }
  ?>
  </div>
  </div>
  </div><!-- /row -->
  </body>
</html>