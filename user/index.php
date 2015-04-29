<?php  
  require("lib/authen_user.php");
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
    <!-- Bootstrap Table -->
    <link rel="stylesheet" href="../css/bootstrap-table.css">
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
  <div class="bs-docs-header" id="content">
    <div class="container">
      <h1><?=$name?></h1>
      <p>Atwise Workshop for Analysis System</p><p>Atwise Consulting Co., Ltd. Success Management Company.</p>
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
      <a href="../logout.php">Logout</a>
    </nav>
  </div>
  <!-- End Menu -->

  <div class="col-md-9">
    <!-- Content Body -->
    <table data-toggle="table"
           data-url="lib/fetch_ac_user.php">
      <thead>
        <tr>
          <th data-field="ac_no" data-formatter="noActivity" data-width="10" data-align="center">กิจกรรมที่</th>
          <th data-field="ac_name" data-formatter="nameActivity">ชื่อกิจกรรม</th>
          <th data-field="description">Description</th>
          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents" data-width="10" data-align="center">Action</th>
        </tr>
      </thead>
    </table>
  </div>
  <script>
    function nameActivity(value, row, index) {
      return '<a class="gName" href="take.php?ac=' + row.ac_id + '">' + value + '</a>';
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
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
        body = document.body;
    showLeft.onclick = function() {
      classie.toggle(this, 'active');
      classie.toggle(menuLeft, 'cbp-spmenu-open');
    };
  </script>
  </body>
</html>