<?php $currentPage = 'news';
include 'header.php';?>

<?php if((checkCapabilities("manage news") == 1) && ($_SESSION['logged_in_user_role'] == 1)){?>

  <div class="mainpanel">
    <div class="emailcontent" style="width:50%;">
      <div class="email-options">
        <div class="settings">
          <h4>News</h4>
        </div>
      </div><!-- email-options -->
      <div class="list-group">

        <?php $newsInfos = getNews();
        $i=1;
        foreach($newsInfos as $newsInfo){?>
          <div class="list-group-item unread">
            <div class="media news-media" id="<?php echo $newsInfo['ID'];?>">
              <div class="media-body">
                <div class="listing-right">
                  <p><?php $date = date_create($newsInfo['created_at']);
                  	echo date_format($date,"d M, Y");
              		?></p>
                  <p><a onClick="deleteNews(<?php echo $newsInfo['ID'];?>)"><i class="fa fa-trash"></i></a></p>
                </div>
                <div class="listing-left">
                  <div>
                    <p><?php echo $i.'.';?></p>
                  </div>
                  <div>
                  	<?php if($newsInfo['news'] == ""){ ?>
                  		<a href="<?php echo $newsInfo['url'];?>">
	                  		<div class="news-left-content">
		                  		<img src="<?php echo $newsInfo['ogImage'];?>" height="100" width="100">
		                  	</div>
		                  	<div class="news-right-content">
		                  		<div class="url-right-upper">
		                  			<?php echo $newsInfo['ogTitle'];?>
		                  		</div>
		                  		<div class="url-right-lower">
		                  			<?php echo $newsInfo['ogDescription'];?>
		                  		</div>
		                  	</div>
	                  	</a>
                  	<?php } else {?>
                  		<p><?php echo $newsInfo['news'];?></p>
                  	<?php }?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php $i++; }?>

      </div>

    </div><!-- emailcontent -->

    <div class="contentpanel emailpanel" style="left:905px;">
      <div class="postnews">
        <h4>Post News</h4>
        <form role="form" method="post" id="postNews">
          <textarea id="wysiwyggggg" name="news" placeholder="Enter news here..." class="form-control" rows="10"></textarea>
          <br clear="all" />
          <p>
            <button type="submit" class="btn btn-default btn-quirk pull-right">Post</button>
          </p>
        </form>

        <br><br>
      </div><!-- mailcontent -->
      <div class="mailcontent hide">
      </div>
    </div><!-- contentpanel -->

  </div><!-- mainpanel -->

<?php } else {?>

  <div class="mainpanel">
    <div class="emailcontent" style="width:50%;">
      <div class="email-options" style="background-color:#d8dce3;">
        <div class="settings">
          <h4>News</h4>
        </div>
      </div><!-- email-options -->
      <div class="list-group">

        <?php $newsInfos = getNews();
        $i=1;
        foreach($newsInfos as $newsInfo){?>
          <div class="list-group-item unread">
            <div class="media announcement-media" id="<?php echo $newsInfo['ID'];?>">
              <div class="media-body">
                <div class="listing-right">
                  <p><?php $date=date_create($newsInfo['created_at']);
                    echo date_format($date,"d M, Y");?></p>
                </div>
                <div class="listing-left">
                  <div>
                    <p><?php echo $i.'.';?></p>
                  </div>
                  <div>
                    <?php if($newsInfo['news'] == ""){ ?>
                      <a href="<?php echo $newsInfo['url'];?>">
                        <div class="news-left-content">
                          <img src="<?php echo $newsInfo['ogImage'];?>" height="100" width="100">
                        </div>
                        <div class="news-right-content">
                          <div class="url-right-upper">
                            <?php echo $newsInfo['ogTitle'];?>
                          </div>
                          <div class="url-right-lower">
                            <?php echo $newsInfo['ogDescription'];?>
                          </div>
                        </div>
                      </a>
                    <?php } else {?>
                      <p><?php echo $newsInfo['news'];?></p>
                    <?php }?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php $i++; }?>

      </div>

    </div><!-- emailcontent -->

    <div class="contentpanel emailpanel" style="left:905px;">
      <div class="postnews">
        
      </div><!-- mailcontent -->
      <div class="mailcontent hide">
      </div>
    </div><!-- contentpanel -->

  </div>

<?php } ?>

<div class="modal bounceIn animated news-form"  id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<?php include 'footer.php';?>