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
  <h1>Prototype Admin</h1>
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
            <li><a href="create_ac.php">Create Activity</a></li>
            <li><a href="view_ac.php">Show Activity</a></li>
            <li><a href="conclude.php">Conclude</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  <!-- End Menu -->

  <div class="col-sm-9">
    <table data-toggle="table"
           data-height="500"
           data-url="lib/fetch_groups.php"
           data-search="true"
           data-sort-order="desc">
      <thead>
        <tr>
          <th data-field="group_name" data-formatter="group_name" data-width="10" data-align="center" data-sortable="true">ชื่อกลุ่ม</th>        
          <th data-field="count_user" data-formatter="count_user" data-width="10" data-align="center" data-sortable="true">จำนวนสมาชิก</th>
          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents" data-width="10" data-align="center">ดูกิจกรรม</th>
        </tr>
      </thead>
    </table>
    <script type="text/javascript">
      function group_name(value, row, index) {
        return '<a href="group_detail.php">' + row.group_name + '</a>';
      }
      function actionFormatter(value, row, index) {
        return [
          '<a class="take ml10" href="javascript:void(0)" title="ดูรายละเอียดกิจกรรม">',
          '<i class="glyphicon glyphicon-pencil"></i>',
          '</a>'
        ].join('');
      }
      window.actionEvents = {
        'click .take': function (e, value, row, index) {
          // console.log(value, row, index);
          window.location.href =  "group_detail.php";
          var dataString = 'group_id=' + row.group_id;
          jQuery.ajax ({
            type: "POST", // HTTP method POST or GET
            url: "group_detail.php", //PHP Page where all your query will write
            dataType: "text", // Data type, HTML, json etc.
            data: dataString, //Form Field values
          });
        }          
      }
    </script>
  </div>
  </body>
</html>