<?php 
// error_reporting(0);

// require_once "phpexcel-master/Classes/PHPExcel.php";
// $tmpfname = "projectAttachments/locations-ccd.xlsx";
        

// $objReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
// $objReader->setReadDataOnly(true);

// $objPHPExcel = $objReader->load($tmpfname );
// $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

// for ($row = 1; $row <= $highestRow; $row++) {
//     $cell = $objPHPExcel->setActiveSheetIndex(0)->getCell("A".$row);
//     echo $cell->getValue();
// }

echo date('m/d/Y', strtotime('-5 days', strtotime('09/09/2016')));




