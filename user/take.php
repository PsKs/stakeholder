<?php
  session_start();//session starts here
  require("../connect.php");
  $ac_id = $_GET['ac'];
  $sql = "select activity.ac_no, activity.ac_name, activity.ac_type, stakeholder_list.stklist_id, stakeholder_list.stklist_name, stakeholder.stk_id, stakeholder_list.stklist_type
          from stakeholder_list
          left join stakeholder on (stakeholder.stklist_id = stakeholder_list.stklist_id) 
          left join activity on (stakeholder.ac_id = activity.ac_id) 
          where activity.ac_id = ".$ac_id;
  $run = mysqli_query($dbcon, $sql);
  while ($rs = mysqli_fetch_array($run, MYSQL_ASSOC)) {
    $ac_no = $rs['ac_no'];
    $ac_name = $rs['ac_name'];
    $ac_type = $rs['ac_type'];
    $arr_stklist_id[] = $rs['stklist_id'];
    $arr_stklist_name[] = $rs['stklist_name'];
    $arr_stklist_type[] = $rs['stklist_type'];
    $arr_stk_id[] = $rs['stk_id'];
  }
  mysqli_free_result($run);
  mysqli_close($dbcon);
  $col_count = count($arr_stklist_id);
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
        table.table > tbody > tr > th {
         text-align: center; 
        }
        table.table > tbody > tr:first-child > th:first-child {
          background-color: #fff;
          border: 0px solid #fff;
        }
        table.table > tbody > tr:first-child + tr > td:first-child {
          background-color: #fff;
          border: 0px solid #fff;
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
  <script> var x = []; </script>
  <!-- <h1>Prototype User</h1> -->
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">กิจกรรมที่ <?php echo $ac_no; ?>  <?php echo $ac_name; ?></h4> 
        </div>
        <div class="panel-body">
          <form class="form">
          <?php
            if ($ac_type === "swot-tows") {
              require ("form_swot-tows.php");
            } else {
              require ("form_default.php");
            }
          ?>
          </form>
          <?php
            if ($ac_type !== "swot-tows") {
          ?>
          <button type="button" class="btn btn-primary" id="addScnt">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            Add Row
          </button>
          <?php
            }
          ?>
          <div class="pull-right">
            <a href="index.php">
            <button type="button" class="btn btn-default">
              Cancel
            </button>
            </a>
            <button type="button" class="btn btn-success" id="save">
              Save
            </button> 
          </div>
          <?php
            /*
            แบบ form horizon
            $i = 0;
            foreach ($arr_stk_id as $key => $value) {
              echo "<div class='form-group'>
                      <label for='arr_TextAns[]' class='col-xs-2'>". $arr_stklist_name[$i] ."</label>";
              echo $form[] = "
                      <div class='col-xs-8'>
                        <input type='text' class='form-control' name='arr_TextAns[]' />
                      </div>
                    </div>";
              $i++;
            }*/
          ?>
          <div id="mymsg"></div>
        </div>
      </div>
    </div>
  </div>
  </body>
</html>
<script>
  function checkHTML(elmId, value) {
    var elem = document.getElementById(elmId);
    console.log(elem);
    if(typeof elem !== 'undefined' && elem !== null) {
      return true;
    }
  }
  function isNotEmtry(element) {
    return element.length >= 1;
  }
  function multiply(index, array) {
    // index = elm ที่หาตำแหน่ง sum ได้แล้วก่อนหน้านั้น
    var sum = 1;
    for (var i = 0; i < index.length; i++) {
      sum = sum * array[index[i]];
    } return sum;
  }
  $('#addScnt').click(function() {   
    scntDiv.append('<tr>'+gen_form()+
                    '<td>\
                      <button type="button" class="btn btn-warning btn-sm" id="remScnt">\
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>\
                          Remove\
                      </button>\
                    </td>\
                  </tr>');
    i++;
    return false;
  });
  //Remove button
  $(document).on('click', '#remScnt', function() {
      if (i > 1) {
          $(this).closest('tr').remove();
          i--;
      }
      return false;
  });
  // click handler
  $(document).on('click', '#save', function(event) {
    ac_type = <?php echo json_encode($ac_type); ?>;
    if (ac_type !== "swot-tows") {
      // x.length = 0; faster than x = [];
      // http://jsperf.com/array-destroy/151
      x.length = 0;
      x.push(<?php echo json_encode($ac_id); ?>);
      var y = [],
          elm = [],
          sum = 0;
      for (var m = 0; m < row; m++) {
        y = [];
        // console.log('x before loop = ',x);
        if (document.getElementById(('arr_TextAns['+m+'][0]') || document.getElementById('arr_LevelAns['+m+'][0]') || document.getElementById('arr_Result['+m+'][0]')) !== null) {
          for (var n = 0; n < arr_stklist.length; n++) {
            if (arr_stklist[n] == "text") {
              y.push(document.getElementById('arr_TextAns['+m+']['+n+']').value);
            } else if (arr_stklist[n] == "level") {
              y.push(document.getElementById('arr_LevelAns['+m+']['+n+']').value);
            } else if (arr_stklist[n] == "sum") {
              // y.push(document.getElementById('arr_Result['+m+']['+n+']').innerHTML = x[m][n];);
              // document.getElementById('arr_Result['+m+']['+n+']').innerHTML = x[m][n];
              arr_stklist.forEach(function(element, index){
                if (element === "level") {
                  elm.push(index);
                }
              });
              // console.log(elm);
              // as inArray will return -1, if the element was not found.
              if (jQuery.inArray("sum", arr_stklist) !== -1 || document.getElementById('arr_Result['+m+']['+n+']') !== null) {
                // console.log(multiply(elm, y));
                sum = multiply(elm, y).toString();
                y.push(sum);
                document.getElementById('arr_Result['+m+']['+n+']').innerHTML = sum;
                elm.length = 0;
              }
            }
            // console.log(y);
          }
        }
        // console.log('y = ',y);
        // console.log('x before = ',x);
        x.push(y);
        // console.log('x after = ',x);
      }
      x = x.filter(isNotEmtry);
      console.log('final = ',x);
      // var name = $('input[id^=arr_TextAns]').map(function(idx, elem) {
      //   return $(elem).val();
      // }).get();
      // var num = $('select[id^=arr_LevelAns]').map(function(idx, elem) {
      //   return $(elem).val();
      // }).get();
      // var toType = function(obj) {
      //   return ({}).toString.call(obj).match(/\s([a-zA-Z]+)/)[1].toLowerCase()
      // }
    // console.log(name);
    // console.log(num.map(Number));
    } else {
      var arr_text = $('textarea[id=text]').map(function(idx, elem) {
        return $(elem).val();
      }).get();
      x.push(<?php echo json_encode($ac_id); ?>);
      x.push(arr_text);
      console.log(x);
    };
  event.preventDefault();
  // document.getElementById('arr_Result').innerHTML = name*num;
  // document.getElementById('mymsg').innerHTML = name*num;
  bootbox.confirm("คุณต้องการที่จะบันทึกข้อมูลหรือไม่?", function(result) {
    if (result) {
      console.log("User confirmed dialog");
      if(x) {
        jQuery.ajax({
          type: "POST", // HTTP method POST or GET
          url: "lib/store_ans.php", //PHP Page where all your query will write
          dataType: "text", // Data type, HTML, json etc.
          data: {'data':x},
          success: function(data) {
            console.log(x);
            // similar behavior as an HTTP redirect
            window.location.replace('view.php');
          }
        });
      }
    } else {
      console.log("User declined dialog");
    }
  }); 
});
</script>