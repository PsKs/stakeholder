<script>
  function alert_warning() {
    $("#alert").html('<div class="alert alert-danger">Username or password is incorrect!</div>');
    window.setTimeout(function() {
      $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
      });
    }, 1000);
  }
</script>
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="login-panel panel panel-success-login">
        <div class="panel-heading">
          <h3 class="panel-title">Sign In</h3>  
        </div>  
        <div class="panel-body">  
          <form role="form" method="post" action="index.php">  
            <fieldset>  
              <div class="form-group">  
                <input class="form-control" placeholder="Username" name="user_name" type="text" autofocus>  
              </div>  
              <div class="form-group">  
                <input class="form-control" placeholder="Password" name="user_pass" type="password" value="">  
              </div>  
              <input class="btn btn-lg btn-success-login btn-block" type="submit" value="login" name="login" >  
            </fieldset>  
          </form>  
        </div>  
      </div>
      <div id="alert"></div>
    </div>  
  </div>  
</div>   
<?php   
require("connect.php");
  if(isset($_POST['login'])) {
    $user_name = $_POST['user_name'];  
    $user_pass = $_POST['user_pass'];
    $check_user = "select * from users WHERE username ='$user_name'AND password ='$user_pass'";  
    $result = mysqli_query($dbcon,$check_user);  
    if (mysqli_num_rows($result)) {
      $res_group = mysqli_fetch_array($result);
      //here session is used and value of $user_name store in $_SESSION.
      $_SESSION['username'] = $res_group['username'];
      $_SESSION['user_type'] = $res_group['user_type'];
      $_SESSION['user_id'] = $res_group['user_id'];
      $_SESSION['name'] = $res_group['name'];
      
      // Free result set
      mysqli_free_result($result);
      mysqli_close($dbcon); 
      if ($res_group['user_type'] === 'admin') {
          echo "<script>window.open('admin/index.php','_self')</script>";
      } else if ($res_group['user_type'] === 'user') {
          echo "<script>window.open('user/index.php','_self')</script>";
      }
    } else {
      echo "<script>alert_warning();</script>";
    }
  }
?>