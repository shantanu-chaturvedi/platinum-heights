<?php $currentPage = 'myProject';
include 'header.php';
$projectId = $_GET['i'];
$projectDetails = getMyProjectDetailsById($_GET['i']);
$projectType =  getProjectTypeById($projectDetails[0]['project_type_id']);
$clientCompany = getClientCompanyNameById($projectDetails[0]['client_id']);
$location = getLocationByLocationId($projectDetails[0]['location_id']);

//downloadQuestionaire(85);?>
  
  <div class="mainpanel">
    <div class="contentpanel">

      <div class="row">
        <div class="col-sm-8 col-md-9 col-lg-10">

          <div class="panel">
            <div class="panel-heading">
              <h4 class="panel-title"> Form <a href="downloads.php?downloadQuestionaire&i=<?php echo $projectId;?>"><span class="glyphicon glyphicon-download-alt pull-right"></span></a></h4>
            </div>
            <div class="panel-body">
              <p><strong>Lorem ipsum dolor sit amet, inani impetus consequat cu pro, solum melius vix ei. Pri eros noluisse euripidis no, te regione omittam reprimique vis.</strong></p>

              <?php //getFormBuilderData($projectId);?>

              <form id="sjfb-sample" method="post">
                <div id="sjfb-fields">
                </div>
                <?php if($projectDetails[0]['inventory_file'] != ""){
                  if($projectDetails[0]['updated_form_data'] == ""){
                    echo $inventory = getInventory('../controller/projectAttachments/'.$projectDetails[0]['inventory_file'],$location);
                  }else{
                    $formData = $projectDetails[0]['updated_form_data'];
                    $formDataArray = json_decode($formData,true);
                    $i=0;
                    $html = "<table class='table'><tr><th>Item</th><th>".$location[0]['location']."</th><th>Value Checked</th></tr>";
                    foreach($formDataArray['grid'][0] as $grid){
                      $html.="<tr><td>".$grid."<input type='hidden' name='comaprisionItem[]' value='".$grid."' /></td>
                                  <td>".$formDataArray['grid'][1][$i]."<input type='hidden' name='comaprisionFrom[]' value='".$formDataArray['grid'][1][$i]."' /></td>
                                  <td><input type='text' name='comaprisionValue[]' value='".$formDataArray['grid'][2][$i]."' /></td>
                              </tr>";
                      $i++;
                    }
                    $html.="</table>";
                    echo $html;
                  }
                }?>
                <?php if($projectDetails[0]['submitted_by_ca'] == 0){ ?>
                  <input type="hidden" value="<?php echo $projectId;?>" name="subprojectId">
                  <input type="hidden" value="<?php echo $projectDetails[0]['ID'];?>" name="projectId">
                  <button type="submit" class="submit btn btn-default btn-quirk" name="inventory_submit">Submit</button>
                <?php }?>
              </form>

            </div>
          </div>

          <div class="panel">
            <div class="panel-heading">
              <h4 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Post Final Form</h4>
            </div>
            <div class="panel-body">
              <p><strong>Lorem ipsum dolor sit amet, inani impetus consequat cu pro, solum melius vix ei. Pri eros noluisse euripidis no, te regione omittam reprimique vis.</strong></p>

              <?php if($projectDetails[0]['submitted_by_ca'] == 1){
                echo '<div class="alert alert-success">
                        <strong>Uploaded</strong>
                      </div>';
              }else{?>
                <div class="alert alert-info">
                  <strong>You need to upload dually filled, signed and stamped document to the project. Documents without signature and stamp will be disregarded.</strong>
                </div>
              
                <form role="form" id="finalFormSubmit" method="post" enctype="multipart/form-data">
                  <br clear="all" />
                  <input name="finalForm" type="file" />
                  <br clear="all" />
                  <p>
                    <button type="submit" class="btn btn-default btn-quirk pull-right">Submit</button>
                  </p>
                  <input type="hidden" value="<?php echo $projectId;?>" name="subprojectId">
                  <input type="hidden" value="<?php echo $projectDetails[0]['ID'];?>" name="projectId">
                </form>
              <?php }?>
            </div>
          </div>

          <div class="panel">
            <div class="panel-heading">
              <h4 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Post Update</h4>
            </div>
            <div class="panel-body">
              <p><strong>Lorem ipsum dolor sit amet, inani impetus consequat cu pro, solum melius vix ei. Pri eros noluisse euripidis no, te regione omittam reprimique vis.</strong></p>
              
              <form role="form" method="post" enctype="multipart/form-data">
                <br clear="all" />
                <textarea id="wysiwyg" name="message" placeholder="Enter message here..." class="form-control" rows="4"></textarea>
                <br clear="all" />
                <input name="timelineFiles[]" type="file" multiple />
                <br clear="all" />
                <p>
                  <button type="submit" name="updateTimeline" class="btn btn-default btn-quirk pull-right">Update Timeline</button>
                </p>
                <input type="hidden" value="<?php echo $projectId;?>" name="subprojectId">
                <input type="hidden" value="<?php echo $projectDetails[0]['ID'];?>" name="projectId">
              </form>
            </div>
          </div>

          <div class="panel">
            <div class="panel-heading">
              <h4 class="panel-title"><span class="fa fa-history"></span> &nbsp; Project Timeline</h4>
            </div>
            
            <div class="panel-body">
              <div class="timeline-wrapper">
                <?php $timelineDates = getMyTimelineDates($projectId);
                foreach($timelineDates as $timelineDate){ 
                  $date1=date_create($timelineDate['created_at']);?>
                  
                  <div class="timeline-date"><?php echo date_format($date1,"l, F d, Y");?></div>

                  <?php $timelineDetails = getMyTimeline($projectId,$timelineDate['created_at']);
                  foreach ($timelineDetails as $timelineDetail){
                    $userInfo = getNameById('tbl_partners',$timelineDetail['user_id']);?>
                    <div class="panel panel-post-item status">
                      <div class="panel-heading">
                        <div class="media">
                          <div class="media-left"> <a href="#"> <img alt="" src="<?php if($data['profile_pic'] == ""){ echo '../assets/images/photos/sampleUserImage.png'; } else{ echo '../view/images/'.$userInfo[0]['profile_pic']; }?>" class="media-object img-circle"> </a> </div>
                          <div class="media-body">
                            <h4 class="media-heading"><?php echo $userInfo[0]['name']?></h4>
                            <?php $date2=date_create($timelineDetail['created_at']);?>
                            <p class="media-usermeta"> <span class="media-time"><?php echo date_format($date2,'g:i A');?></span> </p>
                          </div>
                        </div>
                      </div>
                      <!-- panel-heading -->
                      <div class="panel-body"> <?php echo $timelineDetail['description'];?></div>
                    </div>
                    <!-- panel panel-post -->
                  <?php }?>

                <?php }?>
              </div>
              <!-- timeline-wrapper --> 
            </div>
          </div>
        </div>
        <div class="col-md-3 col-lg-4 dash-right">
          <div class="row">
            <div class="col-sm-5 col-md-12 col-lg-6">
              <div class="panel panel-danger">
                <div class="panel-heading">
                  <h4 class="panel-title"><span class="fa fa-bar-chart"></span> Project Detail</h4>
                </div>
                <div class="panel-body">
                  <h3 class="earning-amount"><?php echo $projectType[0]['type'];?></h3>
                  <h4 class="earning-today"><?php echo $clientCompany[0]['company_name'];?></h4>
                  <br clear="all" />
                  <p><strong><span class="glyphicon glyphicon-tag"></span> Type:</strong> <?php echo $projectType[0]['type'];?><br>
                    <strong><span class="glyphicon glyphicon-user"></span> Client:</strong> <?php echo $clientCompany[0]['company_name'];?><br>
                    <strong><span class="glyphicon glyphicon-map-marker"></span> Location:</strong> <?php echo $location[0]['location'];?></p>
                    <strong><span class="glyphicon glyphicon-align-left"></span> Description:</strong> <?php echo $projectDetails[0]['description'];?>
                  </p>
                </div>
              </div>
              <div class="panel panel-danger">
                <div class="panel-heading">
                  <h4 class="panel-title"><span class="fa fa-download"></span> Downloads</h4>
                </div>
                <div class="panel-body">
                  <p><strong><span class="fa fa-file-pdf-o"></span> <a href="#">Download Instructions</a></strong></p>
                  <p><strong><span class="fa fa-file-excel-o"></span> <a href="downloads.php?downloadQuestionaire&i=<?php echo $projectId;?>">Download Questionnaire</a></strong></p>
                  <p><strong><span class="fa fa-play-circle"></span> <a href="#">Watch Help Video</a></strong></p>
                </div>
              </div>
              <div class="panel panel-danger">
                <div class="panel-body">
                  <?php if($projectDetails[0]['submitted_by_ca'] == 1){ ?>
                    <button class="btn btn-primary btn-lg" disabled style="width:100%;">Submitted Project</button>
                  <?php } else{ ?>
                    <button onClick="submitProjectFinal(<?php echo $projectId; ?>);" class="btn btn-primary btn-lg" style="width:100%;">Submit Project</button>
                  <?php }?>
                </div>
              </div>
            </div>
            <!-- col-md-12 --> 
          </div>
          <!-- row --> 
          
          <!-- row --> 
          
        </div>
      </div>
      <!-- row --> 
      
    </div>
    <!-- contentpanel --> 
    
  </div>
  <!-- mainpanel --> 

  <div class="modal bounceIn animated project-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  </div>

  <?php include "footer.php";?>

  <script type="text/javascript">generateForm(<?php echo $projectId;?>);</script>
