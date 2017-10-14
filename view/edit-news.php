<?php include '../controller/functions.php';
$id = $_GET['newsId'];
$datas = getNewsDetail($id);
foreach ($datas as $data){?>
	<div class="">
		<div class="contentpanel" style="padding:0">

			<?php if((checkCapabilities("manage announcement") == 1) && ($_SESSION['logged_in_user_role'] == 1)){?>
		  
			  	<div class="panel panel-default">
				    <div class="panel-heading">
				      <h4 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Update News</h4>
				    </div>
				    <div class="panel-body">
				      <form role="form" method="post">
				      	<input type="hidden" name="newsId" value="<?php echo $id;?>">
				        <textarea id="summernote" name="news" placeholder="Enter News here..." class="form-control" rows="10"><?php echo $data['news'];?></textarea>
				        <br clear="all" />
				        <p>
				          <button  type="submit" name="updateNews" class="btn btn-default btn-quirk pull-right">Update News</button>
				        </p>
				      </form>
				    </div>
			  	</div>

		  	<?php } else {?>
		  		<div class="panel panel-default">
				    <div class="panel-heading">
				      <h4 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> &nbsp; News</h4>
				    </div>
				    <div class="panel-body">
				        <p><?php echo $data['news'];?></p>
				        <br clear="all" />
				    </div>
				</div>
		  	<?php }?>
		</div>
		<!-- contentpanel --> 
	</div>
<?php }?>
<script type="text/javascript">
	 jQuery('#wysiwyg1').wysihtml5({
    toolbar: {
      fa: true
    }
  });
</script>
