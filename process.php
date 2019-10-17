<?php

	require 'config.php';
	require 'class/Logger.class.php';	
	
	require 'class/DbCDRHandler.class.php';
	require 'class/DbQStatHandler.class.php';
	require 'functions.php';

	$output = 'Start processing..';
	$taskId = (int)$_POST['form-id'];

	
	switch($taskId) { 
	    case 1:  $output = task1($_POST); break;
	    case 2:  $output = task2($_POST); break;
	    case 3:  $output = task3($_POST); break;
	    case 4:  $output = task4($_POST); break;
	    case 5:  $output = task5($_POST); break;
		default: $output = '<p style="color:red;">Failed to get params</p>';
	}	
	
	// TEST CASE
	// $output = getTestResult($_POST);
	
	
	
require 'include/header.php'; ?>


<div class="main-header pricing-header px-3 py-3 pt-md-4 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Результат</h1>
  <a href="" class="btn btn-close btn-success">Выгрузить в Excel</a>	
</div>

<div class="container result">
	<?= $output; ?>
</div>	


<?php require 'include/footer.php'; ?>

	