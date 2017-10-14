<?php include 'header.php';
$adminNames = getNames('tbl_admin');
$caNames = getNames('tbl_partners');
$clientNames = getNames('tbl_clients');
$messageDetails = getMessageDetail($_GET['id']);?>
  
  <div class="mainpanel">
    <div class="contentpanel">
      
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Forward Message</h4>
        </div>
        <div class="panel-body">
          <form role="form" method="post" id="forwardMessage">
            <?php foreach($messageDetails as $messageDetail){?>
              <select id="select6" name="receiver" class="form-control" style="width: 100%" data-placeholder="Send To..." multiple>
                <optgroup label="Admins">
                  <?php foreach($adminNames as $adminName){?>
                  <option value="<?php echo '1-'.$adminName['ID'];?>"><?php echo $adminName['name']?></option>
                  <?php }?>
                </optgroup>
                <optgroup label="CA Partners">
                  <?php foreach($caNames as $caName){?>
                  <option value="<?php echo '2-'.$caName['ID'];?>"><?php echo $caName['name']?></option>
                  <?php }?>
                </optgroup>
                <optgroup label="Clients">
                  <?php foreach($clientNames as $clientName){?>
                  <option value="<?php echo '3-'.$clientName['ID'];?>"><?php echo $clientName['contact_person']?></option>
                  <?php }?>
                </optgroup>
              </select>
              <br clear="all" />
              <br clear="all" />
              <input type="text" name="subject" value="<?php echo $messageDetail['subject'];?>" placeholder="Subject" class="form-control">
              <input type="hidden" name="senderMemberType" value="<?php echo $messageDetail['receiver_member_type'];?>">
              <br clear="all" />
              <textarea id="summernote" name="message" placeholder="Enter message here..." class="form-control" rows="10"><?php echo $messageDetail['message'];?></textarea>
              <br clear="all" />
              <input type="checkbox" value="1" name="sendMail">Send this message in Mail
              <br clear="all" />
              <p>
                <button  type="submit" class="btn btn-default btn-quirk pull-right">Send Message</button>
              </p>
            <?php }?>
          </form>
        </div>
      </div>
    </div>
    <!-- contentpanel --> 
  </div>
  <!-- mainpanel --> 
<?php include 'footer.php';?>