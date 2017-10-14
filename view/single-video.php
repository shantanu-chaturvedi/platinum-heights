<?php $currentPage = 'asset-manager';
include "header.php"; 

$videos = getSingleVideoData($_GET['id']);?>

	<div class="mainpanel">
		<div class="contentpanel">
		  
		    <div class="panel">
		      <div class="panel-heading">
		        <h4 class="panel-title"><span class="fa fa-cube"></span>&nbsp;<?php echo $videos[0]['title'];?></h4>
		        <p><?php $cat = getProjectTypeById($videos[0]['category_id']);
		        echo $cat[0]['type'];?></p>
		      </div>
		      <div class="panel-body">

		      	<p><?php echo $videos[0]['description'];?></p>

		      	<video width="800" controls>
				  <source src="<?php echo '../view/videos/'.$videos[0]['name'];?>" type="video/mp4">
				</video>
		         
		      </div>
		    </div>
		    
		</div>
		<!-- contentpanel --> 
	</div>
	<!-- mainpanel -->


<?php include "footer.php";?>