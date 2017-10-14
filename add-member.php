<?php $parentPage = 'members';
$currentPage = 'add-member';
include 'header.php';?>

<div class="mainpanel">
<div class="contentpanel">
      
      <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title"><span class="fa fa-pencil-square-o"></span> &nbsp; Add New Member</h4>
        </div>
        <div class="panel-body">
        	<form method="POST" id="addMember">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Name</strong> </label>
	          <input type="text" name="name" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Society</strong> </label>
	          <input type="textarea" name="society" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Flat Number</strong> </label>
	          <input type="text" name="flat_number" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Date of Birth</strong> </label>
	          <input type="text" name="dob" class="form-control" id="datepicker-dob">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Date of Anniversary</strong> </label>
	          <input type="text" name="doa" class="form-control" id="datepicker-doa">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Blood Group</strong> </label>
	          <input type="text" name="blood_group" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Telephone Number</strong> </label>
	          <input type="text" name="telephone_number" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Emergency Number</strong> </label>
	          <input type="text" name="emergency_number" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Email Address</strong> </label>
	          <input type="email" name="email" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Role</strong> </label>
	          <select id="select5" class="form-control" name="role" style="width: 100%" data-placeholder="Select Role">
					<option value="">&nbsp;</option>
					<option value="1">Member</option>
					<option value="2">Guest</option>
				</select>
	          <br clear="all" />
	          </div>
	            <br clear="all" />
	            <p>
	            <button type="submit" name="addMember" class="btn btn-default btn-quirk pull-right">Submit</button>
	          </p>
          </form>
        </div>
      </div>
    </div>

<?php include 'footer.php';?>