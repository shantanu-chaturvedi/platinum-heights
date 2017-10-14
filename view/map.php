<?php include "../controller/functions.php";?>
<!DOCTYPE html>
<html>
<head>
<script src="../assets/lib/jquery/jquery.js"></script> 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIigOOE1opODrI2zck-D39fRUISaVjWAM&sensor=false"></script>
<script src="../assets/js/google-map.js"></script> 
<?php $locations = getLatLong('tbl_partners');
$count = count($locations);
$i=1;
foreach($locations as $location){
}?>

<style type="text/css">

html, 
body, 
#map {
    height: 90%; 
}
</style>
<script>

window.onload = function init() {
    var geocoder = new google.maps.Geocoder();

    var address = jQuery('#search-address').val();
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == 'OK') {
            var 
                resultLatLong = jQuery.trim(results[0].geometry.location);
                withoutBracketLatLng = resultLatLong.substr(1, resultLatLong.length-2);
                splitLatLng = withoutBracketLatLng.split(",");
        
                latLngCenter = new google.maps.LatLng(splitLatLng[0], splitLatLng[1]),
                latLngCMarker = new google.maps.LatLng(splitLatLng[0], splitLatLng[1]),

                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: latLngCenter,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: true
                }),

                markerCenter = new google.maps.Marker({
                    position: latLngCMarker,
                    title: 'Location',
                    map: map,
                    draggable: true
                }),

                <?php $i= 1; foreach($locations as $location){  ?>
                	latLng<?php echo $i?> = new google.maps.LatLng(<?php echo $location['latitude'].','.$location['longitude']?>),

        	        marker<?php echo $i?> = new google.maps.Marker({
        	            position: latLng<?php echo $i?>,
        	            title: <?php echo '"'.$location['location'].'"'?>,
        	            map: map,
        	            draggable: true
        	        }),
        	        
        		<?php $i++; }?>

                circle = new google.maps.Circle({
                    map: map,
                    clickable: false,
                    // metres
                    radius: 15000,
                    fillColor: '#fff',
                    fillOpacity: .6,
                    strokeColor: '#313131',
                    strokeOpacity: .4,
                    strokeWeight: .8,
                    draggable: true,
                    geodesic: true
                });

                circle.bindTo('center', markerCenter, 'position');

                var bounds = circle.getBounds();

                google.maps.event.addListener(markerCenter, 'dragend', function() {
                    latLngCenter = new google.maps.LatLng(markerCenter.position.lat(), markerCenter.position.lng());
                    bounds = circle.getBounds();
                });

                <?php $i= 1; foreach($locations as $location){  ?>

                    google.maps.event.addListener(marker<?php echo $i?>, 'dragend', function() {
                        latLng<?php echo $i?> = new google.maps.LatLng(marker<?php echo $i?>.position.lat(), marker<?php echo $i?>.position.lng());
                    });

                <?php $i++; }?>

            	<?php $i= 1; foreach($locations as $location){  ?>
            	   console.log(bounds.contains(latLng<?php echo $i?>));
                <?php $i++; }?>

        }
    });

};

</script>
</head>

<body>
    <div id="map">test</div>
    <form method="POST">
        <input type="text" id="search-address" name="location" value="New Delhi">
        <input type="submit" name="submit" value="Search">
    </form>

</body>

</html>

