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

  <div class="col-md-10">
    <!-- Content Body -->
  </div>
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