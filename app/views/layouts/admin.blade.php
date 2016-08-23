<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="expires" content="0" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Geniisys - Admin</title>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/index.css" rel="stylesheet">
	</head>
	<body>
		
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="navbar-header">
				<a class="navbar-brand" href="http://cpi-genweb.com.ph/admin">GEN<span>ii</span>SYS</a>
			</div><!--navbar-header-->
			<div class="collapse navbar-collapse navbar-right">
      			<ul class="nav navbar-nav">
        			<li>{{ HTML::link('admin', 'Home') }}</li>
        			<li>{{ HTML::link('user', 'Manage User') }}</li>
        			<li>{{ HTML::link('download', 'Manage Download') }}</li>
					<li>{{ HTML::link('news', 'Manage News') }}</li>
        			<li>{{ HTML::link('logout', 'Logout') }}</li>
      			</ul>
			</div><!--collapse navbar-collapse navbar-right"-->
		</nav>
		
		<div id='content'>
			@yield('content')
		</div><!--content-->
		
		<div class="panel-footer">
			&copy; 2014 Computer Professionals, Inc. &middot; All Rights Reserved.
		</div><!--panel-footer-->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    	<script src="../js/bootstrap.min.js"></script>
	</body>
</html>