<?php $parentPage = 'projects';
$currentPage = 'editProject';
include "header.php";

if(checkCapabilities("edit project") == 1){ 

	$projectId = $_GET['i'];
	$_SESSION['project_id'] = $projectId;
	$projectDetails = getProjectDetailById($projectId);

	?>

<div class="mainpanel">

	<div class="contentpanel">
	  	<div class="row">
		    <div class="col-md-12">

		      <div class="panel">
		        <div class="panel-heading">
		          <h4 class="panel-title mb5"><span class="fa fa-pencil-square-o"> </span> Edit Project</h4>
		          <!--<p class="mb15">Lorem ipsum dolor sit amet, inani impetus consequat cu pro, solum melius vix ei. Pri eros noluisse euripidis no, te regione omittam reprimique vis. </p>-->
		        </div>
		        <div class="panel-body">
		          	<div id="wizard" class="swMain">

		          		<ul>
				          	<li>
				          		<a href="#step-1">
					                <span class="stepDesc">
					                   <small>1. Provide Project Details</small>
					                </span>
				           		</a>
			           		</li>
				          	<li>
				          		<a href="#step-2">
					                <span class="stepDesc">
					                   <small>2. Create Questionnaire</small>
					                </span>
				            	</a>
			            	</li>
				          	<li>
				          		<a href="#step-3">
					                <span class="stepDesc">
					                   <small>3. Find CA Partner</small>
					                </span>                   
				             	</a>
			             	</li>
			             	<li>
				          		<a href="#step-4">
					                <span class="stepDesc">
					                   <small>4. Payment</small>
					                </span>                   
				             	</a>
			             	</li>
				          	<li><a href="#step-5">
				                <span class="stepDesc">
				                   <small>5. Assign Project</small>
				                </span>                   
				            </a></li>
				        </ul>

			            <div id="step-1">
				            <div class="form-group">
				            	<form id="projectCreate1" method="POST" enctype='multipart/form-data'>
					              	<div class="col-sm-4 col-md-6 col-lg-2">

					                  	<label class="control-label center-block"><strong>Project Type</strong></label>
					                  	<select id="select5" class="form-control" name="project_type_id" style="width: 100%" data-placeholder="Select Project Type">
						                  <option value="">&nbsp;</option>
						                  <?php $datas = getProjectType();
								          foreach ($datas as $data){?>
								          	<option <?php if($data['ID'] == $projectDetails[0]['project_type_id']) { echo "selected=selected"; }?> value="<?php echo $data['ID'];?>"><?php echo $data['type'];?></option>
								          <?php }?>
						                </select>
					                  	<p class="dev-hint pull-right"><span class="fa fa-cogs"></span> Dev Hint: Pre-defind list of project types.</p>

						                <br clear="all">
						                <br clear="all">                  
					                	<label class="control-label center-block"><strong>Client</strong> </label>
						                <select id="select1" class="form-control clientCompanyName" name="client_id" style="width: 100%" data-placeholder="Search a client">
						                  <option value="">&nbsp;</option>
						                  <?php $datas = getNames('tbl_clients');
								          foreach ($datas as $data){?>
								          	<option <?php if($data['ID'] == $projectDetails[0]['client_id']) { echo "selected=selected"; }?> value="<?php echo $data['ID'];?>"><?php echo $data['company_name'];?></option>
								          <?php }?>
						                </select>
						                <br clear="all">
						                <br clear="all">
						                <?php if(checkCapabilities("add new client") == 1){?>
					                		<p class="pull-right">Not in database? <a href="#" onClick="addNewMember('client');"><span class="fa fa-edit"></span> Add a client</a></p>
				                		<?php }?>

					                	<br clear="all">
					                	<label class="control-label center-block"><strong>Location of Branch / Dealership / Distributership / Frenchise</strong></label>
					                	<?php $exLocations = explode(",",$projectDetails[0]['location_id']);
					                		$locations = getLocationsByClient($projectDetails[0]['client_id']);
					                  		$imLocations = explode("-",$locations);
             								$locationNames = explode(';', $imLocations[0]);
             								$locationIds = explode(';', $imLocations[1]);?>
					                  	<select id="select1" required="" class="form-control clientLocationSelect" name="locations[]" style="width: 100%" data-placeholder="Search location(s)" multiple>
					                  		<option value="">&nbsp;</option>
					                  		<?php $i=0;
					                  		foreach($locationIds as $locationId){ ?>
					                  			<option <?php if(in_array($locationId,$exLocations)){ echo "selected = selected"; } ?> value="<?php echo $locationId; ?>"><?php echo $locationNames[$i]; ?></option>
					                  		<?php $i++; } ?>
					                  	</select>
					                  	<p class="dev-hint pull-right"><span class="fa fa-cogs"></span> Dev Hint: Locations are fetched dynamically from client's information database.</p>

						                <br clear="all">
						                <label class="control-label center-block"><strong>Project Timeline</strong></label>
						                <br clear="all">
						                <div class="input-group">
						                  <input type="text" class="form-control" placeholder="Start Date" name="start_date" id="datepicker-start-date" value="<?php echo $projectDetails[0]['start_date'];?>">
						                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						                  <input type="text" class="form-control" placeholder="Due Date" name="due_date" id="datepicker-due-date" value="<?php echo $projectDetails[0]['due_date'];?>">
						                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
					                    </div>
						                <br clear="all">

						                <?php if(checkCapabilities("assign project") == 1){?>
							                <br clear="all">
						                	<label class="control-label center-block"><strong>Assigned To</strong></label>
						                  	<select id="select1" class="form-control" name="assigned_to[]" style="width: 100%" data-placeholder="Select Admin" multiple>
							                  	<?php $adminNames = getNames('tbl_admin');
							                  	$expAdmins = explode(",",$projectDetails[0]['assigned_to']); 
							                  	foreach($adminNames as $adminName){?>
							                    	<option <?php if(in_array($adminName['ID'], $expAdmins)) { echo "selected=selected"; }?> value="<?php echo $adminName['ID'];?>"><?php echo $adminName['name']?></option>
							                    <?php }?>
							                </select>
						                <?php }?>

					                	<br clear="all">
						                <label class="control-label center-block"><strong>Attach File(s)</strong></label>
			  							<input type="file" name="attach_file[]" multiple>
					                  	<p class="dev-hint pull-right"><span class="fa fa-cogs"></span> Dev Hint: File types and size can be restricted as required.</p>

					              	</div>

					              	<div class="col-sm-4 col-md-6 col-lg-2">

					                  	<label class="control-label center-block"><strong>Description</strong></label>
					                	<textarea class="form-control" required="" name="description" rows="7" placeholder=""><?php echo $projectDetails[0]['description'];?></textarea>

					              		<br clear="all">
					                	<label class="control-label center-block"><strong>Include Help Videos</strong></label>
					                  	<select id="select1" name="videos_id[]" class="form-control helpVideos" style="width: 100%" data-placeholder="Select videos" multiple>
						                  	<option value="">&nbsp;</option>
					                	</select>
					                  	<p class="dev-hint pull-right"><span class="fa fa-cogs"></span> Dev Hint: List of active videos from Video Library.</p>

					                  	<br clear="all">
					                	<label class="control-label center-block"><strong>Reminder 1</strong></label>
					                  	<select id="select5" class="form-control" name="reminder_1" style="width: 100%" data-placeholder="Select Project Type">
						                  <option <?php if(in_array('6', $projectDetails[0]['reminder_1'])) { echo "selected=selected"; }?> value="6">1 week before due date</option>
						                  <option <?php if(in_array('2', $projectDetails[0]['reminder_1'])) { echo "selected=selected"; }?> value="2">2 days before due date</option>
						                  <option <?php if(in_array('1', $projectDetails[0]['reminder_1'])) { echo "selected=selected"; }?> value="1">1 day before due date</option>
						                  <option <?php if(in_array('0', $projectDetails[0]['reminder_1'])) { echo "selected=selected"; }?> value="0">Don't remind</option>
						                </select>

					                	<br clear="all">
					                	<label class="control-label center-block"><strong>Reminder 2</strong></label>
					                  	<select id="select5" class="form-control" name="reminder_2" style="width: 100%" data-placeholder="Select Project Type">
						                  <option <?php if(in_array('6', $projectDetails[0]['reminder_2'])) { echo "selected=selected"; }?> value="6">1 week before due date</option>
						                  <option <?php if(in_array('2', $projectDetails[0]['reminder_2'])) { echo "selected=selected"; }?> value="2" selected="">2 days before due date</option>
						                  <option <?php if(in_array('1', $projectDetails[0]['reminder_2'])) { echo "selected=selected"; }?> value="1">1 day before due date</option>
						                  <option <?php if(in_array('0', $projectDetails[0]['reminder_2'])) { echo "selected=selected"; }?> value="0">Don't remind</option>
						                </select>

						                <input type="hidden" name="project_id" value="<?php echo $projectId; ?>">
						                
					              	</div>
					              	<br clear="all">
				              	</form>
				            </div>
			            </div>

			            <div id="step-2">
				            <div class="form-group">
				              	<div class="col-sm-8 col-md-12 col-lg-4">

				                    <div id="sjfb-wrap">
									    <div class="alert hide">
									        <h2>Success! Form saved.</h2>
									        <p>Here is what your saved form will look like in your database:</p>
									        <textarea></textarea>
									    </div>

									    <?php if(in_array('location_id-0', $_SESSION['changes'])){?>
								    		<div class="alert alert-info">
								                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								                This is to remind you that,<strong>You recently made some changes in locations so don't forget to add/remove inventory data from your comparision grid.</strong>
								            </div>
								    	<?php } 
								    	$grid = 0;?>

									    <div class="col-sm-4 col-md-10 col-lg-2" id="form-builder-box">
									    	
									    	<form id="sjfb" novalidate>
										        <div id="form-fields" class="ui-sortable">
										        	<?php $formDatas = json_decode($projectDetails[0]['form_data'],true);
										        	foreach($formDatas as $formData){
										        		if($formData['type'] == 'text'){
										        			$title = "Short Answer";
										        		}elseif ($formData['type'] == 'textarea') {
										        			$title = "Paragraph";
										        		}elseif ($formData['type'] == 'select') {
										        			$title = "Select Box";
										        		}elseif ($formData['type'] == 'radio') {
										        			$title = "Single Choice";
										        		}elseif ($formData['type'] == 'checkbox') {
										        			$title = "Multiple Choice";
										        		}elseif ($formData['type'] == 'grid') {
										        			$title = "Comparision Grid";
										        		} ?>
										        		<div class="field ui-sortable-handle" data-type="<?php echo $formData['type']; ?>" style="display: block;">
										        			<?php if($formData['type'] == 'grid'){ 
										        				$grid=1;?>
										        				<button type="button" class="delete">Delete Field</button>
											        			<h3><?php echo $title; ?></h3>
											        			<a href="downloads.php?dbinventoryfile&n=<?php echo $projectDetails[0]['inventory_file'] ?>">Download New Inventory File</a>
											        			<input type="file" id="projectCreate2" name="inventory_file">
										        			<?php } else { ?>
										        				<button type="button" class="delete">Delete Field</button>
											        			<h3><?php echo $title; ?></h3>
											        			<label>Question:<input type="text" class="field-label" value="<?php echo $formData['label']; ?>"></label>
											        			<label>Required? <input class="toggle-required" <?php if($formData['req'] == 1){ echo "checked=checked";}?> type="checkbox"></label>
											        			<?php if(($formData['type'] == 'select') || ($formData['type'] == 'radio') || ($formData['type'] == 'checkbox')){ ?>
											        				<div class="choices">
											        					<ul class="ui-sortable">
											        						<?php foreach($formData['choices'] as $choice){ ?>
												        						<li style="display: list-item;" class="ui-sortable-handle">
												        							<label>Choice: <input type="text" class="choice-label" value="<?php echo $choice['label']; ?>"></label>
												        							<label>Selected? <input class="toggle-selected" type="checkbox" <?php if($choice['sel'] == 1){ echo "checked=checked";}?>></label>
												        							<button type="button" class="delete">Delete Choice</button>
											        							</li>
										        							<?php }?>
									        							</ul>
									        							<button type="button" class="add-choice">Add Choice</button></div>
											        			<?php } 
										        			}?>
									        			</div>
										        	<?php }?>
										        </div>
										    </form>
									    </div>
									    <div class="col-sm-4 col-md-2 col-lg-2">
							                <div class="table-responsive">
							                	<div class="add-wrap">
								                  	<ul id="add-field">
								                  		<li>FORM CONTROLS</li>
											            <li><a id="add-text" data-type="text" href="#" title="Short Answer"><span class="fa fa-text-height"></span></a></li>
											            <li><a id="add-textarea" data-type="textarea" href="#" title="Paragraph"><span class="fa fa-align-left"></span></a></li>
											            <li><a id="add-select" data-type="select" href="#" title="Select Box"><span class="fa fa-list-alt"></span></a></li>
											            <li><a id="add-radio" data-type="radio" href="#" title="Single Choice"><span class="fa fa-dot-circle-o"></span></a></li>
											            <li><a id="add-checkbox" data-type="checkbox" href="#" title="Multiple Choice"><span class="fa fa-check-square-o"></span></a></li>
											            <li>
												            <?php if($grid == 1){?>
												            	<span class="fa fa-table"></span>
											            	<?php }else{?>
											            		<a id="add-comparision-grid" data-type="grid" href="#" title="Comparision Grid"><span class="fa fa-table"></span></a>
											            	<?php }?>
										            	</li>
											        </ul>
								                </div>
							                </div>
							            </div>

									</div>
									<?php if($grid == 0){?>
										<br clear="all">
						                <div id="comparision-grid-div">
							                <a href="downloads.php?inventory">Download CSV</a>

							                <br clear="all">
							                <label class="control-label center-block"><strong>Attachments</strong> (Multiple files supported)</label>
					  						<form id="projectCreate2" method="POST" enctype='multipart/form-data'><input type="file" name="inventory_file"></form>
				  						</div>
			  						<?php }?>
				            	</div>
				              	<br clear="all">
				            </div>
			            </div>

			            <div id="step-3">
			            	<div id="tempDiv"></div>
				            <div>
				              	<div class="form-group">
				                	<div id="project-create-map-div" class="col-sm-4 col-md-9 col-lg-2">
				                  		<div></div>
			        					<input type="hidden" id="projectLocationIds">
			        					<input type="hidden" id="noOfMapLoop">
				                  	</div>
				                	<div id="project-details-step-3" class="col-sm-4 col-md-3 col-lg-2"> </div>
				                	<br clear="all">
				              	</div>
				            </div>
			            </div>

			            <div id="step-4">
			            	<div id="tempDiv1"></div>
				            <div class="form-group">
				              	<div class="col-sm-12 col-md-12 col-lg-12" id="project-create-step-4">
				              		<input type="text" id="selectedPartnerDetails">
				              		<table class="table table-striped nomargin">
				              			<thead>
				              				<tr>
				              					<th>#</th>
				              					<th>Selected CA Partners</th>
				              					<th>Payment</th>
				              				</tr>
				              			</thead>
				              			<tbody></tbody>
				              		</table>
				              	</div>
				              	<br clear="all">
				            </div>
			          	</div>

			          	<div id="step-5">
				            <div class="form-group">
				              	<div class="col-sm-4 col-md-6 col-lg-2" id="project-create-step-5">

				                	<label class="control-label center-block"><strong>Project Title</strong></label>
				                	<input type="text" id="projectTitle" class="form-control input-lg" disabled>

				                	<br clear="all">
				                	<label class="control-label center-block"><strong>Client</strong></label>
				                	<input type="text" id="companyName" class="form-control" disabled>
				                
				                	<br clear="all">
				                	<label class="control-label center-block"><strong>Project Timeline</strong></label>
				                
				                	<br clear="all">
					                <div class="input-group">
					                  	<input type="text" id="startDate" class="form-control" disabled>
					                  	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
					              	</div>

				                	<br clear="all">
					                <div class="input-group">
					                  	<input type="text" id="dueDate" class="form-control" disabled>
					                  	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
					              	</div>
				              	</div>
				              	<div class="col-sm-4 col-md-6 col-lg-2">
				                	<label class="control-label center-block"><strong>Selected Members</strong></label>
				                		<div class="table-responsive">
				                  			<table class="table table-striped nomargin" id="project-create-step-5-table">
				                    			<tbody></tbody>
				                  			</table>
				                		</div>
				              		</div>
				              		<br clear="all">
				            	</div>
				          	</div>
			          	</div>

		        	</div>
		    	</div>
		    	<!-- col-md-6 --> 
			</div>
	    <!-- row --> 
		</div>
	<!-- contentpanel --> 
	</div>

<!-- mainpanel -->
</div>

<?php }?>

<?php include "footer.php";?>

<!-- Modal -->
<div class="modal bounceIn animated add-member-form"  id="addMemberMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            <div id="add-map" class="map"></div>
            <div class="form-group">
              <input type="hidden" name="latitude">
              <input type="hidden" name="longitude">
            </div>
      <div class="form-group">
        <label for="logo">Logo:</label>
          <input type="file" name="fileToUpload">
      </div>
      <div class="form-group">
        <label for="clent_location">Other Locations:</label>
          <input type="file" name="upload_client_location"/>
          <a href="downloads.php?sampleLocation">Download Sample File</a>
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
  </div>
