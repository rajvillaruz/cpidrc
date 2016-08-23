<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CPI</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/login.css" rel="stylesheet">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/login.css" rel="stylesheet">
	</head>
	<body>
	<div class="wrapper">
		<div class="row">
			<div class="col-sm-12">
				<img src="img/cpi.png" alt="..." class="img-responsive center-block">
			</div>	
		</div>
		<br/>
		<br/>
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<h4>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<strong>SIGN IN</strong>
				</h4>
			</div>
			<div class="col-sm-3"></div>
		</div>
		<br/>
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				{{ Form::open(array('route' => 'sessions.store', 'class'=>'form-horizontal', 'role'=>'form')) }}
					<div class="form-group">
						{{ Form::label('username', 'Username: ', array('class' => 'col-sm-3 control-label')) }}
						<div class="col-sm-9">
							{{ Form::text('username', '', array('class' => 'form-control')) }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('password', 'Password: ', array('class' => 'col-sm-3 control-label')) }}
						<div class="col-sm-9">
							{{ Form::password('password', array('class' => 'form-control')) }}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<div class="checkbox">
								<label>
									<input type="checkbox"> Remember me
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
						</div>
						<div class="col-sm-9">
							<p class="text-warning" align="center">
								{{ $errors->first(); }}
								@if (Session::has('message'))
									{{ Session::get('message') }}
								@endif
							</p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							{{ Form::submit('Sign In', array('class' => 'btn btn-primary')) }}
						</div>
					</div>
				{{ Form::close() }}
			</div>
			<div class="col-sm-4"></div>
		</div>
		<br/>
		<div class="push"></div><!--For footer to stay at bottom.-->
	</div>
		<div class="footer">
			 <hr/>v1.02 &middot; &copy; 2014 Computer Professionals, Inc. &middot; All Rights Reserved.
		</div><!--panel-footer-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    	<script src="js/bootstrap.min.js"></script>
    	<script src="../js/bootstrap.min.js"></script>
	</body>
</html>