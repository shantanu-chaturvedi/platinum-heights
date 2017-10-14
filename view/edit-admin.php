<?php $parentPage = 'members';
$currentPage = 'member-admin';
include 'header.php';

$id = $_GET['id'];
$datas = getSingleAdminData($id); ?>

<div class="mainpanel">
<div class="contentpanel">
      
      <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title"><span class="fa fa-pencil-square-o"></span> &nbsp; Edit Admin Details</h4>
        </div>
        <div class="panel-body">
        	<form method="POST">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Name</strong> </label>
	          <input type="text" name="name" value="<?php echo $datas[0]['name']?>" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Email</strong> </label>
	          <input type="email" name="email" value="<?php echo $datas[0]['email']?>" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Phone (Work)</strong> </label>
	          <input type="text" name="work_number" value="<?php echo $datas[0]['work_number']?>" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Phone (Mobile)</strong> </label>
	          <input type="text" name="mobile_number" value="<?php echo $datas[0]['mobile_number']?>" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Location</strong> </label>
	          <input type="text" name="location" value="<?php echo $datas[0]['location']?>" class="form-control">
	          <br clear="all" />
	          <div class="form-group">
	            <label for="fileToUpload">Profile Pic:</label>
	            <input type="file" name="fileToUpload">
	          </div>
	          <input type="hidden" value="<?php echo $datas[0]['profile_pic']?>" name="profile_pic">
      		  <input type="hidden" value="<?php echo $datas[0]['ID']?>" name="adminId">

	          <label class="control-label center-block"><strong>Assign Capabilites</strong> </label>
	          <br clear="all" />
	            
	          <div class="col-md-3">
	          <label class="control-label center-block"><strong>Projects: General</strong> </label>
	          <?php $capabilities = explode(',',$datas[0]['capabilities']);?>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('new project',$capabilities)){ echo "checked = 'checked'"; }?> value="new project"><span>Can Create New Project</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('edit project',$capabilities)){ echo "checked = 'checked'"; }?> value="edit project"><span>Can Edit Own Project</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('delete project',$capabilities)){ echo "checked = 'checked'"; }?> value="delete project"><span>Can Delete Own Project</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('assign project',$capabilities)){ echo "checked = 'checked'"; }?> value="assign project"><span>Can Assign Project</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('approve project',$capabilities)){ echo "checked = 'checked'"; }?> value="approve project"><span>Can Approve Project Request</span>
	          </label>
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Projects: Assigned to Me</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('edit my project',$capabilities)){ echo "checked = 'checked'"; }?> value="edit my project"><span>Can Edit</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('delete my project',$capabilities)){ echo "checked = 'checked'"; }?> value="delete my project"><span>Can Delete</span>
	          </label>
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Projects: Not Assigned to Me</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('view other project',$capabilities)){ echo "checked = 'checked'"; }?> value="view other project"><span>Can View</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('edit other project',$capabilities)){ echo "checked = 'checked'"; }?> value="edit other project"><span>Can Edit</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('delete other project',$capabilities)){ echo "checked = 'checked'"; }?> value="delete other project"><span>Can Delete</span>
	          </label>
	          </div>
	        
	          <div class="col-md-3">
	          <label class="control-label center-block"><strong>Messages: 1-1 Messages</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('send message assigned me',$capabilities)){ echo "checked = 'checked'"; }?> value="send message assigned me"><span>Can Send Messages to Projects Assigned to Me</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('send message not assigned me',$capabilities)){ echo "checked = 'checked'"; }?> value="send message not assigned me"><span>Can Send Messages to Proejcts Not Assigned to Me</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('send message to client',$capabilities)){ echo "checked = 'checked'"; }?> id="messageToClient" value="send message to client"><span>Can Send Messages to Client</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('send message to partner',$capabilities)){ echo "checked = 'checked'"; }?> id="messageToPartner" value="send message to partner"><span>Can Send Messages to CA Partners</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('send message to other admin',$capabilities)){ echo "checked = 'checked'"; }?> id="messageToAdmin" value="send message to other admin"><span>Can Send Messages to Other Admins</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('broadcast message',$capabilities)){ echo "checked = 'checked'"; }?> id="broadcastMessage" value="broadcast message"><span>Can Broadcast Messages to Everyone</span>
	          </label>
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Messages: News</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('manage news',$capabilities)){ echo "checked = 'checked'"; }?> id="manageNews" value="manage news"><span>Can Manage News</span>
	          </label>
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Messages: Announcements</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('manage announcement',$capabilities)){ echo "checked = 'checked'"; }?> id="manageAnnoucement" value="manage announcement"><span>Can Manage Announcements</span>
	          </label>
	          </div>
	        
	          <div class="col-md-3">
	          <label class="control-label center-block"><strong>Members: Clients</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('view client listing',$capabilities)){ echo "checked = 'checked'"; }?> id="clientListing" checked="checked" value="view client listing"><span>Can See Listing</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('add new client',$capabilities)){ echo "checked = 'checked'"; }?> id="newClient" value="add new client"><span>Can Add New Client</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('edit client',$capabilities)){ echo "checked = 'checked'"; }?> id="editClient" value="edit client"><span>Can Edit Client</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('delete client',$capabilities)){ echo "checked = 'checked'"; }?> id="deleteClient" value="delete client"><span>Can Delete Client</span>
	          </label>
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Members: CA Partners</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('view partner listing',$capabilities)){ echo "checked = 'checked'"; }?> id="partnerListing" checked="checked" value="view partner listing"><span>Can See Listing</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('add new partner',$capabilities)){ echo "checked = 'checked'"; }?> id="newPartner" value="add new partner"><span>Can Add New CA Partner</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('edit partner',$capabilities)){ echo "checked = 'checked'"; }?> id="editPartner" value="edit partner"><span>Can Edit CA Partner</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('delete partner',$capabilities)){ echo "checked = 'checked'"; }?> id="deletePartner" value="delete partner"><span>Can Delete CA Partner</span>
	          </label>
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Members: Admin</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('view admin listing',$capabilities)){ echo "checked = 'checked'"; }?> id="adminListing" checked="checked" value="view admin listing"><span>Can See Listing</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('add new admin',$capabilities)){ echo "checked = 'checked'"; }?> id="newAdmin" value="add new admin"><span>Can Add New Admin</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('edit admin',$capabilities)){ echo "checked = 'checked'"; }?> id="editAdmin" value="edit admin"><span>Can Edit Admin</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('delete admin',$capabilities)){ echo "checked = 'checked'"; }?> id="deleteAdmin" value="delete admin"><span>Can Delete Admin</span>
	          </label>
	          </div>

	          <div class="col-md-3">
	          <label class="control-label center-block"><strong>Payment: Clients</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('view client payment listing',$capabilities)){ echo "checked = 'checked'"; }?> id="clientPaymentListing" value="view client payment listing"><span>Can See Listing</span>
	          </label>
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Payment: CA Partners</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('view partner payment listing',$capabilities)){ echo "checked = 'checked'"; }?> id="partnerPaymentListing" value="view partner payment listing"><span>Can See Listing</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" <?php if(in_array('pay to partner',$capabilities)){ echo "checked = 'checked'"; }?> id="payToPartner" value="pay to partner"><span>Can Pay to CA Partner</span>
	          </label>
	          </div>
	            
	            <br clear="all" />
	            
	            <p>
	            <button type="submit" name="editAdmin" class="btn btn-default btn-quirk pull-right">Submit</button>
	          </p>
          </form>
        </div>
      </div>
    </div>

<?php include 'footer.php';?>
