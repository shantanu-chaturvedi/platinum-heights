<?php $parentPage = 'messages';
$currentPage = 'inbox';
include 'header.php';?>
<div class="mainpanel">
    <div class="emailcontent inboxcontent">
      <div class="email-options">
        <div class="settings">
          
          <!-- <a href="" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Archive"><i class="fa fa-archive"></i></a>
          <a href="" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Report Spam"><i class="fa fa-exclamation-triangle"></i></a>
          <a href="" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Move to Folder"><i class="fa fa-folder-open"></i></a>
          <a href="" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Add Tag"><i class="fa fa-tag"></i></a> -->
          <a href="" class="tooltips" onClick="deleteMessageInbox(event);" data-toggle="tooltip" data-placement="bottom" title="Move to Trash"><i class="fa fa-trash"></i></a>
          <!-- <a href="" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="More"><i class="fa fa-ellipsis-v"></i></a> -->
        </div>

        <label class="ckbox">
          <h4>Inbox</h4>
        </label>
      </div><!-- email-options -->

      <?php $messages = getInboxMessages($_SESSION['logged_in_userid'],$_SESSION['logged_in_user_role']);
      foreach($messages as $message){?>
        <div class="list-group">
          <div class="list-group-item <?php if($message['unread'] == 1){ echo 'unread'; }?>">
            <div class="list-left">
              <label class="ckbox">
                <input type="checkbox" class="messageDelete" value="<?php echo $message['ID'];?>"><span></span>
              </label>
              <!--<span class="markstar"><i class="glyphicon glyphicon-star"></i></span>-->
            </div>
            <div class="media inbox-media" id="<?php echo $message['ID'];?>">
            <?php if($message['sender_member_type'] == 1){
                  $tblname = 'tbl_admin';
                  $pic = 'profile_pic';
                }else if($message['sender_member_type'] == 2){
                  $tblname = 'tbl_partners';
                  $pic = 'profile_pic';
                }else{
                  $tblname = 'tbl_clients';
                  $pic = 'logo';
                }
                $senderInfos = getNameById($tblname,$message['sender']);
                foreach($senderInfos as $senderInfo){?>
                  <div class="media-left">
                    <img class="media-object img-circle" src="<?php if($data['profile_pic'] == ""){ echo '../assets/images/photos/sampleUserImage.png'; } else{ echo '../view/images/'.$senderInfo[$pic]; }?>" alt="">
                  </div>
                  <div class="media-body">
                    <span class="pull-right"><?php $date = date_create($senderInfo['created_at']);
                              echo date_format($date,"d M, Y");?></span>
                    <h5 class="media-heading">
                      <?php if($senderInfo['receiver_member_type'] == 1){
                        echo $senderInfo['name'];
                      }else{
                        echo "Admin";
                      }?>
                    </h5>
                  </div>
                <?php }?>
              <p><?php echo $message['subject'];?></p>
            </div>
          </div>
        </div>
      <?php }?>

    </div><!-- emailcontent -->

    <div class="contentpanel emailpanel">
      <h3 class="nomail">No mail selected</h3>
      <div class="mailcontent hide">
        
      </div><!-- mailcontent -->
    </div><!-- contentpanel -->

  </div><!-- mainpanel -->
  <div class="modal bounceIn animated message-form"  id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<?php include 'footer.php';?>