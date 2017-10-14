<?php $parentPage = 'projects';
$currentPage = 'completedProject';
include "header.php";?>

	<div class="mainpanel">
		<div class="contentpanel">
		  
		    <div class="panel">
		      <div class="panel-heading">
		        <h4 class="panel-title"><span class="fa fa-cube"></span> Completed Projects </h4>
		        <!--<p>Lorem ipsum dolor sit amet, inani impetus consequat cu pro, solum melius vix ei. Pri eros noluisse euripidis no, te regione omittam reprimique vis.</p>-->
		      </div>
		      <div class="panel-body">
		        <div class="table-responsive">
		          <table class="table table-striped nomargin">
		            <thead>
		              <tr>
		                <th class="text-center">#</th>
		                <th>Project</th>
		                <th>Type</th>
		                <th>Company</th>
		                <th>Location</th>
		                <th>Due on</th>
		                <th>Project Report</th>
		              </tr>
		            </thead>
		            <tbody>
		              <?php $projectDetails = getAllProjectDetails();
		              $i = 0;
		              foreach($projectDetails as $projectDetail){
		                if($projectDetail['final_project_status'] == 1){
		                	$i++;
		                  $projectType =  getProjectTypeById($projectDetail['project_type_id']);
		                  $clientCompany = getClientCompanyNameById($projectDetail['client_id']);
						  $location = getImplodeProjectDetailsById($projectDetail['ID']);?>
		                <tr>
		                  <td><strong><a href="single-project-detail.php?i=<?php echo $projectDetail['ID'];?>&s=1"><?php echo $projectDetail['ID'];?></a></strong></td>
		                  <td><a href="single-project-detail.php?i=<?php echo $projectDetail['ID'];?>&s=1"><?php echo shorter($projectDetail['description'],25);?></td>
		                  <td><?php echo $projectType[0]['type'];?></td>
		                  <td><?php echo $clientCompany[0]['company_name'];?></td>
		                  <td><?php echo $location;?></td>
		                  <td><?php echo $projectDetail['due_date'];?></td>
		                  <td><a href="downloads.php?projectReport&projectId=<?php echo $projectDetail['ID'];?>"><i class="fa fa-download" aria-hidden="true"></i></a></td>
		                </tr>
		              <?php } }
		              if($i == 0){ ?>
		                  <tr><td colspan="7" class="alert alert-info text-center">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <?php echo "No project completed..!"; ?>
		                  </td></tr>
	                <?php }?>
		            </tbody>
		          </table>
		        </div>
		      </div>
		    </div>
		    
		</div> 
	</div>

<?php include "footer.php";?>