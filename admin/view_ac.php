<?php  
  session_start();//session starts here  
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
    </style>
  </head>
  <body>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="../js/jquery-1.11.2.min.js"></script>
  <script src="../js/bootbox.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/bootstrap-table.js"></script>
  <h1>Prototype Admin</h1>
  <div class="row">
  <div class="col-sm-2">
    <div class="sidebar-nav">
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="visible-xs navbar-brand">Sidebar menu</span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Overview</a></li>
            <li><a href="create_ac.php">Create Activity</a></li>
            <li><a href="view_ac.php">Show Activity</a></li>
            <li><a href="#">Summary</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  <!-- End Menu -->

  <div class="col-sm-9">
    <table data-toggle="table"
           data-height="500"
           data-url="fetch_ac.php"
           data-search="true"
           data-sort-order="desc">
        <thead>
        <tr>
            <th data-field="no" data-sortable="true">กิจกรรมที่</th>
            <th data-field="name" data-sortable="true">ชื่อกิจกรรม</th>
            <th data-field="stakeholder_list" data-sortable="true">รายการ</th>
            <th data-field="create" data-sortable="true">สร้างเมื่อ</th>
            <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>
        </tr>
        </thead>
    </table>
    <script>
      var myvar = <?php require("fetch_sk.php"); ?>;
      // console.log(myvar);
      function actionFormatter(value, row, index) {
        return [
            '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
            '<i class="glyphicon glyphicon-edit"></i>',
            '</a>',
            '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-remove"></i>',
            '</a>'
        ].join('');
      }
      window.actionEvents = {
          'click .edit': function (e, value, row, index) {
              // alert('You click edit icon, row: ' + JSON.stringify(row));
              console.log(value, row, index);
              // console.log(myvar[0].stklist_id);
              window.location.href = "test.php?ac="+row.id;
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
  </body>
</html>