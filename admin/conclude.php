<?php  
  require("lib/authen_admin.php");
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

  <div class="col-md-10 col-md-offset-1">
    <table data-toggle="table"
           data-height="400"
           data-url="lib/fetch_groups.php"
           data-search="true"
           data-sort-order="desc">
      <thead>
        <tr>
          <th data-field="group_name" data-formatter="group_name" data-events="actionEvents" data-width="400" data-align="center" data-sortable="true">ลูกค้า</th>        
          <th data-field="count_user" data-formatter="count_user" data-align="center" data-sortable="true">จำนวนกลุ่ม</th>
          <th data-field="count_ac" data-formatter="count_ac" data-align="center" data-sortable="true">จำนวนกิจกรรม</th>
          <th data-field="created" data-formatter="created" data-align="center" data-sortable="true">สร้างเมื่อ</th>
          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents" data-align="center">ดูกิจกรรม</th>
        </tr>
      </thead>
    </table>
  </div>
  <script type="text/javascript">
    function group_name(value, row, index) {
      return '<a class="gName" href="javascript:void(0)">' + row.group_name + '</a>';
    }
    function actionFormatter(value, row, index) {
      return [
        '<a class="view ml10" href="javascript:void(0)" title="ดูรายละเอียดกิจกรรม">',
        '<i class="glyphicon glyphicon-list-alt"></i>',
        '</a>'
      ].join('');
    }
    window.actionEvents = {
      'click .view, .gName': function (e, value, row, index) {
        // console.log(value, row, index);
        var dataString = 'group_id=' + row.group_id + '&count_ac=' + row.count_ac;
        jQuery.ajax ({
          type: "POST", // HTTP method POST or GET
          url: "group_detail.php", //PHP Page where all your query will write
          dataType: "text", // Data type, HTML, json etc.
          data: dataString, //Form Field values
          complete: function(data){
            console.log(dataString);
            //ส่งแบบ GET ไปก่อน
            window.location = 'group_detail.php?' + dataString;
          }
        });
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