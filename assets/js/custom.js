jQuery(document).ready(function(){
  // jQuery( ".table-responsive" ).append( "<a class='dt-button' href='functions.php?memberSheetdownload'><span>PDF</span></a>" );
     if(localStorage.getItem("addStatus")){
          confirmMemberAddAlert();
          localStorage.clear();
     }
     if(localStorage.getItem("editStatus")){
          confirmMemberEditAlert();
          localStorage.clear();
     }
     if(localStorage.getItem("deleteStatus")){
          confirmMemberDeleteAlert();
          localStorage.clear();
     }
});

/*delete member*/
function deleteMember(deletedID){
    if (confirm("Are you sure?") == true) {
        jQuery.ajax({
            url: "functions.php?deleteMember",
            type: "POST",
            data: {memberId:deletedID},
            success: function(response){
                localStorage.setItem("deleteStatus","confirm");
                window.location.reload(); 
            }
        });
    }
}

jQuery(document).on('submit','#addMember', function(e){
    e.preventDefault();
    var postData = jQuery(this).serializeArray();
    jQuery.ajax({
        url: "functions.php?addMember",
        type: "POST",
        data: postData,
        success: function(response){
            localStorage.setItem("addStatus","confirm");
            window.location.reload(); 
        }
    });
});

jQuery(document).on('submit','#editMember', function(e){
    e.preventDefault();
    var postData = jQuery(this).serializeArray();
    jQuery.ajax({
        url: "functions.php?editMember",
        type: "POST",
        data: postData,
        success: function(response){
            localStorage.setItem("editStatus","confirm");
            window.location.reload(); 
        }
    });
});

function confirmMemberAddAlert(){
    jQuery.gritter.add({
      title: 'Successfully Added',
      text: 'This user is Successfully added..!',
      class_name: 'with-icon check-circle success'
    });
}

function confirmMemberEditAlert(){
    jQuery.gritter.add({
      title: 'Successfully Edited',
      text: 'This user is Successfully edited..!',
      class_name: 'with-icon check-circle success'
    });
}

function confirmMemberDeleteAlert(){
    jQuery.gritter.add({
      title: 'Successfully Deleted',
      text: 'This user is Successfully deleted..!',
      class_name: 'with-icon check-circle success'
    });
}