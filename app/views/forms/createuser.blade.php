{{ Form::open(array('route' => 'maintenance.store', 'class'=>'form-horizontal', 'role'=>'form')) }}
	{{ Form::hidden('action', 'createUser') }}
	<div class="form-group">
		{{ Form::label('username', 'User Name', array('class' => 'col-sm-3 control-label input-sm')) }}
		<div class="col-sm-9 @if ($errors->has('username')) has-error @endif">
			{{ Form::text('username', '', array('class' => 'form-control input-sm')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('password', 'Password', array('class' => 'col-sm-3 control-label input-sm')) }}
		<div class="col-sm-9 @if ($errors->has('password')) has-error @endif">
			{{ Form::password('password', array('class' => 'form-control input-sm')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('firstName', 'First Name', array('class' => 'col-sm-3 control-label input-sm')) }}
		<div class="col-sm-9 @if ($errors->has('firstName')) has-error @endif">
			{{ Form::text('firstName', '', array('class' => 'form-control input-sm')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('lastName', 'Last Name', array('class' => 'col-sm-3 control-label input-sm')) }}
		<div class="col-sm-9 @if ($errors->has('lastName')) has-error @endif">
			{{ Form::text('lastName', '', array('class' => 'form-control input-sm')) }}
		</div>
	</div>	
	<div class="form-group">
		{{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label input-sm')) }}
		<div class="col-sm-9 @if ($errors->has('email')) has-error @endif">
			{{ Form::text('email', '', array('class' => 'form-control input-sm')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('checkbox', 'Privileges', array('class' => 'col-sm-3 control-label input-sm')) }}
		<div class="col-sm-9">
			{{ Form::checkbox('privileges[]', 'admin') }} Admin &nbsp;&nbsp;&nbsp;&nbsp;
			{{ Form::checkbox('privileges[]', 'unitHead') }} Unit Head &nbsp;&nbsp;&nbsp;&nbsp;
			{{ Form::checkbox('privileges[]', 'qmr') }} QMR &nbsp;&nbsp;&nbsp;&nbsp;
			{{ Form::checkbox('privileges[]', 'dc') }} Document Controller
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12 text-center">
			{{ Form::submit('Create User', array('class' => 'btn btn-primary input-sm')) }}
		</div>
	</div>
{{ Form::close() }}