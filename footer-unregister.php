<script src="assets/lib/jquery/jquery.js"></script>
<script src="assets/lib/bootstrap/js/bootstrap.js"></script>
<script src="assets/lib/select2/select2.js"></script>
<script src="assets/lib/jquery-validate/jquery.validate.js"></script>

<script>
jQuery(function() {
  jQuery("select.form-control").select2({ minimumResultsForSearch: Infinity });
});

jQuery(document).ready(function(){

  'use strict';

  // Basic Form
  jQuery('form').validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });
});
</script>

</body>
</html>
