<?php $parentPage = 'members';
$currentPage = 'member-partner';
include 'header.php';

$capabilities = checkCapabilities("view partner listing");
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
              <?php if(checkCapabilities("add new partner") == 1){?>
                <button type="button" class="btn btn-success btn-quirk" onClick="addNewMember('partner');">Add New</button>
              <?php }?>
            </div>
             <?php if(isset($_GET['page'])){
              $pageNo = $_GET['page'];
            }else{
              $pageNo = 1;
            } 
            $pageDetails = getPageDetails($pageNo,2);
            $exDetails = explode('-',$pageDetails);?>

             <div class="btn-group pull-right people-pager">
              <button type="button" class="btn btn-default paginationArrows" <?php if($pageNo == 1){echo 'disabled="true"';}?> data-button='previous' data-member="2" data-page ="<?php echo $pageNo;?>"><i class="fa fa-chevron-left"></i></button>
              <button type="button" class="btn btn-default paginationArrows" <?php if($pageNo == $exDetails[3]){echo 'disabled="true"';}?> data-button='next' data-member="2" data-page = "<?php echo $pageNo;?>"><i class="fa fa-chevron-right"></i></button>
            </div>
            <span class="people-count pull-right">Showing <strong><?php echo $exDetails[1].'-'.$exDetails[2];?></strong> of <strong><?php echo $exDetails[0];?></strong> members</span> </div>

          <!-- people-options -->

          <div class="row membersListing">

          <?php $datas = getMemberData($pageNo,2);
          foreach($datas as $data){ ?>

            <div id="member-panel-<?php echo $data['ID'];?>" class="col-md-6 col-lg-3">
              <div class="panel panel-profile grid-view">
                <div class="panel-heading">
                  <div class="text-center"> <a href="#" class="panel-profile-photo"> <img height="70" width="70" class="img-circle" src="<?php if($data['profile_pic'] == ""){ echo '../assets/images/photos/sampleUserImage.png'; } else{ echo '../view/images/'.$data['profile_pic']; }?>" alt=""> </a>
                    <h4 class="panel-profile-name"><?php echo $data['name'];?></h4>
                    <p class="media-usermeta"><i class="glyphicon glyphicon-briefcase"></i> <?php echo $data['firm_name'];?></p>
                    <p class="media-usermeta"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i></p>
                  </div>
                </div>
                <!-- panel-heading -->
                <div class="panel-body people-info">
                  <div class="info-group">
                    <label>Location</label>
                    <?php echo $data['location'];?> <a class="tooltips" href="#" onClick="viewMap(<?php echo $data['latitude'] ?>,<?php echo $data['longitude'] ?>);" data-toggle="tooltip" title="View on Map"><i class="fa fa-map-marker"></i></a> </div>
                  <div class="info-group">
                    <label>Email</label>
                    <?php echo $data['email'];?> </div>
                  <div class="info-group">
                    <label>Phone</label>
                    <?php echo $data['mobile_number'];?> </div>
                  <div class="row">
                    <div class="col-xs-3">
                      <div class="info-group">
                        <label>Projects</label>
                        <h4><?php echo getPartnerCompletedProjectFig($data['ID']);?></h4>
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="info-group">
                        <label>Total</label>
                        <h4>&#8377;<?php echo getPartnerPaymentFig($data['ID'],'total'); ?></h4>
                      </div>
                    </div>
                     <div class="col-xs-3">
                      <div class="info-group">
                        <label>Received</label>
                        <h4>&#8377;<?php echo getPartnerPaymentFig($data['ID'],'received'); ?></h4>
                      </div>
                    </div>
                     <div class="col-xs-2">
                      <div class="info-group">
                        <label>Due</label>
                        <h4>&#8377;<?php echo getPartnerPaymentFig($data['ID'],'due'); ?></h4>
                      </div>
                    </div>
                     <div class="col-xs-2">
                      <div class="info-group">
                        <label>Revenue Pipeline</label>
                        <h4>&#8377;<?php echo getPartnerPaymentFig($data['ID'],'pipeline'); ?></h4>
                      </div>
                    </div>
                  </div>
                  <div class="info-group last">
                    <label>Actions</label>
                    <div class="">
                      <button class="btn btn-default btn-xs" onClick="composeMessage('1','2',<?php echo $data['ID'];?>)"><i class="fa fa-envelope"></i> Send Message</button>
                      <?php if(checkCapabilities("edit partner") == 1){?>
                      <button class="btn btn-default btn-xs" onClick="editPartnerMemberDetails(<?php echo $data['ID']?>)"><i class="fa fa-edit"></i> Edit Details</button>
                      <?php } if(checkCapabilities("delete partner") == 1){?>
                      <button onClick="deleteMember('2',<?php echo $data['ID']?>)" class="btn btn-default btn-xs"><i class="fa fa-trash"></i> Delete User</button>
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
                <input type="hidden" name="memberType" value="2">
                <input type="submit" value="Filter List" class="btn btn-success btn-block" name="filter">
              </form>
            </div>
          </div>

          <!-- panel -->
          <div class="panel">
            <div class="panel-heading">
              <h4 class="panel-title">Search Members on Map</h4>
            </div>
            <div class="panel-body">
              <div class="form-group">
                <?php $locations = getLatLong('tbl_partners'); 
                $json_locations = json_encode($locations);?>
                <div class="input-group">
                  <input type="text" class="form-control" id="search-address" placeholder="Enter location">
                  <span class="input-group-btn">
                    <button class="btn btn-secondary"  onClick='searchMapByAddress(<?php print_r($json_locations);?>);' type="button">Go!</button>
                  </span>
                </div>
                <input type="hidden" id="member_type" value="2">
              </div>
              <div id="search-on-map" class="map"></div>
              </div>
            </div>
          </div>
          <!-- panel --> 

        </div>
      </div>
      <!-- row --> 
    </div>
    <!-- contentpanel --> 
  </div>
  <!-- mainpanel --> 

<?php }?>

  <!-- Modal -->
  <div class="modal bounceIn animated add-member-form"  id="addMemberMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add CA Patners</h4>
      </div>
      <div class="clearfix"></div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
          <label for="name">Name <span class="text-danger">*</span></label>
          <input type="text" required="required" class="form-control" name="name">
        </div>
        <div class="form-group">
                <label>Address <span class="text-danger">*</span></label>
                <input type="text" name="location" class="form-control map-address" id="map-address-add" required >
                <button class="btn btn-success btn-quirk btn-wide mr5 locate-address" id="locate-address-add">Locate</button>
              </div> 
              <div id="add-map" class="map"></div>
              <div class="form-group">
                <input type="hidden" name="latitude">
                <input type="hidden" name="longitude">
              </div>
        <div class="form-group">
          <label for="email">Email address <span class="text-danger">*</span></label>
          <input type="email" required="required" class="form-control" name="email">
        </div>
        <div class="form-group">
          <label for="work_number">Phone (Work) <span class="text-danger">*</span></label>
          <input type="text" required="required" class="form-control" name="work_number">
        </div>
         <div class="form-group">
          <label for="mobile_number">Phone (Mobile) <span class="text-danger">*</span></label>
          <input type="text" required="required" class="form-control" name="mobile_number">
        </div>
        <div class="form-group">
          <label for="firm_name">Firm Name <span class="text-danger">*</span></label>
          <input type="text" required="required" class="form-control" name="firm_name">
        </div>
        <div class="form-group">
          <label for="membership_number">Membership Number <span class="text-danger">*</span></label>
          <input type="text" required="required" class="form-control" name="membership_number">
        </div>
        <div class="form-group">
          <label for="frn_number">FRN Number <span class="text-danger">*</span></label>
          <input type="text" required="required" class="form-control" name="frn_number">
        </div>
        <div class="form-group">
          <label for="team_size">Team Size <span class="text-danger">*</span></label>
          <input type="text" required="required" class="form-control" name="team_size">
        </div>
          <div class="form-group">
          <label for="profile_pic">Profile Pic:</label>
          <input type="file" name="fileToUpload">
        </div>
        </div>
        <div class="clearfix"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" name="addCaPartner" class="btn btn-primary" value="Save changes">
        </div>
      </form>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
  </div>

  <div class="modal bounceIn animated edit-member-form"  id="editMemberMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit CA Patners Details</h4>
      </div>
      <div class="clearfix"></div>
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-body">
              <div class="form-group">
            <label for="name">Name <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="name">
          </div>
          <div class="form-group">
                  <label>Address <span class="text-danger">*</span></label>
                  <input type="text" name="location" class="form-control map-address" id="map-address-edit" required>
                  <button class="btn btn-success btn-quirk btn-wide mr5 locate-address" id="locate-address-edit">Locate</button>
                </div> 
                <div id="edit-map" class="map"></div>
                <div class="form-group">
                  <input type="hidden" name="latitude">
                  <input type="hidden" name="longitude">
                </div>
          <div class="form-group">
            <label for="email">Email address <span class="text-danger">*</span></label>
            <input type="email" readonly required="required" class="form-control" name="email">
          </div>
          <div class="form-group">
            <label for="work_number">Phone (Work) <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="work_number">
          </div>
           <div class="form-group">
            <label for="mobile_number">Phone (Mobile) <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="mobile_number">
          </div>
          <div class="form-group">
            <label for="firm_name">Firm Name <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="firm_name">
          </div>
          <div class="form-group">
            <label for="membership_number">Membership Number <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="membership_number">
          </div>
          <div class="form-group">
            <label for="frn_number">FRN Number <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="frn_number">
          </div>
          <div class="form-group">
            <label for="team_size">Team Size <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="team_size">
          </div>
            <div class="form-group">
            <label for="fileToUpload">Profile Pic</label>
            <input type="file" name="fileToUpload">
          </div>
          <input type="hidden" name="profile_pic">
          <input type="hidden" name="partnerId">
          </div>
          <div class="clearfix"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" name="editCaPartner" class="btn btn-primary" value="Save changes">
          </div>
        </form>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
  </div>

  <div class="modal bounceIn animated view-map-popup" id="viewOnMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"></div>
        <div class="modal-body" style="text-align:center;">
          <div id="locate-map" class="map" style="height:400px;"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div>
  <!-- modal -->

  <div class="modal bounceIn animated member-form" id="memberForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  </div>

<?php include 'footer.php';?>
<div id="temp-data" style="display:none;"></div>