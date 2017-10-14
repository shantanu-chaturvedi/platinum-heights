<?php include 'header-unregister.php';?>

  <div class="signup">
    <div class="row">
      <div class="col-sm-5">
        <div class="panel">
          <div class="panel-heading">
            <h1 class="logo">CACircuit</h1>
            <h4 class="panel-title">Create an Account!</h4>
          </div>
          <div class="panel-body">
            <!--button class="btn btn-primary btn-quirk btn-fb btn-block">Sign Up Using Facebook</button>
            <div class="or">or</div-->
             <form role="form" method="post" enctype="multipart/form-data">
                <div class="form-group mb15">
                  <input type="text" class="form-control" required name="name" placeholder="Your Name">
                </div>
                <div class="form-group mb15">
                  <input type="text" class="form-control" required name="membership_number" placeholder="Your CA Membership Number">
                </div>
                <div class="form-group mb15">
                  <input type="text" class="form-control" required name="firm_name" placeholder="Firm Name">
                </div>
                <div class="form-group mb15">
                  <input type="text" class="form-control" required name="frn_number" placeholder="FRN Number">
                </div>
                <div class="form-group mb15">
                  <input type="text" class="form-control" required name="team_size" placeholder="Team Size">
                </div>
                  <div class="form-group mb15">
                  <input type="email" class="form-control" required name="email" placeholder="Email">
                </div>
                  <div class="form-group mb15">
                  <input type="text" class="form-control" required name="mobile_number" placeholder="Phone">
                </div>

                <div class="form-group mb20">
                  <label class="ckbox">
                    <input type="checkbox" name="checkbox">
                    <span>Accept terms and conditions</span>
                  </label>
                </div>
                <div class="form-group">
                  <button type="submit" name="addCaPartner" class="btn btn-success btn-quirk btn-block">Create Account</button>
                </div>
              </form>
            </div><!-- panel-body -->
        </div><!-- panel -->
      </div><!-- col-sm-5 -->
      <div class="col-sm-7">
        <div class="sign-sidebar">
          <h3 class="signtitle mb20">Weclome to <span class="logo">CACircuit</span></h3>
          <p>Lorem ipsum dolor sit amet, viderer vivendum pericula ei mei. Electram tincidunt definiebas mea ad, enim offendit deseruisse ad mei. Clita timeam per id, quando epicuri ne mea. Causae sanctus expetenda et eos, cum ut idque ancillae.</p>
          <p>Clita timeam per id, quando epicuri ne mea.</p>

          <br>

          <h4 class="reason">1. Point #1</h4>
          <p>Nam ea civibus disputationi, pro prodesset consetetur definitionem et. Ne vis inermis adipisci accusata, id quem saperet per. Ut nec dicant veniam officiis. Omnis justo vix ei, vim at tollit placerat detraxit.</p>

          <br>

          <h4 class="reason">2. Point #2</h4>
          <p>Eum delenit assentior reformidans te, ad est amet sadipscing. Commodo offendit ne vim, sint moderatius vis te, ad sed vidit tollit accusamus. In labore oblique est. Eu alii vero intellegam mea.</p>

          <hr class="invisible">

          <div class="form-group">
            <a href="signin.php" class="btn btn-default btn-quirk btn-stroke btn-stroke-thin btn-block btn-sign">Already a member? Sign In Now!</a>
          </div>
        </div><!-- sign-sidebar -->
      </div>
    </div>
  </div><!-- signup -->

<?php include 'footer-unregister.php';?>