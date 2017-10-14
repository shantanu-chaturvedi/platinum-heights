<?php $currentPage = 'video-library';
include "header.php";

//if(checkCapabilities("video library") == 1){?>

  <div class="mainpanel">
    <div class="contentpanel">
      <div class="row">
        <div class="col-sm-8 col-md-9 col-lg-10">
          <div class="well well-asset-options clearfix">
            <!-- <div class="btn-toolbar btn-toolbar-media-manager pull-left" role="toolbar">
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-default"><i class="fa fa-download"></i> Download</button>
              </div>
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-default disabled"><i class="fa fa-trash"></i> Delete</button>
              </div>
            </div> --><!-- btn-toolbar -->

            <div class="btn-toolbar btn-toolbar-media-manager pull-right" role="toolbar">
              <div class="btn-group" role="group">
                <a href="#" onclick="addNewVideo();"><button type="button" class="btn btn-default"><i class="fa fa-upload"></i> Upload Files</button></a>
              </div>
            </div><!-- btn-toolbar -->
          </div>

          <div class="row filemanager videoDetailsRow">

            <?php $videos = getVideos(); 
            foreach($videos as $video){ ?>
              
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
                      <li><a href="downloads.php?downloadVideo&i=<?php echo $video['ID'];?>"><i class="fa fa-download"></i> Download</a></li>
                      <li><a href="#" onClick="deleteVideo(<?php echo $video['ID'];?>)";><i class="fa fa-trash-o"></i> Delete</a></li>
                    </ul>
                  </div><!-- btn-group -->
                  <h4 class="fm-title"><a href="single-video.php?id=<?php echo $video['ID'];?>"><?php echo $video['title'];?></a></h4>
                  <h5 class="fm-description"><a href="single-video.php?id=<?php echo $video['ID'];?>"><?php echo shorter($video['description'],100).'...';?></a></h5>
                  <small class="text-muted">Added: <?php $date=date_create($video['uploaded_on']); echo date_format($date,"d M, Y");?></small>
                </div><!-- thmb -->
              </div><!-- col-xs-6 -->

            <?php }?>
            
          </div><!-- row -->
        </div><!-- col-sm-9 -->
        <div class="col-sm-4 col-md-3 col-lg-2">
          <div class="fm-sidebar">

            <div class="panel">
              <div class="panel-heading">
                <h4 class="panel-title">Categories</h4>
              </div>
              <div class="panel-body">
                <ul class="folder-list">
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="0">&nbsp; All Videos</li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="1">&nbsp; General</li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="2">&nbsp; Annual Inspection Report</li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="3">&nbsp; Capitalisation Verification </li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="4">&nbsp; Compliance Check</li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="5">&nbsp; Debtor Verification</li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="6">&nbsp; Due Diligence</li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="7">&nbsp; Event Audit</li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="8">&nbsp; Expenses Audit</li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="9">&nbsp; Financial Health Check-up</li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="10">&nbsp; Fixed Asset Register</li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="11">&nbsp; Loan Verification</li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="12">&nbsp; Monthly Inspection Report</li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="13">&nbsp; Quality Review – Stores/Outlets</li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="14">&nbsp; Quarterly Inspection Report </li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="15">&nbsp; Stock Audit</li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="16">&nbsp; Stock Verification </li>
                  <li> <input type="checkbox" class="videoFilterationCheckbox" name="videoFeatures" value="17">&nbsp; Vendor Verification </li>
                </ul>
              </div>
            </div>

          </div>
        </div><!-- col-sm-3 -->
      </div>
    </div>

  </div><!-- mainpanel -->
</section>

<div class="modal bounceIn animated add-video"  id="addVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Upload Video</h4>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="uploadVideo">Upload Video:</label>
            <input type="file" name="uploadVideo">
          </div>
          <div class="form-group">
            <label for="title">Title <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="title">
          </div>
          <div class="form-group">
            <label for="description">Description<span class="text-danger">*</span></label>
            <textarea name="description" class="form-control"></textarea>
          </div>
          <?php $datas = getProjectType(); ?>
          <label class="control-label center-block"><strong>Video Category</strong></label>
          <select class="form-control" name="video_category" style="width: 100%" data-placeholder="Search a Category">
            <option value="">&nbsp;</option>
            <?php foreach ($datas as $data){?>
              <option value="<?php echo $data['ID'];?>"><?php echo $data['type'];?></option>
            <?php }?>
          </select>
          <div class="form-group">
            <label for="activate">Activate</label>
            <!-- <div class="toggle-wrapper">
              <div class="leftpanel-toggle toggle-light success"></div>
            </div> -->
            <input type="radio" name="activate" value="1">Yes
            <input type="radio" name="activate" value="0">No
          </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" name="addVideo" class="btn btn-primary" value="Save changes">
        </div>
      </form>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div>

<div class="modal bounceIn animated edit-video"  id="editVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Upload Video</h4>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="uploadVideo">Upload Video:</label>
            <input type="file" name="uploadVideo">
            <input type="hidden" name="uploadVideoOld">
          </div>
          <div class="form-group">
            <label for="title">Title <span class="text-danger">*</span></label>
            <input type="text" required="required" class="form-control" name="title">
          </div>
          <div class="form-group">
            <label for="description">Description<span class="text-danger">*</span></label>
            <textarea name="description" id="video_description" class="form-control"></textarea>
          </div>
          <?php $datas = getProjectType(); ?>
          <label class="control-label center-block"><strong>Video Category</strong></label>
          <select class="form-control" name="video_category" id="video_category" style="width: 100%" data-placeholder="Search a Category">
            <option value="">&nbsp;</option>
            <?php foreach ($datas as $data){?>
              <option value="<?php echo $data['ID'];?>"><?php echo $data['type'];?></option>
            <?php }?>
          </select>
          <div class="form-group">
            <label for="activate">Activate</label>
            <!-- <div class="toggle-wrapper">
              <div class="leftpanel-toggle toggle-light success"></div>
            </div> -->
            <input type="radio" name="activate" value="1">Yes
            <input type="radio" name="activate" value="0">No
          </div>
          <input type="hidden" name="videoId">
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" name="editVideo" class="btn btn-primary" value="Save changes">
        </div>
      </form>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div>

<div class="modal bounceIn animated video-form" id="videoForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<?php //}

include "footer.php";?>