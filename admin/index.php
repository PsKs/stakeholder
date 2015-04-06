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
    <title>Adwise Workshop for Analysis System</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/component.css">
    <link rel="stylesheet" href="../css/doc.css">
    <!-- Bootstrap Table -->
    <link rel="stylesheet" href="../css/bootstrap-table.css">
    <link rel="stylesheet" href="../css/bootstrap-dropdown-checkbox.css">
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
      .ml10 {
        color: #000;
        /*margin-left: 10px;*/
      }
      .ml10:hover {
        color: #7B1FA2;
      }
      .ml11 {
        color: #000;
        /*margin-left: 10px;*/
      }
      .ml11:hover {
        color: #C9302C;
      }
      .gName {
        color: #000;
      }
      .gName:hover {
        color: #7B1FA2;
        /*text-decoration: none;*/
      }
      .doc-demo {
        margin-bottom: 15px;
      }
      .doc-demo .doc-demo-direct {
        float: right;
        display: none;
      }
      .doc-demo .tab-pane {
        padding: 10px 15px;
      }
      .doc-demo .tab-content > .active {
        border: 1px solid #ddd;
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        border-top: none;
      }
      .doc-demo pre {
        border: none;
        margin: 0;
        padding: 0;
      }
      .doc-demo li:before {
        content: '';
      }
      .doc-demo-frame {
        border: none;
        display: none;
        width: 100%;
      }
      .doc-demo-loader {
        line-height: 100px;
        width: 100%;
        height: 100px;
        text-align: center;
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
  <script src="../js/bootstrap-table.js"></script>
  <script src="../js/bootbox.min.js"></script>
  <script src="../js/bootstrap-dropdown-checkbox.min.js"></script>
  <div class="bs-docs-header" id="content">
    <div class="container">
      <h1>Admin</h1>
      <p>Adwise Workshop for Analysis System</p><p>Atwise Consulting Co., Ltd. Success Management Company.</p>
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
  <!-- ฟอร์มแสดงรายละเอียดของลูกค้า -->
  <div id="customerDetailForm" style="display: none;">
    <div class="doc-demo">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#user-tab" aria-expanded="true">Group</a></li>
        <li class=""><a data-toggle="tab" href="#activity-tab" aria-expanded="false">Activity</a></li>
      </ul>
      <!-- Content Here -->
      <div class="tab-content">
        <div id="gId" value=""></div>
        <div id="user-tab" class="tab-pane active">
          <table class="table" id="userTable">
            <caption>รายละเอียดกลุ่ม</caption>
            <thead>
              <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Name</th>
                <th align="center">Created</th>
                <th align="center">Delete</th>
              </tr>
            </thead>
          </table>
          <button type="button" class="btn btn-success" id="regGroup">เพิ่มกลุ่ม
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
          </button>
          <button type="button" class="btn btn-danger" id="showPass">แสดงรหัส
            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
          </button>
          <button type="button" class="btn btn-info pull-right" id="printBtn">พิมพ์
            <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
          </button>
        </div>
        <div id="activity-tab" class="tab-pane">
          <table class="table" id="activityTable">
            <caption>รายละเอียดกิจกรรม</caption>
            <thead>
              <tr>
                <th>No.</th>
                <th>Name</th>
                <th align="center">Created</th>
                <th align="center">Delete</th>
              </tr>
            </thead>
          </table>
          <span class="myDropdownCheckbox"></span>
          <button type="button" class="btn btn-success" id="addActivityBtn">
            <span class="glyphicon glyphicon-plus"></span> เพิ่ม
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- ฟอร์มลงทะเบียนผู้ใช้งาน (กลุ่ม) -->
  <div id="groupRegisterForm" style="display: none;">
    <div class="doc-demo">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#autoReg-tab" aria-expanded="true">Automatic Register</a></li>
        <li class=""><a data-toggle="tab" href="#manualReg-tab" aria-expanded="false">Manual Register</a></li>
      </ul>
      <!-- Content Here -->
      <div class="tab-content">
        <div id="autoReg-tab" class="tab-pane active">
          <form class="form-horizontal">
            <div class="form-group">
              <label class="col-md-4 control-label" for="username">Prefix-username</label>
              <div class="col-md-4">
                <input name="username" type="text" placeholder="atw" value="atw" class="form-control input-md" autofocus/>
                *Default atw[xxxxxx]
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Prefix-name</label>
              <div class="col-md-4">
                <input name="name" type="text" placeholder="กลุ่มที่" value="กลุ่มที่" class="form-control input-md"/>
                *Default กลุ่มที่ [x]
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="amount">Amount</label>
              <div class="col-md-4">
                <input name="amount" type="text" placeholder="Amount" value="5" class="form-control input-md"/>
              </div>
            </div>
          </form>
        </div>
        <div id="manualReg-tab" class="tab-pane">
          <form class="form-horizontal">
            <div class="form-group">
              <label class="col-md-4 control-label" for="username">Username</label>
              <div class="col-md-4">
                <input name="username" type="text" placeholder="Username" class="form-control input-md" autofocus/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="password">Password</label>
              <div class="col-md-4">
                <input name="password" type="password" placeholder="Password" class="form-control input-md"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Name</label>
              <div class="col-md-4">
                <input name="name" type="text" placeholder="Name of Group" class="form-control input-md"/>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-10 col-md-offset-1">
    <table data-toggle="table"
           data-height="400"
           data-url="lib/fetch_groups.php"
           data-search="true"
           data-sort-order="desc">
      <thead>
        <tr>
          <th data-field="group_name" data-formatter="group_name" data-width="400" data-align="center" data-sortable="true">ลูกค้า</th>        
          <th data-field="count_user" data-formatter="count_user" data-align="center" data-sortable="true">จำนวนกลุ่ม</th>
          <th data-field="count_ac" data-formatter="count_ac" data-align="center" data-sortable="true">จำนวนกิจกรรม</th>
          <th data-field="created" data-formatter="created" data-align="center" data-sortable="true">สร้างเมื่อ</th>
          <th data-field="action" data-formatter="actionFormatter" data-align="center" data-events="actionEvents">รายละเอียด / แก้ไข</th>
        </tr>
      </thead>
    </table>
  </div>
  <script type="text/javascript">
  /*+--------------------------------------------------------------------------------------------------+
    | function callCustomerDetail เพื่อเรียกดูข้อมูลรายละเอียดของลูกค้าทั้งหมด 
    | ซึ่งมีรายชื่อกลุ่ม รายการกิจกรรม สามารถเพิ่ม ลบ แก้ไข ได้
    +--------------------------------------------------------------------------------------------------+*/
    function callCustomerDetail(gId) {
      $("#gId").attr("value", gId);
      var gId = $("#gId").attr("value");
      // alert(gId);
      $.ajax({
        url: "lib/fetch_customer_detail.php",
        type: "POST",
        data: "gId="+gId,
        dataType: "JSON",
        success: function(response) {
          var trHTML = '';
          $("#userTable tbody").empty(); /* Clear table */
          $.each(response, function (i, item) {
              trHTML += '<tr><td>'+item.username+'</td><td title="'+item.full_pass_encrypt+'">'+item.min_pass_encrypt+'</td><td>'+item.name+'</td><td>'+item.created+'</td><td align="center"><a class="ml11" id="delUsrBtn_'+item.user_id+'" href="javascript:void(0)"><span class="glyphicon glyphicon-remove"></span></a></td></tr>';
          });
          $('#userTable').append(trHTML);
        }
      });
      $.ajax({
        url: "lib/fetch_activity_detail.php",
        type: "POST",
        data: "gId="+gId,
        dataType: "JSON",
        success: function(response) {
          var trHTML = '';
          $("#activityTable tbody").empty(); /* Clear table */
          $.each(response, function (i, item) {
              trHTML += '<tr><td align="center">'+item.no+'</td><td title="'+item.stakeholder_list+'">'+item.name+'</td><td>'+item.created+'</td><td align="center"><a class="ml11" id="delActBtn_'+item.com_id+'" href="javascript:void(0)"><span class="glyphicon glyphicon-remove"></span></a></td></tr>';
          });
          $('#activityTable').append(trHTML);
        }
      });
      bootbox.dialog({
        title: 'Customer Detail',
        message: $('#customerDetailForm'),
        show: false, // We will show it manually later
      })
      .on('shown.bs.modal', function() {
        $('#customerDetailForm')
          .show() // Show the customer detail form
      })
      .on('hide.bs.modal', function(e) {
        // Bootbox will remove the modal (including the body which contains the customer detail form)
        // after hiding the modal
        // Therefor, we need to backup the form
        $('#customerDetailForm').hide().appendTo('body');
          setTimeout(function () { window.location.reload(1); } ); /* Load page again when Bootbox close */ 
      })
      .modal('show');
    /*+--------------------------------------------------------------------------------------------------+
      | ปุ่มแสดงรายการกิจกรรม (สีฟ้า)
      +--------------------------------------------------------------------------------------------------+*/
      var myData = (function() {
          var myData = null;
          $.ajax({
              'async': false,
              'global': false,
              'data': "gId="+gId,
              'url': "lib/fetch_activity_diff.php",
              'dataType': "json",
              'success': function(data) {
                  myData = data;
              }
          });
          return myData;
      })();
      $(".myDropdownCheckbox").dropdownCheckbox({
          data: myData,
          autosearch: true,
          title: "รายการกิจกรรม",
          hideHeader: true,
          showNbSelected: true,
          templateButton: '<a class="dropdown-checkbox-toggle btn btn-info" data-toggle="dropdown" href="#">รายการกิจกรรม <span class="glyphicon glyphicon-list" aria-hidden="true"></span>&nbsp;<span class="dropdown-checkbox-nbselected"></span>'
      });
    }
  /*+--------------------------------------------------------------------------------------------------+
    | function clear_form สร้างไว้เพื่อล้างค่าที่ค้างอยู่ใน form ที่ค้างอยู่ก่อนหน้านั้น
    +--------------------------------------------------------------------------------------------------+*/
    function clear_form() {
      $(':input','form')
      .removeAttr('checked')
      .removeAttr('selected')
      .not(':button, :submit, :reset, :hidden, :radio, :checkbox')
      .val('');
      $(".dropdown-checkbox-toggle").removeAttr('checkbox').val('');
    }
    function actionFormatter(value, row, index) {
      return [
        '<a class="g_detail ml10" id="g" href="javascript:void(0)" title="รายละเอียดของลูกค้า กลุ่มและกิจกรรม">',
        '<i class="glyphicon glyphicon-folder-open"></i>',
        '</a>'
      ].join('');
    }
    window.actionEvents = {
    /*+--------------------------------------------------------------------------------------------------+
      | ปุ่มแสดงรายละเอียดของลูกค้า
      | ซึ่งสามารถเพิ่ม ลบ แก้ไข ได้
      +--------------------------------------------------------------------------------------------------+*/
      'click .g_detail': function(e, value, row, index) {
        callCustomerDetail(row.group_id);
      },
    };
  /*+--------------------------------------------------------------------------------------------------+
    | ปุ่มเพิ่ม User (กลุ่ม)
    | มีสองแบบคือ Automatic Register และ Manual Register
    +--------------------------------------------------------------------------------------------------+*/
    $(document).on("click", "#regGroup", function(e) {
      bootbox.dialog({
        title: "Group Register",
        message: $('#groupRegisterForm'),
        show: false,
        buttons: {
          success: {
            label: "Save",
            className: "btn-success",
            callback: function() {
              // console.log($("#gId").attr("value"));
              var gId = $('#gId').attr('value');
              // Get active[autoReg-tab/manualReg-tab] tab form groupRegisterForm
              // and then get "pure" href without hash # sign with this:
              var href = $('#groupRegisterForm ul.nav-tabs li.active a').attr('href').split('#')[1];
              // Or this: href = href.substring(href.indexOf('#') + 1);
              // var data = $('#'+href).find('input[type=text]').map(function() { return $(this).val(); }).get(); // .join() = Convert to String
              var data = $('#'+href).find('form').serializeArray();
              data[data.length] = { name: "group_id", value: gId };
              // console.log(data);
              jQuery.ajax({
                type: "POST",
                url: "lib/regis_group.php",
                dataType: "JSON",
                data: data,
                success: function(data) {
                  console.log("Registered");
                }
              });
              clear_form();
              bootbox.hideAll();
              callCustomerDetail(gId);
            }
          },
          cancel: {
            label: "Cancel",
            className: "btn-default",
            callback: function() {
              clear_form();
            }
          }
        }
      })
      .on('shown.bs.modal', function() {
        $('#groupRegisterForm')
          .show()
      })
      .on('hide.bs.modal', function(e) {
        $('#groupRegisterForm').hide().appendTo('body');
      })
      .modal('show');
    });
  /*+--------------------------------------------------------------------------------------------------+
    | ปุ่มลบกลุ่มในลูกค้า (Delete User)
    +--------------------------------------------------------------------------------------------------+*/
    $(document).on("click", "a[id^='delUsrBtn_']", function(e) {
      var userId = $(this).attr('id').split('_')[1];
      // console.log('Delete User ID: '+userId);
      userId = "userId="+userId;
      $.ajax({
        type: "POST",
        url: "lib/del_user.php",
        dataType: "JSON",
        data: userId+"&funcId="+0,
        success: function(data) {
          if (data === 'cancel') {
            bootbox.alert({
              title: "Can't not delete",
              message: "ขออภัยไม่สามารถลบได้เนื่องจากกลุ่มผู้ใช้นี้ได้ทำกิจกรรมแล้ว"
            });
          } else if (data === 'delete') {
            bootbox.confirm("ยืนยันการลบกลุ่มผู้ใช้", function(result) {
              // return true/false from bootbox
              if (result === true) {
                $.ajax({
                  type: "POST",
                  url: "lib/del_user.php",
                  dataType: "JSON",
                  data: userId+"&funcId="+1,
                  success: function(data) {
                    bootbox.alert({
                      title: "Done",
                      message: data
                    });
                    bootbox.hideAll();
                  }
                });
              };
            }); 
          };
        }
      });
    });
  /*+--------------------------------------------------------------------------------------------------+
    | ปุ่มลบกิจกรรมในลูกค้า (Delete Activity)
    +--------------------------------------------------------------------------------------------------+*/
    $(document).on("click", "a[id^='delActBtn_']", function(e) {
      var comId = $(this).attr('id').split('_')[1];
      // console.log('Delete Activity ID: '+comId);
      comId = "comId="+comId;
      $.ajax({
        type: "POST",
        url: "lib/del_activity.php",
        dataType: "JSON",
        data: comId+"&funcId="+0,
        success: function(data) {
          if (data === 'activated') {
            bootbox.alert({
              title: "Can't not delete",
              message: "ขออภัยไม่สามารถลบได้เนื่องจากกิจกรรมนี้ถูกใช้งานแล้ว"
            });
          } else {
            bootbox.confirm("ยืนยันการลบกิจกรรม", function(result) {
              // return true/false from bootbox
              if (result === true) {
                $.ajax({
                  type: "POST",
                  url: "lib/del_activity.php",
                  dataType: "JSON",
                  data: comId+"&funcId="+1,
                  success: function(data) {
                    bootbox.alert({
                      title: "Done",
                      message: data
                    });
                    bootbox.hideAll();
                  }
                });
              };
            }); 
          };
        }
      });
    });
  /*+--------------------------------------------------------------------------------------------------+
    | ปุ่มสั่งพิมพ์รายชื่อกลุ่ม
    | ซึ่งจะสร้างเป็น PDF ก่อนพิมพ์
    +--------------------------------------------------------------------------------------------------+*/
    $(document).on("click", "#printBtn", function(e) {
      window.print();
    });
  /*+--------------------------------------------------------------------------------------------------+
    | ปุ่มเพิ่มรายการกิจกรรมในลูกค้า
    +--------------------------------------------------------------------------------------------------+*/
    $(document).on("click", "#addActivityBtn", function(e) {
      var item = $(".myDropdownCheckbox").dropdownCheckbox("checked");
      var data = new Array();
      var gId = $('#gId').attr('value');
      item.forEach(function(element, index){
        // console.log(element['id']);
        data.push(element['id']);
      });
      if (item.length !== 0) {
        // console.log(data);
        $.ajax({
            type: "POST",
            url: "lib/regis_activityInGrp.php",
            dataType: "TEXT",
            // data: "item="+JSON.stringify(item),
            data: "data="+data+"&group_id="+gId,
            success: function(data) {
            }
        });
        clear_form();
        bootbox.hideAll();
        callCustomerDetail(gId);
      };
    });
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
        body = document.body;
    showLeft.onclick = function() {
      classie.toggle(this, 'active');
      classie.toggle(menuLeft, 'cbp-spmenu-open');
    };
  </script>
  </body>
</html>