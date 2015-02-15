<?php  
    session_start();//session starts here  
?>  
<!DOCTYPE html>
<html>  
<head lang="en">  
    <meta charset="UTF-8">  
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>  
</head>  
<style>  
    .login-panel {  
        margin-top: 150px;
    }  
  
</style>  
  
<body>  
  
  
<div class="container">  
    <div class="row">  
        <div class="col-md-4 col-md-offset-4">  
            <div class="login-panel panel panel-success">  
                <div class="panel-heading">  
                    <h3 class="panel-title">Sign In</h3>  
                </div>  
                <div class="panel-body">  
                    <form role="form" method="post" action="login.php">  
                        <fieldset>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Username" name="user_name" type="text" autofocus>  
                            </div>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Password" name="user_pass" type="password" value="">  
                            </div>  
  
  
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="login" >  
  
                            <!-- Change this to a button or input when using this as a form -->  
                          <!--  <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->  
                        </fieldset>  
                    </form>  
                </div>  
            </div>  
        </div>  
    </div>  
</div>  
  
  
</body>  
  
</html>  
  
<?php   
require("connect.php");    
    if(isset($_POST['login']))  
    {  
        $user_name = $_POST['user_name'];  
        $user_pass = $_POST['user_pass'];  
      
        $check_user = "select * from users WHERE username ='$user_name'AND password ='$user_pass'";  
      
        $result = mysqli_query($dbcon,$check_user);  
      
        if(mysqli_num_rows($result))  
        {  
            $res_group = mysqli_fetch_array($result);
            //here session is used and value of $user_name store in $_SESSION.
            echo $_SESSION['username'] = $user_name;
            echo $_SESSION['group'] = $res_group['group'];

            // Free result set
            mysqli_free_result($result);
            mysqli_close($dbcon); 
            if ($res_group['group'] == 'admin'): echo "<script>window.open('admin/index.php','_self')</script>"; endif;
            echo "<script>window.open('index.php','_self')</script>";
        }  else {  
            echo "<script>alert('Username or password is incorrect!')</script>";  
        }  
    }

    print_r($_SESSION);

    /*$view_users_query="select * from users";//select query for viewing users.  
    $run=mysqli_query($dbcon,$view_users_query);//here run the sql query.  
  
    while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
    {  
        print_r($row);
    } */
?>