<?php
  session_start();//session starts here
  $name = $_SESSION['name'];
  $user_id = $_SESSION['user_id'];
  require("lib/check_ans.php");
  require("lib/view_user.php");
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
    <!-- <link rel="stylesheet" href="../css/jquery.dataTables.css"> -->
    <link rel="stylesheet" href="../css/dataTables.colvis.jqueryui.css">
    <link rel="stylesheet" href="../css/dataTables.colvis.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap.css">
    <style type="text/css">
      html, body {
        width: auto !important;
        overflow-x: hidden !important;
      }
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
      .table {
        /*font-size: 110%;*/
        font-size: 100%;
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
  <div class="bs-docs-header" id="content">
    <div class="container">
      <h1><?=$name?></h1>
      <p>Risk Management System</p><p>Atwise Consulting Co., Ltd. Success Management Company.</p>
      <button type="button" class="btn btn-primary outline pull-right" id="showLeft">
      <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
      </button>
    </div>
  </div>
  <div class="row">
  <div class="col-md-2"> 
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
      <h3>Menu</h3>
      <a href="index.php">Overview</a>
      <a href="view.php">View Activity</a>
    </nav>
  </div>
  <!-- End Menu -->

  <div class="col-md-10 col-md-offset-1">
  <button id="collapse-init" class="btn btn-primary pull-right">
    Expand All
  </button>
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
  <script>
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
        body = document.body;
    showLeft.onclick = function() {
      classie.toggle(this, 'active');
      classie.toggle(menuLeft, 'cbp-spmenu-open');
    };
  </script>
  </body>
</html>