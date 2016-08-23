@if ($errors->has())
	<div class="alert alert-danger text-center" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Error:</span>
		{{ $errors->first(); }}
	</div>
@endif
@if (Session::has('error'))
	<div class="alert alert-danger text-center" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Error:</span>
		{{ Session::get('error') }}
	</div>	
@endif
@if (Session::has('message'))
	<div class="alert alert-success text-center" role="alert">
		<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
		<span class="sr-only">Error:</span>
		{{ Session::get('message') }}
	</div>
@endif