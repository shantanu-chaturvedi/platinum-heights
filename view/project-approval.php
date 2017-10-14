<?php $parentPage = 'projects';
$currentPage = 'approveProject';
include "header.php"; ?>

	<div class="mainpanel">
		<div class="contentpanel">
		  
		    <div class="panel">
		      <div class="panel-heading">
		        <h4 class="panel-title"><span class="fa fa-cube"></span> Projects Awaiting Approval</h4>
		        <p>Below are the projects that are marked completed by CA Partners. Please review and approve/reject.</p>
		      </div>
		      <div class="panel-body">
		        <div class="table-responsive">
		          <table class="table table-striped nomargin">
		            <thead>
		              <tr>
		                <th class="text-center">#</th>
		                <th>Partner</th>
		                <th>Project</th>
		                <th>Due Date</th>
		                <th>Download Form</th>
		                <th>Action</th>
		              </tr>
		            </thead>
		            <tbody>
		              	<?php $projectDetails = getProjectDetailsForFinalApproval();
		              	if(empty($projectDetails)){ ?>
		              		<tr><td colspan="6" class="alert alert-info text-center">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <?php echo "No project for approval..!"; ?>
		                  </td></tr>
		              	<?php }else{
		              		foreach($projectDetails as $projectDetail){
								$location = getLocationByLocationId($projectDetail['location_id']);
								$partnerInfos = getNameById('tbl_partners',$projectDetail['partner_id']);
								$projectType =  getProjectTypeById($projectDetail['project_type_id']);
								$clientCompany = getClientCompanyNameById($projectDetail['client_id']);?>
				                <tr>
				                  	<td><?php echo $projectDetail['subprojectid'];?></strong></td>
				                  	<td>
				                  		<strong><?php echo $partnerInfos[0]['name']?></strong>
				                  		<p><?php echo $location[0]['location'];?></p>
			                  		</td>
				                  	<td>
				                  		<strong><?php echo $clientCompany[0]['company_name'];?></strong>
				                  		<p><?php echo $projectType[0]['type'];?></p>
			                  		</td>
				                  	<?php $due_date=date_create($projectDetail['due_date']);?>
				                  	<td><?php echo date_format($due_date,"l, F d, Y");?></td>
				                  	<td><a href="downloads.php?final_form=<?php echo $projectDetail['final_form'];?>");"><?php echo $projectDetail['final_form'];?></a></td>
				                  	<td>
				                  		<a id="approveProject"  href="#" onClick="subprojectApproval(1,<?php echo $projectDetail['subprojectid'];?>,<?php echo $projectDetail['ID'];?>);"><button class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></button></a>
										<a id="rejectProject"  href="#" onClick="subprojectApproval(2,<?php echo $projectDetail['subprojectid'];?>,<?php echo $projectDetail['ID'];?>);"><button class="btn btn-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button></a>
									</td>
				                </tr>
			              	<?php }
		              	}?>
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