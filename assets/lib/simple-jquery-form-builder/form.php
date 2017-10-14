<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Simple jQuery Form Builder - Demo</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- CSS -->
    <link href="style.css" rel="stylesheet" type="text/css" />

    <!-- Jquery JS -->
    <script src="../../lib/jquery/jquery.js"></script> <!-- jQuery v1 should also work fine -->

    <!-- SJFB JS -->
    <script src="js/sjfb-html-generator.js" type="text/javascript" ></script> <!-- form generator -->
</head>

<body id="sjfb-body">

<script type="text/javascript">
//On document ready
$(function(){

    //load saved form by ID
    var formID = 1;
    generateForm(formID);

    //Don't allow the sample preview form to be submitted
    $("#sjfb-sample").on("submit", function() {
        event.preventDefault();
        alert('Made it! You can now process your submission however you would like.')
    });

});
</script>


<div id="sjfb-wrap">

    <form id="sjfb-sample">
        <div id="sjfb-fields">
        </div>
        <button type="submit" class="submit">Submit</button>
    </form>

</div>

</body>
</html>

 <script type="text/javascript">generateForm(29);</script>