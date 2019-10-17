<?php

	require 'config.php';
	require 'init.php';	
	require 'include/header.php';
	
		// echo '<pre>'; exit(var_dump($res));

?>

<div class="main-header pricing-header px-3 py-3 pt-md-4 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Статистика PBX</h1>
  <h2>Отчет по звонкам, данные из таблицы CDR</h2>
</div>

<div class="container">
  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Количество уникальных абонентов за период</h4>
      </div>
      <div class="card-body">
        <h4 class="card-title pricing-card-title"><small class="text-muted">на выходе 1 цифра.</small></h4>
        <ul class="list-unstyled mt-3 mb-4">
          <li>выбор очереди по выпадающему списку</li>
          <li>выбор периода в календаре</li>
        </ul>
        <button id="btn-run-1" type="button" class="btn btn-lg btn-block btn-primary">Выбрать</button>
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Суммарное количество звонков по линиям за период <!-- Количество звонков от уникальных абонентов --></h4>
      </div>
      <div class="card-body">
        <h4 class="card-title pricing-card-title"><small class="text-muted">на выходе список с возможностью выгрузки в ексель</small></h4>
        <ul class="list-unstyled mt-3 mb-4">
          <li>сколько раз каждый абонент позвонил за период</li>
        </ul>
        <button id="btn-run-2" type="button" class="btn btn-lg btn-block btn-primary">Выбрать</button>
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Суммарное количество звонков по очередям за период <!-- Количество уникальных абонентов по статусам --></h4>
      </div>
      <div class="card-body">
        <h4 class="card-title pricing-card-title"><small class="text-muted">на выходе список с возможностью выгрузки в ексель</small></h4>
        <ul class="list-unstyled mt-3 mb-4">
          <li>сколько раз каждый абонент позвонил по статусам (answer, noanswer)</li>
        </ul>
        <button id="btn-run-3" type="button" class="btn btn-lg btn-block btn-primary">Выбрать</button>
      </div>
    </div>
  </div>
</div> <!-- /container -->  

<div class="pricing-header px-3 py-3 pt-md-4 pb-md-4 mx-auto text-center">
  <h2>Отчет по агентам, данные из таблиц agent_log и CDR</h2>
</div>

<div class="container">
  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Количество отработанного агентом времени</h4>
      </div>
      <div class="card-body">
        <h4 class="card-title pricing-card-title"><small class="text-muted">на выходе данные в формате времени</small></h4>
        <button id="btn-run-4" type="button" class="btn btn-lg btn-block btn-primary">Выбрать</button>
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Время разговоров агентов за выбранный период</h4>
      </div>
      <div class="card-body">
        <h4 class="card-title pricing-card-title"><small class="text-muted">на выходе данные в формате времени</small></h4>
        <button  id="btn-run-5" type="button" class="btn btn-lg btn-block btn-primary">Выбрать</button>
      </div>
    </div>
  </div>
</div> <!-- /container --> 

<?php require 'include/footer.php'; ?>


<div class="reveal">
	<div class="close close-btn">x</div>
	<h3>Введите данные</h3>	
	<br/>
	
	<form class="reveal-form" method="POST" action="process.php">

		<input type="hidden" name="form-id" value="undef" />
		
		<div class="row">
			<!-- <div class="form-group col-sm-4">
				<label for="queue-select">Очередь</label>
				<select class="form-control" id="queue-select" name="queue">
					<option>testqueue</option>
					<option>mainqueue</option>
					<option>alcoqueue</option>
					<option>rentgen</option>
					<option>director</option>
					<option>itdep</option>
					<option>dep7</option>
					<option>depcont</option>
					<option>oks</option>
					<option>func_diag</option>
					<option>kadry</option>
					<option>neirohirurg</option>
					<option>NONE</option>
				</select>	
			</div> -->
	
			<div class="form-group col-sm-6">
				<label for="start-date">Дата начала</label>
				<input class="form-control start-date" type="text" name="start-date" required>
			</div>
		
			<div class="form-group col-sm-6">
				<label for="end-date">Дада окончания</label>
				<input class="form-control end-date" type="text" name="end-date" required>
			</div>
		</div>			
		
		<br/>
				
		<button type="submit" class="btn btn-run btn-success">Понеслась!</button>
		<button type="button" class="btn btn-close btn-secondary">Закрыть</button>		
	</form>
</div>

<div class="reveal2">
	<div class="close close-btn">x</div>
	<h3>Введите данные</h3>	
	<br/>
	
	<form class="reveal-form" method="POST" action="process.php">

		<input type="hidden" name="form-id" value="undef" />
		
		<div class="row">
			<div class="form-group col-sm-4">
				<label for="queue-select">Номер</label>
				<select class="form-control" id="queue-select" name="number">
					<?php
					
						foreach($res as $r)
							echo '<option>'.$r['number'].'</option>';
							
					?>
				</select>	
			</div>
	
			<div class="form-group col-sm-4">
				<label for="start-date">Дата начала</label>
				<input class="form-control start-date" type="text" name="start-date" required>
			</div>
		
			<div class="form-group col-sm-4">
				<label for="end-date">Дада окончания</label>
				<input class="form-control end-date" type="text" name="end-date" required>
			</div>
		</div>			
		
		<br/>
				
		<button type="submit" class="btn btn-run btn-success">Понеслась!</button>
		<button type="button" class="btn btn-close btn-secondary">Закрыть</button>		
	</form>
</div>

<div class="reveal3">
	<div class="close close-btn">x</div>
	<h3>Введите данные</h3>	
	<br/>
	
	<form class="reveal-form" method="POST" action="process.php">

		<input type="hidden" name="form-id" value="undef" />
		
		<div class="row">
			<div class="form-group col-sm-4">
				<label for="queue-select">Очередь</label>
				<select class="form-control" id="queue-select" name="queuename">
					<?php
					
						foreach($res2 as $r)
							echo '<option>'.$r['queuename'].'</option>';
							
					?>
				</select>	
			</div>
	
			<div class="form-group col-sm-4">
				<label for="start-date">Дата начала</label>
				<input class="form-control start-date" type="text" name="start-date" required>
			</div>
		
			<div class="form-group col-sm-4">
				<label for="end-date">Дада окончания</label>
				<input class="form-control end-date" type="text" name="end-date" required>
			</div>
		</div>			
		
		<br/>
				
		<button type="submit" class="btn btn-run btn-success">Понеслась!</button>
		<button type="button" class="btn btn-close btn-secondary">Закрыть</button>		
	</form>
</div>