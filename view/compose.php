<?php $parentPage = 'messages';
$currentPage = 'compose';
include 'header.php';
$adminNames = getNames('tbl_admin');
$caNames = getNames('tbl_partners');
$clientNames = getNames('tbl_clients'); ?>

  <div class="mainpanel">
    <div class="contentpanel">

      <?php if($_SESSION['logged_in_user_role'] == 1){?>

        <div class="row">
          <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="panel">
              <div class="panel-heading">
                <h4 class="panel-title mb5"><span class="fa fa-pencil-square-o"> </span> Create New Message</h4>
                <!-- <p class="pull-right">Project ID #<span id="projectId"></span> </p> -->
              </div>
              <div class="panel-body">
                <div id="wizardMsg" class="swMain">

                  <ul>
                    <li><a href="#step-1">
                          <span class="stepDesc">
                             <small>1. Select Recipients</small>
                          </span>
                      </a></li>
                    <li><a href="#step-2">
                          <span class="stepDesc">
                             <small>2. Compose Message</small>
                          </span>
                      </a></li>
                  </ul>

                  <div id="step-1">
                    <div class="tab-pane active" id="basic">
                      <div id="basicForm" novalidate="novalidate">

                        <div class="col-sm-8 col-md-9 col-lg-10">
                          
                          <div class="table-responsive">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th><input type="checkbox" id="selectAllUsers"></th>
                                  <th>Name</th>
                                  <th>Location</th>
                                  <th>Company Name</th>
                                  <th>Role</th>
                                </tr>
                              </thead>

                              <tbody id="filterResult">
                                <?php if((checkCapabilities("send message to other admin") == 1) || (checkCapabilities("broadcast message") == 1)) { 
                                foreach($adminNames as $adminName){?>
                                  <tr>
                                    <td><input type="checkbox" class="recipientCheckbox" name="receiver" value=<?php echo "1-".$adminName['ID']?>></td>
                                    <td><?php echo $adminName['name'];?></td>
                                    <td><?php echo $adminName['location'];?></td>
                                    <td>-</td>
                                    <td><span class="label label-info">Manager</span></td>
                                  </tr>
                                <?php } }?>


                                <?php if((checkCapabilities("send message to partner") == 1) || (checkCapabilities("broadcast message") == 1)) { 
                                foreach($caNames as $caName){?>
                                  <tr>
                                    <td><input type="checkbox" class="recipientCheckbox" name="receiver" value=<?php echo "2-".$caName['ID']?>></td>
                                    <td><?php echo $caName['name']?></td>
                                    <td><?php echo $caName['location']?></td>
                                    <td><?php echo $caName['firm_name']?></td>
                                    <td><span class="label label-warning">Partner</span></td>
                                  </tr>
                                <?php } }?>

                                <?php if((checkCapabilities("send message to client") == 1) || (checkCapabilities("broadcast message") == 1)) { 
                                foreach($clientNames as $clientName){?>
                                  <tr>
                                    <td><input type="checkbox" class="recipientCheckbox" name="receiver" value=<?php echo "3-".$clientName['ID']?>></td>
                                    <td><?php echo $clientName['contact_person']?></td>
                                    <td><?php echo $clientName['location']?></td>
                                    <td><?php echo $clientName['company_name']?></td>
                                    <td><span class="label label-danger">Client</span></td>
                                  </tr>
                                <?php } }?>
                              </tbody>

                            </table>
                              
                          </div>
                        </div>

                        <div class="col-sm-4 col-md-3 col-lg-2">
                          <div class="panel">
                            <div class="panel-heading">
                              <h4 class="panel-title">Filter Members</h4>
                            </div>

                            <div class="panel-body">
                              <form  method="post" id="memberSearchForMessage">
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
                                <?php if((checkCapabilities("send message to other admin") == 1) && (checkCapabilities("send message to partner") == 1) && (checkCapabilities("send message to client") == 1)){?>
                                  <div class="form-group">
                                    <label class="control-label center-block">By Role:</label>
                                    <select id="select6" name="role[]" class="form-control" style="width: 100%" data-placeholder="Select Role..." multiple>
                                      <?php if(checkCapabilities("send message to other admin") == 1) { ?>
                                        <option value="1">Admins</option>
                                      <?php } if(checkCapabilities("send message to partner") == 1) { ?>
                                        <option value="2">CA Prtners</option>
                                      <?php } if(checkCapabilities("send message to client") == 1) { ?>
                                        <option value="3">Clients</option>
                                      <?php }?>
                                    </select>
                                  </div>
                                <?php }?>
                                <input type="hidden" name="memberType" value="2">
                                <input type="submit" value="Filter List" class="btn btn-success btn-block" name="filter">
                              </form>
                            </div>
                          </div>  
                        </div> 

                      </div>
                    </div><!-- tab-pane -->
                  </div>

                  <div id="step-2">
                    <div class="form-group">
                      <div class="tab-pane">
                        <input type="text" name="subject" placeholder="Subject" class="form-control">
                        <input type="hidden" name="senderMemberType" value="<?php print_r($_SESSION['logged_in_user_role']);?>">
                        <br clear="all" />
                        <textarea id="summernote" name="message" placeholder="Enter message here..." class="form-control compmessage" rows="10"></textarea>
                        <br clear="all" />
                        <input type="checkbox" value="1" name="sendMail">Send this message in Mail
                        <br clear="all" />
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

          </div> 
        </div>

      <?php } else {?>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> &nbsp; New Message</h4>
          </div>
          <div class="panel-body">
            <form role="form" method="post">
              <?php if($_SESSION['logged_in_user_role'] == 1){ ?>
                <select id="select6" name="receiver[]" class="form-control" style="width: 100%" data-placeholder="Send To..." multiple>
                  <optgroup label="Admins">
                    <?php foreach($adminNames as $adminName){?>
                    <option value="<?php echo '1-'.$adminName['ID'];?>"><?php echo $adminName['name']?></option>
                    <?php }?>
                  </optgroup>
                  <optgroup label="CA Partners">
                    <?php foreach($caNames as $caName){?>
                    <option value="<?php echo '2-'.$caName['ID'];?>"><?php echo $caName['name']?></option>
                    <?php }?>
                  </optgroup>
                  <optgroup label="Clients">
                    <?php foreach($clientNames as $clientName){?>
                    <option value="<?php echo '3-'.$clientName['ID'];?>"><?php echo $clientName['contact_person']?></option>
                    <?php }?>
                  </optgroup>
                </select>
                <input type="hidden" name="message_type" value="">
              <?php } else{?>
                <p><strong>Use below form to compose and send message to <span class="logo">CACircuite</span> team.</strong></p>
                <div class="col-md-6">
                  <label class="rdiobox rdiobox-primary">
                    <input type="radio" name="message_type">
                    <span>Need Help</span> </label>
                  <label class="rdiobox rdiobox-primary">
                    <input type="radio" name="message_type">
                    <span>Query/Suggestion</span> </label>
                  <label class="rdiobox rdiobox-primary">
                    <input type="radio" name="message_type">
                    <span>Report Bug</span> </label>
                </div>
                <?php foreach($adminNames as $adminName){
                  $receiver[] = '1-'.$adminName['ID'];
                }
                $imRec = implode(',', $receiver);?>
                <input type="hidden" name="receiver" value="<?php echo $imRec;?>">

              <?php }?>
              <br clear="all" />
              <br clear="all" />
              <input type="text" name="subject" placeholder="Subject" class="form-control">
              <input type="hidden" name="senderMemberType" value="<?php print_r($_SESSION['logged_in_user_role']);?>">
              <br clear="all" />
              <textarea id="summernote" name="message" placeholder="Enter message here..." class="form-control" rows="10"></textarea>
              <br clear="all" />
              <input type="checkbox" value="1" name="sendMail">Send this message in Mail
              <br clear="all" />
              <p>
                <button  type="submit" name="composeMessage" class="btn btn-default btn-quirk pull-right">Send Message</button>
              </p>
            </form>
          </div>
        </div>
        
      <?php }?>

    </div>
  </div>

<?php include 'footer.php';?>