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
  </nav>
  <!-- End Menu -->

  <div class="col-md-10 col-md-offset-1">
    <table data-toggle="table"
           data-height="400"
           data-url="lib/fetch_ac.php"
           data-search="true"
           data-sort-order="desc">
        <thead>
        <tr>
            <th data-field="no" data-align="center" data-sortable="true">กิจกรรมที่</th>
            <th data-field="name" data-sortable="true">ชื่อกิจกรรม</th>
            <th data-field="stakeholder_list" data-width="400" data-sortable="true">รายการ</th>
            <th data-field="created" data-align="center" data-width="100" data-sortable="true">สร้างขึ้นเมื่อ</th>
            <th data-field="action" data-align="center" data-formatter="actionFormatter" data-events="actionEvents">แก้ไข / ลบ</th>
        </tr>
        </thead>
    </table>
    <script>
      function actionFormatter(value, row, index) {
        return [
          '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
          '<i class="glyphicon glyphicon-edit"></i>',
          '</a>&nbsp;&nbsp;&nbsp;',
          '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
          '<i class="glyphicon glyphicon-trash"></i>',
          '</a>'
        ].join('');
      }
      window.actionEvents = {
          'click .edit': function (e, value, row, index) {
              // alert('You click edit icon, row: ' + JSON.stringify(row));
              console.log(value, row, index);
              // console.log(myvar[0].stklist_id);
              window.location.href = "edit_activity.php?ac="+row.id;
              /*bootbox.dialog({
                  title: "แก้ไขกิจกรรม",
                  message: 
                      '<div class="row">  ' +
                      '<div class="col-md-12"> ' +
                      '<form class="form-horizontal"> ' +
                      '<div class="form-group"> ' +
                      '<label class="col-md-4 control-label" for="noActivity">กิจกรรมที่</label> ' +
                      '<div class="col-md-2"> ' +
                      '<input id="noActivity" name="noActivity" type="text" placeholder="No." class="form-control input-md" value="'+ row['no'] + '"/>' +
                      '</div> ' +
                      '</div> ' +
                      '<div class="form-group"> ' +
                      '<label class="col-md-4 control-label" for="nameActivity">ชื่อกิจกรรม</label> ' +
                      '<div class="col-md-6"> ' +
                      '<input id="nameActivity" name="nameActivity" type="text" placeholder="Name" class="form-control input-md" value="'+ row['name'] + '"/>' +
                      '</div> ' +
                      '</div> ' +
                      '<div class="form-group"> ' +
                      '<label class="col-md-4 control-label" for="stklist_type">รายการ</label> ' +
                      '<div class="col-md-4"> <div class="checkbox-inline"> <label for="inlineCheckbox1"> ' +
                      '<input type="checkbox" name="stklist_name" id="inlineCheckbox1" value="checkbox" checked="checked"> ' +
                      '1 </label> ' +
                      '</div><div class="checkbox-inline"> <label for="inlineCheckbox2"> ' +
                      '<input type="checkbox" name="stklist_name" id="inlineCheckbox2" value="checkbox"> ' +
                      '2 </label> ' +
                      '</div> ' +
                      '</div> </div>' +
                      '</form> </div>  </div>',
                  buttons: {
                      success: {
                          label: "Save",
                          className: "btn-success",
                          callback: function () {
                              var name = $('#name').val();
                              var answer = $("input[name='stklist_type']:checked").val();
                              if(name) {
                                var dataString = 'firstField='+ name + '&secondField='+ answer ; //build a post data structure
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
                                //window.alert("Hello " + name + ". You've chosen <b>" + answer + "</b>");
                              }
                          }
                      },
                      cancel: {
                          label: "Cancel",
                          className: "btn-default"
                      }
                  }
              }
          );*/
          },
          'click .remove': function (e, value, row, index) {
              alert('You click remove icon, row: ' + JSON.stringify(row));
              console.log(value, row, index);
          }
      };
    </script>
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