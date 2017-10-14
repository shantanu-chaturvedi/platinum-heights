<?php include 'functions.php';
// require_once "assets/lib/phpexcel-master/Classes/PHPExcel.php";
if($_SESSION['logged_in'] == ""){
  header("Location: signin.php");
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!--<link rel="shortcut icon" href="../images/favicon.png" type="image/png">-->

<title>Platinum Heights</title>
<?php include "controller/allCssFiles.php";?>
<script src="http://use.edgefonts.net/source-code-pro.js"></script>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="../lib/html5shiv/html5shiv.js"></script>
  <script src="../lib/respond/respond.src.js"></script>
  <![endif]-->
</head>

<body>
<header>
  <div class="headerpanel">
    <div class="logopanel">
      <h2 class="logo"><a href="index.php">PlatinumHeights</a></h2>
    </div>
    <!-- logopanel -->
    
    <div class="headerbar"> <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
      <!-- <div class="searchpanel">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
          <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
          </span> </div> 
      </div> -->
      <div class="header-right">
        <ul class="headermenu">
          
          <li>
            <div class="btn-group">
              
              <button type="button" class="btn btn-logged" data-toggle="dropdown"> 
                    <img src="" alt="" />Admin
                <span class="caret"></span> 
              </button>
              <ul class="dropdown-menu pull-right">
                <li><a href="profile.php"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>
                <li><a href="functions.php?logout"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
      <!-- header-right --> 
    </div>
    <!-- headerbar --> 
  </div>
  <!-- header--> 
</header>
<section>
  <div class="leftpanel">
    <div class="leftpanelinner"> 
      
      <!-- ################## LEFT PANEL PROFILE ################## -->

      
      
      <div class="tab-content"> 
        
        <!-- ################# MAIN MENU ################### -->

       
        
        <div class="tab-pane active" id="mainmenu">
          <h5 class="sidebar-title">Navigation</h5>
          <ul class="nav nav-pills nav-stacked nav-quirk nav-quirk-primary">
            <li class="nav-parent <?php if($parentPage == 'members'){ echo "active"; }?>"><a href="#"><i class="fa fa-envelope"></i> <span>Members</span></a>
                <ul class="children">
                  <li <?php if($currentPage == 'add-members'){ echo "class='active'"; }?>><a href="add-member.php">Add</a></li>
                  <li <?php if($currentPage == 'view-member'){ echo "class='active'"; }?>><a href="view-members.php">View</a></li>
                </ul>
              </li>
              <li class="nav-parent <?php if($parentPage == 'report'){ echo "active"; }?>"><a href="#"><i class="fa fa-envelope"></i> <span>Report</span></a>
                <ul class="children">
                  <li <?php if($currentPage == 'members'){ echo "class='active'"; }?>><a href="members.php">Members</a></li>
                  <li <?php if($currentPage == 'attendance'){ echo "class='active'"; }?>><a href="functions.php?attendanceSheetdownload">Attendance Sheet</a></li>
                  <li <?php if($currentPage == 'bdays'){ echo "class='active'"; }?>><a href="functions.php?eventSheetdownload">Bdays & Anniversaries</a></li>
                </ul>
              </li>
              <li <?php if($currentPage == 'meeting'){ echo "class='active'"; }?>><a href="meeting.php"><i class="fa fa-bullhorn"></i> <span>Meeting</span></a></li>
          </ul>
        </div>
        <!-- tab-pane --> 
        
      </div>
      <!-- tab-content --> 
      
    </div>
    <!-- leftpanelinner --> 
  </div>
  <!-- leftpanel -->