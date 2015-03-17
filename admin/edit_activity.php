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
    $arr_stklist_id[] = $rs['stklist_id'];
    $arr_stklist_name[] = $rs['stklist_name'];
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
    <meta name="author" content="Pongsakorn Sonto">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <title>Adwise Workshop for Analysis System</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
    </style>  
  </head>
  <body>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="../js/jquery-1.11.2.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="../js/bootstrap.min.js"></script>
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Edit Activity</h4> 
          </div>
          <div class="panel-body">
          <form method="post" id="foo" class="form-horizontal">
            <div class="form-group">
              <label for="noActivity" class="col-xs-2">กิจกรรมที่</label>
              <div class="col-xs-7">
                <input class="form-control" type="text" name="noActivity" id="noActivity" value="<?php echo $ac_no; ?>"/>
              </div>
            </div>
            <div class="form-group">
              <label for="nameActivity" class="col-xs-2">ชื่อกิจกรรม</label>
              <div class="col-xs-7">
                <input class="form-control" type="text" name="nameActivity" id="nameActivity" value="<?php echo $ac_name; ?>" autofocus/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-2">Select lists</label>
              <div class="table-scrol col-xs-7">  
                <div class="table-responsive"><!--this is used for responsive display in mobile and other devices-->    
                  <table class="table table-bordered table-hover table-striped" style="table-layout: fixed">
                  <?php  
                    require("../connect.php");  
                    $view_stakeholder_list = "select stklist_id, stklist_name from stakeholder_list";//select query for viewing users.  
                    $run = mysqli_query($dbcon, $view_stakeholder_list);//here run the sql query.  
                    while($row = mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
                    {
                        $stklist_id = $row['stklist_id'];  
                        $stklist_name = $row['stklist_name'];  
                  ?>
                  <label class="checkbox-inline">
                  <input type="checkbox" name="stklist" id="<?php echo $stklist_id; ?>" value="<?php echo $stklist_name; ?>" 
                  <?php
                    if (in_array($stklist_name,$arr_stklist_name)) {
                       echo "checked";
                     } 
                  ?> > <?php echo $stklist_name; ?>
                  </label>   
                  <?php } ?>
                  </table>  
                </div> 
              </div>
            </div>
          <div class="form-group">
            <div class="col-xs-12" align="right">
              <button type="submit" class="btn btn-success">Save</button> 
              <a href="view_ac.php">
              <button type="button" class="btn btn-default">Cancel</button>
              </a>
            </div>
            <!-- The result of the search will be rendered inside this div -->
            <div id="result"></div>
          </div>
        </form>
        <script type="text/javascript">
          var ac_id = <?php echo json_encode($ac_id) ?>;
          var arrStklist_id_old = <?php echo json_encode($arr_stklist_id) ?>;

          /* Attach a submit handler to the form */
          $("#foo").submit(function(event) {
            // Get the value from a checked checkbox
            // var arrStklist_id_new = $("input[type=checkbox]:checked").serialize();
            // ไม่ได้ส่งไปเป็น Array แต่เป็น String
            var arrStklist_id_new = $("input[name='stklist']:checked").map(function() { return this.id; }).get().join();

            /* Stop form from submitting normally */
            event.preventDefault();

            /* Clear result div*/
            $("#result").html('');

            /* Get some values from elements on the page: */
            var values = $(this).serialize() + '&arrStklist_id_old=' + arrStklist_id_old + '&arrStklist_id_new=' + arrStklist_id_new + '&ac_id='+ ac_id;

            /* Send the data using post and put the results in a div */
            $.ajax({
              url: "/lib/update_ac.php",
              type: "POST",
              dataType: "text",
              data: values,
              success: function(){
                  // alert("success");
                  alert(values);
                  // $("#result").html('Submitted successfully');
                  // $("#result").html(values);
                  // console.log(values);
                  window.location.href = "view_ac.php";
              },
              error:function(){
                  alert("failure");
                  $("#result").html('There is error while submit');
              }
            });
          });
        </script>
      </div>
    </div>
  </div>   
  </body>
</html>