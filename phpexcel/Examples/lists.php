<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

require("../../connect.php");
 
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


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
            ->setCellValue('F1', 'extracoach')
            ->setCellValue('G1', 'date');

$objPHPExcel->getActiveSheet()->setTitle('Logs');
            
$row = 2;

$query = mysql_query("SELECT * FROM `players`");

while($log = mysql_fetch_assoc($query)){
      
      $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$row, $log['id'])
            ->setCellValue('B'.$row, $log['userid'])
            ->setCellValue('C'.$row, $log['gymid'])
            ->setCellValue('D'.$row, $log['boys'])
            ->setCellValue('E'.$row, $log['girls'])
            ->setCellValue('F'.$row, $log['extracoach'])
            ->setCellValue('G'.$row, $log['date']);

      $row++;
            
}

$objWorkSheet = $objPHPExcel->createSheet();

$objWorkSheet->setTitle('SFO-Skoler');

//  Attach the newly-cloned sheet to the $objPHPExcel workbook


$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A1', 'id')
            ->setCellValue('B1', 'name')
            ->setCellValue('C1', 'address')
            ->setCellValue('D1', 'area');

$row = 2;

$query = mysql_query("SELECT * FROM `gyms`");

while($sfo = mysql_fetch_assoc($query)){
      
      $objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A'.$row, $sfo['id'])
            ->setCellValue('B'.$row, $sfo['name'])
            ->setCellValue('C'.$row, $sfo['address'])
            ->setCellValue('D'.$row, $sfo['area']);

      $row++;
            
}

$objWorkSheet = $objPHPExcel->createSheet();

$objWorkSheet->setTitle('Brugere');

//  Attach the newly-cloned sheet to the $objPHPExcel workbook


$objPHPExcel->setActiveSheetIndex(2)
            ->setCellValue('A1', 'id')
            ->setCellValue('B1', 'username')
            ->setCellValue('C1', 'name')
            ->setCellValue('D1', 'email')
            ->setCellValue('E1', 'access')
            ;

$row = 2;

$query = mysql_query("SELECT * FROM `users`");

while($sfo = mysql_fetch_assoc($query)){
      
      $objPHPExcel->setActiveSheetIndex(2)
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
