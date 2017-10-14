<?php $currentPage = 'myProject';
include 'header.php';?>

<div class="mainpanel">
  <div class="contentpanel">

    <?php $projectDetails = checkForPartnersApproval();?>
    <div class="col-md-9 col-lg-8 dash-left">

      <?php if($projectDetails){?>
        <div class="panel panel-announcement">
          <ul class="panel-options">
            <li><a><i class="fa fa-refresh"></i></a></li>
            <li><a class="panel-remove"><i class="fa fa-remove"></i></a></li>
          </ul>
          <div class="panel-heading">
            <h4 class="panel-title"><span class="glyphicon glyphicon-check"></span> New Assignment</h4>
          </div>
          <div class="panel-body">
            <p>A new assginment for your area is uploaded by <span class="text-primary logo">CACircuit</span>. Request you to please review and respond to this message.</p>
            <?php foreach($projectDetails as $projectDetail){
                $projectType =  getProjectTypeById($projectDetail['project_type_id']);
                $clientCompany = getClientCompanyNameById($projectDetail['client_id']);
                $location = getLocationByLocationId($projectDetail['location_id']);?>
                <p><strong><span class="glyphicon glyphicon-tag"></span> Type:</strong> <?php echo $projectType[0]['type'];?><br>
                <strong><span class="glyphicon glyphicon-user"></span> Client:</strong> <?php echo $clientCompany[0]['company_name'];?><br>
                <strong><span class="glyphicon glyphicon-map-marker"></span> Location:</strong> <?php echo $location[0]['location'];?><br>
                <strong><span class="glyphicon glyphicon-tag"></span> Payment:</strong> <?php echo $projectDetail['partner_payment'].' Rs.';?><br>
                <strong><span class="glyphicon glyphicon-align-left"></span> Description:</strong> <?php echo shorter($projectDetail['description'],25);?></p>
                <br clear="all" />
                <a href="my-project-details.php?i=<?php echo $projectDetail['subprojectid'];?>"><button class="btn btn-primary btn-sm">Read More</button></a>
                <a id="acceptProject" href="#" onClick="submitProjectStatus(1,<?php echo $projectDetail['subprojectid'];?>,<?php echo $projectDetail['ID'];?>);"><button class="btn btn-success btn-sm">Accept</button></a>
                <a id="notInterestedProject" href="#" onClick="submitProjectStatus(2,<?php echo $projectDetail['subprojectid'];?>,<?php echo $projectDetail['ID'];?>);"><button class="btn btn-danger btn-sm">Not Interested</button></a>
            <?php }?>
          </div>
        </div>
      <?php }?>

      <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title"><span class="fa fa-cube"></span> Projects (Completed)</h4>
          <!--<p>Lorem ipsum dolor sit amet, inani impetus consequat cu pro, solum melius vix ei. Pri eros noluisse euripidis no, te regione omittam reprimique vis.</p>-->
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped nomargin">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Project</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Due on</th>
                </tr>
              </thead>
              <tbody>
                <?php $projectDetails = getMyAllProjectDetails();
                $i = 0;
                foreach($projectDetails as $projectDetail){
                  if($projectDetail['project_status'] == 1){
                    $i++; 
                    $projectType =  getProjectTypeById($projectDetail['project_type_id']);?>
                    <tr>
                      <td><strong><a href="my-project-details.php?i=<?php echo $projectDetail['subprojectid'];?>"><?php echo $projectDetail['subprojectid'];?></a></strong></td>
                      <td><a href="my-project-details.php?i=<?php echo $projectDetail['subprojectid'];?>"><?php echo shorter($projectDetail['description'],25);?></td>
                      <td><?php echo $projectType[0]['type'];?></td>
                      <td>
                        <span class="label label-success">Completed</span>
                      </td>
                      <td><?php echo $projectDetail['due_date'];?></td>
                    </tr>
                <?php } }
                if($i == 0){ ?>
                  <tr><td colspan="5" class="alert alert-info text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo "No project completed..!"; ?>
                  </td></tr>
                <?php }?>
              </tbody>
            </table>
          </div>
          <!-- table-responsive --> 
        </div>
      </div>

      <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title"><span class="fa fa-cube"></span> Projects (Not Completed, In Progress or Rejected)</h4>
          <!--<p>Lorem ipsum dolor sit amet, inani impetus consequat cu pro, solum melius vix ei. Pri eros noluisse euripidis no, te regione omittam reprimique vis.</p>-->
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped nomargin">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Project</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Due on</th>
                </tr>
              </thead>
              <tbody>
                <?php $projectDetails = getMyAllProjectDetails();
                if(empty($projectDetails)){ ?>
                  <tr><td colspan="5" class="alert alert-info text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo "No project..!"; ?>
                  </td></tr>
                <?php }else{
                  foreach($projectDetails as $projectDetail){
                    if(($projectDetail['project_status'] != 1) && ($projectDetail['request_status'] != 0) && ($projectDetail['request_status'] != 4)){
                      $projectType =  getProjectTypeById($projectDetail['project_type_id']);?>
                    <tr>
                      <td><strong><a href="my-project-details.php?i=<?php echo $projectDetail['subprojectid'];?>"><?php echo $projectDetail['subprojectid'];?></a></strong></td>
                      <td><a href="my-project-details.php?i=<?php echo $projectDetail['subprojectid'];?>"><?php echo shorter($projectDetail['description'],25);?></td>
                      <td><?php echo $projectType[0]['type'];?></td>
                      <td>
                        <?php if(($projectDetail['project_status'] == 0) && ($projectDetail['request_status'] == 1)){?>
                          <span class="label label-danger">In Progress</span>
                        <?php }else if(($projectDetail['project_status'] == 2) && ($projectDetail['request_status'] == 1)){?>
                          <span class="label label-warning">Not Completed</span>
                        <?php }else if($projectDetail['request_status'] == 2){?>
                          <span class="label label-default">Rejected</span>
                        <?php }?>
                      </td>
                      <td><?php echo $projectDetail['due_date'];?></td>
                    </tr>
                  <?php } }
                } ?>
                
              </tbody>
            </table>
          </div>
          <!-- table-responsive --> 
        </div>
      </div>
    
    </div>

    <div class="col-md-3 col-lg-4 dash-right">
      <div class="row">
        <div class="col-sm-5 col-md-12 col-lg-6">
          <div class="panel panel-inverse">
            <div class="panel-heading">
              <h4 class="panel-title"><span class="fa fa-bar-chart"></span> Projects Summary</h4>
            </div>
            <div class="panel-body">
              <p>Your projects summary for last 3 months.</p>
              <h3 class="earning-amount"><?php echo myProjectSummary('accepted',3);?></h3>
              <h4 class="earning-today">Total Projects</h4>
              <br clear="all" />
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
          <div class="panel panel-inverse">
            <div class="panel-heading">
              <h4 class="panel-title"><span class="fa fa-line-chart"></span> Earnings Summary</h4>
            </div>
            <div class="panel-body">
              <p>Your earnings summary for last 3 months.</p>
              <h3 class="earning-amount">&#8377;<?php echo getPartnerPaymentFigMonth('total',3);?></h3>
              <h4 class="earning-today">Total Earnings</h4>
              <br clear="all" />
              <p><span class="glyphicon glyphicon-check"></span> Payment Received <span class="pull-right">&#8377; <?php echo getPartnerPaymentFigMonth('received',3);?></span></p>
              <p><span class="glyphicon glyphicon-warning-sign"></span> Payment Due <span class="pull-right">&#8377; <?php echo getPartnerPaymentFigMonth('due',3);?></span></p>
              <p><span class="glyphicon glyphicon-import"></span> Payment Pipeline <span class="pull-right">&#8377; <?php echo getPartnerPaymentFigMonth('pipeline',3);?></span></p>
            </div>
            <div class="panel-footer">
              Total projects done this month: <?php echo myProjectSummary('completed',1);?>
            </div>
          </div>
        </div> 
      </div>
    </div>

  </div>
</div>

<?php include "footer.php";?>
