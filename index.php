<?php include 'header-unregister.php';?>

  <div class="panel signin">
    <div class="panel-heading">
      <h1 class="logo">Platinum Heights</h1>
      <h4 class="panel-title">Welcome! Please signin.</h4>
    </div>
    <div class="panel-body">
      <!--button class="btn btn-primary btn-quirk btn-fb btn-block">Connect with Facebook</button>
      <div class="or">or</div-->
      <?php if(isset($_GET['erroLogin'])){?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Oh snap!</strong> Username or Password is incorrect!
        </div>
      <?php }?>
      <form method="post">
        <div class="form-group mb10">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" name="username" placeholder="Enter Username">
          </div>
        </div>
        <div class="form-group mb10">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" class="form-control" name="password" placeholder="Enter Password">
          </div>
        </div>
        <div><a href="forget-password.php" class="forgot">Forgot password?</a></div>
        <div class="form-group">
          <button type="submit" name="signin" class="btn btn-success btn-quirk btn-block">Sign In</button>
        </div>
      </form>
      <hr class="invisible">
      <div class="form-group">
        <a href="signup.php" class="btn btn-default btn-quirk btn-stroke btn-stroke-thin btn-block btn-sign">Not a member? Sign up now!</a>
      </div>
    </div>
  </div><!-- panel -->

<?php include 'footer-unregister.php';?>
