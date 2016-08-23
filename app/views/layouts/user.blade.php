<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CPI</title>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/uindex.css" rel="stylesheet">
		@yield('head')
	</head>
	<body>
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="navbar-header">
				<a class="navbar-brand" href="user">
					 <img style="max-width:35px; margin-top: -7px;" src="../img/cpi1.png">
					CPI
				</a>
			</div><!--navbar-header-->
			<div class="collapse navbar-collapse navbar-left">
      			<ul class="nav navbar-nav">
        			<li>{{ HTML::link('user', 'Home') }}</li>
        			<li>{{ HTML::link('checkin', 'Check In') }}</li>
					<?php if(empty($approval)): ?>
        				<?php $approval = 0; ?>	
        			<?php endif; ?>
        			<?php if(empty($approval2)): ?>
        				<?php $approval2 = 0; ?>	
        			<?php endif; ?>
        			<?php if(empty($approval3)): ?>
        				<?php $approval3 = 0; ?>	
        			<?php endif; ?>
        			<!--
					<?php if(empty($approval4)): ?>
        				<?php $approval4 = 0; ?>	
        			<?php endif; ?>
        			<?php if(empty($approval5)): ?>
        				<?php $approval5 = 0; ?>	
        			<?php endif; ?>
					-->
        			@if($user->unithead == 1 || $user->qmr == 1 || $user->dcon == 1)
        				<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">For Approval<b class="caret"></b></a>
							<ul class="dropdown-menu dropdown-menu-left" role="menu">
								@if($user->unithead == 1)
            						<li><a href="{{ URL::to('/approval?link=1') }}">@if($approval > 0) {{"<span class=\"badge\">" . $approval . "</span>"}} @endif Unit Head</a></li>
	            				@endif
	            				@if($user->qmr == 1)
            						<li><a href="{{ URL::to('/approval?link=2') }}">@if($approval2 > 0) {{"<span class=\"badge\">" . $approval2 . "</span>"}} @endif QMR</a></li>
            					@endif
            					@if($user->dcon == 1)
            						<li><a href="{{ URL::to('/approval?link=3') }}">@if($approval3 > 0) {{"<span class=\"badge\">" . $approval3 . "</span>"}} @endif Document Controller</a></li>
            					@endif
            					<!--
								@if($user->drcap == 1)
            						<li><a href="{{ URL::to('/approval?link=4') }}">@if($approval4 > 0) {{"<span class=\"badge\">" . $approval4 . "</span>"}} @endif DRC Approver</a></li>
            					@endif
            					@if($user->drcad == 1)
            						<li><a href="{{ URL::to('/approval?link=5') }}">@if($approval5 > 0) {{"<span class=\"badge\">" . $approval5 . "</span>"}} @endif DRC Admin(Final)</a></li>
            					@endif
								-->
            				</ul>
            			</li>
            			<li>{{ HTML::link('report', 'Reports') }}</li>
            		@endif
        			<li>{{ HTML::link('status', 'History') }}</li>
        			@if($user->user == 1)
        				<li>{{ HTML::link('maintenance', 'Maintenance') }}</li>
        			@endif
      			</ul>
      			{{ Form::open(array('route' => 'search.store', 'class'=>'navbar-form navbar-left', 'role'=>'search')) }}
					<div class="form-group">
						<div class="input-group">
							{{ Form::text('search', '', array('class' => 'form-control input-sm', 'placeholder' => 'Search')) }}
							<span class="input-group-btn">
								<button type="submit" class="btn btn-default input-sm">
									<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
								</button>
							</span>
						</div>
					</div>
				{{ Form::close() }}
			</div><!--collapse navbar-collapse navbar-left"-->
			<div class="collapse navbar-collapse navbar-right">
				<form class="navbar-form navbar-right">
				</form>	
				<ul class="nav navbar-nav">
					<li>{{ HTML::link('logout', 'Logout') }}</li>
				</ul>
				<?php if(!empty($user->firstname) && !empty($user->lastname)): ?>
     				<p class="navbar-text navbar-right"><small>Signed in as {{ $user->firstname . "." }}</small></p>
     			<?php endif; ?>
			</div><!--collapse navbar-collapse navbar-right"-->
		</nav>
		<div id='content' style="min-height: 610px" >
			@yield('content')
		</div><!--content-->
		
		<div class="panel-footer">
			&copy; 2014 Computer Professionals, Inc. &middot; All Rights Reserved.
		</div><!--panel-footer-->	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    	<script src="../js/bootstrap.min.js"></script>
    	@yield('script')
	</body>
</html>