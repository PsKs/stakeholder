<?php
  // print_r($_POST['group_id']);
  session_start();//session starts here
  require("../connect.php");
  $group_id = 1;
  $i = 0;
  $stklist_name = array(array());
  $stklist_id = array(array());
  $sql = "SELECT composite_grp_act.ac_id, activity.ac_no, activity.ac_name, activity.position
          FROM composite_grp_act
          LEFT OUTER JOIN activity
          ON composite_grp_act.ac_id = activity.ac_id
          WHERE composite_grp_act.group_id = ".$group_id;
  $run = mysqli_query($dbcon, $sql);
  while ($rs = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $ac_id[] = $rs['ac_id'];
    $ac_no[] = $rs['ac_no'];
    $ac_name[] = $rs['ac_name'];
    $ac_pos[] = $rs['position'];
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
  * ข้อมูลอยู่ในรูปแบบ Array string e.g. ["foo","bar","bra bra"]
  * นำค่าไปใช้งานยังไม่ได้ต้องแปลงเป็น Array ก่อนจึงสามารถ
  * เรียกใช้งานรายตัวได้ 
  * คืนค่าเป็น Array
  */
  
  $ac_pos = split_String_in_Array($ac_pos);
  // print_r($ac_pos);
  $arr_stklist = move_position($ac_pos, $arr_stklist);
  // print_r($arr_stklist);
  // $ans_detail = split_String_in_Array_ANS($ans_detail);
  // print_r($ans_detail);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Pongsakorn Sonto">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <title>Risk Management System</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/component.css">
    <link rel="stylesheet" href="../css/doc.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="../css/jquery.dataTables.css">
    <link rel="stylesheet" href="../css/dataTables.colvis.jqueryui.css">
    <link rel="stylesheet" href="../css/dataTables.colvis.min.css">
    <style type="text/css">
      /***********************
        OUTLINE BUTTONS
      ************************/
      .btn.outline {
          background: none;
          padding: 5px 5px;
      }
      .btn-primary.outline {
          border: 2px solid #fff;
          color: #fff;
      }
      .btn-primary.outline:hover, .btn-primary.outline:focus, .btn-primary.outline:active, .btn-primary.outline.active, .open > .dropdown-toggle.btn-primary {
          color: #CCCCCC;
          border-color: #CCCCCC;
      }
      .btn-primary.outline:active, .btn-primary.outline.active {
          border-color: #A5A5A5;
          color: #A5A5A5;
      }
      /***********************
        CUSTOM BTN VALUES
      ************************/
      .btn {
          padding: 10px 16px;
          border: 0 none;
          font-weight: 700;
          letter-spacing: 1px;
          text-transform: uppercase;
      }
      .btn:focus, .btn:active:focus, .btn.active:focus {
          outline: 0 none;
      }
      .panel {
        margin-top: 50px;
      }
      .panel-heading a:after {
        font-family:'Glyphicons Halflings';
        content:"\e114";
        float: right;
        color: #fff;
      }
      .panel-heading a.collapsed:after {
        content:"\e079";
      }
      .table-group {
        font-size: 110%;
      }
      /*.hover tbody tr:hover td, .table-hover tbody tr:hover th {
        background-color: #fcfcfc;
      }*/
      tr.group, tr.group:hover {
          background-color: #c5bad6 !important;
      }
      td, th { 
        text-align: left; 
      }
      .panel {
        border-color: #9a87b7;
      }
      .panel-primary > .panel-heading {
        background-color: #9a87b7 !important;
        border-color: #9a87b7;
      }
      .panel-primary > .panel-heading > .panel-title {
        font-size: 120%
      }
      .panel-primary > .panel-heading + .panel-collapse > .panel-body {
        border-color: #9a87b7;
      }
      a:focus, a:hover {
        text-decoration: none;
      }
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="../js/jquery-1.11.2.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/modernizr.custom.js"></script>
  <script src="../js/classie.js"></script>
  <!-- JS Plug-in -->
  <script src="../js/bootstrap-table.js"></script>
  <script src="../js/bootbox.min.js"></script>
  <!-- DataTables -->
  <script src="../js/jquery.dataTables.js"></script>
  <script src="../js/dataTables.colVis.min.js"></script>
  <script>
    function table(group, ac) {  
      $(document).ready(function() {
        var table = $('#show_answer'+ac).DataTable( {
          "ajax": "lib/fetch_ans_group.php?group_id="+group+"&ac_id="+ac,
          "dom": 'C<"clear">lfrtip',
          "paging": true,
          "searching": false,
          "columnDefs": [
            { "visible": false, "targets": 0 }
        ],
        "order": [[0, 'asc']],
        "displayLength": 10,
        "drawCallback": function (settings) {
          var api = this.api();
          var rows = api.rows({page:'current'}).nodes();
          var last = null;
          api.column(0, {page:'current'}).data().each( function (group, i) {
            if (last !== group) {
              $(rows).eq(i).before (
                '<tr class="group"><td colspan="8">'+group+'</td></tr>'
              );
              last = group;
            }
          });
        }
    });
    // Order by the grouping
    $('#show_answer'+ac).on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === 0 && currentOrder[1] === 'asc') {
            table.order([0, 'desc']).draw();
        } else {
            table.order([0, 'asc']).draw();
        }
          // "fnRowCallback": function(nRow, aData) {
          //   var id = aData.slice(-1).pop(); // ID is returned by the server as part of the data
          //   var $nRow = $(nRow); // cache the row wrapped up in jQuery
          //   if (id == "2") {
          //     $nRow.css({"background-color": "#FFCDD2"})
          //   }
          //   else if (id == "3") {
          //     $nRow.css({"background-color": "#E1BEE7"})
          //   }
          //   return nRow
          // }
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
          $(this).text('ย่อทั้งหมด');
        } else {
          active = true;
          $('.panel-collapse').collapse('hide');
          $('.panel-title').attr('data-toggle', 'collapse');
          $(this).text('ขยายทั้งหมด');
        }
      });
      // collapse แบบสลับกันออกมาโชว์ไม่มีการค้างไว้
      // $('#accordion').on('show.bs.collapse', function () {
      //     if (active) $('#accordion .in').collapse('hide');
      // });
    });
  </script>
  <div class="bs-docs-header" id="content">
    <div class="container">
      <h1>Admin</h1>
      <p>Risk Management System</p><p>Atwise Consulting Co., Ltd. Success Management Company.</p>
      <button type="button" class="btn btn-primary outline pull-right" id="showLeft">
      <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
      </button>
    </div>
  </div>
  <div class="row">
  <div class="col-sm-2"> 
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
      <h3>Menu</h3>
      <a href="index.php">Overview</a>
      <a href="create_ac.php">Create Activity</a>
      <a href="view_ac.php">View Activity</a>
      <a href="conclude.php">Conclude</a>
    </nav>
  </div>
  <!-- End Menu -->

  <div class="col-sm-1 col-sm-offset-10" style="margin-top: -30px;">
    <button type="button" class="btn btn-primary pull-right" id="collapse-init">
      ขยายทั้งหมด
    </button>
  </div>
  <div class="col-sm-10 col-sm-offset-1" style="margin-top: -20px;">
  <div class="panel-group " id="accordion">
  <?php
    foreach ($ac_id as $key => $ac) {
  ?>
    <div class="panel panel-primary" id="panel<?=$ac?>">
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
              var group_id = (<?php echo $group_id; ?>);
              var ac_id = (<?php echo $ac; ?>);
              table(group_id, ac_id);
            </script>
            <table id="show_answer<?=$ac?>" class="table-group hover compact order-column" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>สมาชิก</th>
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
<script>
  var menuLeft = document.getElementById('cbp-spmenu-s1'),
    body = document.body;
  showLeft.onclick = function() {
    classie.toggle(this, 'active');
    classie.toggle(menuLeft, 'cbp-spmenu-open');
  };
</script>