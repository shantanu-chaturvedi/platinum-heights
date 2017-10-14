<?php include '../controller/functions.php';?>
<?php $id = $_GET['clientid'];
      $datas = getSingleClientData($id); 
      echo json_encode($datas); ?>