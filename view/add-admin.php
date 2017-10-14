<?php $parentPage = 'members';
$currentPage = 'member-admin';
include 'header.php';?>

<div class="mainpanel">
<div class="contentpanel">
      
      <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title"><span class="fa fa-pencil-square-o"></span> &nbsp; Add New Admin</h4>
        </div>
        <div class="panel-body">
        	<form method="POST">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Name</strong> </label>
	          <input type="text" name="name" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Email</strong> </label>
	          <input type="email" name="email" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Phone (Work)</strong> </label>
	          <input type="text" name="work_number" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Phone (Mobile)</strong> </label>
	          <input type="text" name="mobile_number" class="form-control">
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Location</strong> </label>
	          <input type="text" name="location" class="form-control">
	          <br clear="all" />
	          <div class="form-group">
	            <label for="fileToUpload">Profile Pic:</label>
	            <input type="file" name="fileToUpload">
	          </div>

	          <label class="control-label center-block"><strong>Assign Capabilites</strong> </label>
	          <br clear="all" />
	            
	          <div class="col-md-3">
	          <label class="control-label center-block"><strong>Projects: General</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" value="new project"><span>Can Create New Project</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" value="edit project"><span>Can Edit Own Project</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" value="delete project"><span>Can Delete Own Project</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" value="assign project"><span>Can Assign Project</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" value="approve project"><span>Can Approve Project Request</span>
	          </label>
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Projects: Assigned to Me</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" value="edit my project"><span>Can Edit</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" value="delete my project"><span>Can Delete</span>
	          </label>
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Projects: Not Assigned to Me</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" value="view other project"><span>Can View</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" value="edit other project"><span>Can Edit</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" value="delete other project"><span>Can Delete</span>
	          </label>
	          </div>
	        
	          <div class="col-md-3">
	          <label class="control-label center-block"><strong>Messages: 1-1 Messages</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" value="send message assigned me"><span>Can Send Messages to Projects Assigned to Me</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" value="send message not assigned me"><span>Can Send Messages to Proejcts Not Assigned to Me</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="messageToClient" value="send message to client"><span>Can Send Messages to Client</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="messageToPartner" value="send message to partner"><span>Can Send Messages to CA Partners</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="messageToAdmin" value="send message to other admin"><span>Can Send Messages to Other Admins</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="broadcastMessage" value="broadcast message"><span>Can Broadcast Messages to Everyone</span>
	          </label>
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Messages: News</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="manageNews" value="manage news"><span>Can Manage News</span>
	          </label>
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Messages: Announcements</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="manageAnnoucement" value="manage announcement"><span>Can Manage Announcements</span>
	          </label>
	          </div>
	        
	          <div class="col-md-3">
	          <label class="control-label center-block"><strong>Members: Clients</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="clientListing" checked="checked" value="view client listing"><span>Can See Listing</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="newClient" value="add new client"><span>Can Add New Client</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="editClient" value="edit client"><span>Can Edit Client</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="deleteClient" value="delete client"><span>Can Delete Client</span>
	          </label>
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Members: CA Partners</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="partnerListing" checked="checked" value="view partner listing"><span>Can See Listing</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="newPartner" value="add new partner"><span>Can Add New CA Partner</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="editPartner" value="edit partner"><span>Can Edit CA Partner</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="deletePartner" value="delete partner"><span>Can Delete CA Partner</span>
	          </label>
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Members: Admin</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="adminListing" checked="checked" value="view admin listing"><span>Can See Listing</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="newAdmin" value="add new admin"><span>Can Add New Admin</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="editAdmin" value="edit admin"><span>Can Edit Admin</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="deleteAdmin" value="delete admin"><span>Can Delete Admin</span>
	          </label>
	          </div>

	          <div class="col-md-3">
	          <label class="control-label center-block"><strong>Payment: Clients</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="clientPaymentListing" value="view client payment listing"><span>Can See Listing</span>
	          </label>
	          <br clear="all" />
	          <label class="control-label center-block"><strong>Payment: CA Partners</strong> </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="partnerPaymentListing" value="view partner payment listing"><span>Can See Listing</span>
	          </label>
	          <label class="ckbox">
	            <input type="checkbox" name="capabilities[]" id="payToPartner" value="pay to partner"><span>Can Pay to CA Partner</span>
	          </label>
	          <br clear="all" />
	          </div>
	            
	            <br clear="all" />
	            
	            <p>
	            <button type="submit" name="addAdmin" class="btn btn-default btn-quirk pull-right">Submit</button>
	          </p>
          </form>
        </div>
      </div>
    </div>

<?php include 'footer.php';?>