<?php $currentPage = 'meeting';
include 'header.php';?>

<div class="mainpanel">
<div class="contentpanel">
      
      <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title"><span class="fa fa-pencil-square-o"></span> &nbsp; Add New Meeting</h4>
        </div>
        <div class="panel-body">
        	<form method="POST">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Date</strong> </label>
	          <input type="text" name="meeting_date" class="form-control" id="datepicker-dob">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Time</strong> </label>
	          <input type="text" name="meeting_time" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Venue</strong> </label>
	          <input type="text" name="venue" class="form-control">

	          <br clear="all" />
	          <label class="control-label center-block"><strong>Notes</strong> </label>
	          <textarea class="form-control" name="notes"></textarea>
	          <br clear="all" />
	          </div>
	            <br clear="all" />
	            <p><button type="submit" name="addMeeting" class="btn btn-default btn-quirk pull-right">Submit & Download</button></p>
          </form>
        </div>
      </div>
    </div>

<?php include 'footer.php';?>