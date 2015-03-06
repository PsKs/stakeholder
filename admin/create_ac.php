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
  <div class="col-sm-8">
  <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">Create Activity</h4> 
        </div>
        <div class="panel-body">
    <form method="post" action="create_ac.php" class="form-horizontal">
    <div class="form-group">
        <label for="noActivity" class="col-xs-2">กิจกรรมที่</label>
        <div class="col-xs-7">
        <input class="form-control" type="text" name="noActivity" id="noActivity" placeholder="Activity No." autofocus/>
        </div>
    </div>
    <div class="form-group">
        <label for="nameActivity" class="col-xs-2">ชื่อกิจกรรม</label>
        <div class="col-xs-7">
        <input class="form-control" type="text" name="nameActivity" id="nameActivity" placeholder="Activity Name" />
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
              <input type="checkbox" name="<?php echo $stklist_id; ?>" id="<?php echo $stklist_id; ?>" value="<?php echo $stklist_name; ?>"> <?php echo $stklist_name; ?>
              </label>   
              <!-- <tr>  
                  here showing results in the table  
                  <td><?php echo $stklist_id; ?></td>           
                  <td><?php echo $stklist_name; ?></td>  
                  <td align="center"><a href="delete.php?del=<?php echo $user_id ?>"><button class="btn btn-primary">Select</button></a></td> 
              </tr>
              -->
              <?php } ?>
          </table>
          <button type="button" class="btn btn-info alertAdd">
          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add </button>  
        </div> 
      </div>
    </div>
    <div class="form-group">
      <div class="col-xs-12" align="right">
          <button type="submit" class="btn btn-success">Create</button> 
          <button type="reset" class="btn btn-warning">Reset</button>
      </div>
    </div>
        </form>
        </div>
      </div>
    </div>   
  </div>
  <script>
    $(document).on("click", ".alertAdd", function(e) {
      bootbox.dialog({
                title: "เพิ่มรายการ",
                message: '<div class="row">  ' +
                    '<div class="col-md-12"> ' +
                    '<form class="form-horizontal"> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="name">ชื่อรายการ</label> ' +
                    '<div class="col-md-4"> ' +
                    '<input id="name" name="name" type="text" placeholder="Name" class="form-control input-md" autofocus/> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="stklist_type">ประเภทของรายการ</label> ' +
                    '<div class="col-md-4"> <div class="radio"> <label for="stklist_type-0"> ' +
                    '<input type="radio" name="stklist_type" id="stklist_type-0" value="text" checked="checked"> ' +
                    'ข้อความ </label> ' +
                    '</div><div class="radio"> <label for="stklist_type-1"> ' +
                    '<input type="radio" name="stklist_type" id="stklist_type-1" value="level"/>ระดับ (1-5)</label> ' +
                    '</div> ' +
                    '<div class="radio"> <label for="stklist_type-2"> ' +
                    '<input type="radio" name="stklist_type" id="stklist_type-2" value="sum"/>ผลรวม</label> ' +
                    '</div> ' +
                    '</div> </div>' +
                    '</form> </div>  </div>',
                buttons: {
                    success: {
                        label: "Save",
                        className: "btn-success",
                        callback: function () {
                            var name = $('#name').val();
                            var stklist_type = $("input[name='stklist_type']:checked").val();
                            if(name) {
                              var dataString = 'firstField='+ name + '&secondField='+ stklist_type ; //build a post data structure
                              jQuery.ajax({
                              type: "POST", // HTTP method POST or GET
                              url: "create_ac.php", //PHP Page where all your query will write
                              dataType: "text", // Data type, HTML, json etc.
                              data: dataString, //Form Field values
                              success: function(data) {
                                  //$("#YourDivId").html(data); //Your Div Id Where Your listing is placed 
                                  //$("#PopUPDiv").hide(); // Hide Div after success
                                  //alert(data);
                                  window.location.reload();
                              }
                              });
                              //window.alert("Hello " + name + ". You've chosen <b>" + stklist_type + "</b>");
                            }
                        }
                    },
                    cancel: {
                        label: "Cancel",
                        className: "btn-default"
                    }
                }
            }
        );
    });
  </script> 
  </body>
</html>
<?php
  require("../connect.php");
  if (!empty($_POST['noActivity']) && !empty($_POST['nameActivity'])) {
    # code...
    $noActivity = $_POST['noActivity'];
    $nameActivity = $_POST['nameActivity'];
    //$stklist_id = $_POST['inlineCheckbox'];
    // print_r($_POST);
    $insert_activity = "insert into activity (ac_no, ac_name) VALUE ('$noActivity', '$nameActivity')";
    if(mysqli_query($dbcon, $insert_activity))  
    {
      /*
        Array ของ method $_POST ที่จะเก็บ fields ของประเภทจะเริ่มที่ 2
      */
      $i = 0;
      foreach($_POST as $name => $value) {
        // Here you have access to parameter names and their values
        // echo "<p>name is $name and value is $value</p>";
          if ($i >= 2) {
            $insert_stakeholder = "insert into stakeholder (ac_id, stklist_id) VALUE ((select MAX(ac_id) from activity), '$name')";
            mysqli_query($dbcon, $insert_stakeholder);
          }
        $i++;
      }
      //print_r($stakeholder_list);
      //echo "<div class='alert alert-success'>Activity has been created successfully.</div>";
      echo "<script>window.alert('Activity has been created successfully.')</script>";  
    }
  } else {
    echo "No";
  }
  if (!empty($_POST['firstField']) && !empty($_POST['secondField'])) {
    $stklist_name = $_POST['firstField'];
    $stklist_type = $_POST['secondField'];
    $insert_stakeholder_list = "insert into stakeholder_list (stklist_name, stklist_type) VALUE ('$stklist_name', '$stklist_type')";
    if (mysqli_query($dbcon, $insert_stakeholder_list)) {
      echo "Stakeholder list has been created successfully.";
    }
  }
?>
<script>
  var menuLeft = document.getElementById('cbp-spmenu-s1'),
    body = document.body;
  showLeft.onclick = function() {
    classie.toggle(this, 'active');
    classie.toggle(menuLeft, 'cbp-spmenu-open');
  };
</script>