<?php

	require 'class/DbCDRHandler.class.php';

	$sql = "SELECT `number` FROM `extension_plan` WHERE 1";
	$res = DbCDRHandler::getAll($sql);
	
	$sql2 = "SELECT `queuename` FROM `extension_plan` WHERE 1 GROUP BY `queuename`";
	$res2 = DbCDRHandler::getAll($sql2);
	
	// echo '<pre>'; exit(var_dump($res2));
	
	
	