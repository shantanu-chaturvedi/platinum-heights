</section>
<?php include "controller/allJsFiles.php";?>
</body>

<script type="text/javascript">

jQuery(document).ready(function(){

  'use strict';

  // jQuery(document.getElementById('fb-template')).formBuilder();

  // HTML5 WYSIWYG Editor
  // jQuery('#wysiwyg').wysihtml5({
  //   toolbar: {
  //     fa: true
  //   }
  // });

  jQuery('#example').DataTable({
      "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ]
  });

jQuery('#members').DataTable({
      "scrollX": true
  });

  // Summernote
  // jQuery('#wysiwyg').summernote({
  //   height: 200
  // });

  jQuery('#form1').validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });


   // Select2 Box
  jQuery('#select1, #select2, #select3').select2();
  jQuery("#select4").select2({ maximumSelectionLength: 2 });
  jQuery("#select5").select2({ minimumResultsForSearch: Infinity });
  jQuery("#select6, #select7, #select8, #select9").select2({ tags: true });

  // Date Picker
  jQuery('#datepicker-dob').datepicker({
    dateFormat: 'yy-mm-dd'
  });
  jQuery('#datepicker-doa').datepicker({
    dateFormat: 'yy-mm-dd'
  });

  // Textarea Auto Resize
  // autosize(jQuery('#autosize'));


  // Toggles
  jQuery('.toggle').toggles({
    on: true,
    height: 26
  });

  // Input Masks
  // jQuery("#date").mask("99/99/9999");
  // jQuery("#phone").mask("(999) 999-9999");
  // jQuery("#ssn").mask("999-99-9999");

  // Time Picker
  // jQuery('#tpBasic').timepicker();
  // jQuery('#tp2').timepicker({'scrollDefault': 'now'});
  // jQuery('#tp3').timepicker();

  // jQuery('#setTimeButton').on('click', function (){
  //   jQuery('#tp3').timepicker('setTime', new Date());
  // });

  // Colorpicker
  // jQuery('#colorpicker1').colorpicker();
  // jQuery('#colorpicker2').colorpicker({
  //   customClass: 'colorpicker-lg',
  //   sliders: {
  //     saturation: {
  //       maxLeft: 200,
  //       maxTop: 200
  //     },
  //     hue: { maxTop: 200 },
  //     alpha: { maxTop: 200 }
  //   }
  // });

  

});
</script>

</html>