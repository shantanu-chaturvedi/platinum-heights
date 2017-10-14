<?php include '../controller/functions.php';?>
<?php $id = $_GET['videoid'];
$datas = getSingleVideoData($id); 
echo json_encode($datas); ?>
