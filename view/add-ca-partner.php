<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add CA Patners</h4>
      </div>
      <div class="clearfix"></div>
      <form role="form" method="post" enctype="multipart/form-data">
	      <div class="modal-body">
      		  <div class="form-group">
			    <label for="name">Name <span class="text-danger">*</span></label>
			    <input type="text" required="required" class="form-control" name="name">
			  </div>
			  <div class="form-group">
                <label>Address <span class="text-danger">*</span></label>
                <input type="text" name="location" class="form-control map-address" required >
                <button class="btn btn-success btn-quirk btn-wide mr5 locate-address">Locate</button>
              </div> 
              <div id="add-map" class="map"></div>
              <div class="form-group">
	              <input type="hidden" name="latitude">
	              <input type="hidden" name="longitude">
              </div>
			  <div class="form-group">
			    <label for="email">Email address <span class="text-danger">*</span></label>
			    <input type="email" required="required" class="form-control" name="email">
			  </div>
			  <div class="form-group">
			    <label for="work_number">Phone (Work) <span class="text-danger">*</span></label>
			    <input type="text" required="required" class="form-control" name="work_number">
			  </div>
			   <div class="form-group">
			    <label for="mobile_number">Phone (Mobile) <span class="text-danger">*</span></label>
			    <input type="text" required="required" class="form-control" name="mobile_number">
			  </div>
			  <div class="form-group">
			    <label for="firm_name">Firm Name <span class="text-danger">*</span></label>
			    <input type="text" required="required" class="form-control" name="firm_name">
			  </div>
			  <div class="form-group">
			    <label for="membership_number">Membership Number <span class="text-danger">*</span></label>
			    <input type="text" required="required" class="form-control" name="membership_number">
			  </div>
			  <div class="form-group">
			    <label for="frn_number">FRN Number <span class="text-danger">*</span></label>
			    <input type="text" required="required" class="form-control" name="frn_number">
			  </div>
			  <div class="form-group">
			    <label for="team_size">Team Size <span class="text-danger">*</span></label>
			    <input type="text" required="required" class="form-control" name="team_size">
			  </div>
	  		  <div class="form-group">
			  	<label for="profile_pic">Profile Pic:</label>
			  	<input type="file" name="fileToUpload">
			  </div>
	      </div>
	      <div class="clearfix"></div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <input type="submit" name="addCaPartner" class="btn btn-primary" value="Save changes">
	      </div>
      </form>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
  <script type="text/javascript">initialize();</script>