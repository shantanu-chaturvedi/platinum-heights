<?php $parentPage = 'members';
$currentPage = 'view-member';
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
		        <div class="table-responsive">
		          <table class="table table-striped nomargin display nowrap" id="members">
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
		                <th>Action</th>
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
		                  <td><button class="btn btn-primary btn-xs"><a href="edit-member.php?id=<?php echo $memberDetail['id'];?>"><i class="fa fa-pencil-square-o"></i></a></button>
		                  <button class="btn btn-danger btn-xs"<a href="#" onclick='deleteMember(<?php echo $memberDetail['id']; ?>);'><i class="fa fa-trash"></i></a></button></td>
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

	<div class="modal bounceIn animated edit-member-form"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Member Details</h4>
      </div>
      <div class="clearfix"></div>
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
            <label for="name"> Name <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="name">
          </div>
          <div class="form-group">
            <label for="society">Society <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="society">
          </div>
          <div class="form-group">
            <label for="flat_number">Flat Number <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="flat_number">
          </div>
          <div class="form-group">
            <label for="dob">Date of Birth <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="dob">
          </div>
          <div class="form-group">
            <label for="doa">>Date of Anniversary <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="doa">
          </div>
          <div class="form-group">
            <label for="blood_group">Blood Group <span class="text-danger">*</span></label>
            <input type="text" readonly required="required" class="form-control" name="blood_group">
          </div>
          <div class="form-group">
            <label for="telephone_number">Telephone Number <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="telephone_number">
          </div>
          <div class="form-group">
            <label for="emergency_number">Emergency Number <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="emergency_number">
          </div>
          <div class="form-group">
            <label for="email">Email Address <span class="text-danger">*</span></label>
            <input type="email" required="required" class="form-control" name="email">
          </div>
          <div class="form-group">
          	 <select id="select5" class="form-control" name="role" style="width: 100%" data-placeholder="Select Role">
					<option value="">&nbsp;</option>
					<option value="1">Member</option>
					<option value="2">Guest</option>
				</select>
          </div>
        
        <input type="hidden" name="memberId">
        </div>
        <div class="clearfix"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" name="editMember" class="btn btn-primary" value="Save changes">
          </div>
        </form>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
  </div>
	<?php include "footer.php";?>