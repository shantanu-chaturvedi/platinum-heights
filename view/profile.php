<?php include "header.php";?>

<?php $userId = $_SESSION['logged_in_userid'];
if($_SESSION['logged_in_user_role'] == 1){
  $profileDatas = getSingleAdminData($userId);
}else if($_SESSION['logged_in_user_role'] == 2){
  $profileDatas = getSinglePartnerData($userId);
}else{
  $profileDatas = getSingleClientData($userId);
}?>

    <div class="mainpanel">

      <div class="contentpanel">

      <?php foreach($profileDatas as $profileData){ ?>

        <div class="row profile-wrapper">

          <div class="col-xs-12 col-md-3 col-lg-2 profile-left">

            <div class="profile-left-heading">
              <?php if($_SESSION['logged_in_user_role'] == 3){
                $phone = $profileData['phone'];
                $company_name =  $profileData['company_name'];
                $contact_name =  $profileData['contact_person'];?>
                <a href="" class="profile-photo">
                  <img class="img-circle img-responsive" src="<?php echo '../view/images/'.$profileData['logo'];?>" alt="">
                </a>
                <h2 class="profile-name"><?php echo $profileData['company_name'];?></h2>
                <h4 class="profile-designation"><?php echo $profileData['contact_person'];?></h4>
              <?php } else{
                $phone = $profileData['mobile_number'];
                $company_name =  $profileData['firm_name'];
                $contact_name =  $profileData['name'];?>
                <a href="" class="profile-photo">
                  <img class="img-circle img-responsive" src="<?php if($data['profile_pic'] == ""){ echo '../assets/images/photos/sampleUserImage.png'; } else{ echo '../view/images/'.$profileData['profile_pic']; }?>" alt="">
                </a>
                <h2 class="profile-name"><?php echo $profileData['name'];?></h2>
                <h4 class="profile-designation"><?php echo $profileData['firm_name'];?></h4>
              <?php } 
              if($_SESSION['logged_in_user_role'] != 1){?>
                <ul class="list-group">
                  <li class="list-group-item">Projects <a href="#"><?php echo getPartnerCompletedProjectFig($_SESSION['logged_in_userid']);?></a></li>
                  <li class="list-group-item">Earned <a href="#">&#8377;<?php echo getPartnerTotalEarnedFig($_SESSION['logged_in_userid']); ?></a></li>
                </ul>
              <?php }?>
            </div>

            <div class="profile-left-body">
              <h4 class="panel-title">Location</h4>
              <p><i class="glyphicon glyphicon-map-marker mr5"></i> <?php echo $profileData['location'];?></p>

              <hr class="fadeout">

              <?php if($company_name != ""){?>
                <h4 class="panel-title">Company</h4>
                <p><i class="glyphicon glyphicon-briefcase mr5"></i> <?php echo $company_name;?></p>
                <hr class="fadeout">
              <?php }?>

              <h4 class="panel-title">Contacts</h4>
              <p><i class="glyphicon glyphicon-phone mr5"></i> <?php echo $phone;?></p>

              <hr class="fadeout">

              <!-- <h4 class="panel-title">Social</h4>
              <ul class="list-inline profile-social">
                <li><a href=""><i class="fa fa-facebook-official"></i></a></li>
                <li><a href=""><i class="fa fa-twitter"></i></a></li>
                <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                <li><a href=""><i class="fa fa-linkedin"></i></a></li>
              </ul> -->

            </div>
          </div>

          <?php if($_SESSION['logged_in_user_role'] == 1){?>

            <div class="col-md-12 col-lg-8 profile-right">
              <div class="profile-right-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified nav-line">
                  <li class="active"><a href="#basic" data-toggle="tab"><strong>My Profile</strong></a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">

                  <div class="tab-pane active" id="basic">
                    <div class="panel-post-item">
                      <div class="panel-body nopaddingbottom">
                        <div id="basicForm" action="" class="form-horizontal" novalidate="novalidate">

                          <form method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                              <label class="col-sm-3 control-label">Name <span class="text-danger">*</span></label>
                              <div class="col-sm-8">
                                <input type="text" name="name" class="form-control"  required="" aria-required="true" value="<?php echo $contact_name;?>">
                              </div>
                            </div>
                           
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Email <span class="text-danger">*</span></label>
                              <div class="col-sm-8">
                                <input type="email" name="email" class="form-control"  required="" aria-required="true" readonly value="<?php echo $profileData['email'];?>">
                              </div>
                            </div>
                              
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Phone (Mobile Number) <span class="text-danger">*</span></label>
                              <div class="col-sm-8">
                                <input type="text" name="mobile_number" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['mobile_number'];?>">
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-3 control-label">Phone (Office Number) <span class="text-danger">*</span></label>
                              <div class="col-sm-8">
                                <input type="text" name="work_number" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['work_number'];?>">
                              </div>
                            </div>

                            <div class="form-group mb20">
                              <label class="col-sm-3 control-label">Profile Picture <span class="text-danger">*</span></label>
                              <div class="col-sm-8">
                                <input type="file" class="filestyle" name="fileToUpload" data-buttonName="btn-primary">
                                <input type="hidden" name="profile_pic" value="<?php echo $profileData['profile_pic'];?>">
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-3 control-label">Address <span class="text-danger">*</span></label>
                              <div class="col-sm-8">
                                <input type="text" name="location" class="form-control map-address" value="<?php echo $profileData['location'];?>">
                                <button class="btn btn-success btn-quirk btn-wide mr5 locate-address">Locate</button>
                              </div>
                            </div> 

                            <div id="profile-edit-map" class="map">
                            </div>
                            <input type="hidden" value="<?php echo $profileData['latitude'];?>" name="latitude">
                            <input type="hidden" value="<?php echo $profileData['longitude'];?>" name="longitude"> 

                            <input type="hidden" name="adminId" value="<?php echo $profileData['ID'];?>">

                            <div class="col-md-12">
                              <div class="col-sm-9 col-sm-offset-3" style="padding-left: 5px; margin-top: 15px;">
                                <button type="submit" name="editAdmin" class="btn btn-success btn-quirk btn-wide mr5">Submit</button>
                                <button type="reset" class="btn btn-quirk btn-wide btn-default">Reset</button>
                              </div>
                            </div>

                          </form>

                        </div>
                      </div><!-- panel-body -->
                    </div><!-- panel panel-post -->
                  </div><!-- tab-pane -->

                </div>

              </div>
            </div>

          <?php } else if($_SESSION['logged_in_user_role'] == 2){?>

            <div class="col-md-6 col-lg-8 profile-right">
              <div class="profile-right-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified nav-line">
                  <li class="active"><a href="#basic" data-toggle="tab"><strong>My Profile</strong></a></li>
                  <li id="firm-map"><a href="#firm" data-toggle="tab"><strong>Firm Info</strong></a></li>
                  <li><a href="#bank" data-toggle="tab"><strong>Payment Info</strong></a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">

                  <div class="tab-pane active" id="basic">
                    <div class="panel-post-item">
                      <div class="panel-body nopaddingbottom">
                        <div id="basicForm" action="" class="form-horizontal" novalidate="novalidate">

                          <form method="POST" enctype="multipart/form-data">

                          <div class="form-group">
                            <label class="col-sm-3 control-label">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="name" class="form-control"  required="" aria-required="true" value="<?php echo $contact_name;?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label">Membership No. <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="membership_number" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['membership_number'];?>">
                            </div>
                          </div>

                          <div class="form-group mb20">
                            <label class="col-sm-3 control-label">Upload copy of membership no <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="file" class="filestyle" name="fileToMembership" data-buttonName="btn-primary">
                              <input type="hidden" name="membership_number_file" value="<?php echo $profileData['membership_number_file'];?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="email" name="email" class="form-control"  required="" readonly aria-required="true" value="<?php echo $profileData['email'];?>">
                            </div>
                          </div>
                            
                          <div class="form-group">
                            <label class="col-sm-3 control-label">Phone <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="mobile_number" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['mobile_number'];?>">
                            </div>
                          </div>

                          <div class="form-group mb20">
                            <label class="col-sm-3 control-label">Profile Picture <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="file" class="filestyle" name="fileToProfile" data-buttonName="btn-primary">
                              <input type="hidden" name="profile_pic" value="<?php echo $profileData['profile_pic'];?>">
                            </div>
                          </div>

                          <input type="hidden" name="partnerId" value="<?php echo $profileData['ID'];?>">

                          <div class="col-md-12">
                            <div class="col-sm-9 col-sm-offset-3" style="padding-left: 5px; margin-top: 15px;">
                              <button type="submit" name="editPartner1" class="btn btn-success btn-quirk btn-wide mr5">Submit</button>
                              <button type="reset" class="btn btn-quirk btn-wide btn-default">Reset</button>
                            </div>
                          </div>

                          </form>

                        </div>
                      </div><!-- panel-body -->
                    </div><!-- panel panel-post -->
                  </div><!-- tab-pane -->

                  <div class="tab-pane" id="firm">
                    <div class="panel-post-item">
                      <div class="panel-body nopaddingbottom">
                        <div id="basicForm" action="" class="form-horizontal" novalidate="novalidate">

                          <form method="POST" enctype="multipart/form-data" >

                          <div class="form-group">
                            <label class="col-sm-3 control-label">Firm Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="firm_name" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['firm_name'];?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label">FRN Number <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="frn_number" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['frn_number'];?>">
                            </div>
                          </div>

                          <div class="form-group mb20">
                            <label class="col-sm-3 control-label">Upload copy of FRN Number <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="file" class="filestyle" name="fileToFRN" data-buttonName="btn-primary">
                              <input type="hidden" name="frn_number_file" value="<?php echo $profileData['frn_number_file'];?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label">No. of CA's  <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="team_size" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['team_size'];?>">
                            </div>
                          </div>
                            
                          <div class="form-group">
                            <label class="col-sm-3 control-label">No. of other staff <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="other_staff" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['other_staff'];?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label">Phone<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="work_number" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['work_number'];?>">
                            </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Address <span class="text-danger">*</span></label>
                              <div class="col-sm-8">
                                <input type="text" name="location" class="form-control map-address" value="<?php echo $profileData['location'];?>">
                                <button class="btn btn-success btn-quirk btn-wide mr5 locate-address">Locate</button>
                              </div>
                          </div> 

                          <div id="profile-edit-map" class="map"></div>
                          <input type="hidden" value="<?php echo $profileData['latitude'];?>" name="latitude">
                          <input type="hidden" value="<?php echo $profileData['longitude'];?>" name="longitude">

                          <input type="hidden" name="partnerId" value="<?php echo $profileData['ID'];?>">
                    
                          <div class="col-md-12">
                            <div class="col-sm-9 col-sm-offset-3" style="padding-left: 5px; margin-top: 15px;">
                              <button type="submit" name="editPartner2" class="btn btn-success btn-quirk btn-wide mr5">Submit</button>
                              <button type="reset" class="btn btn-quirk btn-wide btn-default">Reset</button>
                            </div>
                          </div> 

                          </form>

                        </div>
                      </div><!-- panel-body -->
                    </div><!-- panel panel-post -->
                  </div>

                  <div class="tab-pane" id="bank">
                    <div class="panel-body nopaddingbottom">
                      <div id="basicForm" action="" class="form-horizontal" novalidate="novalidate">

                        <form method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Bank Account No. <span class="text-danger">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" name="bank_account" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['bank_account'];?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Bank Name <span class="text-danger">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" name="bank_name" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['bank_name'];?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">IFSC CODE<span class="text-danger">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" name="ifsc_code" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['ifsc_code'];?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">PAN card No. <span class="text-danger">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" name="pan_number" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['pan_number'];?>">
                          </div>
                        </div>

                        <div class="form-group mb20">
                          <label class="col-sm-3 control-label">Upload copy of Pan Card <span class="text-danger">*</span></label>
                          <div class="col-sm-8">
                            <input type="file" class="filestyle" name="fileToPan" data-buttonName="btn-primary">
                            <input type="hidden" name="pan_card_file" value="<?php echo $profileData['pan_card_file'];?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Service Tax Reg. <span class="text-danger">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" name="service_tax_number" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['service_tax_number'];?>">
                          </div>
                        </div>

                        <div class="form-group mb20">
                          <label class="col-sm-3 control-label">Upload copy of Service Tax Reg. <span class="text-danger">*</span></label>
                          <div class="col-sm-8">
                            <input type="file" class="filestyle" name="fileToTax" data-buttonName="btn-primary">
                            <input type="hidden" name="service_tax_file" value="<?php echo $profileData['service_tax_file'];?>">
                          </div>
                        </div>

                        <input type="hidden" name="partnerId" value="<?php echo $profileData['ID'];?>">
                      
                        <div class="col-md-12">
                          <div class="col-sm-9 col-sm-offset-3" style="padding-left: 5px; margin-top: 15px;">
                            <button type="submit" name="editPartner3" class="btn btn-success btn-quirk btn-wide mr5">Submit</button>
                            <button type="reset" class="btn btn-quirk btn-wide btn-default">Reset</button>
                          </div>
                        </div>

                        </form>

                      </div>
                    </div><!-- panel-body -->
                  </div>

                </div>

              </div>
            </div>
            <div class="col-md-3 col-lg-2 profile-sidebar">
              <div class="row">

                <div class="col-sm-6 col-md-12">
                  <div class="panel">
                   
                    <div class="panel panel-inverse">
                      <div class="panel-heading">
                        <h4 class="panel-title"><span class="fa fa-bar-chart"></span> Projects Summary</h4>
                      </div>
                      <div class="panel-body">
                        <p>Your projects summary for last 3 months.</p>
                        <h3 class="earning-amount"><?php echo myProjectSummary('accepted',3);?></h3>
                        <h4 class="earning-today">Total Projects</h4>
                        <br clear="all">
                        <p><span class="glyphicon glyphicon-import"></span> Project Recevied <span class="pull-right"><?php echo myProjectSummary('received',3);?></span></p>
                        <p><span class="glyphicon glyphicon-check"></span> Project Completed <span class="pull-right"><?php echo myProjectSummary('completed',3);?></span></p>
                        <p><span class="glyphicon glyphicon-lock"></span> Projects In-Progress <span class="pull-right"><?php echo myProjectSummary('in-progress',3);?></span></p>
                        <p><span class="glyphicon glyphicon-flash"></span> Projects Not Completed <span class="pull-right"><?php echo myProjectSummary('not-completed',3);?></span></p>
                        <p><span class="glyphicon glyphicon-remove"></span> Projects Rejected <span class="pull-right"><?php echo myProjectSummary('rejected',3);?></span></p>
                      </div>
                      <div class="panel-footer">
                      Total projects done this month: <?php echo myProjectSummary('completed',1);?>
                      </div>
                    </div>

                  </div><!-- panel -->
                </div>

                <div class="col-sm-6 col-md-12">
                  <div class="panel">
                    <div class="panel panel-inverse">
                      <div class="panel-heading">
                        <h4 class="panel-title"><span class="fa fa-line-chart"></span> Earnings Summary</h4>
                      </div>
                      <div class="panel-body">
                        <p>Your earnings summary for last 3 months.</p>
                        <h3 class="earning-amount">&#8377;<?php echo getPartnerPaymentFigMonth('total',3);?></h3>
                        <h4 class="earning-today">Total Earnings</h4>
                        <br clear="all">
                        <p><span class="glyphicon glyphicon-check"></span> Payment Received <span class="pull-right">&#8377; <?php echo getPartnerPaymentFigMonth('received',3);?></span></p>
                        <p><span class="glyphicon glyphicon-warning-sign"></span> Payment Due <span class="pull-right">&#8377; <?php echo getPartnerPaymentFigMonth('due',3);?></span></p>
                        <p><span class="glyphicon glyphicon-import"></span> Payment Pipeline <span class="pull-right">&#8377; <?php echo getPartnerPaymentFigMonth('pipeline',3);?></span></p>
                      </div>
                      <div class="panel-footer">
                        Total projects done this month: <?php echo myProjectSummary('completed',1);?>
                      </div>
                    </div>
                  </div><!-- panel -->
                </div>

              </div><!-- row -->
            </div>

          <?php } else if($_SESSION['logged_in_user_role'] == 3){?>

            <div class="col-md-6 col-lg-8 profile-right">
              <div class="profile-right-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified nav-line">
                  <li class="active"><a href="#basic" data-toggle="tab"><strong>My Profile</strong></a></li>
                  <li><a href="#firm" data-toggle="tab"><strong>Firm Info</strong></a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">

                  <div class="tab-pane active" id="basic">
                    <div class="panel-post-item">
                      <div class="panel-body nopaddingbottom">
                        <div id="basicForm" action="" class="form-horizontal" novalidate="novalidate">

                          <form method="POST" enctype="multipart/form-data">

                          <div class="form-group">
                            <label class="col-sm-3 control-label">Contact Person <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="contact_person" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['contact_person'];?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="email" name="email" class="form-control" readonly required="" aria-required="true" value="<?php echo $profileData['email'];?>">
                            </div>
                          </div>
                            
                          <div class="form-group">
                            <label class="col-sm-3 control-label">Phone <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="phone" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['phone'];?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label">Website <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="website" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['website'];?>">
                            </div>
                          </div>

                          <div class="form-group mb20">
                            <label class="col-sm-3 control-label">Logo <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="file" class="filestyle" name="fileToLogo" data-buttonName="btn-primary">
                              <input type="hidden" name="logo" value="<?php echo $profileData['logo'];?>">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-sm-3 control-label">Address <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="location" class="form-control map-address" value="<?php echo $profileData['location'];?>">
                              <button class="btn btn-success btn-quirk btn-wide mr5 locate-address">Locate</button>
                            </div>
                          </div> 

                          <div id="profile-edit-map" class="map"></div>
                          <input type="hidden" value="<?php echo $profileData['latitude'];?>" name="latitude">
                          <input type="hidden" value="<?php echo $profileData['longitude'];?>" name="longitude"> 

                          <input type="hidden" name="clientId" value="<?php echo $profileData['ID'];?>">

                          <div class="col-md-12">
                            <div class="col-sm-9 col-sm-offset-3" style="padding-left: 5px; margin-top: 15px;">
                              <button type="submit" name="editClient1" class="btn btn-success btn-quirk btn-wide mr5">Submit</button>
                              <button type="reset" class="btn btn-quirk btn-wide btn-default">Reset</button>
                            </div>
                          </div>

                          </form>
                         
                        </div>
                      </div><!-- panel-body -->
                    </div><!-- panel panel-post -->
                  </div><!-- tab-pane -->

                  <div class="tab-pane" id="firm">
                    <div class="panel-post-item">
                      <div class="panel-body nopaddingbottom">
                        <div id="basicForm" action="" class="form-horizontal" novalidate="novalidate">

                          <div class="form-group">
                            <label class="col-sm-3 control-label">Company Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="name" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['company_name'];?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label">TAN <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="TAN" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['TAN'];?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label">PAN <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="PAN" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['PAN'];?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label">Service Tax Number <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="service_tax_number" class="form-control"  required="" aria-required="true" value="<?php echo $profileData['service_tax_number'];?>">
                            </div>
                          </div>

                          <input type="hidden" name="clientId" value="<?php echo $profileData['ID'];?>">
                    
                          <div class="col-md-12">
                            <div class="col-sm-9 col-sm-offset-3" style="padding-left: 5px; margin-top: 15px;">
                              <button type="submit" name="editClient2" class="btn btn-success btn-quirk btn-wide mr5">Submit</button>
                              <button type="reset" class="btn btn-quirk btn-wide btn-default">Reset</button>
                            </div>
                          </div> 

                        </div>
                      </div><!-- panel-body -->
                    </div><!-- panel panel-post -->
                  </div>
                  
                </div>

              </div>
            </div>
            <div class="col-md-3 col-lg-2 profile-sidebar">
              <div class="row">

                <div class="col-sm-6 col-md-12">
                  <div class="panel">
                   
                    <div class="panel panel-inverse">
                      <div class="panel-heading">
                        <h4 class="panel-title"><span class="fa fa-bar-chart"></span> Projects Summary</h4>
                      </div>
                      <div class="panel-body">
                        <p>Your projects summary for last 3 months.</p>
                        <h3 class="earning-amount">38</h3>
                        <h4 class="earning-today">Total Projects</h4>
                        <br clear="all">
                        <p><span class="glyphicon glyphicon-import"></span> Project Recevied <span class="pull-right">58</span></p>
                        <p><span class="glyphicon glyphicon-check"></span> Project Completed <span class="pull-right">38</span></p>
                        <p><span class="glyphicon glyphicon-lock"></span> Projects In-Progress <span class="pull-right">2</span></p>
                        <p><span class="glyphicon glyphicon-flash"></span> Projects Not Completed <span class="pull-right">0</span></p>
                        <p><span class="glyphicon glyphicon-remove"></span> Projects Rejected <span class="pull-right">2</span></p>
                      </div>
                      <div class="panel-footer">
                      Total projects done this month: 18
                      </div>
                    </div>

                  </div><!-- panel -->
                </div>

                <div class="col-sm-6 col-md-12">
                  <div class="panel">
                    <div class="panel panel-inverse">
                      <div class="panel-heading">
                        <h4 class="panel-title"><span class="fa fa-line-chart"></span> Earnings Summary</h4>
                      </div>
                      <div class="panel-body">
                        <p>Your earnings summary for last 3 months.</p>
                        <h3 class="earning-amount">₹5041.00</h3>
                        <h4 class="earning-today">Total Earnings</h4>
                        <br clear="all">
                        <p><span class="glyphicon glyphicon-check"></span> Payment Received <span class="pull-right">₹ 1,320.34</span></p>
                        <p><span class="glyphicon glyphicon-import"></span> Payment Initiated <span class="pull-right">₹ 5,520.34</span></p>
                        <p><span class="glyphicon glyphicon-warning-sign"></span> Payment Due <span class="pull-right">₹ 2,520.34</span></p>
                      </div>
                      <div class="panel-footer">
                        Total projects done this month: 18
                      </div>
                    </div>
                  </div><!-- panel -->
                </div>

              </div><!-- row -->
            </div>

          <?php }?>

        </div><!-- row -->

      <?php }?>

    </div><!-- contentpanel -->
  </div><!-- mainpanel -->

<?php include "footer.php";?>
<script type="text/javascript">initializeProfileMap();</script>

