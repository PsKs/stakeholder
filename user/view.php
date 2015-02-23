<?php
  session_start();//session starts here
  require("../connect.php");
  // $ac_id = $_GET['ac'];
  // $sql = "select activity.ac_no, activity.ac_name, stakeholder_list.stklist_id, stakeholder_list.stklist_name, stakeholder.stk_id, stakeholder_list.stklist_type
  //         from stakeholder_list
  //         left join stakeholder on (stakeholder.stklist_id = stakeholder_list.stklist_id) 
  //         left join activity on (stakeholder.ac_id = activity.ac_id) 
  //         where activity.ac_id = ".$ac_id;
  // $run = mysqli_query($dbcon, $sql);
  // while ($rs = mysqli_fetch_array($run, MYSQL_ASSOC)) {
  //   $ac_no = $rs['ac_no'];
  //   $ac_name = $rs['ac_name'];
  //   $arr_stklist_id[] = $rs['stklist_id'];
  //   $arr_stklist_name[] = $rs['stklist_name'];
  //   $arr_stklist_type[] = $rs['stklist_type'];
  //   $arr_stk_id[] = $rs['stk_id'];
  // }
  // mysqli_free_result($run);
  // mysqli_close($dbcon);
  // $col_count = count($arr_stklist_id);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-table.css" rel="stylesheet">

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
          color: grey;
        }
        .panel-heading a.collapsed:after {
          content:"\e080";
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
  <h1>Prototype User</h1>
  <div class="row">
  <div class="col-sm-2">
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
  <div class="col-sm-10">
  <button id="collapse-init" class="btn btn-primary pull-right">
    Disable accordion behavior
  </button>
  <div class="panel-group " id="accordion">
    <div class="panel panel-default" id="panel1">
        <div class="panel-heading">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-target="#collapseOne" 
           href="#collapseOne" class="collapsed">
          Collapsible Group Item #1
        </a>
      </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
        </div>
    </div>
    <div class="panel panel-default" id="panel2">
        <div class="panel-heading">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-target="#collapseTwo" 
           href="#collapseTwo" class="collapsed">
          Collapsible Group Item #2
        </a>
      </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
        </div>
    </div>
    <div class="panel panel-default" id="panel3">
        <div class="panel-heading">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-target="#collapseThree"
           href="#collapseThree" class="collapsed">
          Collapsible Group Item #3
        </a>
      </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
        </div>
    </div>
  </div>
  </div>
  </div><!-- /row -->
  </body>
</html>
<script>
  $(function () {
    var active = true;
    $('#collapse-init').click(function () {
        if (active) {
            active = false;
            $('.panel-collapse').collapse('show');
            $('.panel-title').attr('data-toggle', '');
            $(this).text('Enable accordion behavior');
        } else {
            active = true;
            $('.panel-collapse').collapse('hide');
            $('.panel-title').attr('data-toggle', 'collapse');
            $(this).text('Disable accordion behavior');
        }
    });
    // collapse แบบสลับกันออกมาโชว์ไม่มีการค้างไว้
    // $('#accordion').on('show.bs.collapse', function () {
    //     if (active) $('#accordion .in').collapse('hide');
    // });
  });
</script>