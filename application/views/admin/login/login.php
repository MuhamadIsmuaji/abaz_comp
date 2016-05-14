<!DOCTYPE html>
<html>
<head>
	<title>Abaz Comp | Login Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css') ?>">

	 <!-- Javascript Libs -->
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>

</head>
<body>
	<div class="container">
		<div class="row" style="margin-top: 150px;">
			<div class="col-md-6 col-md-offset-3" style="text-align: center;">
				<h2><strong>Abaz Comp</strong></h2>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row" style="margin-top: 20px;">
			<div class="col-md-6 col-md-offset-3">
				<?php 
					if ( $errorLogin ) {
				?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">
								&times;</span>
							</button>
							<strong>Login Gagal !</strong> Pastikan Username dan Password sudah benar.
						</div>
				<?php 
					}
				?>
				<form action="<?= base_url('login') ?>" method="POST">
					<div class="form-group">
						<label for="username">Username</label>
				    	<input type="text" class="form-control" name="username" placeholder="Username">
				  	</div>
				  	<div class="form-group">
						<label for="username">Password</label>
				    	<input type="password" class="form-control" name="password" placeholder="Password">
				  	</div>
				 	
				  	<button type="submit" class="btn btn-primary btn-block">
				  		<strong>Login</strong>
				  	</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>