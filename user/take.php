<?php  
  session_start();//session starts here 
  require("../connect.php");
  $ac_id = $_GET['ac'];
  $sql = "select activity.ac_no, activity.ac_name, stakeholder_list.stklist_id, stakeholder_list.stklist_name 
          from stakeholder_list 
          left join stakeholder on (stakeholder.stklist_id = stakeholder_list.stklist_id) 
          left join activity on (stakeholder.ac_id = activity.ac_id) 
          where activity.ac_id = ".$ac_id;
  $run = mysqli_query($dbcon, $sql);
  while ($rs = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $ac_no = $rs['ac_no'];
    $ac_name = $rs['ac_name'];
    echo $arr_stklist_id[] = $rs['stklist_id'];
    echo $arr_stklist_name[] = $rs['stklist_name'];
  }
  mysqli_free_result($run);
  mysqli_close($dbcon);  
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
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">กิจกรรมที่ <?php echo $ac_no; ?>  <?php echo $ac_name; ?></h4> 
        </div>
        <div class="panel-body">
          <form method="post" id="foo" class="form-horizontal">
            <div class="form-group">
              <label for="noActivity" class="col-xs-2">กิจกรรมที่</label>
              <div class="col-xs-7">
                <textarea class="form-control" rows="3"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="nameActivity" class="col-xs-2">ชื่อกิจกรรม</label>
              <div class="col-xs-7">
                <input class="form-control" type="text" name="nameActivity" id="nameActivity" value="<?php echo $ac_name; ?>" autofocus/>
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12" align="right">
                <button type="submit" class="btn btn-success">Save</button> 
                <a href="view_ac.php">
                <button type="button" class="btn btn-default">Cancel</button>
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </body>
</html>