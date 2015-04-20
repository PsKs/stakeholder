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
    <title>Atwise Workshop for Analysis System</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/default.css">
    <style type="text/css">
      .panel {
        margin-top: 0px;
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
  </nav>
  <!-- End Menu -->

  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">Create Activity</h4> 
      </div>
      <div class="panel-body">
        <form method="post" action="create_ac.php" class="form-horizontal">
        <div class="form-group">
          <label for="noAct" class="col-xs-2">กิจกรรมที่</label>
          <div class="col-xs-7">
            <input class="form-control" type="text" name="noAct" id="noAct" placeholder="Activity No." autofocus />
          </div>
        </div>
        <div class="form-group">
          <label for="nameAct" class="col-xs-2">ชื่อกิจกรรม</label>
          <div class="col-xs-7">
            <input class="form-control" type="text" name="nameAct" id="nameAct" placeholder="Activity Name" />
          </div>
        </div>
        <div class="form-group">
          <label for="desAct" class="col-xs-2">ลายระเอียด</label>
          <div class="col-xs-7">
            <input class="form-control" type="text" name="desAct" id="desAct" placeholder="Description" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-2">รูปแบบกิจกรรม</label>
          <div class="table-scrol col-xs-7">  
            <div class="table-responsive"><!--this is used for responsive display in mobile and other devices-->    
              <table class="table table-bordered table-hover table-striped" style="table-layout: fixed">
                <label class="radio-inline">
                  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">การระบุความเสี่ยงและการประเมินความเสี่ยง
                </label></br>
                <label class="radio-inline">
                  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">Stakeholder Analysis
                </label></br>
                <label class="radio-inline">
                  <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">SWOT and TOWS Analysis
                </label></br>
                <div class="box">
                  <a href="#" id="custom-show" class="showLink" onclick="showHide('custom');return false;"> Custom Activity</a>
                  <div id="custom" class="more">
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
                      <input type="checkbox" name="<?php echo $stklist_id; ?>" id="<?php echo $stklist_id; ?>" value="<?php echo $stklist_id; ?>"> <?php echo $stklist_name; ?>
                    </label></br>
                    <?php } ?>
                    <div class="box">
                      <p><a href="#" id="custom-hide" class="hideLink" onclick="showHide('custom');return false;"> Hide</a></p>
                    </div>
                    <button type="button" class="btn btn-info alertAdd">
                      <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new List
                    </button>
                  </div>
                </div>
              </table> 
            </div> 
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12" align="right">
            <button type="submit" class="btn btn-success">Create</button> 
            <button type="reset" class="btn btn-warning">Reset</button>
          </div>
        </div>
        </form>
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
                                  // $("#YourDivId").html(data); //Your Div Id Where Your listing is placed 
                                  // $("#PopUPDiv").hide(); // Hide Div after success
                                  // alert(data);
                                  window.location.reload();
                              }
                              });
                              // window.alert("Hello " + name + ". You've chosen <b>" + stklist_type + "</b>");
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
    $(document).on("click", ".radio-inline", function(e) {
      $("input[type='checkbox']").attr("checked", false);
    });
    $(document).on("click", ".checkbox-inline", function(e) {
      $("input[type='radio']").attr("checked", false);
    });
    function showHide(shID) {
      if (document.getElementById(shID)) {
        if (document.getElementById(shID+'-show').style.display != 'none') {
          document.getElementById(shID+'-show').style.display = 'none';
          document.getElementById(shID).style.display = 'block';
        }
        else {
          document.getElementById(shID+'-show').style.display = 'inline';
          document.getElementById(shID).style.display = 'none';
        }
      }
    }
    function msgSuccess() {
      bootbox.alert({
        title: "Activity has been created successfully.",
        message: "สร้างกิจกรรมเรียบร้อยแล้ว.",
        callback: function() {
          window.location.replace("view_ac.php");
        }
      });
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
<?php
  require("../connect.php");
  if (!empty($_POST['noAct']) && !empty($_POST['nameAct'])) {
    $noAct = $_POST['noAct'];
    $nameAct = $_POST['nameAct'];
    $desAct = $_POST['desAct'];
    $typeAct = "custom";
    $staAct = "unactivated";
    $posAct = array ();
    if (!empty($_POST['inlineRadioOptions'])) {
      $activity = $_POST['inlineRadioOptions'];
      switch ($activity) {
        case 'option1':
          $posAct = ["3","4","5","6"];
          $typeAct = "risk";
          break;
        case 'option2':
          $posAct = ["1","2"];
          $typeAct = "stakeholder";
          break;
        default:
          # option3
          $posAct = ["7","8","9","10","11","12","13","14"];
          $typeAct = "swot-tows";
          break;
      }
    } else {
      $i = 0;
      foreach($_POST as $name => $value) {
        if ($i >= 3) {
          array_push($posAct, $value);
        }
        $i++;
      }
    }
    $posActFinal = json_encode($posAct, JSON_UNESCAPED_UNICODE);
    $insert_activity = "INSERT INTO stakeholder.activity (ac_id, ac_no, ac_name, ac_type, status, position, description, created) 
                        VALUES (NULL, '$noAct', '$nameAct', '$typeAct', '$staAct', '$posActFinal', '$desAct', CURRENT_TIMESTAMP)";
    if(mysqli_query($dbcon, $insert_activity)) {
      /*!
       * stklist_id ของการสร้างกิจกรรมแบบ เลือกจากที่สร้างไว้ให้แล้ว [Radio Options]
       */
      if (!empty($_POST['inlineRadioOptions'])) {
        foreach ($posAct as $key => $value) {
          $insert_stakeholder = "INSERT INTO stakeholder.stakeholder (ac_id, stklist_id) 
                                 VALUES ((SELECT MAX(ac_id) FROM stakeholder.activity), '$value')";
          mysqli_query($dbcon, $insert_stakeholder);
        }
      } else {
        /*!
         * stklist_id ของการสร้างกิจกรรมแบบ custom จะเริ่มดึงค่าที่ตัวแปร $_POST ตั้งแต่ตัวที่ 3 เป็นต้นไป
         */
        $i = 0;
        foreach($_POST as $name => $value) {
          if ($i >= 3) {
            $insert_stakeholder = "INSERT INTO stakeholder.stakeholder (ac_id, stklist_id) 
                                   VALUES ((SELECT MAX(ac_id) FROM stakeholder.activity), '$value')";
            mysqli_query($dbcon, $insert_stakeholder);
          }
          $i++;
        }
      }
      echo "<script> msgSuccess(); </script>";
    }
  } else {
    //echo "No";
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