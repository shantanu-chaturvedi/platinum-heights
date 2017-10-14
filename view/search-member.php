<?php include '../controller/functions.php';

if(($_POST['search'] == 'byMap') && (empty($_POST['id']))){ ?>
	<div class="row membersListing">
		<div class="col-md-12 col-lg-6">
			<div class="panel panel-profile grid-view">
	          	<div class="panel-heading">
	            	<div class="text-center">
	            		<h4>No data found..!</h4>
            		</div>
            	</div>
			</div>
		</div>
	</div>

<?php } else{

	$implodeids = implode(',', $_POST['id']);
	if(!empty($implodeids)){
		$ids = $implodeids;
	}else{
		$ids = "";
	}
	if($_POST['memberType'] == 1){
		$tblname = 'tbl_admin';
	}elseif($_POST['memberType'] == 2){
		$tblname = 'tbl_partners';
	}else{
		$tblname = 'tbl_clients';
	}

	if(($_POST['memberType'] == 1) || ($_POST['memberType'] == 2)){
		
		$datas = filterSearch($_POST['name'],$_POST['location'],$_POST['firm_name'],'','',$ids,$tblname);?>
		
		<div class="row membersListing">
			<?php foreach($datas as $data){ ?>
			<div class="col-md-6 col-lg-3">
			  <div class="panel panel-profile grid-view">
			    <div class="panel-heading">
			      <div class="text-center"> <a href="#" class="panel-profile-photo"> <img height="70" width="70" class="img-circle" src="<?php echo '../view/images/'.$data['profile_pic'];?>" alt=""> </a>
			        <h4 class="panel-profile-name"><?php echo $data['name'];?></h4>
			        <?php if($_POST['memberType'] == 2){?>
			        	<p class="media-usermeta"><i class="glyphicon glyphicon-briefcase"></i> <?php echo $data['firm_name'];?></p>
		        	<?php }?>
			        <p class="media-usermeta"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i></p>
			      </div>
			    </div>
			    <!-- panel-heading -->
			    <div class="panel-body people-info">
			    	<div class="info-group">
				        <label>Location</label>
				        <?php echo $data['location'];?> 
		        	</div>
			      	<div class="info-group">
				        <label>Email</label>
				        <?php echo $data['email'];?> 
			        </div>
			      	<div class="info-group">
				        <label>Phone</label>
				        <?php echo $data['mobile_number'];?> 
			        </div>
			      	<div class="row">
				        <div class="col-xs-6">
				          <div class="info-group">
				            <label>Projects</label>
				            <h4>348</h4>
				          </div>
				        </div>
				        <div class="col-xs-6">
				          <div class="info-group">
				            <label>Earnings</label>
				            <h4>&#8377; 5,232</h4>
				          </div>
				        </div>
			      	</div>
		      		<div class="info-group last">
				        <label>Actions</label>
				        <div class="">
				          <button class="btn btn-default btn-xs"><i class="fa fa-envelope"></i> Send Message</button>
				          <button class="btn btn-default btn-xs" onClick="editMemberDetails('admin',<?php echo $data['ID'];?>)"><i class="fa fa-edit"></i> Edit Details</button>
				          <a href="../controller/functions.php?deleteMember&member=1&deleteID=<?php echo $data['ID'];?>"><button class="btn btn-default btn-xs"><i class="fa fa-trash"></i> Delete User</button></a>
				        </div>
			      	</div>
			    </div>
			    <!-- panel-body --> 
			  </div>
			  <!-- panel --> 
			</div>

			<?php }?>
		</div>

	<?php } else{
		$datas = filterSearch('',$_POST['location'],'',$_POST['contact_person'],$_POST['company_name'],$ids,$tblname);?>
		<div class="row membersListing">
	    <?php foreach($datas as $data){ ?>
	      <div class="col-md-6 col-lg-3">
	        <div class="panel panel-profile grid-view">
	          <div class="panel-heading">
	            <div class="text-center"> <a href="#" class="panel-profile-photo"> <img height="80" width="160" class="img-rounded" src="<?php echo '../view/images/'.$data['logo'];?>" alt=""> </a>
	              <h4 class="panel-profile-name"><?php echo $data['company_name'];?></h4>
	              <p class="media-usermeta"><i class="glyphicon glyphicon-user"></i> <?php echo $data['contact_person'];?></p>
	              <p class="media-usermeta"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i></p>
	            </div>
	          </div>
	          <!-- panel-heading -->
	          <div class="panel-body people-info">
	            <div class="info-group">
	              <label>Address</label>
	              <?php echo $data['location'];?></div>
	            <div class="info-group">
	              <label>Email</label>
	              <?php echo $data['email'];?> </div>
	            <div class="info-group">
	              <label>Phone</label>
	              <?php echo $data['phone'];?> </div>
	            <div class="row">
	              <div class="col-xs-6">
	                <div class="info-group">
	                  <label>Projects</label>
	                  <h4>48</h4>
	                </div>
	              </div>
	              <div class="col-xs-6">
	                <div class="info-group">
	                  <label>Payments</label>
	                  <h4>&#8377; 0</h4>
	                </div>
	              </div>
	            </div>
	            <div class="info-group last">
	              <label>Actions</label>
	              <div class="">
	                <button class="btn btn-default btn-xs"><i class="fa fa-envelope"></i> Send Message</button>
	                <button class="btn btn-default btn-xs" onClick="editMemberDetails('client',<?php echo $data['ID']?>)"><i class="fa fa-edit"></i> Edit Details</button>
	                <a href="../controller/functions.php?deleteMember&member=3&deleteID=<?php echo $data['ID'];?>"><button class="btn btn-default btn-xs"><i class="fa fa-trash"></i> Delete User</button></a>
	              </div>
	            </div>
	          </div>
	          <!-- panel-body --> 
	        </div>
	        <!-- panel --> 
	      </div>
	    <?php }?>
	    <!-- col-md-6 -->
	  </div>
	<?php }
	
}

