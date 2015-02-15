<?php  
  session_start();//session starts here  
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
        a:link {
          text-decoration: none;
          color: black;
        }
        a:visited {
          text-decoration: none;
        }
        a:hover {
          text-decoration: none;
          color: #aaaaaa;
        }
        a:active {
          text-decoration: none;
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
            <li><a href="#">Activity</a></li>
            <li><a href="#">#</a></li>
            <li><a href="#">#</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  <!-- End Menu -->

  <div class="col-sm-9">
    <table data-toggle="table"
           data-url="fetch_ac_user.php">
      <thead>
        <tr>
          <th data-field="ac_no" data-formatter="noActivity" data-width="10" data-align="center">กิจกรรมที่</th>
          <th data-field="ac_name" data-formatter="nameActivity">ชื่อกิจกรรม</th>
          <th data-field="description">Description</th>
          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents" data-width="10" data-align="center">Action</th>
        </tr>
      </thead>
    </table>
    <script type="text/javascript">
      function nameActivity(value, row, index) {
        return '<a href="take.php?ac=' + row.ac_id + '">' + value + '</a>';
      }
      function actionFormatter(value, row, index) {
        return [
            '<a class="take ml10" href="javascript:void(0)" title="Take">',
            '<i class="glyphicon glyphicon-pencil"></i>',
            '</a>'
        ].join('');
      }
      window.actionEvents = {
        'click .take': function (e, value, row, index) {
          // console.log(value, row, index);
          window.location.href = "take.php?ac=" + row.ac_id;
        }          
      }
    </script>
  </div>
  </body>
</html>