<div class="modal-dialog">
    <div class="modal-content">

    	<?php if(isset($_GET['deleteMember'])){?>
	      	<form role="form" method="post" id="confirmMemberDeletion">
		      	<div class="modal-body" style="text-align:center;">
				    <h3>Are you sure you want to remove this member:</h3>
				    <input type="hidden" name="member" value="<?php echo $_GET['type'];?>">
				    <input type="hidden" name="memberId" value="<?php echo $_GET['id'];?>">
			      	<button type="submit" name="confirmDeletion" class="btn btn-primary">OK</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
	      	</form>
      	<?php }?>

      	<?php if(isset($_GET['deleteMessage'])){?>
      		<form role="form" method="post" id="confirmMessageDeletion">
		      <div class="modal-body" style="text-align:center;">
				    <h3>Are you sure you want to remove this news:</h3>
				    <input type="hidden" name="messageId" value="<?php echo $_GET['id'];?>">
			      	<button type="submit" name="confirmDeletion" class="btn btn-primary">OK</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
	      </form>
  		<?php }?>

  		<?php if(isset($_GET['deleteNews'])){?>
  			<form role="form" method="post" id="confirmNewsDeletion">
		      <div class="modal-body" style="text-align:center;">
				    <h3>Are you sure you want to remove this news:</h3>
				    <input type="hidden" name="newsId" value="<?php echo $_GET['id'];?>">
			      	<button type="submit" name="confirmDeletion" class="btn btn-primary">OK</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
	      </form>
		<?php }?>

		<?php if(isset($_GET['deleteAnnouncement'])){?>
			<form role="form" method="post" id="confirmAnnouncementDeletion">
		      <div class="modal-body" style="text-align:center;">
				    <h3>Are you sure you want to remove this news:</h3>
				    <input type="hidden" name="announcementId" value="<?php echo $_GET['id'];?>">
			      	<button type="submit" name="confirmDeletion" class="btn btn-primary">OK</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
	      </form>
      	<?php }?>

      	<?php if(isset($_GET['deleteVideo'])){?>
	      	<form role="form" method="post" id="confirmVideoDeletion">
		      	<div class="modal-body" style="text-align:center;">
				    <h3>Are you sure you want to remove this video:</h3>
				    <input type="hidden" name="videoId" value="<?php echo $_GET['id'];?>">
			      	<button type="submit" name="confirmDeletion" class="btn btn-primary">OK</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
	      	</form>
      	<?php }?>

      	<?php if(isset($_GET['submitProjectFinal'])){?>
	      	<form role="form" method="post" id="confirmProjectSubmission">
		      	<div class="modal-body" style="text-align:center;">
				    <h3>After submitting the project you cannot make any further changes in the form:</h3>
				    <input type="hidden" name="subprojectId" value="<?php echo $_GET['subprojectId'];?>">
			      	<button type="submit" name="confirmDeletion" class="btn btn-primary">OK</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
	      	</form>
      	<?php }?>

    </div><!-- modal-content -->
</div><!-- modal-dialog -->
