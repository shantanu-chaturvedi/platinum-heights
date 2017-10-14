<?php $parentPage = 'payment';
$currentPage = 'client-payment';
include "header.php";?>

<?php if(checkCapabilities("view client payment listing") == 1){ ?>

	<div class="mainpanel">
		<div class="contentpanel">
		  
		    <div class="panel">
		      <div class="panel-heading">
		        <h4 class="panel-title"><span class="fa fa-cube"></span> Payment</h4>
		        <p>Lorem ipsum dolor sit amet, inani impetus consequat cu pro, solum melius vix ei. Pri eros noluisse euripidis no, te regione omittam reprimique vis.</p>
		      </div>
		      <div class="panel-body">
		        <div class="table-responsive">
		          <table class="table table-striped nomargin">
		            <thead>
		              <tr>
		                <th class="text-center">#</th>
		                <th>Project</th>
		                <th>Client Name</th>
		                <th>Payment</th>
		                <th>Total Amount</th>
		                <th>OPE</th>
		                <th>Service Tax</th>
		                <th>Net Amount</th>
		                <th>Payment Details</th>
		                <th>Paid On</th>
		              </tr>
		            </thead>
		            <tbody>
		              	<?php $projectDetails = getAllProjectDetails();
		              	foreach($projectDetails as $projectDetail){
		              		$assigned_to = explode(',',$projectDetail['assigned_to']);

			              	if(($projectDetail['client_id'] != 0) && ($projectDetail['final_project_status'] == 1)){
			                  	$projectType =  getProjectTypeById($projectDetail['project_type_id']);
			                  	$clientCompany = getClientCompanyNameById($projectDetail['client_id']);
							  	$location = getImplodeProjectDetailsById($projectDetail['ID']);?>
				                <tr>
				                  	<td><strong><?php echo $projectDetail['ID'];?></strong></td>
				                  	<td><?php echo shorter($projectDetail['description'],25);?></td>
				                  	<td><?php echo $clientCompany[0]['company_name'];?></td>
				                  	<?php if($projectDetail['payment'] == 0){?>
					                  	<td><button class="btn btn-primary btn-xs" onClick="payProjectPayment(<?php echo $projectDetail['ID'];?>)"> PAY </button></td>
					                  	<td><?php echo "-";?></td>
					                  	<td><?php echo "-";?></td>
					                  	<td><?php echo "-";?></td>
					                  	<td><?php echo "-";?></td>
					                  	<td><?php echo "-";?></td>
					                  	<td><?php echo "-";?></td>
			                  		<?php }else{?>
			                  			<td><span class="label label-success">PAID</span></td>
					                  	<td><?php echo $projectDetail['total_amount']." Rs.";?></td>
					                  	<td><?php echo $projectDetail['OPE']." Rs.";?></td>
					                  	<td><?php echo $projectDetail['service_tax']." Rs.";?></td>
					                  	<td><?php echo $projectDetail['net_amount']." Rs.";?></td>
					                  	<td><?php echo $projectDetail['payment_details'];?></td>
					                  	<td>
					                  		<?php $date=date_create($projectDetail['paid_on']);
											echo date_format($date,"d M, Y");?>
										</td>
				                  	<?php }?>
				                </tr>
				            <?php }
		               } ?>
		            </tbody>
		          </table>
		        </div>
		      </div>
		    </div>
		    
		</div>
		<!-- contentpanel --> 
	</div>
	<!-- mainpanel -->

<?php }?>

	<div class="modal bounceIn animated payment-project-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        	<h4 class="modal-title" id="myModalLabel">Payment Details</h4>
		      	</div>
		      	<div class="clearfix"></div>
		        <form role="form" method="post" enctype="multipart/form-data">
		          	<div class="modal-body">
			            <div class="form-group">
				            <label for="payment_detail">Payment Details <span class="text-danger">*</span></label>
				            <input type="text" required="required" class="form-control" name="payment_detail">
				        </div>
				        <div class="form-group">
				            <label for="ope">OPE <span class="text-danger">*</span></label>
				            <input type="text" required="required" class="form-control" name="ope">
				        </div>
				        <div class="form-group">
				            <label for="service_tax">Service Tax <span class="text-danger">*</span></label>
				            <input type="text" required="required" class="form-control" name="service_tax">
				        </div>
				        <div class="form-group">
				            <label for="net_amount">Net Amount <span class="text-danger">*</span></label>
				            <input type="text" required="required" class="form-control" name="net_amount">
				        </div>
				        <input type="hidden" id="project_id" name="project_id">
		        	</div>
			        <div class="clearfix"></div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			            <input type="submit" name="payProject" class="btn btn-primary" value="Save changes">
			        </div>
		        </form>
		    </div><!-- modal-content -->
	  </div><!-- modal-dialog -->
  </div>

<?php include "footer.php";?>