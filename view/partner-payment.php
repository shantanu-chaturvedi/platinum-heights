<?php $parentPage = 'payment';
$currentPage = 'partner-payment';
include "header.php";?>

<?php if(checkCapabilities("view partner payment listing") == 1){ ?>

	<div class="mainpanel">
		<div class="contentpanel">
		  
		    <div class="panel">
		      <div class="panel-heading">
		        <h4 class="panel-title"><span class="fa fa-cube"></span> Partners Payment</h4>
		        <p>Select a project to view the details of payment.</p>
		      </div>
		      <div class="panel-body">
		        <div class="table-responsive">
		        	<form method="POST">
		                <select id="select1" class="form-control selectProjectForPayment" name="client_id" style="width: 100%" data-placeholder="Select Project">
		                  <option value="">&nbsp;</option>
		                  <?php $projectDetails = getAllProjectDetails();
			              foreach($projectDetails as $projectDetail){
			                if($projectDetail['final_project_status'] == 1){ 
			                	$clientCompany = getClientCompanyNameById($projectDetail['client_id']);?>
			                	<option value="<?php echo $projectDetail['ID'];?>"><?php echo $clientCompany[0]['company_name'];?></option>
			               	<?php } } ?>
		                </select>
		        	</form>
		        	<br clear="all">
					<br clear="all">

		          	<table class="table table-striped nomargin paymentTable"></table>
		        </div>
		        <!-- table-responsive --> 
		      </div>
		    </div>
		    
		</div>
		<!-- contentpanel --> 
	</div>
	<!-- mainpanel -->

<?php }?>

	<div class="modal bounceIn animated payment-partner-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
				            <label for="tds">TDS <span class="text-danger">*</span></label>
				            <input type="text" required="required" class="form-control" name="tds">
				        </div>
				        <div class="form-group">
				            <label for="service_tax">Service Tax <span class="text-danger">*</span></label>
				            <input type="text" required="required" class="form-control" name="service_tax">
				        </div>
				        <div class="form-group">
				            <label for="net_amount">Net Amount <span class="text-danger">*</span></label>
				            <input type="text" required="required" class="form-control" name="net_amount">
				        </div>
				        <input type="hidden" id="subproject_id" name="subproject_id">
				        <input type="hidden" id="partner_id" name="partner_id">
		        	</div>
			        <div class="clearfix"></div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			            <input type="submit" name="payPartner" class="btn btn-primary" value="Save changes">
			        </div>
		        </form>
		    </div><!-- modal-content -->
	  </div><!-- modal-dialog -->
  </div>


<?php include "footer.php";?>