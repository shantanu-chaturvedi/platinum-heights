<?php include '../controller/functions.php';?>
<div class="modal-dialog">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        	<h4 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> &nbsp; New Message</h4>
      	</div>
      	<form role="form" method="post" id="composeMessage">
	      	<div class="modal-body">
	      		<p><strong>
		      		<?php if($_GET['receiverMemberType']=='1'){
		      			$tblname = 'tbl_admin';?>
	      		  		Use below form to compose and send message to <span class="logo">CACircuit</span> team.
	  		  		<?php }else if($_GET['receiverMemberType']=='2'){
	  		  			$tblname = 'tbl_partners';?>
	  		  			Use below form to compose and send message to <span class="logo">CACircuit</span> partner.
  		  			<?php }else{
  		  				$tblname = 'tbl_clients';?>
  		  				Use below form to compose and send message to <span class="logo">CACircuit</span> clent.
	  				<?php }?>
  		  		</strong></p>
	          	<br clear="all" />
	          	<?php $datas = getNameById($tblname,$_GET['receiverId']);
	          	foreach ($datas as $data){
	          		if($tblname == 'tbl_clients'){
	          			$name = $data['contact_person'];
	          		}else{
	          			$name = $data['name'];
	          		}
	          	}?>
	            <input type="text" readonly="" value="<?php echo $name;?>" class="form-control">
	          	<input type="hidden" name="senderMemberType" value="<?php echo $_GET['senderMemberType'];?>">
	          	<input type="hidden" name="receiver" value="<?php echo $_GET['receiverMemberType'].'-'.$data['ID'];?>">
	          	<br clear="all" />
	          	<input type="text" name="subject" placeholder="Subject" class="form-control">
	          	<br clear="all" />
	          	<textarea id="summernote" name="message" placeholder="Enter message here..." class="form-control" rows="10"></textarea>
	          	<br clear="all" />
	          	<input type="checkbox" value="1" name="sendMail">Send this message in Mail
              	<br clear="all" />
	      	</div>
	      	<div class="modal-footer">
	      		<button type="submit" class="btn btn-primary">Send Message</button>
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div>
      	</form>
    </div><!-- modal-content -->
</div><!-- modal-dialog -->