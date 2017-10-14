<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Clients</h4>
      </div>
      <div class="clearfix"></div>
      <form role="form" method="post" enctype="multipart/form-data">
	      <div class="modal-body">
      		  <div class="form-group">
			    <label for="company_name">Company Name <span class="text-danger">*</span></label>
			    <input type="text" required="required" class="form-control" name="company_name">
			  </div>
			  <div class="form-group">
			    <label for="service_tax_number">Service Tax Number <span class="text-danger">*</span></label>
			    <input type="text" required="required" class="form-control" name="service_tax_number">
			  </div>
			  <div class="form-group">
			    <label for="TAN">TAN <span class="text-danger">*</span></label>
			    <input type="text" required="required" class="form-control" name="TAN">
			  </div>
			  <div class="form-group">
			    <label for="PAN">PAN <span class="text-danger">*</span></label>
			    <input type="text" required="required" class="form-control" name="PAN">
			  </div>
			  <div class="form-group">
			    <label for="phone">Phone <span class="text-danger">*</span></label>
			    <input type="text" required="required" class="form-control" name="phone">
			  </div>
			  <div class="form-group">
			    <label for="email">Email address <span class="text-danger">*</span></label>
			    <input type="email" required="required" class="form-control" name="email">
			  </div>
			  <div class="form-group">
			    <label for="website">Website <span class="text-danger">*</span></label>
			    <input type="text" required="required" class="form-control" name="website">
			  </div>
			  <div class="form-group">
			    <label for="contact_person">Contact Person <span class="text-danger">*</span></label>
			    <input type="text" required="required" class="form-control" name="contact_person">
			  </div>
			<div class="form-group">
            	<label>Address <span class="text-danger">*</span></label>
            	<input type="text" name="location" class="form-control map-address" required value="<?php echo $profileData['location'];?>">
            	<button class="btn btn-success btn-quirk btn-wide mr5 locate-address">Locate</button>
          	</div> 
          	<div id="locate-map" class="locate-map"></div>
          	<div class="form-group">
              <input type="hidden" name="latitude">
              <input type="hidden" name="longitude">
          	</div>
			<div class="form-group">
				<label for="logo">Logo:</label>
			  	<input type="file" name="fileToUpload">
			</div>
		  </div>
		  <div class="clearfix"></div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <input type="submit" name="addClient" class="btn btn-primary" value="Save changes">
	      </div>
      </form>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
  <script type="text/javascript">initialize();</script>