<?php

require 'config.php';
require 'class/DbCDRHandler.class.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\{Font, Border, Alignment};

	$spreadsheet = new Spreadsheet();
	$sheet = $spreadsheet->getActiveSheet();
	
	$sheet->getColumnDimension('B')->setWidth(50);
	$sheet->getColumnDimension('C')->setWidth(50);
	$sheet->getStyle('A1:C1')->getFill()->getStartColor()->setARGB('cccccc');
	
	$sheet->getStyle('A1:C1')->applyFromArray([
		'font' => [
			'name' => 'Arial',
			'bold' => true,
		],
		'borders' => [
			'allBorders' => [
				'borderStyle' => Border::BORDER_THIN,
			],
		],
		'alignment' => [
			'horizontal' => Alignment::HORIZONTAL_CENTER,
			'vertical' => Alignment::VERTICAL_CENTER,
			'wrapText' => true,
		]
	]);
	

	switch($_POST['task']) { 
	    case 'task1':  $output = saveXls1(); break;
	    case 'task2':  $output = saveXls2(); break;
	    case 'task3':  $output = saveXls3(); break;
	    case 'task4':  $output = saveXls4(); break;
	    case 'task5':  $output = saveXls5(); break;
		default: $output = '<p style="color:red;">Failed to get params</p>';
	}
	
	

function saveXls1() {

	$sql = "SELECT `dst`, COUNT(`src`) as `touches`
FROM `cdr`
WHERE LEFT(`dst`,9) = '781267002'
AND `calldate` > '".$_POST['start-date']."' AND `calldate` < '".$_POST['end-date']."' 
GROUP by `dst`";
		
	$res = DbCDRHandler::getAll($sql);	
	
	global $spreadsheet;
	global $sheet;
	
	$sheet->setCellValue('A1', '№ п/п');
	$sheet->setCellValue('B1', 'Телефонная линия');
	$sheet->setCellValue('C1', 'Кол-во звонков');

	$counter = 1;
		
	foreach($res as $resItem) {
		
		$sheet->setCellValue('A'.++$counter, $counter);
		$sheet->setCellValue('B'.$counter, $resItem['dst']);
		$sheet->setCellValue('C'.$counter, $resItem['touches']);		
		
	} 	

	$writer = new Xlsx($spreadsheet);
	$writer->save('Summary_'.preg_replace('/[ :]/ui', '_', $_POST['start-date']).'-'.preg_replace('/[ :]/ui', '_', $_POST['end-date']).'.xlsx'); 
	
	echo 'Xlsx document created successfully!';	
	
}

function saveXls2() {  
	
	$sql = "SELECT `dst`, COUNT(`dst`) AS `sum_calls` 
FROM `cdr` 
JOIN `extension_plan` ON `cdr`.`dst`=`extension_plan`.`number` 
WHERE `calldate` > '".$_POST['start-date']."' AND `calldate` < '".$_POST['end-date']."' 
GROUP BY `dst`";

	$res = DbCDRHandler::getAll($sql);
	
	global $spreadsheet;
	global $sheet;

	$counter = 1;
	
	$sheet->setCellValue('A1', '№ п/п');
	$sheet->setCellValue('B1', 'Телефонная линия');
	$sheet->setCellValue('C1', 'Кол-во звонков');
	
	foreach($res as $resItem) {
		
		$sheet->setCellValue('A'.++$counter, $counter);
		$sheet->setCellValue('B'.$counter, $resItem['dst']);
		$sheet->setCellValue('C'.$counter, $resItem['sum_calls']);		
		
	} 	

	$writer = new Xlsx($spreadsheet);
	$outfile = 'Summary_'.preg_replace('/[ :]/ui', '_', $_POST['start-date']).'-'.preg_replace('/[ :]/ui', '_', $_POST['end-date']).'.xlsx';
	
	$writer->save($outfile); 
	
	echo 'Документ Эксель создан успешно!';
	
}

function saveXls3() {
	
		$sql = "SELECT `queuename`, COUNT(`dst`) AS `sum_calls` 
FROM `cdr` 
JOIN `extension_plan` ON `cdr`.`dst`=`extension_plan`.`number` 
WHERE `calldate` > '".$_POST['start-date']."' AND `calldate` < '".$_POST['end-date']."' 
GROUP BY `queuename`";

	$res = DbCDRHandler::getAll($sql);
	
	global $spreadsheet;
	global $sheet;

	$counter = 0;
	
	$sheet->setCellValue('A1', '№ п/п');
	$sheet->setCellValue('B1', 'Очередь');
	$sheet->setCellValue('C1', 'Кол-во звонков');	
	
	foreach($res as $resItem) {
		
		$sheet->setCellValue('A'.++$counter, $counter);
		$sheet->setCellValue('B'.$counter, $resItem['queuename']);
		$sheet->setCellValue('C'.$counter, $resItem['sum_calls']);	
		
	} 	

	$writer = new Xlsx($spreadsheet);
	$writer->save('Summary_'.preg_replace('/[ :]/ui', '_', $_POST['start-date']).'-'.preg_replace('/[ :]/ui', '_', $_POST['end-date']).'.xlsx'); 
	
	echo 'Xlsx document created successfully!';	
	
}

function saveXls4() {
	
	$sql = "SELECT `src`, COUNT(`src`) AS `sum_calls` 
FROM `cdr` 
JOIN `extension_plan` ON `cdr`.`dst`=`extension_plan`.`number` 
WHERE `calldate` > '".$_POST['start-date']."' AND `calldate` < '".$_POST['end-date']."' AND `dst` = '".$params['number']."' AND `src` > 7 
GROUP BY `src`";
	
	$res = DbCDRHandler::getAll($sql);
	
	global $spreadsheet;
	global $sheet;

	$counter = 0;
	
	$sheet->setCellValue('A1', '№ п/п');
	$sheet->setCellValue('B1', 'Телефонная линия');
	$sheet->setCellValue('C1', 'Кол-во звонков');	
	
	foreach($res as $resItem) {
		
		$sheet->setCellValue('A'.++$counter, $counter);
		$sheet->setCellValue('B'.$counter, $resItem['src']);
		$sheet->setCellValue('C'.$counter, $resItem['sum_calls']);	
		
	} 	

	$writer = new Xlsx($spreadsheet);
	$writer->save('Summary_'.preg_replace('/[ :]/ui', '_', $_POST['start-date']).'-'.preg_replace('/[ :]/ui', '_', $_POST['end-date']).'.xlsx'); 
	
	echo 'Xlsx document created successfully!';		
	
}

function saveXls5() {
	
	$sql = "SELECT `src`, COUNT(`src`) AS `sum_calls` 
FROM `cdr` 
JOIN `extension_plan` ON `cdr`.`dst`=`extension_plan`.`number` 
WHERE `calldate` > '".$params['start-date']."' AND `calldate` < '".$params['end-date']."' AND `queuename` = '".$params['queuename']."' AND `src` > 7 
GROUP BY `src`";
	
	$res = DbCDRHandler::getAll($sql);	
	
	global $spreadsheet;
	global $sheet;

	$counter = 0;
	
	$sheet->setCellValue('A1', '№ п/п');
	$sheet->setCellValue('B1', 'Телефонная линия');
	$sheet->setCellValue('C1', 'Кол-во звонков');	
	
	foreach($res as $resItem) {
		
		$sheet->setCellValue('A'.++$counter, $counter);
		$sheet->setCellValue('B'.$counter, $resItem['src']);
		$sheet->setCellValue('C'.$counter, $resItem['sum_calls']);	
		
	} 	

	$writer = new Xlsx($spreadsheet);
	$writer->save('Summary_'.preg_replace('/[ :]/ui', '_', $_POST['start-date']).'-'.preg_replace('/[ :]/ui', '_', $_POST['end-date']).'.xlsx'); 
	
	echo 'Xlsx document created successfully!';		
	
	
}