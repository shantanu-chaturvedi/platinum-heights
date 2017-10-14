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
    body {
    margin: 0; 
    padding: 0
}
html, 
body, 
#map {
    height: 100%; 
    font-family: Arial, sans-serif; 
    font-size: .9em; 
    color: #fff;
}
#note { 
    text-align: center;
    padding: .3em; 10px; 
    background: #009ee0; 
}
.bool {
    font-style: italic;
    color: #313131;
}
.info {
    display: inline-block;
    width: 40%;
    text-align: center;
}
.infowin {
    color: #313131;
}
#title,
.bool{
    font-weight: bold;
}

</style>
<script>

window.onload = function init() {
    var
        contentCenter = '<span class="infowin">Center Marker (draggable)</span>',
        <?php foreach($locations as $location){  
            if($i==$count){ ?>
                content<?php echo $i?> = '<span class="infowin">Marker A (draggable)</span>';
            <?php }else {?>
                content<?php echo $i?> = '<span class="infowin">Marker A (draggable)</span>',
            <?php } $i++; }?>
    var
        latLngCenter = new google.maps.LatLng(28.47,75.04),
        latLngCMarker = new google.maps.LatLng(28.6139391, 77.20902120000005),

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7,
            center: latLngCenter,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false
        }),
        markerCenter = new google.maps.Marker({
            position: latLngCMarker,
            title: 'Location',
            map: map,
            draggable: true
        }),

        infoCenter = new google.maps.InfoWindow({
            content: contentCenter
        }),

        <?php $i= 1; foreach($locations as $location){  ?>
            latLng<?php echo $i?> = new google.maps.LatLng(<?php echo $location['latitude'].','.$location['longitude']?>),

            marker<?php echo $i?> = new google.maps.Marker({
                position: latLng<?php echo $i?>,
                title: 'Location',
                map: map,
                draggable: false
            }),

            info<?php echo $i?> = new google.maps.InfoWindow({
                content: content<?php echo $i?>
            }),
        <?php $i++; }?>

        circle = new google.maps.Circle({
            map: map,
            clickable: false,
            // metres
            radius: 100000,
            fillColor: '#fff',
            fillOpacity: .6,
            strokeColor: '#313131',
            strokeOpacity: .4,
            strokeWeight: .8
        });
    // attach circle to marker
    circle.bindTo('center', markerCenter, 'position');

    var
    // get the Bounds of the circle
    bounds = circle.getBounds()
    // Note spans
    ,
        <?php $i=1; foreach($locations as $location){  
            if($i==$count){ ?>
                note<?php echo $i?> = jQuery('.bool#a<?php echo $i?>'),
            <?php }else {?>
                note<?php echo $i?> = jQuery('.bool#a<?php echo $i?>');
            <?php } $i++; }?>

    <?php $i= 1; foreach($locations as $location){  ?>
        note<?php echo $i?>.text(bounds.contains(latLng<?php echo $i?>));
    <?php $i++; }?>

    // get some latLng object and Question if it's contained in the circle:
    google.maps.event.addListener(markerCenter, 'dragend', function() {
        latLngCenter = new google.maps.LatLng(markerCenter.position.lat(), markerCenter.position.lng());
        bounds = circle.getBounds();
        <?php $i= 1; foreach($locations as $location){  ?>
            note<?php echo $i?>.text(bounds.contains(latLng<?php echo $i?>));
            console.log(bounds.contains(latLng<?php echo $i?>));
        <?php $i++; }?>
    });

    <?php $i= 1; foreach($locations as $location){  ?>
        google.maps.event.addListener(marker<?php echo $i?>, 'dragend', function() {
            latLng<?php echo $i?> = new google.maps.LatLng(marker<?php echo $i?>.position.lat(), marker<?php echo $i?>.position.lng());
            note<?php echo $i?>.text(bounds.contains(latLng<?php echo $i?>));
            console.log(bounds.contains(latLng<?php echo $i?>));
        });
    <?php $i++; }?>

    google.maps.event.addListener(markerCenter, 'click', function() {
        infoCenter.open(map, markerCenter);
    });

    <?php $i= 1; foreach($locations as $location){  ?>
        google.maps.event.addListener(marker<?php echo $i?>, 'click', function() {
            info<?php echo $i?>.open(map, marker<?php echo $i?>);
        });
    <?php $i++; }?>

    google.maps.event.addListener(markerCenter, 'drag', function() {
        infoCenter.close();
        <?php $i= 1; foreach($locations as $location){  ?>
            note<?php echo $i?>.html("draggin&hellip;");
        <?php $i++; }?>
    });

    <?php $i= 1; foreach($locations as $location){  ?>
        google.maps.event.addListener(marker<?php echo $i?>, 'drag', function() {
            info<?php echo $i?>.close();
            note<?php echo $i?>.html("draggin&hellip;");
        });
    <?php $i++; }?>
};

</script>
</head>

<body>
<div id="note"><span id="title">&raquo;Inside the circle?&laquo;</span><hr />
    <?php $i = 1; foreach($locations as $location){  
            if($i==$count){ ?>
                <span class="info">Marker <strong><?php echo $i?></strong>: <span id="<?php echo "a".$i?>" class="bool"></span></span> &larr;&diams;&rarr; 
            <?php }else {?>
                <span class="info">Marker <strong><?php echo $i?></strong>: <span id="<?php echo "a".$i?>" class="bool"></span></span>
            <?php } $i++; }?>
    
    </div>
<div id="map">test</div>
</body>

</html>

