<?php include 'header-unregister.php';?>

  <div class="panel signin">
    <div class="panel-heading">
      <h1 class="logo">CACircuit</h1>
      <h4 class="panel-title">Welcome! Please signin.</h4>
    </div>
    <div class="panel-body">
      <form method="post">
        <div class="form-group mb10">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" name="email" placeholder="Enter Email">
          </div>
        </div>
        <div class="form-group">
          <button type="submit" name="forgetPassword" class="btn btn-success btn-quirk btn-block">Reset Now</button>
        </div>
      </form>
    </div>
  </div><!-- panel -->

<?php include 'footer-unregister.php';?>
