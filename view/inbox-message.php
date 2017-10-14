<?php include '../controller/functions.php';
$id = $_GET['messageId'];
updateMessageRead($id);
$datas = getMessageDetail($id);

foreach ($datas as $data){?>
  <div class="mailcontent">
    <div class="email-header">

      <?php if($data['sender_member_type'] == 1){
          $tblname = 'tbl_admin';
            $pic = 'profile_pic';
          }else if($message['sender_member_type'] == 2){
            $tblname = 'tbl_partners';
            $pic = 'profile_pic';
          }else{
            $tblname = 'tbl_clients';
            $pic = 'logo';
          }
        $senderInfos = getNameById($tblname,$data['sender']);
        foreach($senderInfos as $senderInfo){?>

          <div class="pull-right">
           <?php $date = date_create($data['created_at']);
               echo date_format($date,"d M, Y");?>&nbsp;
            <div class="btn-group mr5">

            <?php $receiver_member_type = $data['receiver_member_type'];
            $sender_member_type = $data['sender_member_type'];
            $sender = $data['sender'];?>
              <?php if($_SESSION['logged_in_user_role'] == 1){ ?>
                <button class="btn btn-default" type="button" onClick="composeMessage('<?php echo $receiver_member_type?>','<?php echo $sender_member_type?>','<?php echo $sender?>','<?php echo $subject?>');"><i class="fa fa-reply"></i></button>
              <?php }else{?>
                <button class="btn btn-default" type="button"><a href="compose.php"><i class="fa fa-reply"></i></a></button>
              <?php }?>
              <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul role="menu" class="dropdown-menu dm-icon pull-right">
                <!--<li><a href="#"><i class="fa fa-reply-all"></i> Reply to All</a></li>-->
                <?php if($_SESSION['logged_in_user_role'] == 1){ ?>
                  <li><a href="forward-message.php?id=<?php echo $data['ID'];?>"><i class="fa fa-arrow-right"></i> Foward</a></li>
                <?php }?>
                <!--<li><a href="#"><i class="fa fa-print"></i> Print</a></li>
                <li><a href="#"><i class="fa fa-exclamation-triangle"></i> Report Spam</a></li>-->
                <li><a href="#" onClick="deleteSingleMessage(<?php echo $data['ID']?>)"><i class="fa fa-trash"></i> Delete Message</a></li>
              </ul>
            </div>

            <!--<div class="btn-group">
              <button class="btn btn-default" type="button"><i class="fa fa-angle-left"></i></button>
              <button class="btn btn-default" type="button"><i class="fa fa-angle-right"></i></button>
            </div>-->
          </div>
          <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object img-circle" src="<?php if($data['profile_pic'] == ""){ echo '../assets/images/photos/sampleUserImage.png'; } else{ echo '../view/images/'.$senderInfo[$pic]; }?>" alt="">
              </a>
            </div>
            <div class="media-body">
              <h4 class="media-heading">
                <?php if($message['sender_member_type'] == 1){
                  echo $senderInfo['name'];
                }else{
                  echo "Admin";
                }?>
              </h4>
            </div>
          </div><!-- media -->

      <?php }?>

    </div><!-- email-header -->

    <hr>

    <h3 class="email-subject"><?php echo $data['subject'];?> <!--<span class="markstar"><i class="glyphicon glyphicon-star"></i></span>--></h3>
    <div class="email-body">
      <p><?php echo $data['message'];?></p>
    </div>

    <br>
    <!--<hr>

    <h4 class="panel-title">Attachments:</h4>
    <ul class="list-unstyled list-attachments">
      <li><i class="fa fa-file-pdf-o"></i> <a href="">Template_Documentation.pdf</a></li>
      <li><i class="fa fa-file-pdf-o"></i> <a href="">Template_Documentation.pdf</a></li>
    </ul>

    <hr>-->

    <!--<div class="form-group email-editor">
      <div id="summernote">Reply</div>
    </div>
    <button class="btn btn-success">Send Message</button>
    <button class="btn btn-default">Save as Draft</button>

    <br><br>-->

  </div><!-- mailcontent -->
<?php }?>