<?php $currentPage = 'myPayment';
include "header.php";
$projectId = $_GET['i'];?>

	<div class="mainpanel">
		<div class="contentpanel">
		  
		    <div class="panel">
		      <div class="panel-heading">
		        <h4 class="panel-title"><span class="fa fa-cube"></span> My Payment Details</h4>
		        <p><button style="margin-top: 15px;" class="btn btn-danger"><a href="downloads.php?projectReport&projectId=<?php echo $projectId;?>">Download Master Report</a></button></p>

		      </div>
		      <div class="panel-body">
		        <div class="table-responsive">
	          		<table class="table table-striped nomargin">
			            <thead>
			              <tr>
			                <th>Location</th>
			                <th>Project Status</th>
			                <th>File</th>
			              </tr>
			            </thead>
			            <tbody>
			              	<?php $projectDetails = getSubProjectDetailsByProjectId($projectId);
				            foreach($projectDetails as $projectDetail){
				            	$location = getLocationByLocationId($projectDetail['location_id']); ?>
				            	<tr>
					                <td><?php echo $location[0]['location'];?></td>
					                <td><?php if($projectDetail['project_status'] == 0){
					                		echo '<span class="label label-danger">PENDING</span>';
					                	} else {
					                		echo '<span class="label label-success">COMPLETED</span>';
					                	}?>
					                </td>	
					                <td>
					                	<a href="downloads.php?final_form=<?php echo $projectDetail['final_form'];?>"><i class="fa fa-download" aria-hidden="true"></i></a>
				                	</td>					                
				              	</tr>
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