<?php $currentPage = 'announcements';
include 'header.php';?>

<?php if((checkCapabilities("manage announcement") == 1) && ($_SESSION['logged_in_user_role'] == 1)){?>

  <div class="mainpanel">
    <div class="emailcontent" style="width:50%;">
      <div class="email-options" style="background-color:#d8dce3;">
        <div class="settings">
          <h4>Announcements</h4>
        </div>
      </div><!-- email-options -->
      <div class="list-group">

        <?php $i=1;
          $announcementsInfos = getAnnouncement();
          foreach($announcementsInfos as $announcementsInfo){?>
          <div class="list-group-item unread">
            <div class="media announcement-media" id="<?php echo $announcementsInfo['ID'];?>">
              <div class="media-body">
                <div class="listing-right">
                  <p><?php $date = date_create($newsInfo['created_at']);
                    echo date_format($date,"d M, Y");
                  ?></p>
                  <p><a onClick="deleteAnnouncements(<?php echo $announcementsInfo['ID'];?>)"><i class="fa fa-trash""></i></a></p>
                </div>
                <div class="listing-left">
                  <div>
                    <p><?php echo $i.'.';?></p>
                  </div>
                  <div>
                    <p><?php echo $announcementsInfo['annoucement'];?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php $i++; }?>

      </div>

    </div><!-- emailcontent -->

    <div class="contentpanel emailpanel" style="left:905px;">
      <div class="postannouncement">
        <h4>New Announcement here :-</h4>
        <form role="form" method="post" id="postAnnouncement">
          <textarea id="summernote" name="announcement" placeholder="Enter announcement here..." class="form-control" rows="10"></textarea>
          <br clear="all" />
          <p>
            <button  type="submit" class="btn btn-default btn-quirk pull-right">Post</button>
          </p>
        </form>
        <br><br>
      </div><!-- mailcontent -->
      <div class="mailcontent hide">
      </div>
    </div><!-- contentpanel -->

  </div>

<?php } else {?>

  <div class="mainpanel">
    <div class="emailcontent" style="width:50%;">
      <div class="email-options" style="background-color:#d8dce3;">
        <div class="settings">
          <h4>Announcements</h4>
        </div>
      </div><!-- email-options -->
      <div class="list-group">

        <?php $i=1;
          $announcementsInfos = getAnnouncement();
          foreach($announcementsInfos as $announcementsInfo){?>
          <div class="list-group-item unread">
            <div class="media announcement-media" id="<?php echo $announcementsInfo['ID'];?>">
              <div class="media-body">
                <div class="listing-right">
                  <p><p><?php $date=date_create($announcementsInfo['created_at']);
                    echo date_format($date,"d M, Y");?></p></p>
                </div>
                <div class="listing-left">
                  <div>
                    <p><?php echo $i.'.';?></p>
                  </div>
                  <div>
                    <p><?php echo $announcementsInfo['annoucement'];?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php $i++; }?>

      </div>

    </div><!-- emailcontent -->

    <div class="contentpanel emailpanel" style="left:905px;">
      <div class="postannouncement">
        
      </div><!-- mailcontent -->
      <div class="mailcontent hide">
      </div>
    </div><!-- contentpanel -->

  </div>

<?php } ?>

<div class="modal bounceIn animated announcement-form"  id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<?php include 'footer.php';?>