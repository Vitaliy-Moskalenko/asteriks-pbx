<?php 

function task1($params = null) {

	$sql = "SELECT `dst`, COUNT(`src`) as `touches`
FROM `cdr`
WHERE LEFT(`dst`,9) = '781267002'
AND `calldate` > '".$params['start-date']."' AND `calldate` < '".$params['end-date']."' 
GROUP by `dst`";
		
	$res = DbCDRHandler::getAll($sql);
	
	$out = '<div class="pricing-header px-3 py-3 pt-md-4 pb-md-4 mx-auto text-center" data-task="task1" id="interval">
				<span id="interval-start-date">'.$params['start-date'].'</span> - 
				<span id="interval-end-date">'.$params['end-date'].'</span>
			</div>
	<table id="result-table" class="table table-striped table-bordered table-sm"><thead>
    <tr>
      <th scope="col">№ п/п</th>
      <th scope="col">Телефонная линия</th>
      <th scope="col">Кол-во звонков</th>
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
	
	$out = '<div class="pricing-header px-3 py-3 pt-md-4 pb-md-4 mx-auto text-center" data-task="task2" id="interval">
				<span id="interval-start-date">'.$params['start-date'].'</span> - 
				<span id="interval-end-date">'.$params['end-date'].'</span>
			</div>
	<table id="result-table" class="table table-striped table-bordered table-sm"><thead>
    <tr>
      <th scope="col">№ п/п</th>
      <th scope="col">Телефонная линия</th>
      <th scope="col">Количество звонков</th>
    </tr></thead>';
	
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
	
	$out = '<div class="pricing-header px-3 py-3 pt-md-4 pb-md-4 mx-auto text-center" data-task="task3" id="interval">
				<span id="interval-start-date">'.$params['start-date'].'</span> - 
				<span id="interval-end-date">'.$params['end-date'].'</span>
			</div>
	<table id="result-table" class="table table-striped table-bordered table-sm"><thead>
    <tr>
      <th scope="col">№ п/п</th>
      <th scope="col">Очередь</th>
      <th scope="col">Количество звонков</th>
    </tr></thead>';
	
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

function task4($params = null) {  // exit(var_dump($params));

	$res = DbCDRHandler::callProcedure('worktime_agent');
	
	exit(var_dump($res));
	
	$sql = "SELECT `src`, COUNT(`src`) AS `sum_calls` 
FROM `cdr` 
JOIN `extension_plan` ON `cdr`.`dst`=`extension_plan`.`number` 
WHERE `calldate` > '".$params['start-date']."' AND `calldate` < '".$params['end-date']."' AND `dst` = '".$params['number']."' AND `src` > 7 
GROUP BY `src`";
	
	// $res = DbCDRHandler::getAll($sql);
	
	$out = '<div class="pricing-header px-3 py-3 pt-md-4 pb-md-4 mx-auto text-center" data-task="task4" id="interval">
				<span id="interval-start-date">'.$params['start-date'].'</span> - 
				<span id="interval-end-date">'.$params['end-date'].'</span>
			</div>
	<table id="result-table" class="table table-striped table-bordered table-sm"><thead>
    <tr>
      <th scope="col">№ п/п</th>
      <th scope="col">Источник</th>
      <th scope="col">Количество звонков</th>
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

function task5($params = null) {   

	$sql = "SELECT `src`, COUNT(`src`) AS `sum_calls` 
FROM `cdr` 
JOIN `extension_plan` ON `cdr`.`dst`=`extension_plan`.`number` 
WHERE `calldate` > '".$params['start-date']."' AND `calldate` < '".$params['end-date']."' AND `queuename` = '".$params['queuename']."' AND `src` > 7 
GROUP BY `src`";
	
	$res = DbCDRHandler::getAll($sql);
	
	$out = '<div class="pricing-header px-3 py-3 pt-md-4 pb-md-4 mx-auto text-center" data-task="task5" id="interval">
				<span id="interval-start-date">'.$params['start-date'].'</span> - 
				<span id="interval-end-date">'.$params['end-date'].'</span>
			</div>
	<table id="result-table" class="table table-striped table-bordered table-sm"><thead>
    <tr>
      <th scope="col">№ п/п</th>
      <th scope="col">Источник</th>
      <th scope="col">Количество звонков</th>
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
      <th scope="col">№ п/п</th>
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














