<?php include '../controller/functions.php';?>

<table class="table table-striped nomargin paymentTable">
	<thead>
	  <tr>
	    <th class="text-center">#</th>
	    <th>Partner</th>
	    <th>Location</th>
	    <th>Payment</th>
	    <th class="text-center">Pay</th>
	    <th class="text-center">Payment Details</th>
	    <th class="text-center">TDS</th>
	    <th class="text-center">Service Tax</th>
	    <th class="text-center">Net Amount</th>
	  </tr>
	</thead>
	<tbody>
	  <?php $projectDetails = getProjectDetailsForPayment($_POST['projectId']);
	  foreach($projectDetails as $projectDetail){
		  $location = getImplodeProjectDetailsById($projectDetail['project_id']);
		  $partnerInfos = getNameById('tbl_partners',$projectDetail['partner_id']);?>
	    <tr>
	      	<td><strong><?php echo $projectDetail['subproject_id'];?></strong></td>
	      	<td><?php echo $partnerInfos[0]['name']?></td>
	      	<td><?php echo $location;?></td>
	      	<td><?php echo "Rs. ".$projectDetail['partner_payment'];?></td>
	      	<?php if($projectDetail['payment'] == 1){ ?>
	          	<td><span class="label label-success">PAID</span></td>
	          	<td class="text-center"><?php echo $projectDetail['payment_detail'];?></td>
	          	<td class="text-center"><?php echo "Rs. ".$projectDetail['tds'];?></td>
	          	<td class="text-center"><?php echo "Rs. ".$projectDetail['service_tax'];?></td>
	          	<td class="text-center"><?php echo "Rs. ".$projectDetail['net_amount'];?></td>
	        <?php } else{?>
	        	<td class="text-center">
	        		<?php if(checkCapabilities("pay to partner") == 1){ ?>
	        		<button class="btn btn-primary btn-xs" onClick="payPartnerPayment(<?php echo $projectDetail['subproject_id'];?>,<?php echo $projectDetail['partner_id'];?>)"> PAY </button>
	        		<?php } else {?>
	        			<span class="label label-danger">DUE</span>
	        		<?php }?>
	        	</td>
	          	<td class="text-center"> - </td>
	          	<td class="text-center"> - </td>
	          	<td class="text-center"> - </td>
	          	<td class="text-center"> - </td>
	        <?php }?>
	    </tr>
	  <?php }?>
	</tbody>
</table>