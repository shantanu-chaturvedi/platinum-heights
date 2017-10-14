<?php $parentPage = 'report';
$currentPage = 'members';
include "header.php";
?>
	<div class="mainpanel">
		<div class="contentpanel">

		    <div class="panel">
		      <div class="panel-heading">
		      

		        <h4 class="panel-title"><span class="fa fa-cube"></span> Member Details </h4>
		        <!--<p>Lorem ipsum dolor sit amet, inani impetus consequat cu pro, solum melius vix ei. Pri eros noluisse euripidis no, te regione omittam reprimique vis.</p>-->
		      </div>
		      <div class="panel-body">
		      	<a class='dt-button' href='functions.php?memberSheetdownload'><span>PDF</span></a>
		        <div class="table-responsive">
		          <table class="table table-striped nomargin display nowrap" id="example">
		            <thead>
		              <tr>
		                <th class="text-center">#</th>
		                <th>Name</th>
		                <th>Society</th>
		                <th>Flat Number</th>
		                <th>Date of Birth</th>
		                <th>Date of Anniversary</th>
		                <th>Blood Group</th>
		                <th>Telephone Number</th>
		                <th>Emergency Number</th>
		                <th>Email Address</th>
		                <th>Role</th>
		              </tr>
		            </thead>
		            <tbody>
		              <?php $memberDetails = getMemberData();
		              $i = 1;
		              foreach($memberDetails as $memberDetail){ ?>
		                <tr>
		                  <td><strong><?php echo $i; ?></strong></td>
		                  <td><?php echo $memberDetail['name'];?></td>
		                  <td><?php if($memberDetail['society'] == ''){ echo '-'; }else{ echo $memberDetail['society']; }?></td>
		                  <td><?php echo $memberDetail['flat_no'];?></td>
		                  <td><?php echo $memberDetail['dob'];?></td>
		                  <td><?php echo $memberDetail['doa'];?></td>
		                  <td><?php echo $memberDetail['blood_group'];?></td>
		                  <td><?php echo $memberDetail['telephone_no'];?></td>
		                  <td><?php echo $memberDetail['emergency_no'];?></td>
		                  <td><?php echo $memberDetail['email_address'];?></td>
		                  <td><?php if($memberDetail['role'] == 1){ echo "Member"; }else {echo "Guest";}?></td>
		                </tr>
		              <?php $i++; } 
		              if($i == 0){ ?>
		                  <tr><td colspan="7" class="alert alert-info text-center">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <?php echo "No Member Detail..!"; ?>
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