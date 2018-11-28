<?php

require("connect.php");

      /** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/Copenhagen');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/phpexcel/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("SFOBasket")
							 ->setLastModifiedBy("SFOBasket")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("SFOBasket");



$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'id')
            ->setCellValue('B1', 'userid')
            ->setCellValue('C1', 'gymid')
            ->setCellValue('D1', 'boys')
            ->setCellValue('E1', 'girls')
            ->setCellValue('F1', 'class')
            ->setCellValue('G1', 'date')
            ->setCellValue('H1', 'length')
            ->setCellValue('I1', 'day')
            ->setCellValue('J1', 'month')
            ->setCellValue('K1', 'year');

$objPHPExcel->getActiveSheet()->setTitle('Skoletræningslogs');
            
$row = 2;

$query = mysqli_query($GLOBALS['link'],"SELECT * FROM `players`");

while($log = mysqli_fetch_assoc($query)){

      $datearray=explode("-",$log['date']);
      
      $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$row, $log['id'])
            ->setCellValue('B'.$row, $log['userid'])
            ->setCellValue('C'.$row, $log['gymid'])
            ->setCellValue('D'.$row, $log['boys'])
            ->setCellValue('E'.$row, $log['girls'])
            ->setCellValue('F'.$row, $log['class'])
            ->setCellValue('G'.$row, $log['date'])
            ->setCellValue('H'.$row, $log['length'])
            ->setCellValue('I'.$row, $datearray[2])
            ->setCellValue('J'.$row, $datearray[1])
            ->setCellValue('K'.$row, $datearray[0])
            ;

      $row++;
            
}

$objWorkSheet = $objPHPExcel->createSheet();

$objWorkSheet->setTitle('Klubtræningslogs');

$objPHPExcel->getActiveSheet(1)->setTitle('Klubtræningslogs');
           
$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A1', 'id')
            ->setCellValue('B1', 'userid')
            ->setCellValue('C1', 'locationid')
            ->setCellValue('D1', 'date')
            ->setCellValue('E1', 'length')
            ->setCellValue('F1', 'day')
            ->setCellValue('G1', 'month')
            ->setCellValue('H1', 'year');
		   
		   
$query = mysqli_query($GLOBALS['link'],"SELECT * FROM `clubplayers`");
$row = 2;
while($log = mysqli_fetch_assoc($query)){

      $datearray=explode("-",$log['date']);
      
      $objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A'.$row, $log['id'])
            ->setCellValue('B'.$row, $log['userid'])
            ->setCellValue('C'.$row, $log['locationid'])
            ->setCellValue('D'.$row, $log['date'])
            ->setCellValue('E'.$row, $log['length'])
            ->setCellValue('F'.$row, $datearray[2])
            ->setCellValue('G'.$row, $datearray[1])
            ->setCellValue('H'.$row, $datearray[0])
            ;

      $row++;
            
}


$objWorkSheet = $objPHPExcel->createSheet();

$objWorkSheet->setTitle('Grand Prix logs');

//$objPHPExcel->getActiveSheet(2)->setTitle('Grand Prix logs');
           
$objPHPExcel->setActiveSheetIndex(2)
            ->setCellValue('A1', 'id')
            ->setCellValue('B1', 'userid')
            ->setCellValue('C1', 'date')
            ->setCellValue('D1', 'day')
            ->setCellValue('E1', 'month')
            ->setCellValue('F1', 'year');
		   
		   
$query = mysqli_query($GLOBALS['link'],"SELECT * FROM `grandprixplayers`");
$row = 2;
while($log = mysqli_fetch_assoc($query)){

      $datearray=explode("-",$log['date']);
      
      $objPHPExcel->setActiveSheetIndex(2)
            ->setCellValue('A'.$row, $log['id'])
            ->setCellValue('B'.$row, $log['userid'])
            ->setCellValue('D'.$row, $log['date'])
            ->setCellValue('F'.$row, $datearray[2])
            ->setCellValue('G'.$row, $datearray[1])
            ->setCellValue('H'.$row, $datearray[0])
            ;

      $row++;
            
}


$objWorkSheet = $objPHPExcel->createSheet();

$objWorkSheet->setTitle('SFO-Skoler');

//  Attach the newly-cloned sheet to the $objPHPExcel workbook


$objPHPExcel->setActiveSheetIndex(3)
            ->setCellValue('A1', 'id')
            ->setCellValue('B1', 'name')
            ->setCellValue('C1', 'address')
            ->setCellValue('D1', 'area');


$query = mysqli_query($GLOBALS['link'],"SELECT * FROM `gyms`");
$row = 2;
while($sfo = mysqli_fetch_assoc($query)){
      
      $objPHPExcel->setActiveSheetIndex(3)
            ->setCellValue('A'.$row, $sfo['id'])
            ->setCellValue('B'.$row, $sfo['name'])
            ->setCellValue('C'.$row, $sfo['address'])
            ->setCellValue('D'.$row, $sfo['area']);

      $row++;
            
}

$objWorkSheet = $objPHPExcel->createSheet();

$objWorkSheet->setTitle('Afdelinger');

//  Attach the newly-cloned sheet to the $objPHPExcel workbook


$objPHPExcel->setActiveSheetIndex(4)
            ->setCellValue('A1', 'id')
            ->setCellValue('B1', 'name');


$query = mysqli_query($GLOBALS['link'],"SELECT * FROM `locations`");
$row = 2;
while($location = mysqli_fetch_assoc($query)){
      
      $objPHPExcel->setActiveSheetIndex(4)
            ->setCellValue('A'.$row, $location['id'])
            ->setCellValue('B'.$row, $location['name']);

      $row++;
            
}

$objWorkSheet = $objPHPExcel->createSheet();

$objWorkSheet->setTitle('Brugere');

//  Attach the newly-cloned sheet to the $objPHPExcel workbook


$objPHPExcel->setActiveSheetIndex(5)
            ->setCellValue('A1', 'id')
            ->setCellValue('B1', 'username')
            ->setCellValue('C1', 'name')
            ->setCellValue('D1', 'email')
            ->setCellValue('E1', 'access')
            ;

$query = mysqli_query($GLOBALS['link'],"SELECT * FROM `users`");
$row = 2;
while($sfo = mysqli_fetch_assoc($query)){
      
      $objPHPExcel->setActiveSheetIndex(5)
            ->setCellValue('A'.$row, $sfo['id'])
            ->setCellValue('B'.$row, $sfo['username'])
            ->setCellValue('C'.$row, $sfo['name'])
            ->setCellValue('D'.$row, $sfo['email'])
            ->setCellValue('E'.$row, $sfo['access'])
            ;

      $row++;
            
}


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="SFOLogs.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>
