<?php  
  session_start();//session starts here 
  require("../connect.php");
  $ac_id = $_GET['ac'];
  $sql = "select activity.ac_no, activity.ac_name, stakeholder_list.stklist_id, stakeholder_list.stklist_name, stakeholder.stk_id, stakeholder_list.stklist_type
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
    $arr_stklist_type[] = $rs['stklist_type'];
    $arr_stk_id[] = $rs['stk_id'];
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
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">กิจกรรมที่ <?php echo $ac_no; ?>  <?php echo $ac_name; ?></h4> 
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
            <?php
              foreach ($arr_stklist_name as $key => $value) {
                echo "<th class='text-center'>".$value."</th>";
              }
            ?>
            <th class='col-md-1'></th>
            </tr>
          </thead>
          <tbody id='p_scents'>
          <tr>
            <?php
              foreach ($arr_stklist_type as $key => $value) {
                if ($value == "text") {
                  echo $form[] = "<td><input type='text' class='form-control' name='arrList[]'/>";
                } else {
                  echo $form[] = "<td><select class='form-control' name='arrNum[]'>
                                  <option value='-'>SELECT</option>
                                  <option value='1'>1</option>
                                  <option value='2'>2</option>
                                  <option value='3'>3</option>
                                  <option value='4'>4</option>
                                  <option value='5'>5</option>";
                }
              }
            ?>
            </td>
          </tr>
          </tbody>
          </table>   
          <button type="button" class="btn btn-primary" id="addScnt"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Row</button>
          <button type="button" class="btn btn-success" id="save">Save</button> 
          <a href="index.php">
          <button type="button" class="btn btn-default">Cancel</button>
          </a>          
          <?php
            /* 
            แบบ form horizon
            $i = 0;
            foreach ($arr_stk_id as $key => $value) {
              echo "<div class='form-group'>
                      <label for='arrList[]' class='col-xs-2'>". $arr_stklist_name[$i] ."</label>";
              echo $form[] = "
                      <div class='col-xs-8'>
                        <input type='text' class='form-control' name='arrList[]' />
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
  <script>
        var scntDiv = $('#p_scents');
        var i = $('#p_scents tr').size() + 1;
        var form = <?php echo json_encode($form) ?>;
        $('#addScnt').click(function() {
          scntDiv.append('<tr>'+form+'</td><td><button type="button" class="btn btn-warning btn-sm" id="remScnt"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Remove</button></td></tr>');
          // document.getElementById('mymsg').innerHTML = form; 
          i++;
          return false;
        });
        //Remove button
        $(document).on('click', '#remScnt', function() {
            if (i > 2) {
                $(this).closest('tr').remove();
                i--;
            }
            return false;
        });
        // click handler
        $(document).on('click', '#save', function(event) { 
          var name = $('input[name^=arrList]').map(function(idx, elem) {
            return $(elem).val();
          }).get();
          var num = $('select[name^=arrNum]').map(function(idx, elem) {
            return $(elem).val();
          }).get();
          
        console.log(name);
        console.log(num);
        event.preventDefault();
        // document.getElementById('mymsg').innerHTML = name+num;
        });           
    </script>
  </body>
</html>