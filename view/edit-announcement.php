<?php include '../controller/functions.php';
$id = $_GET['announcementId'];
$datas = getAnnouncementDetail($id);
foreach ($datas as $data){?>
	<div class="">
		<div class="contentpanel" style="padding:0">

			<?php if((checkCapabilities("manage announcement") == 1) && ($_SESSION['logged_in_user_role'] == 1)){?>
		  
				<div class="panel panel-default">
				    <div class="panel-heading">
				      <h4 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Update Announcement</h4>
				    </div>
				    <div class="panel-body">
				      <form role="form" method="post">
				      	<input type="hidden" name="announcementId" value="<?php echo $id;?>">
				        <textarea id="summernote" name="announcement" placeholder="Enter Announcement here..." class="form-control" rows="10"><?php echo $data['annoucement'];?></textarea>
				        <br clear="all" />
				        <p>
				          <button  type="submit" name="updateAnnouncement" class="btn btn-default btn-quirk pull-right">Update Announcement</button>
				        </p>
				      </form>
				    </div>
				</div>

			<?php } else {?>

				<div class="panel panel-default">
				    <div class="panel-heading">
				      <h4 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Announcement</h4>
				    </div>
				    <div class="panel-body">
				        <p><?php echo $data['annoucement'];?></p>
				        <br clear="all" />
				    </div>
				</div>

			<?php } ?>

		</div>
		<!-- contentpanel --> 
	</div>
<?php }?>
