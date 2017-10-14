<?php include '../controller/functions.php';

$videos = filterVideos($_POST['videos']); ?>

<div class="row filemanager videoDetailsRow">

<?php foreach($videos as $video){ ?>
  
  <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 video">
    <div class="thmb">                
      <div class="thmb-prev">
			<video width="100%" controls>
			  <source src="<?php echo '../view/videos/'.$video['name'];?>" type="video/mp4">
			</video>
      </div>
      <div class="btn-group fm-group">
        <button type="button" class="btn btn-default dropdown-toggle fm-toggle" data-toggle="dropdown">
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu pull-right fm-menu" role="menu">
          <!-- <li><a href="#"><i class="fa fa-share"></i> Share</a></li> -->
          <li><a href="#" onClick="editVideo(<?php echo $video['ID'];?>);"><i class="fa fa-pencil"></i> Edit</a></li>
          <li><a href="#" onClick="downloadVideo(<?php echo $video['ID'];?>)";><i class="fa fa-download"></i> Download</a></li>
          <li><a href="#" onClick="deleteVideo(<?php echo $video['ID'];?>)";><i class="fa fa-trash-o"></i> Delete</a></li>
        </ul>
      </div><!-- btn-group -->
      <h4 class="fm-title"><a href="single-video.php?id=<?php echo $video['ID'];?>"><?php echo $video['title'];?></a></h4>
      <h5 class="fm-description"><a href="single-video.php?id=<?php echo $video['ID'];?>"><?php echo shorter($video['description'],100).'...';?></a></h5>
      <small class="text-muted">Added: <?php echo $video['uploaded_on'];?></small>
    </div><!-- thmb -->
  </div><!-- col-xs-6 -->

<?php }?>

</div><!-- row -->