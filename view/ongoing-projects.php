<?php $parentPage = 'projects';
$currentPage = 'ongoingProject';
include "header.php";?>

	<div class="mainpanel">
		<div class="contentpanel">
		  
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
		                <!-- <th class="text-center"> <label class="ckbox ckbox-primary">
		                    <input type="checkbox">
		                    <span></span> </label>
		                </th> -->
		                <th class="text-center">#</th>
		                <th>Project</th>
		                <th>Type</th>
		                <th>Company</th>
		                <th>Location</th>
		                <th>Due on</th>
		                <th>Action</th>
		              </tr>
		            </thead>
		            <tbody>
		              <?php $projectDetails = getAllProjectDetails();
		              $i=0;
		              foreach($projectDetails as $projectDetail){
		              	$assigned_to = explode(',',$projectDetail['assigned_to']);

		              	if($projectDetail['client_id'] != 0){

		              	if(checkCapabilities("view other project") == 1){

		              		if($projectDetail['final_project_status'] != 1){
		              			$i++;
			                  	$projectType =  getProjectTypeById($projectDetail['project_type_id']);
			                  	$clientCompany = getClientCompanyNameById($projectDetail['client_id']);
							  	$location = getImplodeProjectDetailsById($projectDetail['ID']);?>
				                <tr>
				                  <td><strong><a href="single-project-detail.php?i=<?php echo $projectDetail['ID'];?>&s=2"><?php echo $projectDetail['ID'];?></a></strong></td>
				                  <td><a href="single-project-detail.php?i=<?php echo $projectDetail['ID'];?>&s=2"><?php echo shorter($projectDetail['description'],25);?></td>
				                  <td><?php echo $projectType[0]['type'];?></td>
				                  <td><?php echo $clientCompany[0]['company_name'];?></td>
				                  <td><?php echo $location;?></td>
				                  <td><?php echo $projectDetail['due_date'];?></td>
				                  <td><a href="edit-project.php?i=<?php echo $projectDetail['ID'];?>"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Edit Details</button></td>
				                </tr>
			                <?php }
		              	} else {
		              		if(in_array($_SESSION['logged_in_user_in'], $assigned_to)){

		              			if($projectDetail['final_project_status'] != 1){
		              				$i++;
				                  	$projectType =  getProjectTypeById($projectDetail['project_type_id']);
				                  	$clientCompany = getClientCompanyNameById($projectDetail['client_id']);
								  	$location = getImplodeProjectDetailsById($projectDetail['ID']);?>
					                <tr>
					                  <td><strong><a href="single-project-detail.php?i=<?php echo $projectDetail['ID'];?>&s=2"><?php echo $projectDetail['ID'];?></a></strong></td>
					                  <td><a href="single-project-detail.php?i=<?php echo $projectDetail['ID'];?>&s=2"><?php echo shorter($projectDetail['description'],25);?></td>
					                  <td><?php echo $projectType[0]['type'];?></td>
					                  <td><?php echo $clientCompany[0]['company_name'];?></td>
					                  <td><?php echo $location;?></td>
					                  <td class="text-right"><?php echo $projectDetail['due_date'];?></td>
					                  <td><a href="edit-project.php?i=<?php echo $projectDetail['ID'];?>"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Edit Details</button></td>
					                </tr>
			                	<?php }
		              		}
		              	}
			                
		              } } 
		              if($i == 0){ ?>
		                  <tr><td colspan="7" class="alert alert-info text-center">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <?php echo "No project details found..!"; ?>
		                  </td></tr>
	                <?php }?>
		            </tbody>
		          </table>
		        </div>
		        <!-- table-responsive --> 
		      </div>
		    </div>
		    
		</div>
		<!-- contentpanel --> 
	</div>
	<!-- mainpanel -->


<?php include "footer.php";?>