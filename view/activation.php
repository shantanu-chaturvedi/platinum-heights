<?php include 'header-unregister.php';?>

  <div class="panel signin">
    <div class="panel-heading">
      <h1 class="logo">CACircuit</h1>
      <h4 class="panel-title">Welcome to CA Circuit! </h4>
      <h5 class="panel-title"><?php if(isset($_GET['reset_activation_key'])) { echo "Please set your new password..!"; } else { echo "Please set your password."; } ?></h5>
    </div>
    <div class="panel-body">
      <form method="post">
        <div class="form-group mb10">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="hidden" name="email" value="<?php echo $_GET['email'];?>">
            <input type="hidden" name="activation_key" value="<?php if(isset($_GET['reset_activation_key'])) { echo $_GET['reset_activation_key']; } else { echo $_GET['activation_key']; } ?>">
            <input type="password" class="form-control" name="password" placeholder="Enter Password">
          </div>
        </div>
        <div class="form-group">
          <button type="submit" name="setPassword" class="btn btn-success btn-quirk btn-block">Sign In</button>
        </div>
      </form>
      <hr class="invisible">
      
    </div>
  </div><!-- panel -->

<?php include 'footer-unregister.php';?>
