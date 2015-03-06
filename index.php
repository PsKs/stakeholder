<?php  
  session_start();//session starts here  
?>  
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Description here">
    <meta name="keywords" content="keywords here">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Risk Management System</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/doc.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      .login-panel {
        margin-top: 2em;
      }
      .alert-danger {
        margin-top: 2em;
      }
    </style>
  </head>
  <body>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Docs page layout -->
    <div class="bs-docs-header" id="content">
      <div class="container">
        <h1>Risk Management Systems</h1>
        <p>Atwise Consulting Co., Ltd.</p><p>Success Management Company.</p>
        <div id="carbonads-container"><div class="carbonad"><div id="azcarbon"></div></div></div>
      </div>
    </div>
    <?php
      require("login.php");
    ?> 
  </body>
</html>