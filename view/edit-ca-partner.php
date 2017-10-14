<?php include '../controller/functions.php';?>
<?php $id = $_GET['partnerid'];
      $datas = getSinglePartnerData($id);
      echo json_encode($datas); ?> 