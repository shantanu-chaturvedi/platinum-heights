<?php $currentPage = 'myPayment';
include "header.php";?>

	<div class="mainpanel">
		<div class="contentpanel">
		  
		    <div class="panel">
		      <div class="panel-heading">
		        <h4 class="panel-title"><span class="fa fa-cube"></span> My Payment Details</h4>
		        <!--<p>Lorem ipsum dolor sit amet, inani impetus consequat cu pro, solum melius vix ei. Pri eros noluisse euripidis no, te regione omittam reprimique vis.</p>-->
		      </div>
		      <div class="panel-body">
		        <div class="table-responsive">
		        	<?php if($_SESSION['logged_in_user_role'] == 2){?>
			          	<table class="table table-striped nomargin">
				            <thead>
				              <tr>
				                <th class="text-center">#</th>
				                <th>Project</th>
				                <th>Project Status</th>
				                <th>Due Date</th>
				                <th>Paid</th>
				                <th>Service Tax</th>
				                <th>TDS</th>
				                <th>Net Amount</th>
				                <th>Payment Details</th>
				                <th>Paid On</th>
				              </tr>
				            </thead>
				            <tbody>
				              	<?php $projectDetails = getMyAllProjectDetails();
				              	if(empty($projectDetails)){ ?>
				              		<tr><td colspan="8" class="alert alert-info text-center">
					                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					                    <?php echo "No details found..!"; ?>
					                </td></tr>
				              	<?php } else {
						            foreach($projectDetails as $projectDetail){
						            	$projectType =  getProjectTypeById($projectDetail['project_type_id']); ?>
						            	<tr>
							                <td class="text-center"><?php echo $projectDetail['subprojectid'];?></td>
							                <td><?php echo $projectType[0]['type'];?></td>
							                <td><?php if($projectDetail['request_status'] == 0){
							                		echo "<span class='label label-warning'>Project not accepted yet</span>";
							                	}else if($projectDetail['request_status'] == 2){
							                		echo "<span class='label label-danger'>Project Rejected by you</span>";
							                	}else if($projectDetail['request_status'] == 4){
							                		echo "<span class='label label-danger'>Project Assigned to other</span>";
							                	}else if($projectDetail['request_status'] == 1){
							                		if($projectDetail['project_status'] == 0){
							                			echo "<span class='label label-primary'>Project is in-progress</span>";
						                			}else if($projectDetail['project_status'] == 1){
							                			echo "<span class='label label-success'>Project Completed</span>";
						                			}
							                	}?>
							                </td>
							                <td><?php echo $projectDetail['due_date'];?></td>
							                <?php if($projectDetail['payment'] == 0){ ?>
							                	<td><span class="label label-danger">PENDING</span></td>
							                	<td>-</td>
							                	<td>-</td>
							                	<td>-</td>
							                	<td>-</td>
							                	<td>-</td>
						                	<?php }else { ?>
						                		<td><span class="label label-success">PAID</span></td>
						                		<td><?php echo $projectDetail['service_tax'];?></td>
								                <td><?php echo $projectDetail['tds'];?></td>
								                <td><?php echo $projectDetail['net_amount'];?></td>
								                <td><?php echo $projectDetail['payment_detail'];?></td>
								                <td><?php $date=date_create($projectDetail['paid_on']);
													echo date_format($date,"d M, Y");?></td>
						                	<?php }?>
						              	</tr>
						            <?php }
					            } ?>
				            </tbody>
			          	</table>
		          	<?php } else if($_SESSION['logged_in_user_role'] == 3){ ?>
		          		<table class="table table-striped nomargin">
				            <thead>
				              <tr>
				                <th class="text-center">#</th>
				                <th>Project</th>
				                <th>Project Status</th>
				                <th>Payment Status</th>
				                <th>Files</th>
				                <th>Fee</th>
				                <th>Paid On</th>
				                <th>Payment Details</th>
				              </tr>
				            </thead>
				            <tbody>
				              	<?php $clientDetails = getClientPaymentReport();
				              	if(empty($clientDetails)){ ?>
				              		<tr><td colspan="8" class="alert alert-info text-center">
					                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					                    <?php echo "No details found..!"; ?>
					                </td></tr>
				              	<?php } else {
						            foreach($clientDetails as $clientDetail){
						            	$projectType =  getProjectTypeById($clientDetail['project_type_id']); ?>
						            	<tr>
							                <td class="text-center"><a href="my-single-payment-details.php?i=<?php echo $clientDetail['ID'];?>"><?php echo $clientDetail['ID'];?></a></td>
							                <td><a href="my-single-payment-details.php?i=<?php echo $clientDetail['ID'];?>"><?php echo $projectType[0]['type']; ?></a></td>
							                <td><?php if($clientDetail['final_project_status'] == 0){
							                		echo '<span class="label label-danger">PENDING</span>';
							                	} else {
							                		echo '<span class="label label-success">COMPLETED</span>';
							                	}?>
							                </td>
							                <td><?php if($clientDetail['payment'] == 0){
							                		echo '<span class="label label-danger">PENDING</span>';
							                	} else {
							                		echo '<span class="label label-success">COMPLETED</span>';
							                	}?>
							                </td>
							                <td><a href="my-single-payment-details.php?i=<?php echo $clientDetail['ID'];?>"><?php echo 'Master Report';?></a></td>
							                <td><?php echo $clientDetail['net_amount']." Rs.";?></td>
							                <?php if($clientDetail['payment'] == 0){?>
								                <td><?php echo '-'; ?></td>
								                <td><?php echo '-'; ?></td>
							                <?php } else { ?>
								                <td>
								                	<?php $date=date_create($clientDetail['paid_on']);
													echo date_format($date,"d M, Y");?>
								                </td>
								                <td><?php echo $clientDetail['payment_details']; ?></td>
							                <?php }?>
						              	</tr>
						            <?php }
					            } ?>
				            </tbody>
			          	</table>
		          	<?php } ?>
		        </div>
		        <!-- table-responsive --> 
		      </div>
		    </div>
		    
		</div>
		<!-- contentpanel --> 
	</div>
	<!-- mainpanel -->

<?php include "footer.php";?>