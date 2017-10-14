<?php $parentPage = 'members';
$currentPage = 'member-admin';
include 'header.php';

$superAdminId = getSuperAdminId();
$capabilities = checkCapabilities("view admin listing");
if($capabilities == 1){?>
  <div class="mainpanel">
    <div class="contentpanel">
      <div class="row">
        <div class="col-sm-8 col-md-9 col-lg-10 people-list">
          <?php if(isset($_GET['emailError'])){?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Oh snap!</strong> This Email Address already exists!
            </div>
          <?php }?>
          <div class="people-options clearfix">
            <div class="btn-toolbar pull-left">
              <!-- <button type="button" class="btn btn-success btn-quirk" onClick="addNewMember('admin');">Add New</button> -->
              <?php if(checkCapabilities("add new admin") == 1){?>
                <button type="button" class="btn btn-success btn-quirk addNewAdmin"><a href="add-admin.php">Add New</a></button>
              <?php }?>
            </div>
            <?php if(isset($_GET['page'])){
              $pageNo = $_GET['page'];
            }else{
              $pageNo = 1;
            } 
            $pageDetails = getPageDetails($pageNo,1);
            $exDetails = explode('-',$pageDetails);?>
            <div class="btn-group pull-right people-pager">
              <button type="button" class="btn btn-default paginationArrows" id="paginationPreviousButton" <?php if($pageNo == 1){echo 'disabled="true"';}?> data-button='previous' data-member="1" data-page ="<?php echo $pageNo;?>"><i class="fa fa-chevron-left"></i></button>
              <button type="button" class="btn btn-default paginationArrows" <?php if($pageNo == $exDetails[3]){echo 'disabled="true"';}?>  id="paginationNextButton" data-button='next' data-member="1" data-page = "<?php echo $pageNo;?>"><i class="fa fa-chevron-right"></i></button>
            </div>
            <span class="people-count pull-right">Showing <strong><?php echo $exDetails[1].'-'.$exDetails[2];?></strong> of <strong><?php echo $exDetails[0];?></strong> members</span> </div>
          <!-- people-options -->
          <div class="row membersListing">

          <?php  $datas = getMemberData($pageNo,1); 
          foreach($datas as $data){ ?>

            <div id="member-panel-<?php echo $data['ID'];?>" class="col-md-6 col-lg-3">
              <div class="panel panel-profile grid-view">
                <div class="panel-heading">
                  <div class="text-center"> <a href="#" class="panel-profile-photo"> <img height="70" width="70" class="img-circle" src="<?php if($data['profile_pic'] == ""){ echo '../assets/images/photos/sampleUserImage.png'; } else{ echo '../view/images/'.$data['profile_pic']; }?>" alt=""> </a>
                    <h4 class="panel-profile-name"><?php echo $data['name'];?></h4>
                    <p class="media-usermeta"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i></p>
                  </div>
                </div>
                <!-- panel-heading -->
                <div class="panel-body people-info">
                  <div class="info-group">
                    <label>Location</label>
                    <?php echo $data['location'];?></div>
                  <div class="info-group">
                    <label>Email</label>
                    <?php echo $data['email'];?> </div>
                  <div class="info-group">
                    <label>Phone</label>
                    <?php echo $data['mobile_number'];?> </div>
                  <div class="row">
                    <div class="col-xs-6">
                      <div class="info-group">
                        <label>Projects</label>
                        <h4><?php echo getMyDashboardSummary('completed');?></h4>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="info-group">
                        <label>Earnings</label>
                        <h4>&#8377;0</h4>
                      </div>
                    </div>
                  </div>
                  <div class="info-group last">
                    <label>Actions</label>
                    <div class="">
                      <button class="btn btn-default btn-xs" onClick="composeMessage('1','1',<?php echo $data['ID'];?>)"><i class="fa fa-envelope"></i> Send Message</button>
                      <?php if($data['ID'] == $superAdminId){ 
                        if($_SESSION['logged_in_userid'] == $superAdminId){?>
                          <?php if(checkCapabilities("edit admin") == 1){?>
                            <a href="edit-admin.php?id=<?php echo $data['ID'];?>"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Edit Details</button>
                          <?php } if(checkCapabilities("delete admin") == 1){?>
                            <button onClick="deleteMember('1',<?php echo $data['ID']?>)" class="btn btn-default btn-xs"><i class="fa fa-trash"></i> Delete User</button>
                          <?php }?>
                        <?php }?> 
                      <?php } else {?>
                        <?php if(checkCapabilities("edit admin") == 1){?>
                            <a href="edit-admin.php?id=<?php echo $data['ID'];?>"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Edit Details</button>
                          <?php } if(checkCapabilities("delete admin") == 1){?>
                            <button onClick="deleteMember('1',<?php echo $data['ID']?>)" class="btn btn-default btn-xs"><i class="fa fa-trash"></i> Delete User</button>
                          <?php }?>
                      <?php }?>
                    </div>
                  </div>
                </div>
                <!-- panel-body --> 
              </div>
              <!-- panel --> 
            </div>

          <?php }?>

          </div>
          <!-- row --> 
        </div>

        <!-- col-sm-8 -->

        <div class="col-sm-4 col-md-3 col-lg-2">
          <div class="panel">
            <div class="panel-heading">
              <h4 class="panel-title">Filter Members</h4>
            </div>

            <div class="panel-body">
              <form  method="post" id="memberSearchForm">
                <div class="form-group">
                  <label class="control-label center-block">By Name:</label>
                  <input name="name" type="text" class="form-control" placeholder="Enter the name of user">
                </div>

                <div class="form-group">
                  <label class="control-label center-block">By Location:</label>
                  <input name="location" type="text" class="form-control" placeholder="Enter location of user">
                </div>

                <div class="form-group">
                  <label class="control-label center-block">By Firm Name:</label>
                  <input name="firm_name" type="text" class="form-control" placeholder="Enter firm name of user">
                </div>
                <input type="hidden" name="memberType" value="1">
                <input type="submit" value="Filter List" class="btn btn-success btn-block" name="filter">
              </form>
            </div>
          </div>
         
        </div>
      </div>
      <!-- row --> 

    </div>
    <!-- contentpanel --> 
  </div>
<?php }?>
<!-- mainpanel --> 

<div class="modal bounceIn animated member-form" id="memberForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<?php include 'footer.php';?>
<div id="temp-data" style="display:none;"></div>