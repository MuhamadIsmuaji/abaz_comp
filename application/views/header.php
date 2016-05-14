<!DOCTYPE html>
<html>
<head>
	<title>Abaz Comp | <?= $judul ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- css libs -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dataTables.bootstrap.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/jquery.dataTables.min.css') ?>">

	<!-- Javascript Libs -->
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/dataTables.bootstrap.min.js') ?>"></script>
	
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
	    	<div class="navbar-header">
	      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        	<span class="sr-only">Toggle navigation</span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	      	</button>
	      	<a class="navbar-brand" href="#">AbazComp</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    	<ul class="nav navbar-nav navbar-right">
	        	<li><a href="<?= base_url('admin/barang') ?>">Data Barang</a></li>
	        	<li class="dropdown">
	          		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">	Hallo <?= $this->session->userdata('username') ?> 
	          			<span class="caret"></span>
	          		</a>
		          	<ul class="dropdown-menu">
			            <li><a href="#">Profil</a></li>
			            <li><a href="<?= base_url('login/logout') ?>">Logout</a></li>
		          	</ul>
	        	</li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>