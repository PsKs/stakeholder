<?php  
  session_start();//session starts here 
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
    <!-- Bootstrap Table -->
    <link rel="stylesheet" href="../css/bootstrap-table.css">
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
      .ml10 {
        color: #000;
        /*margin-left: 10px;*/
      }
      .ml10:hover {
        color: #7B1FA2;
      }
      .gName {
        color: #000;
      }
      .gName:hover {
        color: #7B1FA2;
        /*text-decoration: none;*/
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

  <div class="col-sm-9">
    <table data-toggle="table"
           data-height="400"
           data-url="lib/fetch_groups.php"
           data-search="true"
           data-sort-order="desc">
      <thead>
        <tr>
          <th data-field="group_name" data-formatter="group_name" data-width="10" data-align="center" data-sortable="true">ชื่อกลุ่ม</th>        
          <th data-field="count_user" data-formatter="count_user" data-width="10" data-align="center" data-sortable="true">จำนวนสมาชิก</th>
          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents" data-width="10" data-align="center">กิจกรรม</th>
        </tr>
      </thead>
    </table>
    <script type="text/javascript">
      function group_name(value, row, index) {
        return '<a class="gName" href="group_detail.php">' + row.group_name + '</a>';
      }
      function actionFormatter(value, row, index) {
        return [
          '<a class="view ml10" href="javascript:void(0)" title="ดูรายละเอียดกิจกรรม">',
          '<i class="glyphicon glyphicon-list-alt"></i>',
          '</a>'
        ].join('');
      }
      window.actionEvents = {
        'click .view': function (e, value, row, index) {
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
<script>
  var menuLeft = document.getElementById('cbp-spmenu-s1'),
    body = document.body;
  showLeft.onclick = function() {
    classie.toggle(this, 'active');
    classie.toggle(menuLeft, 'cbp-spmenu-open');
  };
</script>