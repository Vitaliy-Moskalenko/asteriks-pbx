<!DOCTYPE html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	  <!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"  /> 
	<link rel="stylesheet" type="text/css" href="css/dashboard.css"  /> 
	<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.min.css"/>
	<!-- MDBootstrap Datatables  -->
	<link rel="stylesheet" type="text/css" href="vendor/mdb/css/addons/datatables.min.css"  />
	<link rel="stylesheet" type="text/css" href="css/style.css"/>

</head>
<body>
	
<header>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
	<a class="navbar-brand p-3" href="<?= SITE_NAME ?>">PBX Statistics viewer</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarCollapse">
		<ul class="navbar-nav mr-auto ml-auto">
			<li class="nav-item active">
				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item ml-5">
				<a class="nav-link" href="#">Help</a>
			</li>
			<li class="nav-item ml-5">
				<a class="nav-link" href="#">About</a>
			</li>
		</ul>
		<form class="form-inline mt-2 mt-md-0">
			<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form>
	</div>
</nav>
</header>