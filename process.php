<?php

	require 'config.php';
	// require 'class/Logger.class.php';	
	
	require 'class/DbCDRHandler.class.php';
	require 'class/DbQStatHandler.class.php';
	require 'functions.php';

	$taskId = (int)$_POST['form-id'];
	
	switch($taskId) { 
	    case 1:  $output = task1($_POST); break;
	    case 2:  $output = task2($_POST); break;
	    case 3:  $output = task3($_POST); break;
	    case 4:  $output = task4($_POST); break;
	    case 5:  $output = task5($_POST); break;
		default: $output = '<p style="color:red;">Failed to get params</p>';
	}	
	
require 'include/header.php';



?>


<div class="main-header pricing-header px-3 py-3 pt-md-4 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Результат</h1>
  <a id="exls-export" href="" class="btn btn-close btn-success">Выгрузить в Excel</a>	
  <div class="success-msg"></div>
</div>

<div class="container result">
	<?= $output; ?>
</div>	


<?php require 'include/footer.php'; ?>

<script>
$(document).ready(function() {
	
	$('#exls-export').click(function() {
		
		var task      = $('#interval').data('task');
		var startDate = $('#interval-start-date').text();
		var endDate   = $('#interval-end-date').text();

		var params = { 
			'task'      : task,
			'startDate' : startDate,
			'endDate'   : endDate			
		};
		
		$.ajax({
			type: 'POST',
			url: 'savexlsx.php',
			data: params, 
			// dataType: "json",
			success: function(data){
				$('.success-msg').animate({'opacity':'1'}, 1000);
				$('.success-msg').html(data);
				setTimeout(function() {
					$('.success-msg').animate({'opacity':'0'}, 500);
				}, 7000)
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status); alert(thrownError); 
			},
		});
		
		
		// console.log(redirectUrl);		
		return false;
		
	});	
	
});



</script>












	