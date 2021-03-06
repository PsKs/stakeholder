<?php
  // print_r($_POST['group_id']);
  require("lib/authen_admin.php");
  $group_id = $_GET['group_id'];
  $count_ac = $_GET['count_ac'];
  if ($count_ac === '0') {
    header('Location: conclude.php');
  }
  require("lib/fetch_group_detail.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Pongsakorn Sonto">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <title>Atwise Workshop for Analysis System</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/default.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="../css/jquery.dataTables.css">
    <link rel="stylesheet" href="../css/dataTables.colvis.jqueryui.css">
    <link rel="stylesheet" href="../css/dataTables.colvis.min.css">
    <style type="text/css">
      .table {
        font-size: 110%;
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
    function table(group, ac, us, type) {  
      $(document).ready(function() {
        var table = $('#show_answer'+ac).DataTable( {
          "ajax": "lib/fetch_ans_group.php?group_id=" + group + "&ac_id=" + ac + "&user_id=" + us + "&type=" + type,
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
  <div class="bs-docs-header" id="content">
    <div class="container">
      <h1>Admin</h1>
      <p>Atwise Workshop for Analysis System</p><p>Atwise Consulting Co., Ltd. Success Management Company.</p>
      <button type="button" class="btn btn-primary outline pull-right" id="showLeft">
      <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
      </button>
    </div>
  </div>
  <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
    <h3>Menu</h3>
    <a href="index.php">Overview</a>
    <a href="create_ac.php">Create Activity</a>
    <a href="view_ac.php">View Activity</a>
    <a href="conclude.php">Conclude</a>
    <a href="../logout.php">Logout</a>
  </nav>
  <!-- End Menu -->

  <div class="col-md-7 col-md-offset-3">
    <a href="conclude.php"><button type="button" class="btn btn-primary" title="Back to Groups">Customers</button>
    </a>
    <!-- Split button -->
    <div class="btn-group">
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Activities <span class="caret"></span>
      </button>
      <ul class="activities dropdown-menu" role="menu">
        <?php
          $arr = fetch_activities_list($group_id);
          // print_r($arr);
          // echo count($arr['ac_id']);
          for ($i=0; $i < count($arr['ac_id']); $i++) { 
            echo "<li><a href='#' value='".$arr['ac_id'][$i]."'>กิจกรรมที่ ".$arr['ac_no'][$i]." - ".$arr['ac_name'][$i]."</a></li>";
          }
        ?>
        <li class="divider"></li>
        <li><a href="#" >สรุปกิจกรรมทั้งหมด</a></li>
      </ul>
    </div>
    <!-- Split button -->
    <div class="btn-group">
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Groups <span class="caret"></span>
      </button>
      <ul class="users dropdown-menu" role="menu">
        <?php
          $arr = fetch_users_list($group_id);
          for ($i=0; $i < count($arr['user_id']); $i++) { 
            echo "<li><a href='#' value='".$arr['user_id'][$i]."'>".$arr['name'][$i]."</a></li>";
          }
        ?>
        <!-- <li class="divider"></li> -->
        <!-- <li><a href="#">Separated link</a></li> -->
      </ul>
    </div>
    <button type="button" class="btn btn-info" id="collapse-init">
      Expand All
    </button>
  </div>
  <div class="col-md-12" style="margin-top: -20px;">
  <div class="panel-group" id="accordion">
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
            table(group_id, ac_id, 0, "activity");
          </script>
          <table id="show_answer<?=$ac?>" class="table hover compact order-column" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>กลุ่ม</th>
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
  <script>
    $('ul.activities a').click(function(event){
      event.preventDefault();
      var ac = $(this).attr('value');
      var dataStr = 'group_id=' + group_id + '&activity_id=' + ac;
      console.log(dataStr);
      $.ajax({
        type: 'POST',
        url: 'show_table.php',
        data: dataStr,
        complete: function(data){
          console.log("DONE");
          //ส่งแบบ GET ไปก่อน
          window.location = 'show_table.php?' + dataStr;
        }
      });
    });
    $('ul.users a').click(function(event){
      event.preventDefault();
      var usr = $(this).attr('value');
      var dataStr = 'group_id=' + group_id + '&user_id=' + usr;
      console.log(dataStr);
      $.ajax({
        type: 'POST',
        url: 'show_table.php',
        data: dataStr,
        complete: function(data){
          console.log("DONE");
          //ส่งแบบ GET ไปก่อน
          window.location = 'show_table.php?' + dataStr;
        }
      });
    });
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
        body = document.body;
    showLeft.onclick = function() {
      classie.toggle(this, 'active');
      classie.toggle(menuLeft, 'cbp-spmenu-open');
    };
  </script>
  </body>
</html>