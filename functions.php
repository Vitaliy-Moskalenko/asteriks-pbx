<?php 

// $logger = Logger::get_logger( realpath(dirname(__FILE__)) );

function task1($params = null) {

	$sql = "SELECT `dst`, COUNT(`src`) as `touches`
FROM `cdr`
WHERE LEFT(`dst`,9) = '781267002'
AND `calldate` > '".$params['start-date']."' AND `calldate` < '".$params['end-date']."' 
GROUP by `dst`";
	
	// 1. SELECT `dst`, COUNT(`src`) as `touches` FROM `cdr` WHERE LEFT(`dst`,9) = '781267002' GROUP by `dst` AND date запрос на получение кол-ва уникальных за период группа по всем линииям!
    // 2. SELECT `src` , COUNT(`src`) AS `touches` FROM `cdr` WHERE `dst` = '78126700220' AND LENGTH(`src`) > 6 GROUP BY `src` Запрос на получение количества звонков от каждого абонента по выбранной 
		
	$res = DbCDRHandler::getAll($sql);
	
	$out = '<table class="table table-striped"><thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Dst</th>
      <th scope="col">Touches</th>
    </tr></thead>';
	
	$counter = 0;	
	
	foreach($res as $resItem) {
		$out .= '<tr><th scope="row">'.++$counter.'</th>';
		
		$out .= '<td>'.$resItem['dst'].'</td>';
		$out .= '<td>'.$resItem['touches'].'</td>';
		
		$out .= '</tr>';
	} 
	
	$out .= '</table>';
	
	return $out;
}


function task2($params = null) {	
	
	$sql = "SELECT `dst`, COUNT(`dst`) AS `sum_calls` 
FROM `cdr` 
JOIN `extension_plan` ON `cdr`.`dst`=`extension_plan`.`number` 
WHERE `calldate` > '".$params['start-date']."' AND `calldate` < '".$params['end-date']."' 
GROUP BY `dst`";

	$res = DbCDRHandler::getAll($sql);
	
	$out = '<table class="table table-striped"><thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Dst</th>
      <th scope="col">Sum Calls</th>
    </tr></thead>';
	
	// exit(var_dump($res));
	
	$counter = 0;	
	
	foreach($res as $resItem) {
		$out .= '<tr><th scope="row">'.++$counter.'</th>';
		
		$out .= '<td>'.$resItem['dst'].'</td>';
		$out .= '<td>'.$resItem['sum_calls'].'</td>';
		
		$out .= '</tr>';
	} 
	
	$out .= '</table>';
	
	return $out;

}


function task3($params = null) {
	
	$sql = "SELECT `queuename`, COUNT(`dst`) AS `sum_calls` 
FROM `cdr` 
JOIN `extension_plan` ON `cdr`.`dst`=`extension_plan`.`number` 
WHERE `calldate` > '".$params['start-date']."' AND `calldate` < '".$params['end-date']."' 
GROUP BY `queuename`";

	$res = DbCDRHandler::getAll($sql);
	
	$out = '<table class="table table-striped"><thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">queuename</th>
      <th scope="col">Sum Calls</th>
    </tr></thead>';
	
	// exit(var_dump($res));
	
	$counter = 0;	
	
	foreach($res as $resItem) {
		$out .= '<tr><th scope="row">'.++$counter.'</th>';
		
		$out .= '<td>'.$resItem['queuename'].'</td>';
		$out .= '<td>'.$resItem['sum_calls'].'</td>';
		
		$out .= '</tr>';
	} 
	
	$out .= '</table>';
	
	return $out;	
	
}

function task4($params = null) {
	
	$sql = "SELECT `src`, COUNT(`src`) AS `sum_calls` 
FROM `cdr` 
JOIN `extension_plan` ON `cdr`.`dst`=`extension_plan`.`number` 
WHERE `calldate` > '".$params['start-date']."' AND `calldate` < '".$params['end-date']."' AND `dst` = '".$params['number']."' AND `src` > 7 
GROUP BY `src`";
	
	$res = DbCDRHandler::getAll($sql);
	
	$out = '<table class="table table-striped"><thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">src</th>
      <th scope="col">Sum Calls</th>
    </tr></thead>';
	
	$counter = 0;	
	
	foreach($res as $resItem) {
		$out .= '<tr><th scope="row">'.++$counter.'</th>';
		
		$out .= '<td>'.$resItem['src'].'</td>';
		$out .= '<td>'.$resItem['sum_calls'].'</td>';
		
		$out .= '</tr>';
	} 
	
	$out .= '</table>';
	
	return $out;	
	
}

function task5($params = null) {    // echo '<pre>'; exit(var_dump($params));    

	$sql = "SELECT `src`, COUNT(`src`) AS `sum_calls` 
FROM `cdr` 
JOIN `extension_plan` ON `cdr`.`dst`=`extension_plan`.`number` 
WHERE `calldate` > '".$params['start-date']."' AND `calldate` < '".$params['end-date']."' AND `queuename` = '".$params['queuename']."' AND `src` > 7 
GROUP BY `src`";


	
	$res = DbCDRHandler::getAll($sql);
	
	// echo '<pre>'; exit(var_dump($res));
	
	$out = '<table class="table table-striped"><thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">src</th>
      <th scope="col">Sum Calls</th>
    </tr></thead>';
	
	$counter = 0;	
	
	foreach($res as $resItem) {
		$out .= '<tr><th scope="row">'.++$counter.'</th>';
		
		$out .= '<td>'.$resItem['src'].'</td>';
		$out .= '<td>'.$resItem['sum_calls'].'</td>';
		
		$out .= '</tr>';
	} 
	
	$out .= '</table>';
	
	return $out;		
	
}


function getTestResult($params = null) {
	
	$fd = fopen("table_example.log", 'r') or die("Failed to open file!");
	while(!feof($fd)) 
		$testRes[] = htmlentities(fgets($fd));
    
	fclose($fd);	
	
	$res = '<table class="table table-striped"><thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
    </tr></thead>';
	
	$counter = 0;

	foreach($testRes as $row) {
		
		$rowArr = explode("|", $row);
		
		$res .= '<tr><th scope="row">'.++$counter.'</th>';
			
		$res .= '<td>'.$rowArr[0].'</td>';
		$res .= '<td>'.$rowArr[1].'</td>';
			
		$res .= '</tr>';
	}	
	
	$res .= '</table>';
	
	return $res;
	
}














