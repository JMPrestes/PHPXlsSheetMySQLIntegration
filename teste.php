<?php

require_once('vendor/autoload.php');
$fileName="/var/www/html/Jordan/Procedural/_crud/planilha-25-09-2019.xls";
$objPHPExcel = PHPExcel_IOFactory::load($fileName);
$objWriterCSV = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
$objWriterCSV->setExcelCompatibility(true);
$objWriterCSV->save(str_replace('.php', '.csv', __FILE__));
$file_name= basename(__FILE__, '.php').'.csv';
$path = "/var/www/html/Jordan/Procedural/_crud/".$file_name ;

/*$excelReader = PHPExcel_IOFactory::createReaderForFile($fileName);
$excelReader->setLoadAllSheets();
$excelObj = $excelReader->load($fileName);
$excelObj->getActiveSheet()->toArray(null,true,true,true);
$worksheetNames = $excelObj->getSheetNames($fileName);
$return = array();
foreach($worksheetNames as $key => $sheetName){  
    //define a aba ativa
    $excelObj->setActiveSheetIndexByName($sheetName);
    //cria um array com o nome da aba como índice
    $return[$sheetName] = $excelObj->getActiveSheet()->toArray(null,true,true,true);
}
//exibe o array
$data=$return;

try {
    $csvwriter = new BasicExcel\Writer\Csv(); //or \Xls || \Xlsx
    $csvwriter->fromArray($data);
    //$csvwriter->writeFile('myfilename.csv');
    //OR
    $csvwriter->download('myfilename.csv');
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

