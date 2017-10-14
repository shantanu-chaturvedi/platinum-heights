<?php $parentPage = 'projects';
$currentPage = 'ongoingProject';
include "header.php"; ?>

	<div class="mainpanel">
		<div class="contentpanel">
		  
		    <div class="panel">
		      <div class="panel-heading">
		        <h4 class="panel-title"><span class="fa fa-cube"></span> Projects (Not Completed, In Progress or Rejected)</h4>
		        <!--<p>Lorem ipsum dolor sit amet, inani impetus consequat cu pro, solum melius vix ei. Pri eros noluisse euripidis no, te regione omittam reprimique vis.</p>-->
		      </div>
		      <div class="panel-body">
		        <div class="table-responsive">
		          <table class="table table-striped nomargin">
		            <thead>
		              <tr>
		                <th class="text-center">#</th>
		                <th>Partner</th>
		                <th>Location</th>
		                <th>Status</th>
		                <th>Assigned On</th>
		                <th>Approve/Reject On</th>
		                <th>Completed On</th>
		              </tr>
		            </thead>
		            <tbody>
		              	<?php $projectId = $_GET['i'];
		              	$projectStatus = $_GET['s'];
					    $projectDetails = getSubProjectDetailsByProjectId($projectId);
		              	foreach($projectDetails as $projectDetail){
							$location = getLocationByLocationId($projectDetail['location_id']);
							$partnerInfos = getNameById('tbl_partners',$projectDetail['partner_id']);?>
			                <tr>
			                  <td><strong><?php echo $projectDetail['ID'];?></strong></td>
			                  <td><?php echo $partnerInfos[0]['name']?></td>
			                  <td><?php echo $location[0]['location'];?></td>
			                  <td>
			                    <?php if(($projectDetail['project_status'] == 0) && ($projectDetail['request_status'] == 0)){?>
			                      <span class="label label-primary">Pending to approve</span>
			                    <?php }else if(($projectDetail['project_status'] == 0) && ($projectDetail['request_status'] == 1)){?>
			                      <span class="label label-danger">In Progress</span>
			                    <?php }else if(($projectDetail['project_status'] == 2) && ($projectDetail['request_status'] == 1)){?>
			                      <span class="label label-warning">Not Completed</span>
			                    <?php }else if(($projectDetail['project_status'] == 0) && ($projectDetail['request_status'] == 2)){?>
			                      <span class="label label-default">Rejected</span>
			                    <?php }else if(($projectDetail['project_status'] == 1) && ($projectDetail['request_status'] == 1)){?>
			                      <span class="label label-success">Completed</span>
			                    <?php }?>
			                  </td>
			                  <td>
			                  	<?php $created_at=date_create($projectDetail['created_at']);
			                  	echo date_format($created_at,"l, F d, Y");?>
			                  </td>
			                  <td>
			                  	<?php if($projectDetail['request_date'] == ""){
			                  		echo "-";
			                  	}else{
			                  		$request_date=date_create($projectDetail['request_date']);
			                  		echo date_format($request_date,"l, F d, Y");
			                  	}?>
			                  </td>
			                  <td>
			                  	<?php if($projectDetail['project_date'] == ""){
			                  		echo "-";
			                  	}else{
			                  		$project_date=date_create($projectDetail['project_date']);
			                  		echo date_format($project_date,"l, F d, Y");
			                  	} ?>
			                  </td>
			                </tr>
		              	<?php } ?>
		            </tbody>
		          </table>
		        </div>
		        <!-- table-responsive --> 
		      </div>
		    </div>

		    <div class="panel">
	            <div class="panel-heading">
	              <h4 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Compose Message</h4>
	            </div>
	            <div class="panel-body">
	              	<!--<p><strong>Lorem ipsum dolor sit amet, inani impetus consequat cu pro, solum melius vix ei. Pri eros noluisse euripidis no, te regione omittam reprimique vis.</strong></p>-->

	              	<form role="form" method="post" enctype="multipart/form-data">

		              	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
		              		<br clear="all" />
				          	<input type="text" name="subject" placeholder="Subject" class="form-control">
				          	<br clear="all" />
			                <br clear="all" />
			                <textarea id="wysiwyg" name="message" placeholder="Enter message here..." class="form-control" rows="4"></textarea>
			                <br clear="all" />
			                <input type="checkbox" value="1" name="sendMail">Send this message in Mail
              				<br clear="all" />	
			                <input type="hidden" name="project_id" value="<?php echo $projectId;?>">		              	
		              	</div>

		              	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		              		<br clear="all" />
		              		<select id="select6" name="recipient[]" class="form-control selectAllRecipient" style="width: 100%" data-placeholder="All people working on project..." multiple>
		              		 	<option class="optionGroup" value="0">Select All</option>
		              		 	<?php foreach($projectDetails as $projectDetail){
		              		 		// if($projectDetail['request_status'] == 1){
		              		 			$partnerInfos = getNameById('tbl_partners',$projectDetail['partner_id']); ?>
		              		 			<option class="optionChild" value="<?php echo $projectDetail['ID'].'-'.$projectDetail['partner_id'];?>"><?php echo $partnerInfos[0]['name']?></option>
		              		 	<?php } ?>
		              		</select> 
		              		<br clear="all" />
		              		<select id="select7" name="recipient[]" class="form-control selectAllRecipientNotCompleted" style="width: 100%" data-placeholder="All people who have not completed the project..." multiple>
		              		 	<option class="optionGroup" value="0">Select All</option>
		              		 	<?php foreach($projectDetails as $projectDetail){ 
		              		 		if(($projectDetail['project_status'] == 0) && ($projectDetail['request_status'] == 1)){
		              		 			$partnerInfos = getNameById('tbl_partners',$projectDetail['partner_id']);?>
		              		 			<option class="optionChild" value="<?php echo $projectDetail['ID'].'-'.$projectDetail['partner_id'];?>"><?php echo $partnerInfos[0]['name']?></option>
		              		 	<?php } }?>
		              		</select>
		              		<br clear="all" /> 
			              	<select id="select8" name="recipient[]" class="form-control selectAllRecipientCompleted" style="width: 100%" data-placeholder="All people who have completed the project..." multiple>
		              		 	<option class="optionGroup" value="0">Select All</option>
		              		 	<?php foreach($projectDetails as $projectDetail){ 
		              		 		if(($projectDetail['project_status'] == 1) && ($projectDetail['request_status'] == 1)){
	              		 				$partnerInfos = getNameById('tbl_partners',$projectDetail['partner_id']);?>
		              		 			<option class="optionChild" value="<?php echo $projectDetail['ID'].'-'.$projectDetail['partner_id'];?>"><?php echo $partnerInfos[0]['name']?></option>
		              		 	<?php } }?>
		              		</select> 
		              		<br clear="all" />
	                    </div>

	                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	                    	<br clear="all" />
	                    	<p>
			                  <button type="submit" name="sendProjectMessage" class="btn btn-default btn-quirk pull-right">Send</button>
			                </p>
	                    </div>

                    </form>
	            </div>
	          </div>

		    <div class="panel">
	            <div class="panel-heading">
	              <h4 class="panel-title"><span class="fa fa-history"></span> &nbsp; Project Timeline</h4>
	            </div>
	            
	            <div class="panel-body">
	              <div class="timeline-wrapper">
	                <?php $timelineDates = getProjectTimelineDates($projectId);
	                foreach($timelineDates as $timelineDate){ 
	                  $date1=date_create($timelineDate['created_at']);?>
	                  
	                  <div class="timeline-date"><?php echo date_format($date1,"l, F d, Y");?></div>

	                  <?php $timelineDetails = getProjectTimeline($projectId,$timelineDate['created_at']);
	                  foreach ($timelineDetails as $timelineDetail){
	                    $userInfo = getNameById('tbl_partners',$timelineDetail['user_id']);?>
	                    <div class="panel panel-post-item status">
	                      <div class="panel-heading">
	                        <div class="media">
	                          <div class="media-left"> <a href="#"> <img src="<?php if($userInfo[0]['profile_pic'] == ""){ echo '../assets/images/photos/sampleUserImage.png'; } else{ echo '../view/images/'.$userInfo[0]['profile_pic']; }?>" alt="" class="media-object img-circle" /> </a> </div>
	                          <div class="media-body">
	                            <h4 class="media-heading"><?php echo $userInfo[0]['name']?></h4>
	                            <?php $date2=date_create($timelineDetail['created_at']);?>
	                            <p class="media-usermeta"> <span class="media-time"><?php echo date_format($date2,'g:i A');?></span> </p>
	                          </div>
	                        </div>
	                      </div>
	                      <!-- panel-heading -->
	                      <div class="panel-body"> <?php echo $timelineDetail['description'];?></div>
	                    </div>
	                    <!-- panel panel-post -->
	                  <?php }?>

	                <?php }?>
	              </div>
	              <!-- timeline-wrapper --> 
	            </div>
	          </div>
		    
		</div>
		<!-- contentpanel --> 
	</div>
	<!-- mainpanel -->


<?php include "footer.php";?>